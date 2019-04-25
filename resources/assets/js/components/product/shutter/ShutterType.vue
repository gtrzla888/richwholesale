<template>
    <v-select
            :items="shutterType"
             v-model="sType"
            label="Shutter Type"
            :rules="[v => !!v || 'Shutter Type is required']"
            required
            :value="value"
          ></v-select>
</template>
<script>
    export default {
        name: 'shutter_type',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            shutterType() {
                return  [
                    'Standard',
                    'Sliding',
                    'Bifold Track',
                    'U Channel',
                ]
            },
            sType: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'shutter_type', value, index: this.index})
                }
            }
        }
    }
</script>
