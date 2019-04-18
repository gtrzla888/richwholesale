<template>
    <v-layout row wrap align-center>
      <v-flex xs12 sm3 d-flex>
        <v-select
          :items="companies"
          label="Company Name (Select)"
        ></v-select>
      </v-flex>
      <v-spacer></v-spacer>
      <v-flex xs12 sm3 d-flex>
        <v-dialog
          ref="dialog"
          v-model="modal"
          :return-value.sync="todays"
          persistent
          lazy
          full-width
          width="290px"
        >
          <template v-slot:activator="{ on }">
            <v-text-field
              v-model="todays"
              label="Todays Date (Display) "
              prepend-icon="event"
              readonly
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker v-model="todays" scrollable>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
            <v-btn flat color="primary" @click="$refs.dialog.save(todays)">OK</v-btn>
          </v-date-picker>
        </v-dialog>
      </v-flex>
      <v-spacer></v-spacer>
      <v-flex xs12 sm3 d-flex>
        <v-text-field
          v-model="poRef"
          :counter="10"
          :rules="poRefRules"
          label="PO Number or Reference"
          placeholder="PO Number or Reference"
          required
        ></v-text-field>
      </v-flex>
      <v-spacer></v-spacer>
      <v-flex xs12 sm3 d-flex>
        <v-text-field
          class="mx-3"
          outline
          label="Search"
          placeholder="Search"
          prepend-inner-icon="search"
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm12 d-flex>
        <v-text-field
          label="Notes"
          placeholder="Notes..."
        ></v-text-field>
      </v-flex>

      <v-flex xs12 sm12 d-flex>
        <v-tabs
          v-model="active"
          color="#589ACC"
          dark
          slider-color="blue"
        >
          <v-tab
            v-for="product in products"
            :key="product.name"
            ripple
          >
            {{product.name}}
          </v-tab>
          <v-tab-item
            v-for="product in products"
            :key="product.name"
          >
            <v-card flat>
              <v-card-text>{{product.name}}</v-card-text>
            </v-card>
          </v-tab-item>
        </v-tabs>
      </v-flex>

    </v-layout>
</template>

<script>
export default {
  name: 'home-view',
  metaInfo () {
    return { title: this.$t('home') }
  },
  data: () => ({
    companies: ['Company A', 'Company B', 'Company C'],
    todays: new Date().toISOString().substr(0, 10),
    modal: false,
    poRef: 'A00123',
    poRefRules: [
      v => !!v || 'PO number is required',
      v => v.length <= 10 || 'PO number must be less than 10 characters'
    ],
    search: null,
    active: null,
    products: [
      {name: 'Basswood Shutters'},
      {name: 'PVC Shutters'},
      {name: 'AU PVC Shutters'},
      {name: 'Aluminium  Shutters'},
      {name: 'Roller Blinder'},
    ]

  })
}
</script>
