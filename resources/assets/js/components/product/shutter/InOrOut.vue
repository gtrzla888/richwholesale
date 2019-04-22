<template>
    <v-select
            :items="inOrOut"
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
            value: String
        },
        computed: {
            inOrOut() {
                return  [
                    'In',
                    'Out',
                ]
            },
        }
    }
</script>
