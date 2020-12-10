import axios from '@/axios.js'

export default {

  async iniciarDepartamento({ commit }){
    try {
      commit('SET_DEPA')
    } catch (error) {
      console.log(error);
    }
  },
  async iniciarProvincia({ commit }){
    try {
      commit('SET_PROVI')
    } catch (error) {
      console.log(error);
    }
  },
  async iniciarDistrito({ commit }){
    try {
      commit('SET_DISTRI')
    } catch (error) {
      console.log(error);
    }
  },
  async listarCliente({ commit }){
    try {
      let response = await axios.get("/admin/cliente");
      this.result = response.data.cliente;
      commit('SET_CLIENTES', this.result)
    } catch (error) {
      console.log(error);
    }
  },
  async listarDepartamentos({ commit }){
    try {
      let response = await axios.get("/admin/departamentos");
      this.result = response.data.departamentos;
      commit('SET_DEPARTAMENTOS', this.result)
    } catch (error) {
      console.log(error);
    }
  },
  async listarProvincias({ commit}, num){
    try {
      let response = await axios.get("/admin/departamentos/provincias/" + num);
      this.result = response.data.provincias;
      commit('SET_PROVINCIAS', this.result)
    } catch (error) {
      console.log(error);
    }
  },
  async listarDistritos({ commit}, num){
    try {
      let response = await axios.get("/admin/departamentos/distritos/" + num);
      this.result = response.data.distritos;
      commit('SET_DISTRITOS', this.result)
    } catch (error) {
      console.log(error);
    }
  },
  async addCliente({ commit, dispatch }, item) {
    let respuesta = false;
    try {
      await axios.post('/admin/cliente', item)
      .then((response) => {
        if (response.data.res == "si") {
          respuesta = true;
        }else {
          dispatch('listarCliente')
        }
        commit('setRespuesta', respuesta)
      })
      // console.log('este es la variable: ' + abb);

    } catch (e) {
        // commit('setError', e.message, { root: true })

    } finally {
        console.log('La peticion addTodo ha finalizado')
    }
  },
  async updateCliente({ commit, dispatch }, item) {
    let abb = false;
    try {
      await axios.put('/admin/cliente/actualizar',item)
      .then((response) => {
          dispatch('listarCliente')
          commit('setRespuesta', abb)
      })

    } catch (e) {
    } finally {
        console.log('La peticion updateTodo ha finalizado')
    }
}



}
