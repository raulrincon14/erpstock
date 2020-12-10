
import state from './moduleMarcaState.js'
import mutations from './moduleMarcaMutations.js'
import actions from './moduleMarcaActions.js'
import getters from './moduleMarcaGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
