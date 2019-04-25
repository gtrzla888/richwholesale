<template>
  <v-card>
    <v-card-title class="grey lighten-4">
      <v-layout row wrap align-end>
        <v-flex xs12 sm3 d-flex  offset-sm9>
          <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            outline
            hide-details
          ></v-text-field>
        </v-flex>
        <v-flex xs12 sm3 d-flex>
          <v-select
            :items="companies"
            v-model="company"
            item-text="name"
            item-value="id"
            outline
            label="Company Name (Select)"
            class="mx-3"
            clearable
          ></v-select>
        </v-flex>

        <v-flex xs12 sm3  d-flex offset-sm6>
          <v-select
            :items="dates"
            v-model="createdAt"
            item-text="text"
            item-value="value"
            outline
            class="mx-3"
            label="Date Filter"
            clearable
          ></v-select>
        </v-flex>
      </v-layout>
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
                  <v-list-tile-title >Create Custom Quote</v-list-tile-title>
                </v-list-tile>
                <v-list-tile @click="remove(props.item)">
                  <v-list-tile-title >Remove</v-list-tile-title>
                </v-list-tile>
                <v-list-tile @click="edit(props.item)">
                  <v-list-tile-title >Edit</v-list-tile-title>
                </v-list-tile>
              </v-list>
            </v-menu>
          </td>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
  import axios from 'axios'
  import moment from 'moment'
  export default {
    data () {
      return {
        search: '',
        headers: [
          {
            text: 'Order #',
            align: 'left',
            sortable: false,
            value: 'id'
          },
          { text: 'Company', value: 'company.name' },
          { text: 'PO / Reference', value: 'po_reference' },
          { text: 'Last modifired', value: 'updated_at' },
          { text: 'Statue', value: 'status' },
          { text: 'Order Date', value: 'created_at' },
          { text: 'Actions', value: 'actions'}
        ],
        quotes: [],
        companies: [],
        company: '',
        createdAt: '',
        dates: [
          {
            'value': moment().add(-30, 'days').format('YYYY-MM-DD'),
            'text': 'Last 30 days'
          }
        ],
      }
    },
    name: 'home-view',
    metaInfo () {
      //return { title: this.$t('Orders') }
    },
    methods: {
      async loadQuotes() {
        const { data } = await axios.get('/api/quotes')
        this.quotes = data;
      },
      async loadCompanies() {
        const { data } = await axios.get('/api/user/companies')
        this.companies = data;
      },
      createCustomerQuote() {

      },
      edit() {

      },
      remove() {

      }
    },
    watch: {
      company() {
        this.loadQuotes()
      },
      createdAt() {
        this.loadQuotes()
      }
    },
    created () {
      this.loadQuotes();
      this.loadCompanies()
    }
  }
</script>
