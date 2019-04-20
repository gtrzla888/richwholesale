<template>
  <v-dialog
    v-model="isDialogOpen"
    persistent=""
    max-width="500px"
  >
    <h3>Please select the product you want to add</h3>
<!--    <v-radio-group v-model="column" column>-->
<!--      <v-radio label="Aluminium Shutters" value="radio-1"></v-radio>-->
<!--      <v-radio label="Option 2" value="radio-2"></v-radio>-->
<!--    </v-radio-group>-->
    <!-- for alum shutters -->
    <v-form
      ref="addItemForm"
      v-model="valid"
      lazy-validation
    >
      <v-card>
        <v-card-title>
          <h3>Add Item</h3>
        </v-card-title>
        <v-card-text>
          <v-text-field
            v-model="name"
            :counter="10"
            :rules="nameRules"
            label="Name"
            required
          ></v-text-field>

          <v-text-field
            v-model="width"
            placeholder="Width(mm), no decimal"
            label="Width(mm)"
            type = "number"
            required
          ></v-text-field>

          <v-text-field
            v-model="drop"
            placeholder="Drop(mm), no decimal"
            label="Drop(mm)"
            type = "number"
            @blur="calculateSqm"
            required
          >
          </v-text-field>

          <v-text-field
            :value="sqm"
            placeholder="Sqm"
            label="Sqm"
            readonly
          ></v-text-field>

          <v-select
            :items="shutterTypes"
            label="Shutter Type"
          ></v-select>

          <v-text-field
            :v-model="layout"
            placeholder="Panel layout"
            label="Panel Layout"
          ></v-text-field>

          <v-text-field
            :v-model="qty"
            placeholder="Panel Quantity"
            label="Panel Quantity"
            type="number"
          ></v-text-field>

          <v-radio-group v-model="inOrOut" :mandatory="false" row>
            <v-radio label="In" value="in"></v-radio>
            <v-radio label="Out" value="out"></v-radio>
          </v-radio-group>

          <v-select
            :items="midRailSelect"
            label="Mid Rail"
          ></v-select>

          <v-text-field
            :v-model="mrh"
            placeholder="Mid Rail Height"
            label="Mid Rail Height"
            type="number"
          ></v-text-field>

          <v-text-field
            :v-model="bladeSize"
            placeholder="Blade Size"
            label="Blade Size"
            type="number"
          ></v-text-field>

          <v-text-field
            :v-model="tiltRod"
            placeholder="Tilt Rod"
            label="Tilt Rod"
            type="number"
          ></v-text-field>

        </v-card-text>
        <v-card-actions>
          <v-btn color="secondary" flat @click.stop="closeDialog">Close</v-btn>
          <v-btn color="primary" flat @click.stop="closeDialog">Submit</v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
    <!-- end alum shutters -->

  </v-dialog>
</template>

<script>
  import {mapGetters} from 'vuex'
  export default {
    name: 'addItem',
    computed:{
      ...mapGetters(['isDialogOpen'])
    },
    data: () => ({
      valid: false,
      name: '',
      width: 0,
      drop: 0,
      sqm: 0,
      qty: 0,
      layout: '',
      inOrOut: '',
      mrh: 0,
      tiltRod: '',
      bladeSize: 0,
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 10) || 'Name must be less than 10 characters'
      ],
      shutterTypes: [
        'Standard',
        'Sliding',
        'Bifold Track',
        'U Channel',
      ],
      midRailSelect: [
        'Centre',
        '1',
        '2',
        '3'
      ],
      select: [
        { text: 'State 1' },
        { text: 'State 2' },
        { text: 'State 3' },
        { text: 'State 4' },
        { text: 'State 5' },
        { text: 'State 6' },
        { text: 'State 7' }
      ]
    }),
    methods: {
      closeDialog() {
        this.$store.dispatch('updateAddItemDialogStatus', {status: false})
      },
      calculateSqm() {
        this.sqm = this.width * this.drop;
      }
    }
  }
</script>

<style scoped>

</style>
