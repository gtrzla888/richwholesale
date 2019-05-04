<template>
<form @submit.prevent="update" @keydown="form.onKeydown($event)">
  <v-container fluid grid-list-xl>
  <v-layout row wrap>
      <v-flex  xs12 sm6 md8>
        <v-layout row>
          <v-flex d-flex md6>
              <v-select
                :items="companies"
                item-text="name"
                item-value="id"
                label="Company Name"
                outline
              >
              </v-select>
          </v-flex>
          <v-flex d-flex md6>
            <div>
              <v-text-field
                label="Today Date"
                outline
                :value='today'
                readonly
              ></v-text-field>
            </div>
          </v-flex>
        </v-layout>
        <h3 class="heading">Company Specific</h3>
        <v-layout row>
          <v-flex md6>
            <v-text-field
              label="ABN"
              outline
              :value.sync="form.abn"
            ></v-text-field>
          </v-flex>
          <v-flex d-flex md6>
            
          </v-flex>
        </v-layout>
        <h3 class="heading">Billing Address</h3>
        <v-layout row>
          <v-flex md6>
            <v-text-field
              label="Attention"
              outline
              :value.sync="form.companyName"
            ></v-text-field>
          </v-flex>
          <v-flex d-flex md6>
            <v-text-field
              label="Contact Number"
              outline
              :value.sync="form.companyContactNo"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
            <v-text-field
              label="Address line 1"
              outline
              :value.sync="form.address1"
            ></v-text-field>
          </v-flex>
          <v-flex d-flex md6>
            <v-text-field
              label="Address line 2"
              outline
              :value.sync="form.address2"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
            <v-text-field
              label="City"
              outline
              :value.sync="form.city"
            ></v-text-field>
          </v-flex>
          <v-flex d-flex md6>
            <v-text-field
              label="State/Territory"
              outline
              :value.sync="form.stateTerritory"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
            <v-text-field
              label="Postcode"
              outline
              :value.sync="form.postcode"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <h3 class="heading">Delivery Address</h3>
        <v-layout row>
          <v-flex d-flex md6>
            <v-text-field
              label="Name"
              outline
              :value.sync="form.deliveryName"
            ></v-text-field>
          </v-flex>
          <v-flex d-flex md6>
            <v-text-field
              label="Contact Number"
              outline
              :value.sync="form.deliveryContactNo"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
             <v-text-field
              label="Address line 1"
              outline
              :value.sync="form.deliveryAddress1"
            ></v-text-field>
          </v-flex>
           <v-flex d-flex md6>
             <v-text-field
              label="Address line 2"
              outline
              :value.sync="form.deliveryAddress2"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
             <v-text-field
              label="City"
              outline
              :value.sync="form.deliveryCity"
            ></v-text-field>
          </v-flex>
           <v-flex d-flex md6>
             <v-text-field
              label="Sate/Territory"
              outline
              :value.sync="form.deliveryStateTerritory"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
             <v-text-field
              label="Postcode"
              outline
              :value.sync="form.deliveryPostcode"
            ></v-text-field>
          </v-flex> 
        </v-layout>
      </v-flex>
      <v-flex d-flex  xs12 sm6 md4>
        <v-card flat>
            <v-card-title primary-title>
              <h3 class="heading mb-0"> Logged in as {{ user.name }} </h3>
            </v-card-title>
            <v-card-text>
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
              <submit-button :flat="false" color="primary" :form="form" :label="$t('update')"></submit-button>
            </v-card-actions>
        </v-card>
      </v-flex>
  </v-layout>
  </v-container>
</form>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import { validateMixin } from '~/plugins/validation'
import moment from 'moment'

export default {
  name: 'profile-view',
  data: () => ({
    form: new Form({
      name: '',
      email: '',
      role: '',
      contactNumber: '',
      abn: '',
      companyName: '',
      companyContactNo: '',
      address1: '',
      address2: '',
      city: '',
      stateTerritory: '',
      postcode: '',
      deliveryName: '',
      deliveryContactNo: '',
      deliveryAddress1: '',
      deliveryAddress2: '',
      deliveryCity: '',
      deliveryStateTerritory: '',
      deliveryPostcode: ''
    }),
    today: moment().format('YYYY-MM-DD')
  }),

  computed: mapGetters({
    user: 'authUser',
    companies: 'companies'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
    this.$store.dispatch('fetchCompanies')
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

