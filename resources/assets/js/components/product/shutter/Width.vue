<template>
    <v-text-field
            :value="value"
            v-model="width"
            label="Width(mm)"
            :rules="[v => !!v || 'Width is required']"
            type = "number"
            min="0"
            required
            single-line
            counter
            autofocus
    ></v-text-field>
</template>
<script>
    export default {
        name: 'width',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            width: {
                get() {
                    return this.value
                },
                set(value) {
                    this.$emit('productChanged', {field: 'width', value, index: this.index}) 
                }
            }
        },
        methods: {
        }
    }
</script>
