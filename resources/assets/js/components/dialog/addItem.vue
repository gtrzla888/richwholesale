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
      ref="form"
      v-model="valid"
      :lazy-validation="true"
    >
      <v-card>
        <v-card-title>
          <h3>{{ type }} Product</h3>
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
            label="Width(mm)"
            :rules="[v => !!v || 'Width is required']"
            type = "number"
            min="0"
            required
          ></v-text-field>

          <v-text-field
            v-model="product.drop"
            label="Drop(mm)"
            type = "number"
            :rules="[v => !!v || 'Drop is required']"
            min="0"
            required
            @blur="calculateSqm"
          >
          </v-text-field>

          <v-text-field
            :value="product.sqm"
            label="Sqm(auto calculated)"
            readonly
          ></v-text-field>

          <v-select
            :items="shutterType"
            label="Shutter Type"
            v-model="product.shutter_type"
            :rules="[v => !!v || 'Shutter Type is required']"
            required
          ></v-select>

          <v-select
            :items="corners"
            label="Corner"
            v-model="product.corner"
            :rules="[v => !!v || 'Corner is required']"
            required
          ></v-select>

          <v-text-field
            v-model="product.panel_layout"
            label="Panel Layout"
            :rules="[v => !!v || 'Panel layout is required', v =>  /[LTRD-]/gm.test(v) || 'Panel Layout is not valid']"
            required
            type="text"
            @blur="calculatePQTY"
          ></v-text-field>

          <v-text-field
            :value="product.panel_qty"
            label="Panel Quantity"
            type="number"
            readonly
          ></v-text-field>

          <v-radio-group 
            v-model="product.in_or_out" 
            :mandatory="true" 
            row 
            required
            :rules="[v => !!v || 'In or Out is required']"
          >
            <v-radio label="In" value="In"></v-radio>
            <v-radio label="Out" value="Out"></v-radio>
          </v-radio-group>

          <v-select
            :items="midRail"
            label="Mid Rail"
            v-model="product.mid_rail"
            :rules="[v => !!v || 'Mid Rail is required']"
            required
          ></v-select>

          <v-text-field
            v-model="product.mid_rail_height"
            label="Mid Rail Height"
            :rules="[v => !!v || 'Mid Rail Height is required']"
            type="number"
            min="0"
            required
          ></v-text-field>

          <v-select
              :items="bladeSize"
              label="Blade Size"
              :rules="[v => !!v || 'Blade Size is required']"
              v-model="product.blade_size"
          ></v-select>

          <v-select
              :items="tiltRod"
              label="Tile Rod"
              :rules="[v => !!v || 'Tile Rod is required']"
              v-model="product.tilt_rod"
          ></v-select>

          <v-select
                  :items="colour"
                  label="Mid Rail"
                  :rules="[v => !!v || 'Mid Rail is required']"
                  v-model="product.colour"
                  required
          ></v-select>

          <v-select
                  :items="stileType"
                  label="Stile Type"
                  :rules="[v => !!v || 'Stile Type is required']"
                  v-model="product.stile_type"
          ></v-select>

          <v-select
                  :items="frame"
                  label="Frame"
                  :rules="[v => !!v || 'Frame is required']"
                  v-model="product.frame"
          ></v-select>

          <v-select
                  :items="frameOptions"
                  label="Frame"
                  :rules="[v => !!v || 'Frame Option is required']"
                  v-model="product.frame_options"
          ></v-select>

          <v-select
                  :items="hingeType"
                  label="Hinge Type"
                  :rules="[v => !!v || 'Hinge Type is required']"
                  v-model="product.hinge_type"
          ></v-select>

          <v-select
                  :items="hingeColour"
                  label="Hinge Colour"
                  :rules="[v => !!v || 'Hinge Colour is required']"
                  v-model="product.hinge_color"
          ></v-select>

          <v-text-field
                  v-model="product.notes"
                  label="Notes"
                  type="text"
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
    }),
    methods: {
      onSubmit(event) {
        if (!this.$refs.form.validate()) {
           return
        }
        this.product.type = this.type;
        this.$emit('clicked', this.product)
        this.product = {}
        
        this.$store.dispatch('updateAddItemDialogStatus', {status: false})
      },
      onCancel() {
        this.$store.dispatch('updateAddItemDialogStatus', {status: false})
      },
      calculateSqm() {
        this.product.sqm = this.product.width * this.product.drop;
      },
      calculatePQTY() {
        this.product.panel_qty = (this.product.panel_layout.match(/L/g) || []).length + (this.product.panel_layout.match(/R/g) || []).length
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
      },
      shutterType() {
          return  [
            'Standard',
            'Sliding',
            'Bifold Track',
            'U Channel',
          ]
      },
      corners() {
          return [
              'No',
              90,
              135
          ]
      },
      tiltRod() {
        return [
          'Clear View'
        ]
      },
      bladeSize() {
         return [
           '89mm'
         ]
      },
      midRail() {
        return [
          'Centre',
          '1',
          '2',
          '3'
        ]
      },
      frame() {
        return [
          'No Frame',
          'Z20-C6',
          'BL50-B10',
          'BL65-B10A'
        ]
      },
      frameOptions() {
          return [
            'na',
            'LRTB',
            'LRT',
            'LRB'
          ]
      },
      stileType() {
        return [
          '50b'
        ]
      },
      colour() {
        return [
          'W100 Snow',

        ]
      },
      hingeType() {
          return [
            'na',
            'Non Mortised',
            'Pivot'
          ]
      },
      hingeColour() {
          return [
            'white',
          ]
      }
    },
    props: {
      type: String,
      selectedProduct: Object
    }
  }
</script>

