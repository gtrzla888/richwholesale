<template>
    <v-select
            :items="rollDirections"
            v-model="rollDirection"
            :value="value"
            label="Roll Direction"
            :rules="[v => !!v || 'Roll Direction is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'roll_direction',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            rollDirections() {
                return [
                    'Standard',
                    'Reverse',
                ]
            },
            rollDirection: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'roll_direction', value, index: this.index})
                }
            }
        }
    }
</script>