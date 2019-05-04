<template>
  <v-select
    :items="colors"
    v-model="color"
    :value="value"
    label="Color"
    :rules="[v => !!v || 'Color is required']"
    required
  ></v-select>
</template>
<script>
  export default {
    name: 'colour',
    data: () => (
      {}
    ),
    props: {
      value: String,
      index: Number,
      productType: String,
    },
    computed: {
      colors () {
        const product = this.$store.state.order[this.productType][this.index]
        let colors = []
        if (this.productType === 'roller_blinds') {
          switch (true) {
            case product.type === 'Blockout' && product.fabric === 'Solitaire':
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
            case product.type === 'Blockout' && product.fabric === 'Focus':
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
            case product.type === 'Blockout' && product.fabric === 'Metroshade':
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
            case product.type === 'Blockout' && product.fabric === 'Sanctuary':
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
            case product.type === 'Blockout' && product.fabric === 'Riviera':
              colors = [
                'Cannes',
                'Nice',
                'La Palme',
                'St Marie',
                'Monte Carlo',
                'Cassis',
              ]
              break
            case product.type === 'Blockout' && product.fabric === 'Tusk':
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
            case product.type === 'Blockout' && product.fabric === 'Jersey':
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
            case product.type === 'Blockout' && product.fabric === 'Balmoral':
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
            case product.type === 'Screen' && product.fabric === 'One Screen':
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
            case product.type === 'Screen' && product.fabric === 'Solar View':
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
            case product.type === 'Light Filter' && product.fabric === 'Metroshade':
              colors = [
                'Dove/White',
                'Ecru',
                'Nougat',
                'Ice Grey',
                'Quill',
                'Moonstone',
              ]
              break
            case product.type === 'Light Filter' && product.fabric === 'Riviera':
              colors = [
                'Cannes',
                'Nice',
                'La Palme',
                'St Marie',
                'Monte Carlo',
                'Cassis',
              ]
              break
            case product.type === 'Light Filter' && product.fabric === 'Tusk':
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
            case product.type === 'Light Filter' && product.fabric === 'Jersey':
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
            case product.type === 'Light Filter' && product.fabric === 'Balmoral':
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
            'Custom'
          ]
        } else if (this.productType === 'aluminium_shutters') {
          colors = [
            'White',
            'Cream',
            'Silver'
          ]
        }

        return colors

      },
      color: {
        get () {
          return this.value
        },
        set (value) {
          this.$emit('productChanged', { field: 'colour', value, index: this.index })
        },
      },
    },
  }
</script>
