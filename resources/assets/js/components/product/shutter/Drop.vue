<template>
    <v-text-field
            :value="value"
            v-model="drop"
            label="Drop(mm)"
            type = "number"
            :rules="[v => !!v || 'Drop is required']"
            min="0"
            required
            single-line
            counter
            autofocus
    ></v-text-field>
</template>
<script>
    export default {
        name: 'drop',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            drop: {
                get() {
                    return this.value
                },
                set(value) {
                    this.$emit('productChanged', {field: 'drop', value, index: this.index}) 
                }
            }
        }
    }
</script>
