<template>
    <v-select
            :items="tiltRod"
            v-model="tRod"
            :value="value"
            label="Tilt Rod"
            :rules="[v => !!v || 'Tilt Rod is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'tilt_rod',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number,
            productType: String,
        },
        computed: {
            tiltRod() {
              switch (this.productType) {
                case 'aluminium_shutters':
                case 'au_pvc_shutters':
                  return [
                    'Clear View'
                  ]
                case 'pvc_shutters':
                case 'basswood_shutters':
                  return [
                    'Clear View',
                    'Central',
                  ]
              }
            },
            tRod: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'tilt_rod', value, index: this.index})
                }
            }
        }
    }
</script>
