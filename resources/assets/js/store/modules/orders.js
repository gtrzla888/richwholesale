import * as types from '../mutation-types'
import axios from 'axios'

// state
export const state = {
  orders: []
}

// mutations
export const mutations = {
  [types.FETCH_ORDER_SUCCESS] (state, { orders }) {
    state.orders = orders
  },
  [types.FETCH_ORDER_FAILURE] (state) {
    state.orders = []
  }
}

// actions
export const actions = {
  async fetchOrders ({ commit }) {
    try {
      const { data } = await axios.get('/api/orders')
      commit(types.FETCH_ORDER_SUCCESS, { orders: data })
    } catch (e) {
      commit(types.FETCH_ORDER_FAILURE)
    }
  },

  async updateOrder ({ commit }, payload) {
    try {
      const { data } = await axios.put('/api/order/' + payload.id, payload)
    } catch (e) {
    }
  },
}

// getters
export const getters = {
  orders: state => state.orders
}
