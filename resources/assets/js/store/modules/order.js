import * as types from '../mutation-types'
import Cookies from 'js-cookie'
import axios from 'axios'

// state
export const state = {
  order: null
}

// mutations
export const mutations = {
  [types.SAVE_ORDER] (state, { order, remember }) {
    state.order = order
    Cookies.set('order', order, { expires: remember ? 365 : null })
  },
  [types.GET_ORDER] (state) {
    state.order = Cookies.get('order') ? JSON.parse(Cookies.get('order')): null
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
    Cookies.remove('order')
  }
}

// actions
export const actions = {
  saveOrder ({ commit, dispatch }, payload) {
    commit(types.SAVE_ORDER, payload)
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