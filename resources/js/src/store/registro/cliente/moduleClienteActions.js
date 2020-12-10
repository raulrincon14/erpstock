import axios from '@/axios.js'

export default {

  async listarCliente({ commit }){
    try {
      let response = await axios.get("/admin/cliente");
      this.result = response.data.cliente;
      commit('SET_CLIENTES', this.result)
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
