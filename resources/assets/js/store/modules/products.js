import * as types from '../mutation-types'

const productLines = [
  {
    name: 'Basswood Shutters',
    key: 'basswood_shutters',
    headers: [
      { text: 'Name', value: 'name', sortable: false },
      { text: 'Width(mm)', value: 'width', sortable: false },
      { text: 'Drop(mm)', value: 'drop', sortable: false },
      { text: 'Sqm', value: 'sqm', sortable: false },
      { text: 'Shutter Type', value: 'shutter_type', sortable: false },
      { text: 'Corner', value: 'corner', sortable: false },
      { text: 'Panel Layout', value: 'panel_layout', sortable: false },
      { text: 'Panel Qty', value: 'panel_qty', sortable: false },
      { text: 'In or Out', value: 'in_or_out', sortable: false },
      { text: 'Mid Rail', value: 'mid_rail', sortable: false },
      { text: 'Mid Rail Height', value: 'mid_rail_height', sortable: false },
      { text: 'Blade Size', value: 'blade_size', sortable: false },
      { text: 'Tilt Rod', value: 'tilt_rod', sortable: false },
      { text: 'Colour', value: 'colour', sortable: false },
      { text: 'Stile Type', value: 'stile_type', sortable: false },
      { text: 'Frame', value: 'frame', sortable: false },
      { text: 'FrameOptions', value: 'frame_options', sortable: false },
      { text: 'HingeType', value: 'hinge_type', sortable: false },
      { text: 'HingeColor', value: 'hinge_color', sortable: false },
      { text: 'Notes', value: 'notes', sortable: false },
      { text: 'Actions', value: 'actions', sortable: false }
    ]
  },
  {
    name: 'PVC Shutters',
    key: 'pvc_shutters',
    headers: [
      { text: 'Name', value: 'name', sortable: false },
      { text: 'Width(mm)', value: 'width', sortable: false },
      { text: 'Drop(mm)', value: 'drop', sortable: false },
      { text: 'Sqm', value: 'sqm', sortable: false },
      { text: 'Shutter Type', value: 'shutter_type', sortable: false },
      { text: 'Panel Layout', value: 'panel_layout', sortable: false },
      { text: 'Panel Qty', value: 'panel_qty', sortable: false },
      { text: 'In or Out', value: 'in_or_out', sortable: false },
      { text: 'Mid Rail', value: 'mid_rail', sortable: false },
      { text: 'Mid Rail Height', value: 'mid_rail_height', sortable: false },
      { text: 'Blade Size', value: 'blade_size', sortable: false },
      { text: 'Tilt Rod', value: 'tilt_rod', sortable: false },
      { text: 'Colour', value: 'colour', sortable: false },
      { text: 'Frame', value: 'frame', sortable: false },
      { text: 'Notes', value: 'notes', sortable: false },
      { text: 'Actions', value: 'actions', sortable: false }
    ]
  },
  {
    name: 'AU PVC Shutters',
    key: 'au_pvc_shutters',
    headers: [
      { text: 'Name', value: 'name', sortable: false },
      { text: 'Width(mm)', value: 'width', sortable: false },
      { text: 'Drop(mm)', value: 'drop', sortable: false },
      { text: 'Sqm', value: 'sqm', sortable: false },
      { text: 'Shutter Type', value: 'shutter_type', sortable: false },
      { text: 'Panel Layout', value: 'panel_layout', sortable: false },
      { text: 'Panel Qty', value: 'panel_qty', sortable: false },
      { text: 'In or Out', value: 'in_or_out', sortable: false },
      { text: 'Mid Rail', value: 'mid_rail', sortable: false },
      { text: 'Mid Rail Height', value: 'mid_rail_height', sortable: false },
      { text: 'Blade Size', value: 'blade_size', sortable: false },
      { text: 'Tilt Rod', value: 'tilt_rod', sortable: false },
      { text: 'Colour', value: 'colour', sortable: false },
      { text: 'Frame', value: 'frame', sortable: false },
      { text: 'Notes', value: 'notes', sortable: false },
      { text: 'Actions', value: 'actions', sortable: false }
    ]
  },
  {
    name: 'Aluminium  Shutters',
    key: 'aluminium_shutters',
    headers: [
      { text: 'Name', value: 'name', sortable: false },
      { text: 'Width(mm)', value: 'width', sortable: false },
      { text: 'Drop(mm)', value: 'drop', sortable: false },
      { text: 'Sqm', value: 'sqm', sortable: false },
      { text: 'Shutter Type', value: 'shutter_type', sortable: false },
      { text: 'Panel Layout', value: 'panel_layout', sortable: false },
      { text: 'Panel Qty', value: 'panel_qty', sortable: false },
      { text: 'In or Out', value: 'in_or_out', sortable: false },
      { text: 'Mid Rail', value: 'mid_rail', sortable: false },
      { text: 'Mid Rail Height', value: 'mid_rail_height', sortable: false },
      { text: 'Blade Size', value: 'blade_size', sortable: false },
      { text: 'Tilt Rod', value: 'tilt_rod', sortable: false },
      { text: 'Colour', value: 'colour', sortable: false },
      { text: 'Frame', value: 'frame', sortable: false },
      { text: 'Notes', value: 'notes', sortable: false },
      { text: 'Actions', value: 'actions', sortable: false }
    ]
  },
  {
    name: 'Roller Blinds',
    key: 'roller_blinds',
    headers: [
      { text: 'Name', value: 'name', sortable: false },
      { text: 'Width(mm)', value: 'width', sortable: false },
      { text: 'Drop(mm)', value: 'drop', sortable: false },
      { text: 'Sqm', value: 'sqm', sortable: false },
      { text: 'Type', value: 'type', sortable: false },
      { text: 'Fabric', value: 'fabric', sortable: false },
      { text: 'Colour', value: 'colour', sortable: false },
      { text: 'Control Type', value: 'control_type', sortable: false },
      { text: 'Control Side', value: 'control_side', sortable: false },
      { text: 'Chain Length', value: 'chain_length', sortable: false },
      { text: 'Component Colour', value: 'component_colour', sortable: false },
      { text: 'Base Rail', value: 'base_rail', sortable: false },
      { text: 'Roll Direction', value: 'roll_direction', sortable: false },
      { text: 'Motor Type', value: 'motor_type', sortable: false },
      { text: 'Charger', value: 'charger', sortable: false },
      { text: 'Wifi Hub', value: 'wifi_hub', sortable: false },
      { text: 'Remote', value: 'remote', sortable: false },
      { text: 'Bracket Options', value: 'bracket_options', sortable: false },
      { text: 'Notes', value: 'notes', sortable: false },
      { text: 'Actions', value: 'actions', sortable: false }
    ]
  }
]

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
  },
}

// actions
export const actions = {
  fetchProductsLine ({ commit }, payload) {
    commit(types.FETCH_PRODUCTS_LINE, payload)
  },
  fetchProducts ({ commit }) {
    commit(types.FETCH_PRODUCTS)
  }
}

// getters
export const getters = {
  products: state => state.products
}
