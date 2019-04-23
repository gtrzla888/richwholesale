import * as types from '../mutation-types'
import axios from 'axios'

// state
export const state = {
  company_id: '',
  po_reference: '',
  notes: '',
  basswood_shutters: [],
  pvc_shutters: [],
  au_pvc_shutters: [],
  aluminium_shutters: [],
  roller_blinds: []
}

// mutations
export const mutations = {
  [types.SAVE_ORDER] (state, { order }) {
    state.order = order
  },
  [types.SAVE_ORDER_PO_REFERENCE] (state, poReference) {
    state.po_reference = poReference
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
  [types.UPDATE_ORDER_PRODUCT] (state, payload) {
    state[payload.selectedTabKey][payload.index][payload.field] = payload.value
  },
  [types.FETCH_ORDER_SUCCESS] (state, { order }) {
    state.order = order
  },
  [types.FETCH_ORDER_FAILURE] (state) {
    state.order = null
  },
  [types.UPDATE_ORDER] (state, { order }) {
    state.order = order
  },
  [types.CLEAR_ORDER] (state) {
    state.order = null
  },
  [types.CALCULATE_ORDER_SQM] (state, payload) {
    if (payload.field === 'width') {
      state[payload.selectedTabKey][payload.index]['sqm'] = payload.value * state[payload.selectedTabKey][payload.index]['drop']
    }
    if (payload.field === 'drop') {
      state[payload.selectedTabKey][payload.index]['sqm'] = payload.value * state[payload.selectedTabKey][payload.index]['width']
    }
  },
}

// actions
export const actions = {
  saveOrder ({ commit, dispatch }, payload) {
    commit(types.SAVE_ORDER, payload)
  },
  updatePoReference ({ commit }, payload) {
    commit(types.SAVE_ORDER_PO_REFERENCE, payload)
  },
  updateCompanyId ({ commit }, payload) {
    commit(types.SAVE_ORDER_COMPANY_ID, payload)
  },
  getOrder ({ commit }, payload) {
    commit(types.GET_ORDER, payload)
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
  calculateSQM ({ commit }, payload) {
    commit(types.CALCULATE_ORDER_SQM, payload)
  },
  async fetchOrder ({ commit }) {
    try {
      const { data } = await axios.get('/api/order/companies')
      commit(types.FETCH_ORDER_SUCCESS, { order: data })
    } catch (e) {
      commit(types.FETCH_ORDER_FAILURE)
    }
  },
  async submitOrder ({ commit }, payload) {
    try {
      console.log('erere')
      const { data } = await axios.post('/api/orders', payload)
      console.log(data)
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
