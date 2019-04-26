<template>
    <v-select
            :items="chargers"
            v-model="charger"
            :value="value"
            label="Chargers"
            :rules="[v => !!v || 'Chargers is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'charger',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            chargers() {
                return [
                'na',
                'Yes',
                ]
            },
            charger: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'charger', value, index: this.index})
                }
            }
        }
    }
</script>