<template>
  <v-layout row wrap align-center>
    <v-flex xs9></v-flex>
    <v-flex xs3>
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        outline
        hide-details
      ></v-text-field>
    </v-flex>

    <v-flex xs4>
      <v-select
        :items="companies"
        v-model="company"
        item-text="name"
        item-value="id"
        outline
        label="Company Name (Select)"
        clearable
      ></v-select>
    </v-flex>
    <v-flex xs5></v-flex>
    <v-flex xs3>
      <v-select
        :items="dates"
        v-model="createdAt"
        item-text="text"
        item-value="value"
        outline
        label="Date Filter"
        clearable
      ></v-select>
    </v-flex>

    <v-flex>
      <v-card>
        <v-card-title class="grey lighten-4">
          <h3 class="headline mb-0">{{ $t('Customer Quotes') }}</h3>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <v-data-table
            :headers="headers"
            :items="quotes"
            :search="search"
            class="elevation-1"
          >
            <template v-slot:items="props">
              <td>{{ props.item.id }}</td>
              <td class="text-xs-left">{{ props.item.quote.company.name }}</td>
              <td class="text-xs-left">{{ props.item.quote.customer_name }}</td>
              <td class="text-xs-left">{{ props.item.quote.po_reference }}</td>
              <td class="text-xs-left">{{ props.item.updated_at }}</td>
              <td class="text-xs-left">{{ props.item.status }}</td>
              <td class="text-xs-left">
                  <v-edit-dialog
                  :return-value.sync="props.item.fixed_markup"
                  large
                  lazy
                  @save="updateFixedMarkup(props.item)"
                >
                  {{ props.item.fixed_markup }}
                  <v-text-field
                    slot="input"
                    v-model="props.item.fixed_markup"
                    label="Fixed Markup"
                    single-line
                    autofocus
                  ></v-text-field>
                </v-edit-dialog>
            </td>
              <td class="text-xs-left">
                <v-edit-dialog
                  :return-value.sync="props.item.percentage_markup"
                  large
                  lazy
                  @save="updatePercentageMarkup(props.item)"
                >
               {{ props.item.percentage_markup }}
                  <v-text-field
                    slot="input"
                    v-model="props.item.percentage_markup"
                    label="Percentage Markup"
                    single-line
                    autofocus
                  ></v-text-field>
                </v-edit-dialog>
             </td>
              <td class="text-xs-left">{{ props.item.created_at }}</td>
              <td class="text-xs-center">
                <v-menu offset-x left bottom>
                  <v-btn
                    icon
                    slot="activator">
                    <v-icon>more_vert</v-icon>
                  </v-btn>
                  <v-list>
                    <v-list-tile @click="remove(props.item, props.index)">
                      <v-list-tile-title>Remove</v-list-tile-title>
                    </v-list-tile>
                  </v-list>
                </v-menu>
              </td>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-flex>

  </v-layout>
</template>

<script>
  import axios from 'axios'
  import moment from 'moment'
  import { async } from 'q';

  export default {
    data () {
      return {
        dialog: false,
        search: '',
        fixedMarkup: '',
        percentageMarkup: '',
        headers: [
          {
            text: 'Customer Quote #',
            align: 'left',
            sortable: false,
            value: 'id',
          },
          { text: 'Company', value: 'company.name' },
          { text: 'Customer Name', value: 'customer_name' },
          { text: 'PO / Reference', value: 'po_reference' },
          { text: 'Last modifired', value: 'updated_at' },
          { text: 'Status', value: 'status' },
          { text: 'Fixed Markup', value: 'fixed_markup'},
          { text: 'Percentage Markup', value: 'percentage_markup'},
          { text: 'Order Date', value: 'created_at' },
          { text: 'Actions', value: 'actions' },
        ],
        quotes: [],
        companies: [],
        company: '',
        createdAt: '',
        selectedQuoteId: '',
        dates: [
          {
            'value': moment().add(-30, 'days').format('YYYY-MM-DD'),
            'text': 'Last 30 days',
          },
        ],
      }
    },
    name: 'home-view',
    metaInfo () {
      //return { title: this.$t('Orders') }
    },
    methods: {
      async loadCustomerQuotes () {
        const { data } = await axios.get('/api/customer-quotes', { params: { company: this.company, created_at: this.createdAt } })
        this.quotes = data
      },
      async loadCompanies () {
        const { data } = await axios.get('/api/user/companies')
        this.companies = data
      },

      async updateFixedMarkup (customerQuote) {
        try {
          const { data } = await axios.put('/api/customer-quotes/' + customerQuote.id, { fixed_markup: customerQuote.fixed_markup })
          this.$store.dispatch('responseMessage', {
            type: 'success',
            text: this.$t('Customer Quote updated')
          })
        } catch(e) {
        }
      },
      async updatePercentageMarkup (customerQuote) {
        try {
            const { data } = await axios.put('/api/customer-quotes/' + customerQuote.id, { percentage_markup: customerQuote.percentage_markup })
            this.$store.dispatch('responseMessage', {
            type: 'success',
            text: this.$t('Customer Quote updated')
          })
        } catch(e) {
        }
      },
      async remove (customerQuote, index) {
        try {
          await axios.delete('/api/customer-quotes/' + customerQuote.id)
          this.quotes.splice(index, 1)
          this.$store.dispatch('responseMessage', {
            type: 'success',
            text: this.$t('Customer Quote Deleted')
          })
        } catch (e) {
        }
   
      },
    },
    watch: {
      company () {
        this.loadCustomerQuotes()
      },
      createdAt () {
        this.loadCustomerQuotes()
      },
    },
    created () {
      this.loadCustomerQuotes()
      this.loadCompanies()
    },
  }
</script>
