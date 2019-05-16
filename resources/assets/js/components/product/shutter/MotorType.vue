<template>
    <v-select
            :items="motorTypes"
            v-model="motorType"
            :value="value"
            label="Motor Type"
            :rules="[v => !!v || 'Motor Type is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'motor_type',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            motorTypes() {
                return [
                'NA',
                'Acmeda 240v',
                'Acmeda Li Ion 1.1nm',
                'Acmeda Li Ion 3.0nm'
                ]
            },
            motorType: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'mid_rail', value, index: this.index})
                }
            }
        }
    }
</script>