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
        <v-card-title>
          <h3 class="headline mb-0">{{ $t('Orders') }}</h3>
        </v-card-title>

        <v-card-text>
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="orders"
            :search="search"
            select-all
            class="elevation-1"
          >
            <template v-slot:items="props">
              <td>
                <v-checkbox
                  v-model="props.selected"
                  primary
                  hide-details
                ></v-checkbox>
              </td>
              <td>{{ props.item.id }}</td>
              <td class="text-xs-left">{{ props.item.quote.company.name }}</td>
              <td class="text-xs-left">{{ props.item.quote.po_reference }}</td>
              <td class="text-xs-left">{{ props.item.updated_at }}</td>
              <td class="text-xs-left">{{ props.item.total }}</td>
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
                <v-edit-dialog
                  :return-value.sync="props.item.eta"
                  lazy
                  large
                  @save="saveEta(props.item)"
                >
                  {{ props.item.eta }}
                  <template v-slot:input>
                    <v-date-picker
                      :value="today"
                      v-model="props.item.eta"
                      :landscape="true"
                    >
                    </v-date-picker>
                  </template>
                </v-edit-dialog>
              </td>
            </template>
            <v-alert v-slot:no-results :value="true" color="error" icon="warning">
              Your search for "{{ search }}" found no results.
            </v-alert>
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
        selected: [],
        items: ['Completed', 'Confirmed', 'Manufactoring'],
        search: '',
        status: '',
        headers: [
          {
            text: 'Order #',
            align: 'left',
            sortable: false,
            value: 'id',
          },
          { text: 'Company', value: 'quote.company.name' },
          { text: 'PO / Reference', value: 'quote.po_reference' },
          { text: 'Last modifired', value: 'updated_at' },
          { text: 'Total', value: 'total' },
          { text: 'Status', value: 'status' },
          { text: 'Order Date', value: 'created_at' },
          { text: 'ETA', value: 'eta' },
        ],
        orders: [],
        companies: [],
        company: '',
        createdAt: '',
        dates: [
          {
            'value': moment().add(-30, 'days').format('YYYY-MM-DD'),
            'text': 'Last 30 days',
          },
        ],
        today: new Date().toISOString().substr(0, 10),
      }
    },
    name: 'home-view',
    metaInfo () {
      return { title: this.$t('Orders') }
    },
    methods: {
      async loadOrders () {
        const { data } = await axios.get('/api/orders',
          { params: { company: this.company, created_at: this.createdAt } },
        )
        this.orders = data
        console.log(data)
      },
      async saveStatus (item) {
        const { data } = await axios.put('/api/orders/' + item.id, { status: item.status })
      },
      async saveEta (item) {
        const { data } = await axios.put('/api/orders/' + item.id, { eta: item.eta })
      },
      async loadCompanies () {
        const { data } = await axios.get('/api/companies')
        console.log(data)
        this.companies = data
      },
    },
    watch: {
      company () {
        this.loadOrders()
      },
      createdAt () {
        this.loadOrders()
      },
    },
    created () {
      // fetch the companies
      this.loadOrders()
      this.loadCompanies()
    },
  }
</script>
