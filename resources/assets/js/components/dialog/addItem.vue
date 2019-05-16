<template>
  <v-dialog
    v-model="isAddDialogOpen"
    persistent=""
    width="50vw"
  >
    <v-form
      ref="form"
      v-model="valid"
      :lazy-validation="true"
    >
      <v-card>
        <v-card-title>
          <h3>{{ productType }} Product</h3>
        </v-card-title>
        <v-card-text>
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
            type="number"
            min="0"
            required
            @input="calculateSqm"
          ></v-text-field>

          <v-text-field
            v-model="product.drop"
            label="Drop(mm)"
            type="number"
            :rules="dropRules"
            min="0"
            required
            @input="calculateSqm"
          >
          </v-text-field>

          <v-text-field
            :value="product.sqm"
            label="Sqm(auto calculated)"
            readonly
          ></v-text-field>

          <v-select
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
            :items="shutterType"
            label="Shutter Type"
            v-model="product.shutter_type"
            :rules="[v => !!v || 'Shutter Type is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="types"
            label="Type"
            v-model="product.type"
            :rules="[v => !!v || 'Type is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="fabrics"
            label="Fabric"
            v-model="product.fabric"
            :rules="[v => !!v || 'Fabric is required']"
            required
          ></v-select>

          <v-select
            :items="colours"
            label="Colour"
            :rules="[v => !!v || 'Colour is required']"
            v-model="product.colour"
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="controlType"
            label="Control Type"
            v-model="product.control_type"
            :rules="[v => !!v || 'Control type is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="controlSide"
            label="Control Side"
            v-model="product.control_side"
            :rules="[v => !!v || 'Control side is required']"
            required
          ></v-select>

          <v-text-field
            v-if="productType==='roller_blinds'"
            v-model="product.chain_length"
            label="Chain Length"
            :rules="[v => !!v || 'Chain Length is required']"
            required
          ></v-text-field>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="componentColours"
            label="Component Colour"
            v-model="product.component_colour"
            :rules="[v => !!v || 'Component Color is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="baseRails"
            label="Base Rail"
            v-model="product.base_rail"
            :rules="[v => !!v || 'Base Rail is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="rollDirections"
            label="Roll Directions"
            v-model="product.roll_direction"
            :rules="[v => !!v || 'Roll Directions is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="motorTypes"
            label="Motor Type"
            v-model="product.motor_type"
            :rules="[v => !!v || 'Motor Type is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="chargers"
            label="Charger"
            v-model="product.charger"
            :rules="[v => !!v || 'Charger is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="wiFiHubs"
            label="WiFi Hub"
            v-model="product.wifi_hub"
            :rules="[v => !!v || 'WiFi Hub is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="remotes"
            label="Remote"
            v-model="product.remote"
            :rules="[v => !!v || 'Remote is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='roller_blinds'"
            :items="bracketOptions"
            label="Bracket Options"
            v-model="product.bracket_options"
            :rules="[v => !!v || 'Bracket Options is required']"
            required
          ></v-select>

          <v-select
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='au_pvc_shutters' || productType === 'aluminium_shutters'"
            :items="corners"
            label="Corner"
            v-model="product.corner"
            :rules="[v => !!v || 'Corner is required']"
            required
          ></v-select>

          <v-text-field
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
            v-model="product.panel_layout"
            label="Panel Layout"
            :rules="[v => !!v || 'Panel layout is required', v =>  /[LTRDltrd-]/gm.test(v) || 'Panel Layout is not valid']"
            required
            type="text"
            @input="calculatePQTY"
          ></v-text-field>

          <v-text-field
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
            :value="product.panel_qty"
            label="Panel Quantity"
            type="number"
            readonly
          ></v-text-field>

          <v-radio-group
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
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
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
            :items="midRail"
            label="Mid Rail"
            v-model="product.mid_rail"
            :rules="[v => !!v || 'Mid Rail is required']"
            required
          ></v-select>

          <v-text-field
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
            v-model="product.mid_rail_height"
            label="Mid Rail Height"
            :rules="midRailHeightRules"
            type="number"
            min="0"
            required
          ></v-text-field>

          <v-select
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
            :items="bladeSize"
            label="Blade Size"
            :rules="[v => !!v || 'Blade Size is required']"
            v-model="product.blade_size"
          ></v-select>

          <v-select
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
            :items="tiltRod"
            label="Tilt Rod"
            :rules="[v => !!v || 'Tilt Rod is required']"
            v-model="product.tilt_rod"
          ></v-select>

          <v-select
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='au_pvc_shutters'"
            :items="stileType"
            label="Stile Type"
            :rules="[v => !!v || 'Stile Type is required']"
            v-model="product.stile_type"
          ></v-select>

          <v-select
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
            :items="frame"
            label="Frame"
            :rules="[v => !!v || 'Frame is required']"
            v-model="product.frame"
          ></v-select>

          <v-select
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='au_pvc_shutters'"
            :items="frameOptions"
            label="Frame Options"
            :rules="[v => !!v || 'Frame Options is required']"
            v-model="product.frame_options"
          ></v-select>

          <v-select
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='au_pvc_shutters'"
            :items="hingeType"
            label="Hinge Type"
            :rules="[v => !!v || 'Hinge Type is required']"
            v-model="product.hinge_type"
          ></v-select>

          <v-select
            v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='au_pvc_shutters'"
            :items="hingeColour"
            label="Hinge Colour"
            :rules="[v => !!v || 'Hinge Colour is required']"
            v-model="product.hinge_colour"
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
  import { mapGetters } from 'vuex'

  export default {
    name: 'addItem',
    data: () => (
      {
        valid: false,
        nameRules: [
          v => !!v || 'Name is required',
          v => (
                 v && v.length <= 10
               ) || 'Name must be less than 10 characters',
        ],
      }
    ),
    methods: {
      onSubmit (event) {
        if (!this.$refs.form.validate()) {
          return
        }
        this.$emit('clicked', this.product)
        this.$store.dispatch('updateAddItemDialogStatus', { status: false })
        this.$refs.form.resetValidation()
        this.product = this.initialiseProduct()
      },
      onCancel () {
        this.$store.dispatch('updateAddItemDialogStatus', { status: false })
        this.$refs.form.resetValidation()
        this.product = this.initialiseProduct()
        console.log(this.product)
      },
      calculateSqm () {
        this.product.sqm = 0
        if (this.product.width && this.product.drop) {
          this.product.sqm = this.product.width * this.product.drop / 1000000
        }
      },
      calculatePQTY () {
        if (this.product.panel_layout) {
          this.product.panel_qty = (
            this.product.panel_layout.match(/(L|l|R|r)/g) || []
          ).length
        }
      },
      initialiseProduct() {
        switch(this.productType) {
            case 'basswood_shutters':
            case 'pvc_shutters':
            case 'au_pvc_shutters':
              return {
                corner: 'No',
                mid_rail: 'NA',
                frame_options: 'NA',
                hinge_type: 'NA'
              }
            case 'aluminium_shutters':
              return {
                corner: 'No',
                mid_rail: 'NA',
                frame: 'No Frame',
              }
            case 'roller_blinds': 
              return {
                motor_type: 'NA',
                charger: 'NA',
                wifi_hub: 'NA',
                remote: 'NA'
              }
            default:
              return {
                corner: 'No',
                mid_rail: 'NA',
                frame_options: 'NA',
                hinge_type: 'NA'
              }
          }
      }
    },
    computed: {
      ...mapGetters(['isAddDialogOpen']),
      dropRules () {
        switch (this.productType) {
          case 'pvc_shutters':
          case 'au_pvc_shutters':
            return [
              v => !!v || 'Drop is required',
              v => (
                     v && v <= 2440 && v >= 250
                   ) || 'Drop must be less than 2440mm and greater than 250mm',
            ]
          case 'aluminium_shutters':
            return [
              v => !!v || 'Drop is required',
              v => (
                     v && v <= 3050 && v >= 250
                   ) || 'Drop must be less than 3050mm and greater than 250mm',
            ]
          case 'basswood_shutters':
            return [
              v => !!v || 'Drop is required',
              v => (
                     v && v >= 300
                   ) || 'Drop must be greater than 300mm',
            ]
          case 'roller_blinds':
            return [
              v => !!v || 'Drop is required',
              v => (
                     v && v <= 3300
                   ) || 'Drop must be less than 3300mm',
            ]
        }
      },
      widthRules () {
        switch (this.productType) {
          case 'pvc_shutters':
          case 'au_pvc_shutters':
            return [
              v => !!v || 'Width is required',
              v => (
                     v && v >= 250
                   ) || 'Width must be greater than 250mm',
            ]
          case 'aluminium_shutters':
            return [
              v => !!v || 'Width is required',
              v => (
                     v && v >= 250
                   ) || 'Width must be greater than 250mm',
            ]
          case 'basswood_shutters':
            return [
              v => !!v || 'Width is required',
              v => (
                     v && v >= 300
                   ) || 'Width must be greater than 300mm',
            ]
          case 'roller_blinds':
            return [
              v => !!v || 'Width is required',
              v => (
                     v && v <= 3010
                   ) || 'Width must be less than 3010mm',
            ]
        }
      },
      midRailHeightRules () {
        if (this.product.drop >= 1599) {
          return [
            v => !!v || 'Mid Rail Height is required',
          ]
        }
      },
      product: {
        get () {
          console.log(this.productType);
          return this.initialiseProduct();
        },
        set () {
        },
      },
      shutterType () {
        return [
          'Standard',
          'Sliding',
          'Bifold Track',
          'U Channel',
        ]
      },
      corners () {
        return [
          'No',
          '90',
          '135',
        ]
      },
      tiltRod () {
        switch (this.productType) {
          case 'aluminium_shutters':
          case 'au_pvc_shutters':
            return [
              'Clear View',
            ]
          case 'pvc_shutters':
          case 'basswood_shutters':
            return [
              'Clear View',
              'Central',
            ]
        }
      },
      bladeSize () {
        switch (this.productType) {
          case 'aluminium_shutters':
          case 'au_pvc_shutters':
            return [
              '89mm',
            ]
          case 'pvc_shutters':
            return [
              '64mm',
              '89mm',
            ]
          case 'basswood_shutters':
            return [
              '47mm',
              '89mm',
              '64mm',
              '114mm',
            ]
        }
      },
      midRail () {
        switch (this.productType) {
          case 'aluminium_shutters':
            if (this.product.drop <= 2299 && this.product.drop >= 1800) {
              return [
                'NA',
                'Centre',
                '1',
              ]
            } else if (this.product.drop <= 2599 && this.product.drop >= 2300) {
              return [
                '2',
              ]
            } else if (this.product.drop <= 2600 && this.product.drop >= 3000) {
              return [
                '3',
              ]
            }
            break
          case 'pvc_shutters':
            return [
                'NA',
                'Centre',
                '1',
              ]
            break
          case 'au_pvc_shutters':
            if (this.product.drop <= 1999 && this.product.drop >= 1600) {
              return [
                'NA',
                'Centre',
                '1',
              ]
            } else if (this.product.drop <= 2440 && this.product.drop >= 2000) {
              return [
                '2',
              ]
            }
            break
          case 'basswood_shutters':
            return [
              'NA',
              'Centre',
              '1',
              '2',
              '3',
            ]
        }

      },
      frame () {
        switch (this.productType) {
          case 'aluminium_shutters':
            return [
              'No Frame',
              'L',
              'U Channel',
              'Bi Fold',
              'Sliding',
            ]
          case 'basswood_shutters':
            return [
              'No Frame',
              'FL50-B9',
              'BL50-B10',
              'BC65-B14A',
              'BC50-B14',
              'Z35-C7',
              'Z20-C6',
              'CZ25-D1',
              'CZ25-D2',
              'BL65-B10A',
            ]
          case 'pvc_shutters':
          case 'au_pvc_shutters':
            return [
              'No Frame',
              'Z20-C6',
              'BL50-B10',
              'BL65-B10A',
            ]
        }
      },
      frameOptions () {
        return [
          'NA',
          'LRTB',
          'LRT',
          'LRB',
        ]
      },
      stileType () {
        switch (this.productType) {
          case 'au_pvc_shutters':
          case 'pvc_shutters':
            return [
              '50b',
            ]
          case 'basswood_shutters':
            return [
              '50b',
              '60b',
              '50f',
              '60f',
            ]
        }
      },
      fabrics () {
        let options = []
        switch (this.product.type) {
          case 'Blockout':
            options = [
              'Solitaire',
              'Focus',
              'Metroshade',
              'Sanctuary',
              'Riviera',
              'Tusk',
              'Jersey',
              'Balmoral',
            ]
            break
          case 'Screen':
            options = [
              'One Screen',
              'Solar View',
            ]
            break
          case 'Light Filter':
            options = [
              'Metroshade',
              'Riviera',
              'Tusk',
              'Jersey',
              'Balmoral',
            ]
            break
        }
        return options
      },
      colours () {
        let colors = []
        if (this.productType === 'roller_blinds') {
          switch (true) {
            case this.product.type === 'Blockout' && this.product.fabric === 'Solitaire':
              colors = [
                'Snow',
                'Antique White',
                'Champagne',
                'Granite',
                'Peat',
                'Pepper',
                'Coffee',
                'Concord',
                'Ironstone',
                'Onyx',
              ]
              break
            case this.product.type === 'Blockout' && this.product.fabric === 'Focus':
              colors = [
                'White',
                'Chalk',
                'Shell',
                'Dove',
                'Linen',
                'Cream',
                'Powder',
                'Putty',
                'Stone',
                'Cotton',
                'Alabaster',
                'Almond',
                'Sandstone',
                'Latte',
                'Beechwood',
                'Cloud',
                'Pumice',
                'Oyster',
                'Eucalypt',
                'Duck Egg',
                'Smoke',
                'Ash',
                'Blush',
                'Jarrah',
                'Espresso',
                'Fig',
                'Tempest',
                'Coal',
                'Ebony',
              ]
              break
            case this.product.type === 'Blockout' && this.product.fabric === 'Metroshade':
              colors = [
                'Dove/White',
                'Ecru',
                'Nougat',
                'Dune',
                'Pebble',
                'Seal',
                'Quill',
                'Ice Grey',
                'Moonstone',
                'Slate',
                'Storm',
                'Black',
              ]
              break
            case this.product.type === 'Blockout' && this.product.fabric === 'Sanctuary':
              colors = [
                'Plaster',
                'Marble',
                'Limestone',
                'Ceramic',
                'Truffle',
                'Fossil',
                'Suede',
                'Mineral',
                'Slate',
                'Baltic',
                'Lava',
              ]
              break
            case this.product.type === 'Blockout' && this.product.fabric === 'Riviera':
              colors = [
                'Cannes',
                'Nice',
                'La Palme',
                'St Marie',
                'Monte Carlo',
                'Cassis',
              ]
              break
            case this.product.type === 'Blockout' && this.product.fabric === 'Tusk':
              colors = [
                'Mushroom',
                'Pepper',
                'Beach',
                'Coconut',
                'Slate',
                'Whisper',
                'Hazelnut',
                'Henna',
              ]
              break
            case this.product.type === 'Blockout' && this.product.fabric === 'Jersey':
              colors = [
                'Opal',
                'Organic',
                'Stone',
                'Render',
                'Timber',
                'Pavement',
                'Steel',
              ]
              break
            case this.product.type === 'Blockout' && this.product.fabric === 'Balmoral':
              colors = [
                'White',
                'Pearl',
                'Birch',
                'Bourneville',
                'Concrete',
                'Dove',
                'Jet',
                'Putty',
                'Pyrite',
                'Steel',
              ]
              break
            case this.product.type === 'Screen' && this.product.fabric === 'One Screen':
              colors = [
                'White',
                'Sand',
                'Dune',
                'Linen/Bronze',
                'Wallaby',
                'Ice',
                'Grey',
                'Gunmetal',
                'Silver/Black',
                'Mercury',
                'Charcoal',
                'Black',
              ]
              break
            case this.product.type === 'Screen' && this.product.fabric === 'Solar View':
              colors = [
                'White',
                'Off White',
                'Alabaster',
                'Cotton',
                'Bone/Off White',
                'Taupe',
                'Platinum',
                'Bronze/Charcoal',
                'Black/Copper',
                'Grey',
                'Charcoal',
                'Black',
              ]
              break
            case this.product.type === 'Light Filter' && this.product.fabric === 'Metroshade':
              colors = [
                'Dove/White',
                'Ecru',
                'Nougat',
                'Ice Grey',
                'Quill',
                'Moonstone',
              ]
              break
            case this.product.type === 'Light Filter' && this.product.fabric === 'Riviera':
              colors = [
                'Cannes',
                'Nice',
                'La Palme',
                'St Marie',
                'Monte Carlo',
                'Cassis',
              ]
              break
            case this.product.type === 'Light Filter' && this.product.fabric === 'Tusk':
              colors = [
                'Mushroom',
                'Pepper',
                'Beach',
                'Coconut',
                'Slate',
                'Whisper',
                'Hazelnut',
                'Henna',
              ]
              break
            case this.product.type === 'Light Filter' && this.product.fabric === 'Jersey':
              colors = [
                'Opal',
                'Organic',
                'Stone',
                'Render',
                'Timber',
                'Pavement',
                'Steel',
              ]
              break
            case this.product.type === 'Light Filter' && this.product.fabric === 'Balmoral':
              colors = [
                'White',
                'Pearl',
                'Birch',
                'Bourneville',
                'Concrete',
                'Dove',
                'Jet',
                'Putty',
                'Pyrite',
                'Steel',
              ]
              break
          }
        } else if (this.productType === 'pvc_shutters') {
          colors = [
            'W100 Snow',
            'W101 Dove',
            'W104 China',
            'W105 Soft Pearl',
            'W107 Pearl',
            'W109 Linen Wash',
            'W115 Clay',
            'W118 Wheat',
            'W401 Eggshell',
            'W402 Palm Beach',
            'W00 Custom',
          ]
        } else if (this.productType === 'basswood_shutters') {
          colors = [
            'W100 Snow',
            'W101 Dove',
            'W104 China',
            'W105 Soft Pearl',
            'W107 Pearl',
            'W109 Linen Wash',
            'W115 Clay',
            'W118 Wheat',
            'W401 Eggshell',
            'W402 Palm Beach',
            'W00 Custom',
            'S430 Black Ash',
            'S508 Jet',
            'S602 Maple',
            'S604 Aged Teak',
            'S606 Mahogan',
            'S701 Walnut',
          ]
        } else if (this.productType === 'au_pvc_shutters') {
          colors = [
            'White',
            'Off White',
            'Custom',
          ]
        } else if (this.productType === 'aluminium_shutters') {
          colors = [
            'White',
            'Cream',
            'Silver',
          ]
        }

        return colors
      },
      controlSide () {
        return ['Left', 'Right']
      },
      controlType () {
        return ['Chain', 'Motor']
      },
      hingeType () {
        switch (this.productType) {
          case 'basswood_shutters':
            return [
              'NA',
              'Non Mortised',
              'Pivot',
              'Hang strip',
            ]
          case 'au_pvc_shutters':
          case 'pvc_shutters':
            return [
              'NA',
              'Non Mortised',
              'Pivot',
            ]
        }
      },
      hingeColour () {
        switch (this.productType) {
          case 'basswood_shutters':
            return [
              'White',
              'Bright Brass',
              'Nickel',
              'Black',
              'Stainless',
              'Colour Match',
            ]
          case 'pvc_shutters':
            return [
              'white',
              'Nickel',
              'Stainless',
              'Colour Match',
            ]
          case 'au_pvc_shutters':
            return [
              'White',
            ]
        }
      },
      types () {
        return [
          'Blockout',
          'Screen',
          'Light Filter',
        ]
      },
      componentColours () {
        return [
          'White',
          'Black',
        ]
      },
      baseRails () {
        return [
          'Silver',
          'Black',
        ]
      },
      rollDirections () {
        return [
          'Standard',
          'Reverse',
        ]
      },
      motorTypes () {
        return [
          'NA',
          'Acmeda 240v',
          'Acmeda Li Ion 1.1nm',
          'Acmeda Li Ion 3.0nm',
        ]
      },
      chargers () {
        return [
          'NA',
          'Yes',
        ]
      },
      wiFiHubs () {
        return [
          'NA',
          'Acmeda Pulse',
        ]
      },
      remotes () {
        return [
          'NA',
          '1 Channel',
          '15 Channel',
        ]
      },
      bracketOptions () {
        return [
          'Single',
          'Slim Combo Top Front',
          'Slim Combo Top Back',
          'Double Bracket',
        ]
      },
    },
    props: {
      productType: String,
      selectedProduct: Object,
    },
  }
</script>

