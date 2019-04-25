<template>
    <v-select
            :items="controlTypes"
            v-model="controlType"
            :value="value"
            label="Control Type"
            :rules="[v => !!v || 'Control Type is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'control_type',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            controlTypes() {
                return [
                'Chain',
                'Motor'
                ]
            },
            controlType: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'control_type', value, index: this.index})
                }
            }
        }
    }
</script>