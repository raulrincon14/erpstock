import axios from '@/axios.js'

export default {

  async listarUnidad({ commit }){
    try {
      let response = await axios.get("/admin/unidad");
      this.result = response.data.unidad;
      commit('SET_UNIDADES', this.result)
    } catch (error) {
      console.log(error);
    }
  },
  async addUnidad({ commit, dispatch }, item) {
    let respuesta = false;
    try {
      await axios.post('/admin/unidad', item)
      .then((response) => {
        if (response.data.res == "si") {
          respuesta = true;
        }else {
          dispatch('listarUnidad')
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
  async updateUnidad({ commit, dispatch }, item) {
    let abb = false;
    try {
      await axios.put('/admin/unidad/actualizar',item)
      .then((response) => {
          dispatch('listarUnidad')
          commit('setRespuesta', abb)
      })

    } catch (e) {
    } finally {
        console.log('La peticion updateTodo ha finalizado')
    }
}



}
