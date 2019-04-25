<template>
    <v-select
            :items="componentColors"
            v-model="componentColor"
            :value="value"
            label="Component Color"
            :rules="[v => !!v || 'Component Color is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'component_colour',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            componentColors() {
                return [
                'White',
                'Black',
                ]
            },
            componentColor: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'component_colour', value, index: this.index})
                }
            }
        }
    }
</script>