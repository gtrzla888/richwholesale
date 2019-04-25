<template>
    <v-select
            :items="inOrOut"
            v-model="io"
            label="In or Out"
            :rules="[v => !!v || 'Shutter Type is required']"
            required
            :value="value"
          ></v-select>
</template>
<script>
    export default {
        name: 'in_or_out',
        data: () => ({
        
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            inOrOut() {
                return  [
                    'In',
                    'Out',
                ]
            },
            io: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'in_or_out', value, index: this.index}) 
                }
            }

        }
    }
</script>
