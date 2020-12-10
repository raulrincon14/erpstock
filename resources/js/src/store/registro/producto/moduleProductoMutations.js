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
  SET_TIPOS (state, productos) {
    state.productos = productos
    // console.log(state.categorias);
  },
  ADD_CATE(state, gists) {
            state.productos = gists;
        },
  LISTAR_TIPOS(state, productos){
    state.productos = productos
  },
  setError(status, payload) {
      status.error = true
      status.errorMessage = payload
      status.productos = []
  },
  setRespuesta(state, as){
      state.respuesta = as
  },
  UPDATE_TIPO (state, product) {
    const productIndex = state.categorias.findIndex((p) => p.id === product.id)
    Object.assign(state.categorias[productIndex], product)
  },
  REMOVE_ITEMC (state, itemId) {
    const ItemIndex = state.categorias.findIndex((p) => p.id === itemId)
    state.categorias.splice(ItemIndex, 1)
  }
}
