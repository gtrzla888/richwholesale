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
  roller_blinds: [],
  order: null
}

// mutations
export const mutations = {
  [types.SAVE_ORDER] (state, order) {
    state.order = JSON.parse(order)
  },
  [types.SAVE_ORDER_PO_REFERENCE] (state, poReference) {
    state.po_reference = poReference
  },
  [types.SAVE_ORDER_COMPANY_ID] (state, companyId) {
    state.company_id = companyId
  },
  [types.FETCH_ORDER_SUCCESS] (state, { order }) {
    state.order = order
  },
  [types.FETCH_ORDER_FAILURE] (state) {
    state.order = null
  },
  [types.UPDATE_ORDER] (state, newOrder) {
    state.order = newOrder
  },
  [types.INSERT_ORDER] (state, payload) {
    if (payload.selectedKey && payload.product) {
      state[payload.selectedKey].push(payload.product)
    }
  },
  [types.CLEAR_ORDER] (state) {
    state.order = null
  }
}

// actions
export const actions = {
  saveOrder ({ commit }, payload) {
    commit(types.SAVE_ORDER, JSON.stringify(payload))
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

  async updateOrder ({ commit }, payload) {
    commit(types.UPDATE_ORDER, payload)
  },

  async fetchOrder ({ commit }) {
    try {
      const { data } = await axios.get('/api/order/companies')
      commit(types.FETCH_ORDER_SUCCESS, { order: data })
    } catch (e) {
      commit(types.FETCH_ORDER_FAILURE)
    }
  },
  insertOrder ({ commit }, payload) {
    commit(types.INSERT_ORDER, payload)
  }
}

// getters
export const getters = {
  order: state => state.order
}
