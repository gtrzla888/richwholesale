<template>
  <v-flex style="overflow: auto">
      <v-data-table
      :headers="headers"
      :items="products"
      hide-actions
      item-key="name"
      class="product-list"
    >
      <template v-slot:items="props">
        <tr>
          <td class="text-xs-right" v-for="header in headers" v-if="header.value !== 'actions'" v-bind:key="header.value">

            <v-edit-dialog
                    :return-value="name"
                    large
                    lazy
                    persistent
                    @save="save"
                    @cancel="cancel"
                    @open="open"
                    @close="close"
            >
              {{props.item[header.value]}}
              <template v-slot:input>
                <component v-bind:is="header.value" :value="props.item[header.value]" v-on:productChanged="productChanged" :index="props.index"></component>
              </template>
            </v-edit-dialog>
          </td>
          <td class="text-xs-center">
            <v-menu offset-x left bottom>
              <v-btn
                      icon
                      slot="activator">
                <v-icon>more_vert</v-icon>
              </v-btn>
              <v-list>
                <v-list-tile @click="onRemove(props.index)">
                  <v-list-tile-title >Remove</v-list-tile-title>
                </v-list-tile>
              </v-list>
            </v-menu>
          </td>
        </tr>
      </template>
    </v-data-table>
  </v-flex>
</template>
<script>
  export default {
    data: () => ({
    }),
    computed: {
        name: {
          get() {
            return 'test'
          },
          set() {

          }
        },
        products: {
          get() {
            return this.$store.state.order[this.productType]
          },
          set (value) {
            //this.$store.dispatch('updateProducts', { selectedTabKey: this.productType, value})
          }
        },
        // filters: {
        //   filterActionHeaders (hVal) {
        //     return hVal
        //     // if(hVal.value === 'actions') {
        //     //   return ''
        //     // }else {
        //     //   return hVal
        //     // }
        //   }
        // }
    },
    methods: {
      onUpdateProduct(payload) {
          console.log(payload.id, payload.name)
      },
      toggleAll () {
        if (this.selected.length) this.selected = []
        else this.selected = this.desserts.slice()
      },
      changeSort (column) {
        if (this.pagination.sortBy === column) {
          this.pagination.descending = !this.pagination.descending
        } else {
          this.pagination.sortBy = column
          this.pagination.descending = false
        }
      },
      productChanged(value) {
        console.log(value)
          this.$store.dispatch('updateOrderProduct', { selectedTabKey: this.productType, ...value})
      },
      save (index) {
        this.snack = true
        this.snackText = 'Data saved'
      },
      cancel () {
        this.snack = true
        this.snackText = 'Canceled'
      },
      open (index) {
        this.snack = true
        this.snackText = 'Dialog opened'
      },
      close () {
      },
      onEdit(index) {
         this.$emit('edit', index)
      },
      onRemove(index) {
         this.$emit('remove', index)
      }
    },
    props: {
      productType: String,
      headers: Array,
      items: Object
    },
  }
</script>

<style lang="stylus">
  .v-tabs
    width: 100%;
</style>
