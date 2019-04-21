import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  companies: null
}

// mutations
export const mutations = {
  [types.FETCH_COMPANIES_SUCCESS] (state, { companies }) {
    state.companies = companies
  },
  [types.FETCH_COMPANIES_FAILURE] (state) {
    state.companies = null
  }
}

// actions
export const actions = {
  async fetchCompanies ({ commit }) {
    try {
      const { data } = await axios.get('/api/user/companies')
      commit(types.FETCH_COMPANIES_SUCCESS, { companies: data })
    } catch (e) {
      commit(types.FETCH_COMPANIES_FAILURE)
    }
  }
}

// getters
export const getters = {
  companies: state => state.companies
}
