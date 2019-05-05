<template>
    <v-text-field
            :value="value"
            v-model="mdh"
            label="Mid Rail Height"
            :rules="[v => !!v || 'Mid rail Height is required']"
            type="text"
    ></v-text-field>
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
