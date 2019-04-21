import * as types from '../mutation-types'

// state
export const state = {
  isDialogOpen: false
}

// mutations
export const mutations = {
  [types.UPDATE_ADD_ITEM_DIALOG_STATUS] (state, {status}) {
    state.isDialogOpen = status
  }
}

// actions
export const actions = {
  async updateAddItemDialogStatus ({ commit }, payload) {
    commit(types.UPDATE_ADD_ITEM_DIALOG_STATUS, payload)
  }
}

// getters
export const getters = {
  isDialogOpen: state => state.isDialogOpen
}
