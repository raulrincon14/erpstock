
import state from './moduleProveedorState.js'
import mutations from './moduleProveedorMutations.js'
import actions from './moduleProveedorActions.js'
import getters from './moduleProveedorGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
