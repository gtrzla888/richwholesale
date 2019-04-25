<template>
    <v-select
            :items="baseRails"
            v-model="baseRail"
            :value="value"
            label="Base Rail"
            :rules="[v => !!v || 'Base Rail is required']"
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
            index: Number
        },
        computed: {
            baseRails() {
                return [
                '47mm',
                '89mm',
                '64mm',
                '114mm'
                ]
            },
            baseRail: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'base_rail', value, index: this.index})
                }
            }
        }
    }
</script>