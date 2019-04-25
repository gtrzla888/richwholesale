<template>
    <v-select
            :items="types"
             v-model="sType"
            label="Type"
            :rules="[v => !!v || 'Type is required']"
            required
            :value="value"
          ></v-select>
</template>
<script>
    export default {
        name: 'type',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            types() {
                return  [
                    'Blockout',
                    'Screen',
                    'Light Filter',
                ]
            },
            sType: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'type', value, index: this.index})
                }
            }
        }
    }
</script>
