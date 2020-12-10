
import state from './moduleCiudadesState.js'
import mutations from './moduleCiudadesMutations.js'
import actions from './moduleCiudadesActions.js'
import getters from './moduleCiudadesGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
