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
  SET_CATEGORIAS (state, categorias) {
    state.categorias = categorias
    // console.log(state.categorias);
  },
  ADD_CATE(state, gists) {
            state.categorias = gists;
        },
  LISTAR_CATEGORIAS(state, categorias){
    state.categorias = categorias
  },
  setError(status, payload) {
      status.error = true
      status.errorMessage = payload
      status.categorias = []
  },
  setRespuesta(state, as){
      state.respuesta = as
  },
  UPDATE_CATEGORIA (state, product) {
    const productIndex = state.categorias.findIndex((p) => p.id === product.id)
    Object.assign(state.categorias[productIndex], product)
  },
  REMOVE_ITEMC (state, itemId) {
    const ItemIndex = state.categorias.findIndex((p) => p.id === itemId)
    state.categorias.splice(ItemIndex, 1)
  }
}
