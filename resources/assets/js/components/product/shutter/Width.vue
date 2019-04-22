<template>
    <v-text-field
            :value="value"
            label="Width(mm)"
            :rules="[v => !!v || 'Width is required']"
            type = "number"
            min="0"
            required
            single-line
            counter
            autofocus
    ></v-text-field>
</template>
<script>
    export default {
        name: 'width',
        data: () => ({
        }),
        props: {
            value: String
        }
    }
</script>
