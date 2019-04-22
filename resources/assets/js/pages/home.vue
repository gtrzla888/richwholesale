<template>
    <v-form ref="form" lazy-validation>
    <v-layout row wrap align-center>

        <v-flex xs12 sm3 d-flex>
            <v-select
                    :items="companies"
                    item-text="name"
                    item-value="id"
                    outline
                    label="Company Name (Select)"
                    class="mx-3"
                    v-model="company_id"
            ></v-select>
        </v-flex>
        <v-spacer></v-spacer>
        <v-flex xs12 sm3 d-flex>
            <v-dialog
                    ref="dialog"
                    v-model="modal"
                    :return-value.sync="todays"
                    persistent
                    lazy
                    full-width
                    width="290px"
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                            v-model="todays"
                            label="Todays Date (Display) "
                            prepend-inner-icon="event"
                            readonly
                            outline
                            class="mx-3"
                            v-on="on"
                    ></v-text-field>
                </template>
                <v-date-picker v-model="todays" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
                    <v-btn flat color="primary" @click="$refs.dialog.save(todays)">OK</v-btn>
                </v-date-picker>
            </v-dialog>
        </v-flex>
        <v-spacer></v-spacer>
        <v-flex xs12 sm3 d-flex>
            <v-text-field
                    v-model="po_reference"
                    :counter="10"
                    outline
                    :rules="poRefRules"
                    label="PO Number or Reference"
                    class="mx-3"
                    required
            ></v-text-field>
        </v-flex>
        <v-spacer></v-spacer>
        <v-flex xs12 sm3 d-flex>
            <v-text-field
                    class="mx-3"
                    outline
                    label="Customer Name"
                    prepend-inner-icon="people"
            ></v-text-field>
        </v-flex>

        <v-flex xs12 sm12 d-flex>
            <v-textarea
                    name="notes"
                    label="Notes"
                    rows="1"
                    v-model="notes"
                    class="mx-3"
                    outline
                    auto-grow
            ></v-textarea>
        </v-flex>

        <v-flex xs12 sm12 d-flex>
            <v-toolbar
                    dark
                    color = "#748C5D"
            >
                <!--          <v-toolbar-side-icon></v-toolbar-side-icon>-->
                <v-toolbar-title>Total price $10000</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items class="hidden-sm-and-down">
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn fab small color="#748C5D" dark v-on="on" @click.prevent="openAddItemWindow">
                                <v-icon>add</v-icon>
                            </v-btn>
                        </template>
                        <span>Add item</span>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn fab small color="#748C5D" dark v-on="on" @click="saveOrder">
                                <v-icon>save</v-icon>
                            </v-btn>
                        </template>
                        <span>Save quote</span>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn fab small color="#748C5D" dark v-on="on"  @click="submitOrder">
                                <v-icon>send</v-icon>
                            </v-btn>
                        </template>
                        <span>Submit order</span>
                    </v-tooltip>
                </v-toolbar-items>
            </v-toolbar>
        </v-flex>

        <v-flex xs12 sm12 d-flex>
            <v-tabs
                    v-model="active"
                    color="#748C5D"
                    dark
                    grow
                    slider-color="#F2D7B6"
                    @change="getProducts"
            >
                <v-tab
                        v-for="product in products"
                        :key="product.name"
                        ripple
                >
                    {{product.name}}
                </v-tab>
                <v-tab-item
                        v-for="product in products"
                        :key="product.name"
                >
                    <app-product-list :headers="product.headers" :items="order[selectedTabKey]" @edit="onEdit" @remove="onRemove"></app-product-list>
                  <v-snackbar
                    v-model="snackBar.showSnack"
                    :bottom="true"
                    :timeout="snackBar.timeout"
                  >
                    {{ snackBar.text }}
                    <v-btn
                      color="pink"
                      flat
                      @click="snackBar.showSnack = false"
                    >
                      Close
                    </v-btn>
                  </v-snackbar>
                </v-tab-item>
            </v-tabs>
        </v-flex>
        <app-add-item @clicked="onProductSubmit" :type="selectedTabKey" :selectedProduct.sync="selectedProduct"></app-add-item>
    </v-layout>
    </v-form>
</template>

<script>
  import {mapGetters} from 'vuex'
  import addItemWindow from '~/components/dialog/addItem'
  import productList from '~/components/table/productItem'
  export default {
    name: 'home-view',
    metaInfo () {
      return { title: this.$t('home') }
    },
    data: () => ({
      todays: new Date().toISOString().substr(0, 10),
      modal: false,
      poRefRules: [
        v => !!v || 'PO number is required',
      ],
      search: null,
      active: null,
      selectedTabKey: '',
      selectedProduct: {},
      selectedProductIndex: null,
      snackBar: {
        showSnack: false,
        timeout: 6000,
        text: ''
      }
    }),
    methods: {
      openAddItemWindow() {
        this.$store.dispatch('updateAddItemDialogStatus', {status: true});
        this.selectedProduct = {}
        this.selectedProductIndex = null
      },
      getProducts(index) {
        this.selectedTabKey = this.products[index].key;
      },
      saveOrder() {
        this.$store.dispatch('saveOrder', this.order)
        this.snackBar.text = "Your order is saved."
        this.snackBar.showSnack = true
      },
      onProductSubmit (product) {
        if (this.selectedProductIndex !== null) {
          this.order[this.selectedTabKey][this.selectedProductIndex] = product
          this.$store.dispatch('updateOrder', this.order)
        } else {
          let payload = {};
          payload.selectedKey = this.selectedTabKey;
          payload.product = product;
          this.$store.dispatch('insertOrder', payload)
          this.snackBar.text = 'Your order item is added'
          this.snackBar.showSnack = true
        }
     
        this.selectedProduct = {}
      },
      onEdit(index) {
        this.selectedProductIndex = index
        this.selectedProduct = this.order[this.selectedTabKey][index]
        this.$store.dispatch('updateAddItemDialogStatus', {status: true});
      },
      onRemove(index) {
          this.$store.dispatch('removeOrderProduct', {selectedTabKey: this.selectedTabKey, index: index})
      },
      submitOrder() {
          this.$store.dispatch('submitOrder', this.order)
      }
    },
    computed: {
      ...mapGetters(['products']),
      companies: {
        get() {
            return this.$store.state.auth.user.companies;
        },
      },
      order: {
        get() {
          return this.$store.state.order;
        },
        set(newOrder) {
          this.$store.dispatch('saveOrder', newOrder)
        }
      },
      notes: {
        get () {
          return this.$store.state.order.notes
        },
        set (value) {
          this.$store.commit('updateMessage', value)
        }
      },
      po_reference: {
         get () {
           return this.$store.state.order.po_reference
        },
        set (value) {
          this.$store.dispatch('updatePoReference', value)
        }
      },
      company_id: {
         get () {
            return this.$store.state.order.company_id
        },
        set (value) {
          this.$store.dispatch('updateCompanyId', value)
        }
      }
    },
    components: {
      appAddItem: addItemWindow,
      appProductList: productList
    },
    created () {
      // fetch the companies
      this.$store.dispatch('fetchProducts')
    }
  }
</script>
<style lang="stylus" scoped>
    a .primary--text
        color: #212626 !important
</style>
