<template>
  <v-card>
    <v-card-title>
        <v-layout row wrap>
        <v-flex xs12 sm3 d-flex>
            <v-select
                    :items="companies"
                    item-text="name"
                    item-value="id"
                    outline
                    label="Company Name (Select)"
                    class="mx-3"
            ></v-select>
        </v-flex>
      <v-flex xs12 sm2 d-flex>
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
                    item-text="name"
                    item-value="id"
                    outline
                    label="Last 30 Days"
                    class="mx-3"
            ></v-select>
        </v-flex>
        </v-layout>
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
          <td class="text-xs-left">{{ props.item.company.name }}</td>
          <td class="text-xs-left">{{ props.item.po_reference }}</td>
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
                    hide-overlay="true"
                    @save="saveEta(props.item)"
            >
              {{ props.item.eta }}
                <v-date-picker
                        slot="input"
                        :value="today"
                        v-model="props.item.eta"
                        :landscape="true"
                >
                </v-date-picker>
            </v-edit-dialog>
          </td>
        </template>
        <v-alert v-slot:no-results :value="true" color="error" icon="warning">
          Your search for "{{ search }}" found no results.
        </v-alert>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
  import axios from 'axios';
  import {mapGetters} from 'vuex'
  export default {
    data () {
      return {
        selected: [],
        items: ['Completed', 'Confirmed', 'Manufactoring'],
        search: '',
        status:'',
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
          { text: 'Total', value: 'total' },
          { text: 'Status', value: 'status' },
          { text: 'Order Date', value: 'created_at' },
          { text: 'ETA', value: 'eta' },
        ],
        orders: [],
        today: new Date().toISOString().substr(0, 10),
      }
    },
    name: 'home-view',
    metaInfo () {
      return { title: this.$t('Orders') }
    },
    methods: {
      async loadOrders() {
        const { data } = await axios.get('/api/orders')
        this.orders = data;
        console.log(data);
      },
      async saveStatus(item) {
        const { data } = await axios.put('/api/orders/' + item.id, {status: item.status})
      },
      async saveEta(item) {
        const { data } = await axios.put('/api/orders/' + item.id, {eta: item.eta})
      }
    },
    created () {
      // fetch the companies
      //this.$store.dispatch('fetchOrders')
      this.loadOrders()
    }
  }
</script>
