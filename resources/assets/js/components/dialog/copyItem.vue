<template>
    <v-dialog
    v-model="isCopyDialogOpen"
    persistent=""
    width="50vw"
  >
        <v-form
        ref="form"
        v-model="valid"
        :lazy-validation="true"
        >
        <v-card>
            <v-card-title>
                <h3>Fill the fields and copy the current product</h3>
            </v-card-title>
            <v-card-text>
                <v-text-field
                  v-model="product.name"
                  :counter="3"
                  :rules="[v => !!v || 'Name is required', v => (v && v.length >= 3) || 'Name must be more than 3 characters']"
                  label="Name"
                  required
                ></v-text-field>

                <v-text-field
                  v-model="product.width"
                  label="Width(mm)"
                  :rules="widthRules"
                  type = "number"
                  min="0"
                  required
                  @input="calculateSqm"
                ></v-text-field>

                <v-text-field
                  v-model="product.drop"
                  label="Drop(mm)"
                  type = "number"
                  :rules="dropRules"
                  min="0"
                  required
                  @input="calculateSqm"
                >
                </v-text-field>

                <v-text-field
                  v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
                  :value="product.sqm"
                  label="Sqm(auto calculated)"
                  readonly
                ></v-text-field>

                <v-text-field
                  v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
                  v-model="product.panel_layout"
                  label="Panel Layout"
                  :rules="[v => !!v || 'Panel layout is required', v =>  /[LTRDltrd-]/gm.test(v) || 'Panel Layout is not valid']"
                  required
                  type="text"
                ></v-text-field>

                <v-text-field
                  v-if="productType==='basswood_shutters' || productType==='pvc_shutters' || productType==='aluminium_shutters' || productType==='au_pvc_shutters'"
                  :value="product.panel_qty"
                  label="Panel Quantity"
                  type="number"
                  readonly
                ></v-text-field>
            </v-card-text>
            <v-card-actions>
                <v-btn color="secondary" flat @click.stop="onCancel">Close</v-btn>
                <v-btn color="primary" flat @click.stop="onCopy">Copy</v-btn>
            </v-card-actions>
        </v-card>
        </v-form>
    </v-dialog>
</template>
<script>
import {mapGetters} from 'vuex'
import {eventBus} from '../../app'
export default {
    name: 'copyItem',
    data: () => ({
        valid: false,
    }),
    methods: {
      onCopy(event) {
        if (!this.$refs.form.validate()) {
           return
        }
        this.calculateSqm()
        this.calculatePQTY()
        this.$store.dispatch('copyOrderProduct', {selectedTabKey: this.type, product: this.selectedProduct, index: eventBus.selectedProudctIndex})
        this.$store.dispatch('updateCopyItemDialogStatus', {status: false})
      },
      onCancel() {
        this.$refs.form.reset()
        this.$store.dispatch('updateCopyItemDialogStatus', {status: false})
      },
      calculateSqm() {
        this.product.sqm = this.product.width * this.product.drop / 10000;
      },
      calculatePQTY() {
        this.product.panel_qty = (this.product.panel_layout.toUpperCase().match(/L/g) || []).length + (this.product.panel_layout.toUpperCase().match(/R/g) || []).length
      }
    },
    computed: {
      ...mapGetters(['isCopyDialogOpen']),
          dropRules() {
        switch(this.productType) {
          case 'pvc_shutters':
          case 'au_pvc_shutters':
            return [
               v => !!v || 'Drop is required',
                v => (
                 v && v <= 2440 && v >= 250
               ) || 'Drop must be less than 2440mm and greater than 250mm',
            ]
            case 'aluminium_shutters':
            return [
                v => !!v || 'Drop is required',
                v => (
                 v && v <= 3050 && v >= 250
               ) || 'Drop must be less than 3050mm and greater than 250mm',
            ]
            case 'basswood_shutters':
            return [
                v => !!v || 'Drop is required',
                v => (
                 v  && v >= 300
               ) || 'Drop must be greater than 300mm',
            ]
          case 'roller_blinds':
            return [
                v => !!v || 'Drop is required',
                v => (
                 v  && v <= 3300
               ) || 'Drop must be less than 3300mm',
            ]
        }
      },
      widthRules() {
        switch(this.productType) {
          case 'pvc_shutters':
          case 'au_pvc_shutters':
            return [
               v => !!v || 'Width is required',
                v => (
                 v && v >= 250
               ) || 'Width must be greater than 250mm',
            ]
            case 'aluminium_shutters':
            return [
                v => !!v || 'Width is required',
                v => (
                 v && v >= 250
               ) || 'Width must be greater than 250mm',
            ]
            case 'basswood_shutters':
            return [
                v => !!v || 'Width is required',
                v => (
                 v  && v >= 300
               ) || 'Width must be greater than 300mm',
            ]
          case 'roller_blinds':
            return [
                v => !!v || 'Width is required',
                v => (
                 v  && v <= 3010
               ) || 'Width must be less than 3010mm',
            ]
        }
      },
      product: {
        get() {
            return this.selectedProduct
        },
        set() {

        }
      },

    },
    props: {
      productType: String,
      selectedProduct: Object,
    }
}
</script>
