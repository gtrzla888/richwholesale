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
        <v-card-title class="bg-dark">
          <h3 class="headline mb-0">{{ $t('Invoices') }}</h3>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <v-data-table
            :headers="headers"
            :items="invoices"
            :search="search"
            class="elevation-1"
          >
            <template v-slot:items="props">
              <td>{{ props.item.id }}</td>
              <td class="text-xs-left">{{ props.item.order.quote.company.name }}</td>
              <td class="text-xs-left">{{ props.item.order.quote.po_reference }}</td>
              <td class="text-xs-left">{{ props.item.updated_at }}</td>
              <td class="text-xs-left">
                <v-edit-dialog
                  :return-value.sync="props.item.status"
                  large
                  lazy
                  @save="saveStatus(props.item)"
                >
                  {{ props.item.status }}
                  <v-select
                    slot="input"
                    v-model="props.item.status"
                    :items="items"
                  ></v-select>
                </v-edit-dialog>
              </td>
              <td class="text-xs-left">{{ props.item.created_at }}</td>
              <td class="text-xs-left">
                <v-menu offset-x left bottom>
                  <v-btn
                    icon
                    slot="activator">
                    <v-icon>more_vert</v-icon>
                  </v-btn>
                  <v-list>
                    <v-list-tile @click="view(props.item)">
                      <v-list-tile-title>View</v-list-tile-title>
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

  export default {
    data () {
      return {
        search: '',
        items: ['Invoiced', 'Paid'],
        headers: [
          {
            text: 'Invoice #',
            align: 'left',
            sortable: false,
            value: 'id',
          },
          { text: 'Company', value: 'company.name' },
          { text: 'PO / Reference', value: 'po_reference' },
          { text: 'Last modifired', value: 'updated_at' },
          { text: 'Status', value: 'status' },
          { text: 'Order Date', value: 'created_at' },
          { text: 'Actions', value: 'actions',  sortable: false},
        ],
        invoices: [],
        companies: [],
        company: '',
        createdAt: '',
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
      return { title: this.$t('Invoices') }
    },
    methods: {
      async loadInvoices () {
        try {
          const { data } = await axios.get('/api/invoices', { params: { company: this.company, created_at: this.createdAt }})
          this.invoices = data
        } catch(e) {}

      },
      async loadCompanies () {
        try {
          const { data } = await axios.get('/api/user/companies')
          this.companies = data
        } catch (e) {
          
        }
      },
      async saveStatus (item) {
        try {
          const { data } = await axios.put('/api/invoices/' + item.id, { status: item.status })
          this.$store.dispatch('responseMessage', {
            type: 'success',
            text: this.$t('Invoice Updated')
          })
        } catch (e) {
        }
      },
    },
    watch: {
      company () {
        this.loadInvoices()
      },
      createdAt () {
        this.loadInvoices()
      },
    },
    created () {
      this.loadInvoices()
      this.loadCompanies()
    },
  }
</script>
