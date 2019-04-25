<template>
    <v-select
            :items="frameOptions"
            v-model="fOptions"
            :value="value"
            label="Frame Options"
            :rules="[v => !!v || 'Frame Options is required']"
            required
    ></v-select>
</template>
<script>
    export default {
        name: 'frame_options',
        data: () => ({
        }),
        props: {
            value: String,
            index: Number
        },
        computed: {
            frameOptions() {
                return [
                'na',
                'LRTB',
                'LRT',
                'LRB'
                ]
            },
            fOptions: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('productChanged', {field: 'frame_options', value, index: this.index})
                }
            }
        }
    }
</script>