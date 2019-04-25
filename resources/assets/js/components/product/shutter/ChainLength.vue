<template>
    <v-text-field
        :value="value"
        v-model="chainLength"
        label="Chain Length"
        :rules="[v => !!v || 'Chain Length is required']"
        type="text"
          ></v-text-field>
</template>
<script>
    export default {
        name: 'chain_length',
        data: () => ({
        
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            chainLength: {
                get() {
                    return this.value
                },
                set(value) {
                    this.$emit('productChanged', {field: 'chain_length', value, index: this.index}) 
                }
            }
        },
        methods: {
        }
    }
</script>
