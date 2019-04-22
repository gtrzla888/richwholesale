<template>
    <v-text-field
            :value="value"
            label="Drop(mm)"
            type = "number"
            :rules="[v => !!v || 'Drop is required']"
            min="0"
            required
            single-line
            counter
            autofocus
    ></v-text-field>
</template>
<script>
    export default {
        name: 'drop',
        data: () => ({
        }),
        props: {
            value: String
        }
    }
</script>
