<template>
    <v-text-field
            label="Panel Layout"
            :rules="[v => !!v || 'Panel Layout is required']"
            required
            type="text"
            :value="value"
          ></v-text-field>
</template>
<script>
    export default {
        name: 'panel_layout',
        data: () => ({
        }),
        props: {
            value: String
        },
        computed: {
        }
    }
</script>
