<template>
    <v-select
            :items="remotes"
            v-model="remote"
            :value="value"
            label="Remote"
            :rules="[v => !!v || 'Remote is required']"
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
                    'na',
                    '1 Channel',
                    '15 Channel',
                ]
            },
            remote: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'remote', value, index: this.index})
                }
            }
        }
    }
</script>