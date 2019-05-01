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
          <h3 class="headline mb-0">{{ $t('Quotes') }}</h3>
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
              <td class="text-xs-left">{{ props.item.company.name }}</td>
              <td class="text-xs-left">{{ props.item.po_reference }}</td>
              <td class="text-xs-left">{{ props.item.updated_at }}</td>
              <td class="text-xs-left">{{ props.item.status }}</td>
              <td class="text-xs-left">{{ props.item.created_at }}</td>
              <td class="text-xs-center">
                <v-menu offset-x left bottom>
                  <v-btn
                    icon
                    slot="activator">
                    <v-icon>more_vert</v-icon>
                  </v-btn>
                  <v-list>
                    <v-list-tile @click="createCustomerQuote(props.item)">
                      <v-list-tile-title>Create Custom Quote</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile @click="remove(props.item)">
                      <v-list-tile-title>Remove</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile @click="edit(props.item)">
                      <v-list-tile-title>Edit</v-list-tile-title>
                    </v-list-tile>
                  </v-list>
                </v-menu>
              </td>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-flex>

    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">Create customer quote</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm6 md6>
                <v-text-field label="Fixed markup*" required v-model="fixedMarkup"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-text-field label="Percentage markup" required v-model="percentageMarkup"></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" flat @click="onCreateCustomerQuote()">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
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
            text: 'Quote #',
            align: 'left',
            sortable: false,
            value: 'id',
          },
          { text: 'Company', value: 'company.name' },
          { text: 'PO / Reference', value: 'po_reference' },
          { text: 'Last modifired', value: 'updated_at' },
          { text: 'Status', value: 'status' },
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
      return { title: this.$t('Quotes') }
    },
    methods: {
      async loadQuotes () {
        try {
          const { data } = await axios.get('/api/quotes', { params: { company: this.company, created_at: this.createdAt }})
          this.quotes = data
        } catch (e) {
        }
      },
      async loadCompanies () {
        try {
          const { data } = await axios.get('/api/user/companies')
          this.companies = data
        } catch (e) {
        }
      },
      createCustomerQuote (quote) {
        this.dialog = true
        this.selectedQuoteId = quote.id
      },
      edit (quote) {
          this.selectedQuoteId = quote.id
          this.$store.dispatch('fetchOrder', {id: quote.id})
          this.$route.push('home');
      },
      remove () {

      },
      async onCreateCustomerQuote() {
        try {
          this.dialog = false;
          await axios.post('api/quotes/' + this.selectedQuoteId + '/customer-quotes', {
            fixed_markup: this.fixedMarkup, percentage_markup: this.percentageMarkup
          })
        } catch (e) {
        }
      }
    },
    watch: {
      company () {
        this.loadQuotes()
      },
      createdAt () {
        this.loadQuotes()
      },
    },
    created () {
      this.loadQuotes()
      this.loadCompanies()
    },
  }
</script>
