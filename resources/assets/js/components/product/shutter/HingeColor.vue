<template>
    <v-select
            :items="hingeColors"
            v-model="hColors"
            :value="value"
            label="Hinge Color"
            :rules="[v => !!v || 'Hinge Color is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'hinge_color',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            hingeColors() {
                return [
                'White',
                'Bright Brass',
                'Nickel',
                'Black',
                'Stainless',
                'Colour Match'
                ]
            },
            hColors: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'hinge_color', value, index: this.index})
                }
            }
        }
    }
</script>