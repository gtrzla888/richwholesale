<template>
     <v-select
            :items="corners"
            label="Corner"
            :rules="[v => !!v || 'Corner is required']"
            required
            :value="value"
            v-model="corner"
    ></v-select>
</template>
<script>
    export default {
        name: 'corner',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
             corners() {
                return [
                    'No',
                    '90',
                    '135'
                ]
            },
            corner: {
                get() {
                    return this.value
                },
                set(value) {
                    this.$emit('productChanged', {field: 'corner', value, index: this.index}) 
                }
            }
        }
    }
</script>
