import axios from '@/axios.js'

export default {

  async listarTipo({ commit }){
    try {
      let response = await axios.get("/admin/tipo");
      this.result = response.data.tipo;
      commit('SET_TIPOS', this.result)
    } catch (error) {
      console.log(error);
    }
  },
  async addTipo({ commit, dispatch }, item) {
    let respuesta = false;
    try {
      await axios.post('/admin/tipo', item)
      .then((response) => {
        if (response.data.res == "si") {
          respuesta = true;
        }else {
          dispatch('listarTipo')
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
  async updateTipo({ commit, dispatch }, item) {
    let abb = false;
    try {
      await axios.put('/admin/tipo/actualizar',item)
      .then((response) => {
          dispatch('listarTipo')
          commit('setRespuesta', abb)
      })

    } catch (e) {
    } finally {
        console.log('La peticion updateTodo ha finalizado')
    }
}



}
