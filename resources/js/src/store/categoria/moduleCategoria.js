
import state from './moduleCategoriaState.js'
import mutations from './moduleCategoriaMutations.js'
import actions from './moduleCategoriaActions.js'
import getters from './moduleCategoriaGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
