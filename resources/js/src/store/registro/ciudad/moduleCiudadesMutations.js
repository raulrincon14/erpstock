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
  SET_CLIENTES (state, clientes) {
    state.clientes = clientes
    // console.log(state.categorias);
  },
  SET_DEPARTAMENTOS (state, departamentos) {
    state.departamentos = departamentos
    // console.log(state.categorias);
  },
  SET_DEPA(state){
    state.departamentos = [];
  },
  SET_PROVI(state){
    state.provincias = [];
  },
  SET_DISTRI(state){
    state.distritos = [];
  },
  SET_PROVINCIAS (state, provincias) {
    state.provincias = provincias
    // console.log(state.categorias);
  },
  SET_DISTRITOS (state, distritos) {
    state.distritos = distritos
    // console.log(state.categorias);
  },
  ADD_CATE(state, gists) {
            state.clientes = gists;
        },
  LISTAR_PAISES(state, paises){
    state.paises = paises
  },
  LISTAR_DEPARTAMENTOS(state, departamentos){
    state.departamentos = departamentos
  },
  LISTAR_PROVINCIAS(state, provincias){
    state.provincias = provincias
  },
  LISTAR_DISTRITOS(state, distritos){
    state.distritos = distritos
  },
  setError(status, payload) {
      status.error = true
      status.errorMessage = payload
      status.clientes = []
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
