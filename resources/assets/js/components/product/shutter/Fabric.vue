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
            index: Number,
            productType: String,
        },
        computed: {
            fabrics() {
                const rollerBlinds = this.$store.state.order.roller_blinds[this.index];
                switch(rollerBlinds.type) {
                    case 'Light Filter':
                        return [
                           'Metroshade',
                            'Riviera',
                            'Tusk',
                            'Jersey',
                            'Balmoral'
                        ]
                    case 'Blockout':
                        return [
                            'Solitaire',
                            'Focus',
                            'Metroshade',
                            'Sanctuary',
                            'Riviera',
                            'Tusk',
                            'Jersey',
                            'Balmoral'
                        ]
                    case 'Screen':
                        return [
                            'One Screen',
                            'Solar View'
                        ]
                }

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
