<template>
    <v-select
            :items="hingeColors"
            v-model="hColors"
            :value="value"
            label="Hinge Color"
            :rules="[v => !!v || 'Hinge Color is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'hinge_colour',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number,
            productType: String,
        },
        computed: {
            hingeColors() {
              switch (this.productType) {
                case 'basswood_shutters':
                  return [
                    'White',
                    'Bright Brass',
                    'Nickel',
                    'Black',
                    'Stainless',
                    'Colour Match'
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
            hColors: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'hinge_colour', value, index: this.index})
                }
            }
        }
    }
</script>
