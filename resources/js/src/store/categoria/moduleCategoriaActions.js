import axios from '@/axios.js'

export default {

  async listarCategoria({ commit }){
    try {
      let response = await axios.get("/admin/categoria");
      this.result = response.data.categoria;
      commit('SET_CATEGORIAS', this.result)
    } catch (error) {
      console.log(error);
    }
  },
  async addCategoria({ commit, dispatch }, item) {
    let respuesta = false;
    try {
      await axios.post('/admin/categoria', item)
      .then((response) => {
        if (response.data.res == "si") {
          respuesta = true;
        }else {
          dispatch('listarCategoria')
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
  async updateCategoria({ commit, dispatch }, item) {
    let abb = false;
    try {
      await axios.put('/admin/categoria/actualizar',item)
      .then((response) => {
          dispatch('listarCategoria')
          commit('setRespuesta', abb)
      })

    } catch (e) {
    } finally {
        console.log('La peticion updateTodo ha finalizado')
    }
},
async eliminarCategoria({ commit, dispatch }, item) {
  let abb = false;
  try {
    axios.delete('/admin/categoria/eliminar', {params: { idcategoria: item }})
    .then((response) => {
      if (response.data.res == "si") {
        abb = true;
        dispatch('listarCategoria')
      }
        commit('setRespuesta', abb)
    })
  } catch (e) {
  } finally {
      console.log('La peticion updateTodo ha finalizado')
  }
},
  async desactivarCategoria({ commit, dispatch }, item) {
    let abb = false;
    try {
      await axios.put('/categoria/desactivar', item)
      .then((response) => {
          dispatch('listarCategoria')
      })
      commit('setRespuesta', abb)
    } catch (e) {
    } finally {
        console.log('La peticion updateTodo ha finalizado')
    }
},
  async activarCategoria({ commit, dispatch }, item) {
    let abb = false;
    try {
      await axios.put('/categoria/activar', item)
      .then((response) => {
          dispatch('listarCategoria')
      })
      commit('setRespuesta', abb)
    } catch (e) {
    } finally {
        console.log('La peticion updateTodo ha finalizado')
    }
},

  updateItemc ({ commit }, item) {
    return new Promise((resolve, reject) => {
      axios.post(`/api/data-list/products/${item.id}`, {item})
        .then((response) => {
          commit('UPDATE_CATEGORIA', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeItemc ({ commit }, itemId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/data-list/products/${itemId}`)
        .then((response) => {
          commit('REMOVE_ITEMC', itemId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
  // eventDragged({ commit }, payload) {
  //   return new Promise((resolve, reject) => {
  //     axios.post(`/api/apps/calendar/event/dragged/${payload.event.id}`, {payload: payload})
  //       .then((response) => {

  //         // Convert Date String to Date Object
  //         let event = response.data
  //         event.startDate = new Date(event.startDate)
  //         event.endDate = new Date(event.endDate)

  //         commit('UPDATE_EVENT', event)
  //         resolve(response)
  //       })
  //       .catch((error) => { reject(error) })
  //   })
  // },
}
