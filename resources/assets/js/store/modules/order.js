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
  updateCompanyId ({ commit }, payload) {
    commit(types.SAVE_ORDER_COMPANY_ID, payload)
  },
  getOrder ({ commit }, payload) {
    commit(types.GET_ORDER, payload)
  },

  async fetchOrder ({ commit }) {
    try {
      const { data } = await axios.get('/api/order/companies')
      commit(types.FETCH_ORDER_SUCCESS, { order: data })
    } catch (e) {
      commit(types.FETCH_ORDER_FAILURE)
    }
  }
}

// getters
export const getters = {
  order: state => state.order
}