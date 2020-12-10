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
  SET_UNIDADES (state, unidades) {
    state.unidades = unidades
    // console.log(state.categorias);
  },
  ADD_CATE(state, gists) {
            state.categorias = gists;
        },
  LISTAR_UNIDADES(state, categorias){
    state.categorias = categorias
  },
  setError(status, payload) {
      status.error = true
      status.errorMessage = payload
      status.categorias = []
  },
  setRespuesta(state, as){
      state.respuesta = as
  }
}
