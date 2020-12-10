<!-- =========================================================================================
  File Name: DataListListView.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="data-list-list-view" class="data-list-container">

    <data-view-sidebar :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />

    <vs-table ref="table" multiple v-model="selected" pagination :max-items="itemsPerPage" search :data="products">

      <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">

        <div class="flex flex-wrap-reverse items-center data-list-btn-container">



          <!-- ADD NEW -->
          <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
              <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
              <span class="ml-2 text-base text-primary">Nuevo</span>
          </div>
        </div>

        <!-- ITEMS PER PAGE -->
        <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler">
          <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
            <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ products.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : products.length }} of {{ queriedItems }}</span>
            <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
          </div>
          <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
          <vs-dropdown-menu>

            <vs-dropdown-item @click="itemsPerPage=8">
              <span>8</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=15">
              <span>15</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=20">
              <span>20</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=30">
              <span>30</span>
            </vs-dropdown-item>
          </vs-dropdown-menu>
        </vs-dropdown>
      </div>

      <template slot="thead">
        <vs-th sort-key="name">Nombre</vs-th>
        <vs-th sort-key="category">Descripción</vs-th>
        <vs-th sort-key="popularity">Estado</vs-th>
        <vs-th>Acciones</vs-th>
      </template>

        <template slot-scope="{data}">
          <tbody>
            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

              <vs-td>
                <p class="product-name font-medium truncate">{{ tr.ma_nombre }}</p>
              </vs-td>

              <vs-td>
                <p class="product-category">{{ tr.ma_desc }}</p>
              </vs-td>
              <vs-td>
                <div v-if="tr.ma_estado === 1">
                  <vs-chip color="success" class="product-order-status"><span>Activo</span></vs-chip>
                </div>
                <div v-else>
                  <vs-chip color="danger" class="product-order-status"><span>Inactivo</span></vs-chip>
                </div>
              </vs-td>

              <vs-td class="whitespace-no-wrap">
                <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" @click.stop="editData(tr)" />
                <template v-if="tr.ma_estado">
                  <feather-icon icon="ToggleLeftIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="Desactivar(tr)" />
                </template>
                <template v-else="tr.ma_estado">
                  <feather-icon icon="ToggleRightIcon" svgClasses="w-5 h-5 hover:text-success stroke-current" class="ml-2" @click.stop="Activar(tr)" />
                </template>
                <!-- <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="eliminar({idcategoria:tr.idcategoria})" /> -->
                <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="eliminard(tr.idmarca)" />
              </vs-td>

            </vs-tr>
          </tbody>
        </template>
    </vs-table>
  </div>
</template>

<script>
// import {mapState} from 'vuex'
import axios from 'axios'
import DataViewSidebar from '@/views/registro/producto/marca/Nmarca.vue'
import moduleMarca from '@/store/marca/moduleMarca.js'

// import moduleDataList from '@/store/data-list/moduleDataList.js'

export default {
  components: {
    DataViewSidebar
  },
  data () {
    return {
      selected: [],
      // products: [],
      itemsPerPage: 8,
      isMounted: false,

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {}
    }
  },
  computed: {
    currentPage () {
      if (this.isMounted) {
        return this.$refs.table.currentx
      }
      return 0
    },
    products () {
      return this.$store.state.dataMarca.marcas
      // return this.$store.state.dataList.products
    },
    errore(){
      return this.$store.state.dataMarca.respuesta
    },
    queriedItems () {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.products.length
    }
  },
  methods: {
    addNewData () {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    deleteData (id) {
      this.$store.dispatch('dataList/removeItem', id).catch(err => { console.error(err) })
    },
    async eliminar(id) {

      try {
            await this.$store.dispatch('dataMarca/eliminarMarca', id)
              if (this.errore) {
                  await this.notificacion('Se elimnó con éxito','success','check_circle');
              }
              await this.notificacion('No se puede eliminar, es probable que ya esté en uso.','warning','warning');
              console.log(id);
              console.log(this.errore);
          // this.$emit('closeSidebar')
          // await this.initValues();
          this.$forceUpdate(); // <-- a ver si esto funciona
      } catch (e) {
          // console.error(err)
      }
    },
    eliminard(id){
        axios.delete('/admin/marca/eliminar', {params: { idmarca: id }})
        .then((response) => {
          if (response.data.res == "si") {
            this.$store.dispatch('dataMarca/listarMarca')
            this.notificacion('Se elimnó con éxito','success','check_circle');
          }else {
            this.notificacion('No se puede eliminar, es probable que ya esté en uso.','warning','warning');
          }
        })
    },
    notificacion(a,b,c){
      this.$vs.notify({
      title:'Marca',
      text:a,
      color:b,
      icon:c,
      position:'bottom-center'
      })
    },
    Desactivar(q){
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: `Seguro de desactivar?`,
        text: 'Se desactivará y ya no funcionará en el sistema',
        accept: this.Desactivar1,
        parameters: [q]
      })
    },
    Desactivar1: function(parameters){
    // Desactivar1 (id) {
    let abb = false;
    try {
      axios.put('/marca/desactivar', parameters[0])
      .then((response) => {
          this.$store.dispatch('dataMarca/listarMarca')
          this.notificacion('Se desactivó con exito.','success','check_circle');
      })
      // commit('setRespuesta', abb)
    } catch (e) {
      this.notificacion('No se pudo desactivar.','warning','warning');
    }

      // this.$store.dispatch('dataCategoria/desactivarCategoria',  parameters[0]).catch(err => { console.error(err) })
    },
    Activar(q){
      this.$vs.dialog({
        type: 'confirm',
        color: 'success',
        title: `Desea Activar?`,
        text: 'Ya se puede usar en el sistema',
        accept: this.Activar1,
        parameters:[q]
      })
    },
    Activar1: function(parameters) {
      try {
        axios.put('/marca/activar', parameters[0])
        .then((response) => {
          this.$store.dispatch('dataMarca/listarMarca')
          this.notificacion('Se activó con exito.','success','check_circle');
        })
        // commit('setRespuesta', abb)
      } catch (e) {
        this.notificacion('No se pudo activar.','warning','warning');
      }
      // this.$store.dispatch('dataCategoria/activarCategoria', parameters[0]).catch(err => { console.error(err) })
    },
    editData (data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = data
      this.toggleDataSidebar(true)
    },
    getOrderStatusColor (status) {
      if (status === 'on_hold')   return 'warning'
      if (status === 'delivered') return 'success'
      if (status === 'canceled')  return 'danger'
      return 'primary'
    },
    getPopularityColor (num) {
      if (num > 90)  return 'success'
      if (num > 70)  return 'primary'
      if (num >= 50) return 'warning'
      if (num < 50)  return 'danger'
      return 'primary'
    },
    toggleDataSidebar (val = false) {
      this.addNewDataSidebar = val
    }
  },
  created () {
    if (!moduleMarca.isRegistered) {
      this.$store.registerModule('dataMarca', moduleMarca)
      moduleMarca.isRegistered = true
    }
    this.$store.dispatch('dataMarca/listarMarca')
  },
  mounted () {
    this.isMounted = true
  }
}
</script>

<style lang="scss">
#data-list-list-view {
  .vs-con-table {

    /*
      Below media-queries is fix for responsiveness of action buttons
      Note: If you change action buttons or layout of this page, Please remove below style
    */
    @media (max-width: 689px) {
      .vs-table--search {
        margin-left: 0;
        max-width: unset;
        width: 100%;

        .vs-table--search-input {
          width: 100%;
        }
      }
    }

    @media (max-width: 461px) {
      .items-per-page-handler {
        display: none;
      }
    }

    @media (max-width: 341px) {
      .data-list-btn-container {
        width: 100%;

        .dd-actions,
        .btn-add-new {
          width: 100%;
          margin-right: 0 !important;
        }
      }
    }

    .product-name {
      max-width: 23rem;
    }

    .vs-table--header {
      display: flex;
      flex-wrap: wrap;
      margin-left: 1.5rem;
      margin-right: 1.5rem;
      > span {
        display: flex;
        flex-grow: 1;
      }

      .vs-table--search{
        padding-top: 0;

        .vs-table--search-input {
          padding: 0.9rem 2.5rem;
          font-size: 1rem;

          &+i {
            left: 1rem;
          }

          &:focus+i {
            left: 1rem;
          }
        }
      }
    }

    .vs-table {
      border-collapse: separate;
      border-spacing: 0 0.5rem;
      padding: 0 1rem;

      tr{
          box-shadow: 0 4px 20px 0 rgba(0,0,0,.05);
          td{
            padding: 10px;
            &:first-child{
              border-top-left-radius: .5rem;
              border-bottom-left-radius: .5rem;
            }
            &:last-child{
              border-top-right-radius: .5rem;
              border-bottom-right-radius: .5rem;
            }
          }
          td.td-check{
            padding: 20px !important;
          }
      }
    }

    .vs-table--thead{
      th {
        padding-top: 0;
        padding-bottom: 0;

        .vs-table-text{
          text-transform: uppercase;
          font-weight: 600;
        }
      }
      th.td-check{
        padding: 0 15px !important;
      }
      tr{
        background: none;
        box-shadow: none;
      }
    }

    .vs-table--pagination {
      justify-content: center;
    }
  }
}
</style>
