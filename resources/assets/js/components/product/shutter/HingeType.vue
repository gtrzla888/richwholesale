<template>
    <v-select
            :items="hingeTypes"
            v-model="hingeType"
            :value="value"
            label="Frame Options"
            :rules="[v => !!v || 'Frame Options is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'hinge_type',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            hingeTypes() {
                return [
                'na',
                'Non Mortised',
                'Hang Strip',
                'Pivot'
                ]
            },
            hingeType: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'hinge_type', value, index: this.index})
                }
            }
        }
    }
</script>