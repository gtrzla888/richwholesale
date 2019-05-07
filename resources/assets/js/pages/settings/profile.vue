<template>
<form @submit.prevent="update" @keydown="form.onKeydown($event)">
  <v-container fluid grid-list-xl>
  <v-layout row wrap>
      <v-flex  xs12 sm6 md8>
        <v-layout row>
          <v-flex d-flex md6>
              <v-select
                :items="user.companies"
                item-text="name"
                item-value="id"
                label="Company Name"
                outline
                :value="form.company.id"
                @change="changeCompany"
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
              :form="form"
              label="ABN"
              outline
              v-model="form.company.abn"
            ></v-text-field>
          </v-flex>
          <v-flex d-flex md6>
            
          </v-flex>
        </v-layout>
        <h3 class="heading">Billing Address</h3>
        <v-layout row>
          <v-flex md6>
            <v-text-field
              :form="form"
              label="Attention"
              outline
              v-model="form.company.billingAddress.attention"
            ></v-text-field>
          </v-flex>
          <v-flex d-flex md6>
            <v-text-field
              :form="form"
              label="Contact Number"
              outline
              v-model="form.company.billingAddress.contact_number"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
            <v-text-field
              :form="form"
              label="Address line 1"
              outline
              v-model="form.company.billingAddress.address1"
            ></v-text-field>
          </v-flex>
          <v-flex d-flex md6>
            <v-text-field
              :form="form"
              label="Address line 2"
              outline
              v-model="form.company.billingAddress.address2"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
            <v-text-field
              :form="form"
              label="City"
              outline
              v-model="form.company.billingAddress.city"
            ></v-text-field>
          </v-flex>
          <v-flex d-flex md6>
            <v-text-field
              :form="form"
              label="State/Territory"
              outline
              v-model="form.company.billingAddress.state"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
            <v-text-field
              :form="form"
              label="Postcode"
              outline
              v-model="form.company.billingAddress.postcode"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <h3 class="heading">Delivery Address</h3>
        <v-layout row>
          <v-flex d-flex md6>
            <v-text-field
              :form="form"
              label="Name"
              outline
              v-model="form.company.deliveryAddress.name"
            ></v-text-field>
          </v-flex>
          <v-flex d-flex md6>
            <v-text-field
              :form="form"
              label="Contact Number"
              outline
              v-model="form.company.deliveryAddress.contact_number"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
             <v-text-field
               :form="form"
              label="Address line 1"
              outline
              v-model="form.company.deliveryAddress.address1"
            ></v-text-field>
          </v-flex>
           <v-flex d-flex md6>
             <v-text-field
               :form="form"
              label="Address line 2"
              outline
               v-model="form.company.deliveryAddress.address2"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
             <v-text-field
               :form="form"
              label="City"
              outline
               v-model="form.company.deliveryAddress.city"
            ></v-text-field>
          </v-flex>
           <v-flex d-flex md6>
             <v-text-field
               :form="form"
                label="Sate/Territory"
                outline
               v-model="form.company.deliveryAddress.state"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex d-flex md6>
             <v-text-field
               :form="form"
                label="Postcode"
                outline
                v-model="form.company.deliveryAddress.postcode"
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
                v-validate="'numeric|max:10'"
                :value.sync="form.contact_number"
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
import _ from 'lodash'

export default {
  name: 'profile-view',
  data: () => ({
    companies: {},
    selectedCompanyId: '',
    form: new Form({
      name: '',
      email: '',
      role: '',
      contact_number: '',
      company: {
        id: '',
        abn: '',
        billingAddress: {
          attention: '',
          contact_number: '',
          address1: '',
          address2: '',
          city: '',
          state: '',
          postcode: ''
        },
        deliveryAddress: {
          name: '',
          contact_number: '',
          address1: '',
          address2: '',
          city: '',
          state: '',
          postcode: ''
        }
      },
    }),
    today: moment().format('YYYY-MM-DD')
  }),

  computed: mapGetters({
    user: 'authUser',
  }),
  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      if (key !== 'companies') {
        this.form[key] = this.user[key]
      }
    })
    this.form.company =  JSON.parse(JSON.stringify(this.user.companies[0]))
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
    },
    changeCompany(value) {
      this.form.company = _.find(JSON.parse(JSON.stringify(this.user.companies)), (company) => company.id === value)
    }
  }
}
</script>

