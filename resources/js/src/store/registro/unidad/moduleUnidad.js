
import state from './moduleUnidadState.js'
import mutations from './moduleUnidadMutations.js'
import actions from './moduleUnidadActions.js'
import getters from './moduleUnidadGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
