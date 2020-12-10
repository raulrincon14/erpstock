/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  ADD_ITEMC (state, item) {
    state.categorias.unshift(item)
  },
  SET_PROVEEDORES (state, proveedores) {
    state.proveedores = proveedores
    // console.log(state.categorias);
  },
  LISTAR_PROVEEDORES(state, proveedores){
    state.proveedores = proveedores
  },
  setError(status, payload) {
      status.error = true
      status.errorMessage = payload
      status.proveedores = []
  },
  setRespuesta(state, as){
      state.respuesta = as
  }
}
