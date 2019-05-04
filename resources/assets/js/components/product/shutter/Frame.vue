<template>
    <v-select
            :items="frames"
            v-model="frame"
            :value="value"
            label="Frame"
            :rules="[v => !!v || 'Frame is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'frame',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number,
            productType: String,
        },
        computed: {
            frames() {
              console.log(this.productType);
              switch (this.productType) {
                case 'aluminium_shutters':
                  return [
                    'No Frame',
                    'L',
                    'U Channel',
                    'Bi Fold',
                    'Sliding'
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
                    'BL65-B10A']
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
            frame: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'frame', value, index: this.index})
                }
            }
        }
    }
</script>
