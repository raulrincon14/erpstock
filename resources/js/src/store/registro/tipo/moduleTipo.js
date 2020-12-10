
import state from './moduleTipoState.js'
import mutations from './moduleTipoMutations.js'
import actions from './moduleTipoActions.js'
import getters from './moduleTipoGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
