<template>
  <v-card>
    <v-card-title class="grey lighten-4">
      <h3 class="headline mb-0">{{ $t('Orders') }}</h3>
    </v-card-title>
    <v-divider></v-divider>
    <v-card-text>
      <v-data-table
        :headers="headers"
        :items="orders"
        class="elevation-1"
      >
        <template v-slot:items="props">
          <td>{{ props.item.id }}</td>
          <td class="text-xs-left">{{ props.item.company.name }}</td>
          <td class="text-xs-left">{{ props.item.po_reference }}</td>
          <td class="text-xs-left">{{ props.item.updated_at }}</td>
          <td class="text-xs-left">{{ props.item.status }}</td>
          <td class="text-xs-left">{{ props.item.created_at }}</td>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
  import axios from 'axios';
  export default {
    data () {
      return {
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
          { text: 'Order Date', value: 'created_at' }
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


