import axios from '@/axios.js'

export default {

  async listarProveedor({ commit }){
    try {
      let response = await axios.get("/admin/proveedor");
      this.result = response.data.proveedor;
      commit('SET_PROVEEDORES', this.result)
    } catch (error) {
      console.log(error);
    }
  },
  async addProveedor({ commit, dispatch }, item) {
    let respuesta = false;
    try {
      await axios.post('/admin/proveedor', item)
      .then((response) => {
        if (response.data.res == "si") {
          respuesta = true;
        }else {
          dispatch('listarProveedor')
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
  async updateProveedor({ commit, dispatch }, item) {
    let abb = false;
    try {
      await axios.put('/admin/proveedor/actualizar',item)
      .then((response) => {
          dispatch('listarProveedor')
          commit('setRespuesta', abb)
      })

    } catch (e) {
    } finally {
        console.log('La peticion updateTodo ha finalizado')
    }
}



}
