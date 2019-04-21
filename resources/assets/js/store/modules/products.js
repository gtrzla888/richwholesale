import * as types from '../mutation-types'

const productLines = [{
  name: 'Basswood Shutters',
  key: 'basswood_shutters',
  headers: [
    { text: 'Name', value: 'name' },
    { text: 'Width(mm)', value: 'width' },
    { text: 'Drop(mm)', value: 'drop' },
    { text: 'Sqm', value: 'sqm' },
    { text: 'Shutter Type', value: 'shutter_type' },
    { text: 'Panel Layout', value: 'panel_layout' },
    { text: 'Panel Qty', value: 'panel_qty' },
    { text: 'In or Out', value: 'in_or_out' },
//    { text: 'Mid Rail', value: 'mdr' },
//    { text: 'Mid Rail Height', value: 'mdHeight' },
//    { text: 'Blade Size', value: 'bsize' },
//    { text: 'Tilt Rod', value: 'tiltRod' },
//    { text: 'Color', value: 'color' },
//    { text: 'Frame', value: 'frame' },
//    { text: 'Notes', value: 'notes' },
    { text: 'Actions', value: 'actions'}
  ],
  items: [
    {
      name: '',
      width: 0,
      drop: 0,
      sqm: 0,
      shutter_type: 'standard',
      panel_layout: 'square',
      panel_qty: 5,
      in_or_out: 'In',
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
  name: 'PVC Shutters',
  key: 'pvc_shutters',
  headers: [
    { text: 'Width(mm)', value: 'width' },
    { text: 'Drop(mm)', value: 'drop' },
    { text: 'Sqm', value: 'sqm' },
    { text: 'Shutter Type', value: 'type' },
    { text: 'Panel Layout', value: 'layout' },
    { text: 'Panel Qty', value: 'qty' },
    { text: 'In or Out', value: 'io' },
//    { text: 'Mid Rail', value: 'mdr' },
//    { text: 'Mid Rail Height', value: 'mdHeight' },
//    { text: 'Blade Size', value: 'bsize' },
//    { text: 'Tilt Rod', value: 'tiltRod' },
//    { text: 'Color', value: 'color' },
//    { text: 'Frame', value: 'frame' },
    { text: 'Notes', value: 'notes' },
    { text: 'Actions', value: 'actions' }
  ],
  items: [
  ]
},
{
  name: 'AU PVC Shutters',
  key: 'au_pvc_shutters',
  headers: [
    { text: 'Width(mm)', value: 'width' },
    { text: 'Drop(mm)', value: 'drop' },
    { text: 'Sqm', value: 'sqm' },
    { text: 'Shutter Type', value: 'type' },
    { text: 'Panel Layout', value: 'layout' },
    { text: 'Panel Qty', value: 'qty' },
    { text: 'In or Out', value: 'io' },
//    { text: 'Mid Rail', value: 'mdr' },
//    { text: 'Mid Rail Height', value: 'mdHeight' },
//    { text: 'Blade Size', value: 'bsize' },
//    { text: 'Tilt Rod', value: 'tiltRod' },
//    { text: 'Color', value: 'color' },
//    { text: 'Frame', value: 'frame' },
//    { text: 'Notes', value: 'notes' },
    { text: 'Actions', value: 'actions' }
  ],
  items: [
  ]
},
{
  name: 'Aluminium  Shutters',
  key: 'aluminium_shutters',
  headers: [
    { text: 'Width(mm)', value: 'width' },
    { text: 'Drop(mm)', value: 'drop' },
    { text: 'Sqm', value: 'sqm' },
    { text: 'Shutter Type', value: 'type' },
    { text: 'Panel Layout', value: 'layout' },
    { text: 'Panel Qty', value: 'qty' },
    { text: 'In or Out', value: 'io' },
//    { text: 'Mid Rail', value: 'mdr' },
//    { text: 'Mid Rail Height', value: 'mdHeight' },
//    { text: 'Blade Size', value: 'bsize' },
//    { text: 'Tilt Rod', value: 'tiltRod' },
//    { text: 'Color', value: 'color' },
//    { text: 'Frame', value: 'frame' },
//    { text: 'Notes', value: 'notes' },
    { text: 'Actions', value: 'actions' }
  ],
  items: [
  ]
},
{
  name: 'Roller Blinds',
  key: 'roller_blinds',
  headers: [
    { text: 'Width(mm)', value: 'width' },
    { text: 'Drop(mm)', value: 'drop' },
    { text: 'Type', value: 'type' },
    { text: 'Fabric', value: 'fabric' },
    { text: 'Colour', value: 'colour' },
    { text: 'Control Type', value: 'control_type' },
    { text: 'Control Side', value: 'control_side' },
//    { text: 'Chain Length', value: 'chain_length' },
//    { text: 'Component Colour', value: 'component_colour' },
//    { text: 'Base Rail', value: 'base_rail' },
//    { text: 'Roll Direction', value: 'roll_direction' },
//    { text: 'Motor Type', value: 'motor_type' },
//    { text: 'Charger', value: 'charger' },
//    { text: 'Wifi Hub', value: 'wifi_hub' },
//    { text: 'Remote', value: 'remote' },
//    { text: 'Bracket Options', value: 'bracket_options' },
//    { text: 'Notes', value: 'notes' }
    { text: 'Actions', value: 'actions' }
  ],
  items: [
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
