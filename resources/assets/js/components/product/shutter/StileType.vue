<template>
    <v-select
            :items="stileType"
             v-model="sType"
            label="Stile Type"
            :rules="[v => !!v || 'Stile Type is required']"
            required
            :value="value"
          ></v-select>
</template>
<script>
    export default {
        name: 'stile_type',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number,
            productType: String,
        },
        computed: {
            stileType() {
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
            sType: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'stile_type', value, index: this.index})
                }
            }
        }
    }
</script>
