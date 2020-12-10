/*=========================================================================================
  File Name: store.js
  Description: Vuex store
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import Vuex from 'vuex'

import state from './state'
import getters from './getters'
import mutations from './mutations'
import actions from './actions'

Vue.use(Vuex)

// import moduleTodo from './todo/moduleTodo.js'
// import moduleCalendar from './calendar/moduleCalendar.js'
// import moduleChat from './chat/moduleChat.js'
// import moduleEmail from './email/moduleEmail.js'
import moduleAuth from './auth/moduleAuth.js'
import moduleCliente from './registro/cliente/moduleCliente.js'
import moduleProveedor from './registro/proveedor/moduleProveedor.js'
import moduleCategoria from './categoria/moduleCategoria.js'
import moduleMarca from './marca/moduleMarca.js'
import moduleTipo from './registro/tipo/moduleTipo.js'
import moduleUnidad from './registro/unidad/moduleUnidad.js'
import moduleProducto from './registro/producto/moduleProducto.js'
import moduleCiudad from './registro/ciudad/moduleCiudad.js'
//Empieza la seccion de movimientos
import moduleCompra from './movimiento/compra/moduleCompra.js'

import moduleECommerce from './eCommerce/moduleECommerce.js'


export default new Vuex.Store({
  getters,
  mutations,
  state,
  actions,
  modules: {
    // todo: moduleTodo,
    // calendar: moduleCalendar,
    // chat: moduleChat,
    // email: moduleEmail,
    auth: moduleAuth,
    cliente: moduleCliente,
    proveedor: moduleProveedor,
    categoria: moduleCategoria,
    marca: moduleMarca,
    tipo: moduleTipo,
    unidad: moduleUnidad,
    producto: moduleProducto,
    ciudad: moduleCiudad,
    compra: moduleCompra,
    eCommerce: moduleECommerce
  },
  strict: process.env.NODE_ENV !== 'production'
})
