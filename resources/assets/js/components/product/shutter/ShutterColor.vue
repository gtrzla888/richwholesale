<template>
    <v-select
            :items="colors"
            v-model="color"
            :value="value"
            label="Color"
            :rules="[v => !!v || 'Color is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'shutter_color',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            colors() {
                return [
                'W100 Snow',
                'W101 Dove',
                'W104 China',
                'W105 Soft Pearl',
                'W107 Pearl',
                'W109 Linen Wash',
                'W115 Clay',
                'W118 Wheat', 
                'W401 Eggshell',
                'W402 Palm Beach',
                'W00 Custom',
                'S430 Black Ash',
                'S508 Jet',
                'S602 Maple',
                'S604 Aged Teak',
                'S606 Mahogan',
                'S701 Walnut'
                ]
            },
            color: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'shutter_color', value, index: this.index})
                }
            }
        }
    }
</script>