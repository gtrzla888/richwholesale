<template>
    <v-select
            :items="shutterType"
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
            value: String
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
        }
    }
</script>
