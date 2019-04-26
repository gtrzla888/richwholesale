<template>
    <v-select
            :items="remotes"
            v-model="remote"
            :value="value"
            label="Remotes"
            :rules="[v => !!v || 'Remotes is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'remote',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            remotes() {
                return [
                'Single',
                'Slim Combo Top Front',
                'Slim Combo Top Back',
                'Double Bracket'
                ]
            },
            remote: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'bracket_options', value, index: this.index})
                }
            }
        }
    }
</script>