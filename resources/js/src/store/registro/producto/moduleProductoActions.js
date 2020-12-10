import axios from '@/axios.js'

export default {

  async listarProducto({ commit }){
    try {
      let response = await axios.get("/admin/producto");
      this.result = response.data.producto;
      commit('SET_TIPOS', this.result)
    } catch (error) {
      console.log(error);
    }
  },
  // async listarProductoCompra({ commit }){
  //   try {
  //     let response = await axios.get("/admin/producto");
  //     this.result = response.data.producto;
  //     producto:[{
  //       idproducto: result.idproducto,
  //       nombre: result.pr_nombre+" "+result.pr_medida+" "+result.u_nombre,
  //       precio: result.pr_precioc
  //       }
  //     ];
  //
  //
  //
  //     commit('SET_TIPOS', this.result)
  //   } catch (error) {
  //     console.log(error);
  //   }
  // },
  async addProducto({ commit, dispatch }, item) {
    let respuesta = false;
    try {
      await axios.post('/admin/producto', item)
      .then((response) => {
        if (response.data.res == "si") {
          respuesta = true;
        }else {
          dispatch('listarProducto')
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
  async updateProducto({ commit, dispatch }, item) {
    let abb = false;
    try {
      await axios.put('/admin/producto/actualizar',item)
      .then((response) => {
          dispatch('listarProducto')
          commit('setRespuesta', abb)
      })

    } catch (e) {
    } finally {
        console.log('La peticion updateTodo ha finalizado')
    }
}



}
