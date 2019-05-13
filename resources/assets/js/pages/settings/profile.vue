<template>
  <v-form
    @submit.prevent="update"
    ref="form"
    v-model="valid"
  >
    <v-container fluid grid-list-xl>
      <v-layout row wrap>
        <v-flex xs12 sm6 md8>
          <v-layout row>
            <v-flex d-flex md6>
              <v-select
                :items="user.companies"
                item-text="name"
                item-value="id"
                label="Company Name"
                outline
                :value.sync="form.company.id"
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
                label="ABN"
                outline
                :rules="[v => !!v || 'ABN is required']"
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
                label="Attention"
                outline
                :rules="[v => !!v || 'Attention is required']"
                v-model="form.company.billingAddress.attention"
              ></v-text-field>
            </v-flex>
            <v-flex d-flex md6>
              <v-text-field
                label="Contact Number"
                outline
                :rules="[v => !!v || 'Contact number is required']"
                v-model="form.company.billingAddress.contact_number"
              ></v-text-field>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex d-flex md6>
              <v-text-field
                label="Address line 1"
                outline
                :rules="[v => !!v || 'Address is required']"
                v-model="form.company.billingAddress.address1"
              ></v-text-field>
            </v-flex>
            <v-flex d-flex md6>
              <v-text-field
                label="Address line 2"
                outline
                v-model="form.company.billingAddress.address2"
              ></v-text-field>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex d-flex md6>
              <v-text-field
                label="City"
                outline
                :rules="[v => !!v || 'City is required']"
                v-model="form.company.billingAddress.city"
              ></v-text-field>
            </v-flex>
            <v-flex d-flex md6>
              <v-text-field
                label="State/Territory"
                :rules="[v => !!v || 'State is required']"
                outline
                v-model="form.company.billingAddress.state"
              ></v-text-field>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex d-flex md6>
              <v-text-field
                label="Postcode"
                :rules="[v => !!v || 'Postcode is required']"
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
                :rules="[v => !!v || 'Name is required']"
                outline
                v-model="form.company.deliveryAddress.name"
              ></v-text-field>
            </v-flex>
            <v-flex d-flex md6>
              <v-text-field
                label="Contact Number"
                :rules="[v => !!v || 'Contact Number is required']"
                outline
                v-model="form.company.deliveryAddress.contact_number"
              ></v-text-field>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex d-flex md6>
              <v-text-field
                label="Address line 1"
                :rules="[v => !!v || 'Address is required']"
                outline
                v-model="form.company.deliveryAddress.address1"
              ></v-text-field>
            </v-flex>
            <v-flex d-flex md6>
              <v-text-field
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
                :rules="[v => !!v || 'City is required']"
                v-model="form.company.deliveryAddress.city"
              ></v-text-field>
            </v-flex>
            <v-flex d-flex md6>
              <v-text-field
                label="Sate/Territory"
                :rules="[v => !!v || 'State is required']"
                outline
                v-model="form.company.deliveryAddress.state"
              ></v-text-field>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex d-flex md6>
              <v-text-field
                label="Postcode"
                :rules="[v => !!v || 'Postcode is required']"
                outline
                v-model="form.company.deliveryAddress.postcode"
              ></v-text-field>
            </v-flex>
          </v-layout>
        </v-flex>
        <v-flex d-flex xs12 sm6 md4>
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
              <v-text-field
                :label="$t('name')"
                v-model="form.name"
                counter="30"
                data-vv-name="name"
                v-validate="'required|max:30'"
              ></v-text-field>

              <!-- contact -->
              <v-text-field
                v-validate="'numeric|max:10'"
                v-model="form.contact_number"
                label="Contact Number"
                data-vv-name="contact"
              ></v-text-field>

              <!-- Email -->
              <v-text-field
                :label="$t('email')"
                v-model="form.email"
                v-validate="'required|email'"
                data-vv-name="email"
              ></v-text-field>


            </v-card-text>
            <v-card-actions>
              <submit-button :flat="false" color="primary" :form="form" :label="$t('update')"></submit-button>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  import Form from 'vform'
  import { mapGetters } from 'vuex'
  import { validateMixin } from '~/plugins/validation'
  import moment from 'moment'
  import _ from 'lodash'

  export default {
    name: 'profile-view',
    data: () => (
      {
        valid: true,
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
              postcode: '',
            },
            deliveryAddress: {
              name: '',
              contact_number: '',
              address1: '',
              address2: '',
              city: '',
              state: '',
              postcode: '',
            },
          },
        }),
        today: moment().format('YYYY-MM-DD'),
      }
    ),

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
      this.form.company = JSON.parse(JSON.stringify(this.user.companies[0]))
    },
    methods: {
      async update (event) {
        if (!await this.$refs.form.validate()) {
          return
        }

        this.$emit('busy', true)

        const { data } = await this.form.patch('/api/settings/profile')

        await this.$store.dispatch('updateUser', { user: data })
        this.$emit('busy', false)

        this.$store.dispatch('responseMessage', {
          type: 'success',
          text: this.$t('info_updated'),
        })
      },
      changeCompany (value) {
        this.form.company = _.find(JSON.parse(JSON.stringify(this.user.companies)), (company) => company.id === value)
        this.$refs.form.resetValidation()
      },
    }
  }
</script>

