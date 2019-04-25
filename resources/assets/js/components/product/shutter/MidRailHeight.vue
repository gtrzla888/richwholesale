<template>
    <v-select
            :items="midRailHeight"
            :value="value"
            v-model="mdh"
            label="Mid Rail Height"
            :rules="[v => !!v || 'Mid rail Height is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'mid_rail_height',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            midRailHeight() {
                return [
                'Centre',
                '1',
                '2',
                '3'
                ]
            },
            mdh: {
                get() {
                    return this.value
                },
                set(value) {
                    this.$emit('productChanged', {field: 'mid_rail_height', value, index: this.index}) 
                }
            }
        }
    }
</script>