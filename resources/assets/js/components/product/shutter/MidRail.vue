<template>
    <v-select
            :items="midRail"
            label="Mid Rail"
            :rules="[v => !!v || 'Shutter Type is required']"
            required
            :value="value"
          ></v-select>
</template>
<script>
    export default {
        name: 'mid_rail',
        data: () => ({
        }),
        props: {
            value: String
        },
        computed: {
            midRail() {
                return [
                'Centre',
                '1',
                '2',
                '3'
                ]
            },
        }
    }
</script>