<template>
  <v-flex style="overflow: auto">
      <v-data-table
      :headers="headers"
      :items="items"
      hide-actions
      item-key="name"
      class="product-list"
    >
      <template v-slot:items="props">
        <tr :active="props.selected" @click="props.selected = !props.selected">
          <td class="text-xs-right" v-for="header in headers" v-if="header.value !== 'actions'" v-bind:key="header.value">
              {{props.item[header.value]}}
          </td>
          <td class="text-xs-center">
            <v-menu offset-x left bottom>
              <v-btn
                      icon
                      slot="activator">
                <v-icon>more_vert</v-icon>
              </v-btn>
              <v-list>
                <v-list-tile @click="onEdit(props.index)">
                  <v-list-tile-title >Edit</v-list-tile-title>
                </v-list-tile>
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
    props: ['headers', 'items'],
    data: () => ({
      max25chars: v => v.length <= 25 || 'Input too long!',
      pagination: {
        sortBy: 'width'
      },
    }),

    methods: {
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
      save () {
        this.snack = true
        this.snackText = 'Data saved'
      },
      cancel () {
        this.snack = true
        this.snackText = 'Canceled'
      },
      open () {
        this.snack = true
        this.snackText = 'Dialog opened'
      },
      close () {
        console.log('Dialog closed')
      },
      onEdit(index) {
         this.$emit('edit', index)
      },
      onRemove(index) {
         this.$emit('remove', index)
      }
    }
  }
</script>

<style scoped lang="stylus">
  table.v-table thead td:not(:nth-child(1)), table.v-table tbody td:not(:nth-child(1)), table.v-table thead th:not(:nth-child(1)), table.v-table tbody th:not(:nth-child(1)), table.v-table thead td:first-child, table.v-table tbody td:first-child, table.v-table thead th:first-child, table.v-table tbody th:first-child
    padding: 0!important;
    max-width: 7%;
</style>
