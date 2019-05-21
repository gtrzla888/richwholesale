<template>
  <v-layout row wrap align-center>
    <v-flex xs9></v-flex>
    <v-flex xs3>
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        outline
        hide-details
      ></v-text-field>
  
    </v-flex>

    <v-flex xs4>
      <v-select
        :items="companies"
        v-model="company"
        item-text="name"
        item-value="id"
        outline
        label="Company Name (Select)"
        clearable
      ></v-select>
    </v-flex>
    <v-flex xs5></v-flex>
    <v-flex xs3>
      <v-select
        :items="dates"
        v-model="createdAt"
        item-text="text"
        item-value="value"
        outline
        label="Date Filter"
        clearable
      ></v-select>
    </v-flex>

    <v-flex>
      <v-card>
        <v-card-title class="bg-dark">
          <h3 class="headline mb-0">{{ $t('Quotes') }}</h3>
          <v-spacer></v-spacer>
         <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-btn fab small color="#748C5D" dark v-on="on" @click="submitOrder" :disabled="disabled">
                  <v-icon>send</v-icon>
                </v-btn>
              </template>
              <span>Submit Order</span>
            </v-tooltip>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="quotes"
            :search="search"
            select-all
            class="elevation-1"
          >
            <template v-slot:items="props">
              <td>
                <v-checkbox
                  v-model="props.selected"
                  primary
                  hide-details
                ></v-checkbox>
              </td>
              <td>{{ props.item.id }}</td>
              <td class="text-xs-left">{{ props.item.company.name }}</td>
              <td class="text-xs-left">{{ props.item.po_reference }}</td>
              <td class="text-xs-left">{{ props.item.updated_at }}</td>
              <td class="text-xs-left"> 
                 {{ props.item.status }}
                </td>
              <td class="text-xs-left">{{ props.item.created_at }}</td>
              <td class="text-xs-lef">
                <v-menu offset-x left bottom v-if="props.item.status === 'Pending'">
                  <v-btn
                    icon
                    slot="activator">
                    <v-icon>more_vert</v-icon>
                  </v-btn>
                  <v-list>
                    <v-list-tile @click="createCustomerQuote(props.item)">
                      <v-list-tile-title>Create Customer</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile @click="remove(props.item)">
                      <v-list-tile-title>Remove</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile @click="edit(props.item)">
                      <v-list-tile-title>Edit</v-list-tile-title>
                    </v-list-tile>
                  </v-list>
                </v-menu>
              </td>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-flex>

    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-form @submit.prevent="onCreateCustomerQuote" ref="form">
      <v-card>
        <v-card-title>
          <span class="headline">Create customer quote</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm12 md12>
                <v-radio-group v-model="markupType" :rules="[v => !!v || 'Markup Type is required']">
                  <v-radio label="Fixed Markup" value="Fixed Markup"></v-radio>
                  <v-radio label="Percentage Markup" value="Percentage Markup"></v-radio>
                </v-radio-group>
                <v-text-field 
                label="Markup Value" 
                required 
                v-model="markupValue"
                type="number"
                min="0"
                :rules="[v => !!v || 'Markup is required']"
                >
                </v-text-field>
              </v-flex>
            
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" flat type="submit">Save</v-btn>
        </v-card-actions>
      </v-card>
      </v-form>
    </v-dialog>
  </v-layout>
</template>

<script>
  import axios from 'axios'
  import moment from 'moment'
  import { async } from 'q'
  import _ from 'lodash'

  export default {
    data () {
      return {
        selected: [],
        dialog: false,
        items: ['Ordered', 'Pending'],
        search: '',
        markupType: '',
        markupValue: '',
        headers: [
          {
            text: 'Quote #',
            align: 'left',
            sortable: false,
            value: 'id',
          },
          { text: 'Company', value: 'company.name' },
          { text: 'PO / Reference', value: 'po_reference' },
          { text: 'Last modifired', value: 'updated_at' },
          { text: 'Status', value: 'status' },
          { text: 'Order Date', value: 'created_at' },
          { text: 'Actions', value: 'actions', zzssortable: false, },
        ],
        quotes: [],
        companies: [],
        company: '',
        createdAt: '',
        selectedQuoteId: '',
        dates: [
          {
            'value': moment().add(-30, 'days').format('YYYY-MM-DD'),
            'text': 'Last 30 days',
          },
        ],
      }
    },
    name: 'home-view',
    metaInfo () {
      return { title: this.$t('Quotes') }
    },
    methods: {
      async loadQuotes () {
        try {
          const { data } = await axios.get('/api/quotes', { params: { company: this.company, created_at: this.createdAt }})
          this.quotes = data
        } catch (e) {
        }
      },
      async loadCompanies () {
        try {
          const { data } = await axios.get('/api/user/companies')
          this.companies = data
        } catch (e) {
        }
      },
      createCustomerQuote (quote) {
        this.dialog = true
        this.selectedQuoteId = quote.id
      },
      async saveStatus (item) {
        try {
          const { data } = await axios.put('/api/quotes/' + item.id, { status: item.status })
           this.$store.dispatch('responseMessage', {
            type: 'success',
            text: this.$t('Quote Updated')
            })
        } catch (e) {
        }
      },
      async submitOrder() {
        const selectedIds = _.map(this.selected, 'id')
        try {
          const { data } = await axios.post('/api/quotes/submit', { quote_ids: selectedIds })
            this.loadQuotes()
            this.selected = []
           this.$store.dispatch('responseMessage', {
            type: 'success',
            text: this.$t('Quotes Submited')
            })
        } catch (e) {
        }

      },
      edit (quote) {
          this.selectedQuoteId = quote.id
          try {
            this.$store.dispatch('fetchOrder', {id: quote.id})
            this.$router.push('home');
          } catch (e) {
          }
      },
      async remove (quote) {
          this.selectedQuoteId = quote.id
          try {
            await  axios.delete('api/quotes/' + this.selectedQuoteId)
            this.quotes.splice(1, this.selectedQuoteId)
            this.$store.dispatch('responseMessage', {
            type: 'success',
            text: this.$t('Quote Deleted')
            })
          } catch (e) {

          }
      },
      async onCreateCustomerQuote() {
        try {
          if (!this.$refs.form.validate()) {
            return
          }
          this.dialog = false;
          await axios.post('api/quotes/' + this.selectedQuoteId + '/customer-quotes', {
            markup_type: this.markupType, markup_value: this.markupValue
          })
          this.$store.dispatch('responseMessage', {
            type: 'success',
            text: this.$t('Customer Quote Created')
          })
        } catch(e) {
        }
      }
    },
    watch: {
      company () {
        this.loadQuotes()
      },
      createdAt () {
        this.loadQuotes()
      },
    },
    computed: {
      disabled() {
          return this.selected.length < 1; // or === 0   
      }
    },
    created () {
      this.loadQuotes()
      this.loadCompanies()
    },
  }
</script>
<style lang="stylus">
  .bg-dark
    background-color: rgb(116, 140, 93);
    .headline
      color: white;
</style>>


