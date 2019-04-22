<template>
    <v-text-field
        :value="value"
        v-model="notes"
        label="Notes"
        type="text"
          ></v-text-field>
</template>
<script>
    export default {
        name: 'notes',
        data: () => ({
        
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            notes: {
                get() {
                    return this.value
                },
                set(value) {
                    this.$emit('productChanged', {field: 'notes', value, index: this.index}) 
                }
            }
        },
        methods: {
        }
    }
</script>
