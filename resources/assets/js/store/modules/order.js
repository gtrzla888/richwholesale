import * as types from '../mutation-types'
import axios from 'axios'

const order = {
  id: '',
  company_id: '',
  po_reference: '',
  notes: '',
  basswood_shutters: [],
  pvc_shutters: [],
  au_pvc_shutters: [],
  aluminium_shutters: [],
  roller_blinds: [],
  total: 0
}
// state
export const state = {
  ...order
}

// mutations
export const mutations = {
  [types.SAVE_ORDER] (state, { order }) {
    Object.assign(state, { ...order })
  },
  [types.SAVE_ORDER_PO_REFERENCE] (state, poReference) {
    state.po_reference = poReference
  },
  [types.SAVE_ORDER_CUSTOMER_NAME] (state, customerName) {
    state.customer_name = customerName
  },
  [types.SAVE_ORDER_COMPANY_ID] (state, companyId) {
    state.company_id = companyId
  },
  [types.SAVE_ORDER_PRODUCT] (state, payload) {
    state[payload.selectedTabKey].push(payload.product)
  },
  [types.REMOVE_ORDER_PRODUCT] (state, payload) {
    state[payload.selectedTabKey].splice(payload.index, 1)
  },
  [types.COPY_ORDER_PRODUCT] (state, payload) {
    const targetObj = state[payload.selectedTabKey][payload.index]
    const newObj = { ...targetObj }
    Object.keys(newObj).map((key, index) => {
      switch (key) {
        case 'name':
          newObj[key] = payload.product.name
          break
        case 'width':
          newObj[key] = payload.product.width
          break
        case 'drop':
          newObj[key] = payload.product.drop
          break
        case 'sqm':
          newObj[key] = payload.product.sqm
          break
        case 'panel_layout':
          newObj[key] = payload.product.panel_layout
          break
        case 'panel_qty':
          newObj[key] = payload.product.panel_qty
          break
        default:
          break
      }
    })
    state[payload.selectedTabKey].push(newObj)
  },
  [types.UPDATE_ORDER_PRODUCT] (state, payload) {
    state[payload.selectedTabKey][payload.index][payload.field] = payload.value
  },
  [types.FETCH_ORDER_SUCCESS] (state, { order }) {
    Object.assign(state, { ...order })
  },
  [types.FETCH_ORDER_FAILURE] (state) {
    Object.assign(state, { ...order })
  },
  [types.CLEAR_ORDER] (state) {
    Object.assign(state, { ...order })
  },
  [types.CALCULATE_ORDER_SQM] (state, payload) {
    if (payload.field === 'width') {
      state[payload.selectedTabKey][payload.index]['sqm'] = payload.value * state[payload.selectedTabKey][payload.index]['drop']
    }
    if (payload.field === 'drop') {
      state[payload.selectedTabKey][payload.index]['sqm'] = payload.value * state[payload.selectedTabKey][payload.index]['width']
    }
  },
  [types.FETCH_ORDER_TOTALPRICE_SUCCESS] (state, { total }) {
    state.total = total
  },
  [types.FETCH_ORDER_TOTALPRICE_FAILURE] (state) {
    state.total = 0
  }
}

// actions
export const actions = {
  saveOrder ({ commit, dispatch }, payload) {
    commit(types.SAVE_ORDER, payload)
  },
  updatePoReference ({ commit }, payload) {
    commit(types.SAVE_ORDER_PO_REFERENCE, payload)
  },
  updateCustomerName ({ commit }, payload) {
    commit(types.SAVE_ORDER_CUSTOMER_NAME, payload)
  },
  updateCompanyId ({ commit }, payload) {
    commit(types.SAVE_ORDER_COMPANY_ID, payload)
  },
  saveOrderProduct ({ commit }, payload) {
    commit(types.SAVE_ORDER_PRODUCT, payload)
  },
  updateOrderProduct ({ commit }, payload) {
    commit(types.UPDATE_ORDER_PRODUCT, payload)
  },
  removeOrderProduct ({ commit }, payload) {
    commit(types.REMOVE_ORDER_PRODUCT, payload)
  },
  copyOrderProduct ({ commit }, payload) {
    commit(types.COPY_ORDER_PRODUCT, payload)
  },
  calculateSQM ({ commit }, payload) {
    commit(types.CALCULATE_ORDER_SQM, payload)
  },
  clearOrder ({ commit }) {
    commit(types.CLEAR_ORDER)
  },
  async getTotalPrice ({ commit }, payload) {
    try {
      const { data } = await axios.post('/api/quotes/price', payload)
      commit(types.FETCH_ORDER_TOTALPRICE_SUCCESS, { total: data })
    } catch (e) {
      commit(types.FETCH_ORDER_TOTALPRICE_FAILURE)
    }
  },
  async fetchOrder ({ commit }, payload) {
    try {
      const { data } = await axios.get('/api/quotes/' + payload.id)
      commit(types.FETCH_ORDER_SUCCESS, { order: data })
    } catch (e) {
      commit(types.FETCH_ORDER_FAILURE)
    }
  },

  async submitOrder ({ commit }, payload) {
    try {
      const { data } = await axios.post('/api/quotes?order=true', payload)
      commit(types.RESPONSE_MSG, {
        type: 'error',
        text: data.errors
      })
    } catch (e) {
      console.log('iam here')
    }
  },

  async submitQuote ({ commit }, payload) {
    try {
      const { data } = await axios.post('/api/quotes', payload)
      commit(types.RESPONSE_MSG, {
        type: 'error',
        text: data.errors
      })
    } catch (e) {
      console.log('iam here')
    }
  }
}

// getters
export const getters = {
  order: state => state.order
}
