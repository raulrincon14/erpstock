
import state from './moduleCompraState.js'
import mutations from './moduleCompraMutations.js'
import actions from './moduleCompraActions.js'
import getters from './moduleCompraGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
