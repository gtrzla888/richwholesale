<template>
    <v-select
            :items="wifiHubs"
            v-model="wifiHub"
            :value="value"
            label="WiFi Hub"
            :rules="[v => !!v || 'WiFi Hub is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'wifi_hub',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            wifiHubs() {
                return [
                'na',
                'Acmeda Pulse',
                ]
            },
            wifiHub: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'wifi_hub', value, index: this.index})
                }
            }
        }
    }
</script>