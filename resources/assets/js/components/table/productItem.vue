<template>
      <v-data-table
      :headers="headers"
      :items="shutters"
      :pagination.sync="pagination"
      select-all
      item-key="name"
      class="product-list"
    >
      <template v-slot:headers="props">
        <tr>
          <th
            v-for="header in props.headers"
            :key="header.text"
            :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '']"
            class="flex align-items-start"
            @click="changeSort(header.value)"
          >
            <v-icon small>arrow_upward</v-icon>
            {{ header.text }}
          </th>
        </tr>
      </template>
      <template v-slot:items="props">
        <tr :active="props.selected" @click="props.selected = !props.selected">
          <td class="p-0">
            <v-edit-dialog
              :return-value.sync="props.item.width"
              lazy
              @save="save"
              @cancel="cancel"
              @open="open"
              @close="close"
            >
              <span class="text-center">{{ props.item.width }}</span>
              <template v-slot:input>
                <v-text-field
                  v-model="props.item.width"
                  :rules="[max25chars]"
                  label="Edit"
                  single-line
                  counter
                ></v-text-field>
              </template>
            </v-edit-dialog>
          </td>
          <td class="text-xs-right" >{{ props.item.drop }}</td>
          <td class="text-xs-right">{{ props.item.sqm }}</td>
          <td class="text-xs-right">{{ props.item.type }}</td>
          <td class="text-xs-right">{{ props.item.layout }}</td>
          <td class="text-xs-right">{{ props.item.qty }}</td>
          <td class="text-xs-right">{{ props.item.io }}</td>
          <td class="text-xs-right">{{ props.item.mdr }}</td>
          <td class="text-xs-right">{{ props.item.mdHeight }}</td>
          <td class="text-xs-right">{{ props.item.bsize }}</td>
          <td class="text-xs-right">{{ props.item.tiltRod }}</td>
          <td class="text-xs-right">{{ props.item.color }}</td>
          <td class="text-xs-right">{{ props.item.frame }}</td>
          <td class="text-xs-right">{{ props.item.notes }}</td>
          <td class="text-xs-right">
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-btn fab small color="#748C5D" dark v-on="on" @click.prevent="openAddItemWindow">
                  <v-icon>remove</v-icon>
                </v-btn>
              </template>
              <span>Remove item</span>
            </v-tooltip>
          </td>
        </tr>
      </template>
    </v-data-table>
</template>
<script>
  export default {
    props: ['headers', 'shutters'],
    data: () => ({
      max25chars: v => v.length <= 25 || 'Input too long!',
      pagination: {
        sortBy: 'width'
      },
      // headers: [
      //   { text: 'Width(mm)', value: 'width'},
      //   { text: 'Drop(mm)', value: 'drop'},
      //   { text: 'Sqm', value: 'sqm'},
      //   { text: 'Shutter Type', value: 'type'},
      //   { text: 'Panel Layout', value: 'layout'},
      //   { text: 'Panel Qty', value: 'qty'},
      //   { text: 'In or Out', value: 'io'},
      //   { text: 'Mid Rail', value: 'mdr'},
      //   { text: 'Mid Rail Height', value: 'mdHeight'},
      //   { text: 'Blade Size', value: 'bsize'},
      //   { text: 'Tilt Rod', value: 'tiltRod'},
      //   { text: 'Color', value: 'color'},
      //   { text: 'Frame', value: 'frame'},
      //   { text: 'Notes', value: 'notes'},
      //   { text: 'Actions', value: ''}
      // ],
      // shutters: [
      //   {
      //     width: 200,
      //     drop: 150,
      //     sqm: 30000,
      //     type: 'standard',
      //     layout: 'square',
      //     qty: 5,
      //     io: 'In',
      //     mdr: 'Centre',
      //     mdHeight: 100,
      //     bsize: 3000,
      //     tiltRod: 'Clear View',
      //     color: 'grey',
      //     frame: 'no frame',
      //     notes: 'no comments'
      //   }
      // ]
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
      }
    }
  }
</script>

<style scoped lang="stylus">
  table.v-table thead td:not(:nth-child(1)), table.v-table tbody td:not(:nth-child(1)), table.v-table thead th:not(:nth-child(1)), table.v-table tbody th:not(:nth-child(1)), table.v-table thead td:first-child, table.v-table tbody td:first-child, table.v-table thead th:first-child, table.v-table tbody th:first-child
    padding: 0!important;
</style>
