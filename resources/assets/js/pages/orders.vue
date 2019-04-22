<template>
  <v-card>
    <v-card-title class="grey lighten-4">
      <h3 class="headline mb-0">{{ $t('Orders') }}</h3>
      <v-spacer></v-spacer>
      <v-text-field
              v-model="search"
              append-icon="search"
              label="Search"
              single-line
              hide-details
      ></v-text-field>
    </v-card-title>
    <v-divider></v-divider>
    <v-card-text>
      <v-data-table
        :headers="headers"
        :items="orders"
        :search="search"
        class="elevation-1"
      >
        <template v-slot:items="props">
          <td>{{ props.item.id }}</td>
          <td class="text-xs-left">{{ props.item.company.name }}</td>
          <td class="text-xs-left">{{ props.item.po_reference }}</td>
          <td class="text-xs-left">{{ props.item.updated_at }}</td>
          <td class="text-xs-left">{{ props.item.total }}</td>
          <td class="text-xs-left">
            <v-edit-dialog
                    :return-value.sync="props.item.status"
                    lazy
            >
            {{ props.item.status }}
              <template v-slot:input>
                <v-select
                        v-model="props.item.status"
                        :items="items"
                ></v-select>
              </template>
            </v-edit-dialog>
          </td>
          <td class="text-xs-left">{{ props.item.created_at }}</td>
          <td class="text-xs-left">
            <v-edit-dialog
                    :return-value.sync="props.item.eta"
                    lazy
                    hide-overlay="true"
            >
              {{ props.item.eta }}
              <template v-slot:input>
                <v-date-picker
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
</template>

<script>
  import axios from 'axios';
  export default {
    data () {
      return {
        items: ['Completed', 'Confirmed', 'Manufactoring'],
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
          { text: 'Total', value: 'total' },
          { text: 'Status', value: 'status' },
          { text: 'Order Date', value: 'created_at' },
          { text: 'ETA', value: 'eta' },
        ],
        orders: []
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
      }
    },
    created () {
      this.loadOrders();
    }
  }
</script>
