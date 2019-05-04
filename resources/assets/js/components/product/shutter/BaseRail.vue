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
        name: 'base_rail',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            baseRails() {
                return [
                    'Silver',
                    'Black',
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