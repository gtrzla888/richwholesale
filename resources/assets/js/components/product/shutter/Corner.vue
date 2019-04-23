<template>
     <v-select
            :items="corner"
            label="Corner"
            :rules="[v => !!v || 'Corner is required']"
            required
            :value="value"
            v-model="corner"
            @change="onChange"
    ></v-select>
</template>
<script>
    export default {
        name: 'corner',
        data: () => ({
        }),
        props: {
            value: String,
            index: String
        },
        computed: {
             corners() {
                return [
                    'No',
                    90,
                    135
                ]
            },
        },
        methods: {

        }
    }
</script>
