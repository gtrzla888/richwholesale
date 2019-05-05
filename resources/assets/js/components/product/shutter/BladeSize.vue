<template>
    <v-select
            :items="bladeSize"
            v-model="bSize"
            :value="value"
            label="Blade Size"
            :rules="[v => !!v || 'Blade Size is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'blade_size',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number,
            productType: String,
        },
        computed: {
            bladeSize() {
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
            bSize: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'blade_size', value, index: this.index})
                }
            }
        }
    }
</script>
