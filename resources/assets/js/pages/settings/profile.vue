<template>
  <v-card flat>
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <v-card-title primary-title>
        <h5 class="subheading mb-0">{{ $t('your_info') }}</h5>
      </v-card-title>
      <v-card-text>

<!--        <v-select-->
<!--          v-model="form.role"-->
<!--          :form="form"-->
<!--          :items="roles"-->
<!--          label="Role"-->
<!--        ></v-select>-->
        <v-text-field
          label="Role"
          :value="user.role"
          readonly
        ></v-text-field>

        <!-- Name -->
        <text-input
          :form="form"
          :label="$t('name')"
          :v-errors="errors"
          :value.sync="form.name"
          counter="30"
          name="name"
          v-validate="'required|max:30'"
        ></text-input>

        <!-- contact -->
        <text-input
          :form="form"
          :v-errors="errors"
          v-validate="'required|numeric|max:10'"
          :value.sync="form.contactNumber"
          label="Contact Number"
          name="contact"
        ></text-input>

        <!-- Email -->
        <email-input
          :form="form"
          :label="$t('email')"
          :v-errors="errors"
          :value.sync="form.email"
          name="email"
          v-validate="'required|email'"
        ></email-input>


      </v-card-text>
      <v-card-actions>
        <submit-button :flat="true" :form="form" :label="$t('update')"></submit-button>
      </v-card-actions>
    </form>
  </v-card>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import { validateMixin } from '~/plugins/validation'

export default {
  name: 'profile-view',
  data: () => ({
    form: new Form({
      name: '',
      email: '',
      role: '',
      contactNumber: ''
    })
  }),

  computed: mapGetters({
    user: 'authUser'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },
  mixins: [validateMixin],
  methods: {
    async update () {
      if (await this.formHasErrors()) return

      this.$emit('busy', true)

      const { data } = await this.form.patch('/api/settings/profile')

      await this.$store.dispatch('updateUser', { user: data })
      this.$emit('busy', false)

      this.$store.dispatch('responseMessage', {
        type: 'success',
        text: this.$t('info_updated')
      })
    }
  }
}
</script>

