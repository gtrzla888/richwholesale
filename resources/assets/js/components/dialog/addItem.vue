<template>
  <v-dialog
    v-model="isDialogOpen"
    persistent=""
    width="500"
  >
<!--    <v-radio-group v-model="column" column>-->
<!--      <v-radio label="Aluminium Shutters" value="radio-1"></v-radio>-->
<!--      <v-radio label="Option 2" value="radio-2"></v-radio>-->
<!--    </v-radio-group>-->
    <!-- for alum shutters -->
    <v-form
      ref="addItemForm"
      v-model="valid"
    >
      <v-card>
        <v-card-title>
          <h3>Add Item</h3>
        </v-card-title>
        <v-card-text>
          <v-text-field
                  v-model="product.type"
                  v-show="false"
          ></v-text-field>

          <v-text-field
            v-model="product.name"
            :counter="10"
            :rules="nameRules"
            label="Name"
            required
          ></v-text-field>

          <v-text-field
            v-model="product.width"
            placeholder="Width(mm), no decimal"
            label="Width(mm)"
            type = "number"
            required
          ></v-text-field>

          <v-text-field
            v-model="product.drop"
            placeholder="Drop(mm), no decimal"
            label="Drop(mm)"
            type = "number"
            @blur="calculateSqm"
            required
          >
          </v-text-field>

          <v-text-field
            :value="product.sqm"
            placeholder="Sqm"
            label="Sqm"
            readonly
          ></v-text-field>

          <v-select
            :items="shutterTypes"
            label="Shutter Type"
            :v-model="product.shutter_type"
          ></v-select>

          <v-text-field
            :v-model="product.panel_layout"
            placeholder="Panel layout"
            label="Panel Layout"
          ></v-text-field>

          <v-text-field
            :v-model="product.panel_qty"
            placeholder="Panel Quantity"
            label="Panel Quantity"
            type="number"
          ></v-text-field>

          <v-radio-group v-model="product.in_or_out" :mandatory="true" row>
            <v-radio label="In" value="in"></v-radio>
            <v-radio label="Out" value="out"></v-radio>
          </v-radio-group>

          <v-select
            :items="midRails"
            label="Mid Rail"
            :v-model="product.mid_rail"
          ></v-select>

          <v-text-field
            :v-model="product.mid_rai_height"
            placeholder="Mid Rail Height"
            label="Mid Rail Height"
            type="number"
          ></v-text-field>

          <v-text-field
            :v-model="product.blade_size"
            placeholder="Blade Size"
            label="Blade Size"
            type="number"
          ></v-text-field>

          <v-text-field
            :v-model="product.tilt_rod"
            placeholder="Tilt Rod"
            label="Tilt Rod"
            type="number"
          ></v-text-field>

          <v-select
                  :items="colours"
                  label="Mid Rail"
                  :v-model="product.colour"
          ></v-select>

          <v-select
                  :items="frames"
                  label="Frame"
                  :v-model="product.frame"
          ></v-select>

          <v-text-field
                  :v-model="product.notes"
                  placeholder="Notes"
                  label="Notes"
                  type="number"
          ></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn color="secondary" flat @click.stop="onCancel">Close</v-btn>
          <v-btn color="primary" flat @click.stop="onSubmit">Submit</v-btn>
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
    data: () => ({
      valid: false,
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 10) || 'Name must be less than 10 characters'
      ],
      frames:[

      ],
      shutterTypes: [
        'Standard',
        'Sliding',
        'Bifold Track',
        'U Channel',
      ],
      midRails: [
        'Centre',
        '1',
        '2',
        '3'
      ],
      colours: [

      ],
    }),
    methods: {
      onSubmit(event) {
        this.product.type = this.type;
        this.$emit('clicked', this.product)
        this.product = {}
        this.$store.dispatch('updateAddItemDialogStatus', {status: false})
      },
      onCancel() {
        this.$store.dispatch('updateAddItemDialogStatus', {status: false})
      },
      calculateSqm() {
        this.sqm = this.width * this.drop;
      }
    },
    computed: {
      ...mapGetters(['isDialogOpen']),
      product: {
        get() {
            return this.selectedProduct
        },
        set() {

        }
    
      }
    },
    props: {
      type: String,
      selectedProduct: Object
    },
    created() {
      console.log(this.product)
    }
  }
</script>

<style scoped>

</style>
