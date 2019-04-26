<template>
    <v-select
            :items="controlSides"
            v-model="controlSide"
            :value="value"
            label="Control Side"
            :rules="[v => !!v || 'Control Side is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'control_side',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            controlSides() {
                return [
                'Left',
                'Right'
                ]
            },
            controlSide: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'control_side', value, index: this.index})
                }
            }
        }
    }
</script>