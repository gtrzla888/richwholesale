<template>
  <v-btn large color="primary" v-if="block" block :loading="form.busy" :disabled="form.busy" type="submit">
    {{ label }}
  </v-btn>
  <v-btn large v-else-if="flat" flat :color="color" :loading="form.busy" :disabled="form.busy" type="submit">
    {{ label }}
  </v-btn>
  <v-btn large depressed :color="color" v-else :loading="form.busy" :disabled="form.busy" type="submit">
    {{ label }}
  </v-btn>
</template>

<script>
export default {
  name: 'submit-button',
  props: {
    form: {
      type: Object,
      required: true
    },
    label: {
      type: String,
      required: true
    },
    flat: {
      type: Boolean,
      default: false
    },
    block: {
      type: Boolean,
      default: false
    },
    color: {
      type: String,
      default: 'primary'
    }
  }
}
</script>
