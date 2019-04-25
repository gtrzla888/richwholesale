<template>
    <v-select
            :items="bracketOptions"
            v-model="bracketOption"
            :value="value"
            label="Bracket Options"
            :rules="[v => !!v || 'Bracket Options is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'bracket_options',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            bracketOptions() {
                return [
                'Single',
                'Slim Combo Top Front',
                'Slim Combo Top Back',
                'Double Bracket'
                ]
            },
            bracketOption: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'bracket_options', value, index: this.index})
                }
            }
        }
    }
</script>