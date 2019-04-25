<template>
    <v-select
            :items="tiltRod"
            v-model="tRod"
            :value="value"
            label="Tilt Rod"
            :rules="[v => !!v || 'Tilt Rod is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'tilt_rod',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            tiltRod() {
                return [
                'Clear View',
                'Central'
                ]
            },
            tRod: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'tilt_rod', value, index: this.index})
                }
            }
        }
    }
</script>