<template>
    <v-text-field
            :value="value"
            v-model="name"
            single-line
            :counter="10"
            :rules="[v => !!v || 'Name is required']"
            label="Name"
            autofocus
            required
    ></v-text-field>
</template>
<script>
    export default {
        name: 'name',
        data: () => ({
        
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            name: {
                get() {
                    return this.value
                },
                set(value) {
                    this.$emit('productChanged', {field: 'name', value, index: this.index}) 
                }
            }
        },
        methods: {
        }
    }
</script>
