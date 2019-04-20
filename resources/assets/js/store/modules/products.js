import * as types from '../mutation-types'

const productLines = [{
  'name': 'Basswood Shutters',
  headers: [
    { text: 'Width(mm)', value: 'width' },
    { text: 'Drop(mm)', value: 'drop' },
    { text: 'Sqm', value: 'sqm' },
    { text: 'Shutter Type', value: 'type' },
    { text: 'Panel Layout', value: 'layout' },
    { text: 'Panel Qty', value: 'qty' },
    { text: 'In or Out', value: 'io' },
    { text: 'Mid Rail', value: 'mdr' },
    { text: 'Mid Rail Height', value: 'mdHeight' },
    { text: 'Blade Size', value: 'bsize' },
    { text: 'Tilt Rod', value: 'tiltRod' },
    { text: 'Color', value: 'color' },
    { text: 'Frame', value: 'frame' },
    { text: 'Notes', value: 'notes' },
    { text: 'Actions', value: '' }
  ],
  shutters: [
    {
      width: 0,
      drop: 0,
      sqm: 0,
      type: 'standard',
      layout: 'square',
      qty: 5,
      io: '',
      mdr: '',
      mdHeight: 0,
      bsize: 0,
      tiltRod: '',
      color: '',
      frame: '',
      notes: ''
    }
  ]
},
{
  'name': 'PVC Shutters',
  headers: [
    { text: 'Width(mm)', value: 'width' },
    { text: 'Drop(mm)', value: 'drop' },
    { text: 'Sqm', value: 'sqm' },
    { text: 'Shutter Type', value: 'type' },
    { text: 'Panel Layout', value: 'layout' },
    { text: 'Panel Qty', value: 'qty' },
    { text: 'In or Out', value: 'io' },
    { text: 'Mid Rail', value: 'mdr' },
    { text: 'Mid Rail Height', value: 'mdHeight' },
    { text: 'Blade Size', value: 'bsize' },
    { text: 'Tilt Rod', value: 'tiltRod' },
    { text: 'Color', value: 'color' },
    { text: 'Frame', value: 'frame' },
    { text: 'Notes', value: 'notes' },
    { text: 'Actions', value: '' }
  ],
  shutters: [
    {
      width: 0,
      drop: 0,
      sqm: 0,
      type: 'standard',
      layout: 'square',
      qty: 5,
      io: '',
      mdr: '',
      mdHeight: 0,
      bsize: 0,
      tiltRod: '',
      color: '',
      frame: '',
      notes: ''
    }
  ]
},
{
  'name': 'AU PVC Shutters',
  headers: [
    { text: 'Width(mm)', value: 'width' },
    { text: 'Drop(mm)', value: 'drop' },
    { text: 'Sqm', value: 'sqm' },
    { text: 'Shutter Type', value: 'type' },
    { text: 'Panel Layout', value: 'layout' },
    { text: 'Panel Qty', value: 'qty' },
    { text: 'In or Out', value: 'io' },
    { text: 'Mid Rail', value: 'mdr' },
    { text: 'Mid Rail Height', value: 'mdHeight' },
    { text: 'Blade Size', value: 'bsize' },
    { text: 'Tilt Rod', value: 'tiltRod' },
    { text: 'Color', value: 'color' },
    { text: 'Frame', value: 'frame' },
    { text: 'Notes', value: 'notes' },
    { text: 'Actions', value: '' }
  ],
  shutters: [
    {
      width: 0,
      drop: 0,
      sqm: 0,
      type: 'standard',
      layout: 'square',
      qty: 5,
      io: '',
      mdr: '',
      mdHeight: 0,
      bsize: 0,
      tiltRod: '',
      color: '',
      frame: '',
      notes: ''
    }
  ]
},
{
  'name': 'Aluminium  Shutters',
  headers: [
    { text: 'Width(mm)', value: 'width' },
    { text: 'Drop(mm)', value: 'drop' },
    { text: 'Sqm', value: 'sqm' },
    { text: 'Shutter Type', value: 'type' },
    { text: 'Panel Layout', value: 'layout' },
    { text: 'Panel Qty', value: 'qty' },
    { text: 'In or Out', value: 'io' },
    { text: 'Mid Rail', value: 'mdr' },
    { text: 'Mid Rail Height', value: 'mdHeight' },
    { text: 'Blade Size', value: 'bsize' },
    { text: 'Tilt Rod', value: 'tiltRod' },
    { text: 'Color', value: 'color' },
    { text: 'Frame', value: 'frame' },
    { text: 'Notes', value: 'notes' },
    { text: 'Actions', value: '' }
  ],
  shutters: [
    {
      width: 0,
      drop: 0,
      sqm: 0,
      type: 'standard',
      layout: 'square',
      qty: 5,
      io: '',
      mdr: '',
      mdHeight: 0,
      bsize: 0,
      tiltRod: '',
      color: '',
      frame: '',
      notes: ''
    }
  ]
},
{
  'name': 'Roller Blinder',
  headers: [
    { text: 'Width(mm)', value: 'width' },
    { text: 'Drop(mm)', value: 'drop' },
    { text: 'Sqm', value: 'sqm' },
    { text: 'Shutter Type', value: 'type' },
    { text: 'Panel Layout', value: 'layout' },
    { text: 'Panel Qty', value: 'qty' },
    { text: 'In or Out', value: 'io' },
    { text: 'Mid Rail', value: 'mdr' },
    { text: 'Mid Rail Height', value: 'mdHeight' },
    { text: 'Blade Size', value: 'bsize' },
    { text: 'Tilt Rod', value: 'tiltRod' },
    { text: 'Color', value: 'color' },
    { text: 'Frame', value: 'frame' },
    { text: 'Notes', value: 'notes' },
    { text: 'Actions', value: '' }
  ],
  shutters: [
    {
      width: 0,
      drop: 0,
      sqm: 0,
      type: 'standard',
      layout: 'square',
      qty: 5,
      io: '',
      mdr: '',
      mdHeight: 0,
      bsize: 0,
      tiltRod: '',
      color: '',
      frame: '',
      notes: ''
    }
  ]
}]

// state
export const state = {
  products: productLines
}

// mutations
export const mutations = {
  [types.FETCH_PRODUCTS_LINE] (state, productLine) {
    state.products = productLines[productLine]
  },
  [types.FETCH_PRODUCTS] (state) {
    state.products = productLines
  }
}

// actions
export const actions = {
  fetchProductsLine ({ commit }, payload) {
    commit(types.FETCH_PRODUCTS_LINE, payload)
  },
  fetchProducts ({commit}) {
    commit(types.FETCH_PRODUCTS)
  }
}

// getters
export const getters = {
  products: state => state.products
}
