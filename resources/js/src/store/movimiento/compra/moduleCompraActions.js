import axios from '@/axios.js'

export default {

  async listarCompra({ commit }){
    try {
      let response = await axios.get("/admin/compra");
      this.result = response.data.compra;
      commit('SET_COMPRAS', this.result)
    } catch (error) {
      console.log(error);
    }
  }

}
