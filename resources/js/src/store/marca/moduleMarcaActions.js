import axios from '@/axios.js'

export default {

  async listarMarca({ commit }){
    try {
      let response = await axios.get("/admin/marca");
      this.result = response.data.marca;
      commit('SET_MARCAS', this.result)
    } catch (error) {
      console.log(error);
    }
  },
  async addMarca({ commit, dispatch }, item) {
    let respuesta = false;
    try {
      await axios.post('/admin/marca', item)
      .then((response) => {
        if (response.data.res == "si") {
          respuesta = true;
        }else {
          dispatch('listarMarca')
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
  async updateMarca({ commit, dispatch }, item) {
    let abb = false;
    try {
      await axios.put('/admin/marca/actualizar',item)
      .then((response) => {
          dispatch('listarMarca')
          commit('setRespuesta', abb)
      })

    } catch (e) {
    } finally {
        console.log('La peticion updateTodo ha finalizado')
    }
}



}
