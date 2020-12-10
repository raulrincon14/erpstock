
import state from './moduleClienteState.js'
import mutations from './moduleClienteMutations.js'
import actions from './moduleClienteActions.js'
import getters from './moduleClienteGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
