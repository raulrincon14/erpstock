
import state from './moduleProductoState.js'
import mutations from './moduleProductoMutations.js'
import actions from './moduleProductoActions.js'
import getters from './moduleProductoGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
