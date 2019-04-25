<template>
    <v-text-field
            :value="value"
            v-model="panel_layout"
            label="Panel Layout"
            :rules="rules"
            required
            type="text"
            :disabled="disabled"
          ></v-text-field>
</template>
<script>
    export default {
        name: 'panel_layout',
        data: () => ({
            disabled: false,
            rules: [v => !!v || 'Panel layout is required', v =>  /[LTRD-]/gm.test(v) || 'Panel Layout is not valid']
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            panel_layout: {
                get() {
                    return this.value
                },
                set(value) {
                    this.$emit('productChanged', {field: 'panel_layout', value, index: this.index}) 
                }
            }
        }
    }
</script>
