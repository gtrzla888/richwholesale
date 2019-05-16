<template>
  <v-select
    :items="midRail"
    v-model="mr"
    :value="value"
    label="Mid Rail"
    :rules="[v => !!v || 'Mid rail is required']"
    required
  ></v-select>
</template>
<script>
  export default {
    name: 'mid_rail',
    data: () => (
      {}
    ),
    props: {
      value: String,
      index: Number,
      productType: String,
    },
    computed: {
      midRail () {
        const product = this.$store.state.order[this.productType][this.index]
        switch (this.productType) {
          case 'aluminium_shutters':
            if (product.drop <= 2299 && product.drop >= 1800) {
              return [
                'NA',
                'Centre',
                '1',
              ]
            } else if (product.drop <= 2599 && product.drop >= 2300) {
              return [
                '2',
              ]
            } else if (product.drop <= 2600 && product.drop >= 3000) {
              return [
                '3',
              ]
            }
            break
          case 'pvc_shutters':
          case 'au_pvc_shutters':
            if (product.drop <= 1999 && product.drop >= 1600) {
              return [
                'NA',
                'Centre',
                '1',
              ]
            } else if (product.drop <= 2440 && product.drop >= 2000) {
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
      mr: {
        get () {
          return this.value
        },
        set (value) {
          this.$emit('productChanged', { field: 'mid_rail', value, index: this.index })
        },
      },
    },
  }
</script>
