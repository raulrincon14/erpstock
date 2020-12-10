<template>
  <div id="data-list-list-view" class="data-list-container">

    <!-- <data-view-sidebar :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" /> -->
    <Ncategoria :isSidebarActive="addNewDataSidebar"></Ncategoria>

    <vs-table ref="table" multiple v-model="selected" pagination :max-items="8" search :data="categoria">

      <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">

        <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
            <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
            <span class="ml-2 text-base text-primary">Nuevo</span>
        </div>

        <!-- ITEMS PER PAGE -->

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
                <p class="product-name font-medium truncate">{{ tr.ca_nombre }}</p>
              </vs-td>

              <vs-td>
                <p class="product-category">{{ tr.ca_desc }}</p>
              </vs-td>

              <vs-td>
                <p class="product-price">{{ tr.ca_estado }}</p>
              </vs-td>

              <vs-td class="whitespace-no-wrap">
                <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" />
                <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2"  />
              </vs-td>

            </vs-tr>
          </tbody>
        </template>
    </vs-table>
  </div>
</template>

<script>
import Ncategoria from '../Ncategoriade.vue'
import axios from '@/axios.js'
export default {
  components:{
    Ncategoria
  },
  data() {
    return {
      addNewDataSidebar: false,
      selected: [],
      'tableList': [
        'vs-th: Component',
        'vs-tr: Component',
        'vs-td: Component',
        'thread: Slot',
        'tbody: Slot',
        'header: Slot'
      ],
      categoria: [],
      users: []
    }
  },
  computed: {

  },
  methods: {
    addNewData () {
      // this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    listarCategoria() {
    let me = this;
    var url='/admin/categoria';
    axios.get(url).then(function(response) {
            var respuesta = response.data.categoria;
            me.categoria = respuesta;
            console.log(respuesta);
        })
        .catch(function(error) {
            console.log(error);
        })
        .finally(function() {
            // always executed
        });
  },
  toggleDataSidebar (val = false) {
    this.addNewDataSidebar = val
  }
},
mounted(){
  this.listarCategoria();
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
            padding: 10px !important;
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
