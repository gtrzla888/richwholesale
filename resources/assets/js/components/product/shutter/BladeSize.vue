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
            index: Number
        },
        computed: {
            bladeSize() {
                return [
                '47mm',
                '89mm',
                '64mm',
                '114mm'
                ]
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