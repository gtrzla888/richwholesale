<template>
    <v-select
            :items="fabrics"
            v-model="fabric"
            :value="value"
            label="Fabric"
            :rules="[v => !!v || 'Fabric is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'fabric',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            fabrics() {
                return [
                'na',
                'Acmeda Pulse',
                ]
            },
            fabric: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'fabric', value, index: this.index})
                }
            }
        }
    }
</script>