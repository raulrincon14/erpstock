
<template>

  <vs-sidebar click-not-close position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
    <div class="mt-6 flex items-center justify-between px-6">
        <h4>{{ Object.entries(this.data).length === 0 ? "Nueva" : "Actualizar" }} Marca</h4>
        <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>
    <component :is="scrollbarTag" class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">

      <div class="p-6">
        <!-- NAME -->
        <vs-input label="Nombre(*)" v-model="dataName" class="mt-5 w-full" name="nombre" v-validate="'required'" />
        <span class="text-danger text-sm" v-show="errors.has('nombre')">{{ errors.first('nombre') }}</span>
        <!-- Descripción -->
        <vs-input label="Descripción" v-model="desc" class="mt-5 w-full" name="descripción" />
      </div>
    </component>

    <div class="flex flex-wrap items-center p-6" slot="footer">
      <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">Registrar</vs-button>
      <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">Cancelar</vs-button>
    </div>
  </vs-sidebar>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
// import "toastr";
import {mapState} from 'vuex'
export default {
  props: {
    isSidebarActive: {
      type: Boolean,
      required: true
    },
    data: {
      type: Object,
      default: () => {}
    }
  },
  components: {
    VuePerfectScrollbar
  },
  data () {
    return {
      dataName: '',
      desc: '',
    settings: { // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: .60
      }
    }
  },
  watch: {
    isSidebarActive (val) {
      if (!val) return
      if (Object.entries(this.data).length === 0) {
        this.initValues()
        this.$validator.reset()
      } else {
        const { ma_nombre, ma_desc } = JSON.parse(JSON.stringify(this.data))
        this.dataName = ma_nombre
        this.desc = ma_desc
        this.initValues()
      }
      // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataName, this.dataCategory, this.dataOrder_status, this.dataPrice } = JSON.parse(JSON.stringify(this.data))
    }
  },
  computed: {
    ...mapState('marca', ['respuesta'])
    ,
    repito(){
      return this.$store.state.dataMarca.respuesta
    },
    isSidebarActiveLocal: {
      get () {
        return this.isSidebarActive
      },
      set (val) {
        if (!val) {
          this.$emit('closeSidebar')
        }
      }
    },
    isFormValid () {
      return !this.errors.any() && this.dataName
    },
    scrollbarTag () { return this.$store.getters.scrollbarTag }
  },
  methods: {
    initValues () {
      if (this.data.idmarca) return
      this.dataName = ''
      this.desc = ''
    },
    async submitData (){
      const result = await this.$validator.validateAll();
      if (result) {
          try {
              const obj = {
                  idmarca: this.data.idmarca,
                  ma_nombre: this.dataName,
                  ma_desc: this.desc
              }
              if (this.data.idmarca !== null && this.data.idmarca >= 0) {
                  await this.$store.dispatch('dataMarca/updateMarca', obj)
              } else {
                await this.$store.dispatch('dataMarca/addMarca', obj)
                  if (this.respuesta) {
                      await this.notificacion('ya se encuentra registrada','warning','warning');
                      return
                  }
                  await this.notificacion('Se registró con éxito','success','check_circle');
              }
              this.$emit('closeSidebar')
              await this.initValues();
              // this.$forceUpdate(); // <-- a ver si esto funciona
          } catch (e) {
              console.error(err)
          }
      }
},
    notificacion(a,b,c){
      this.$vs.notify({
      title:'Marca',
      text:a,
      color:b,
      icon:c,
      position:'bottom-center'
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 400px;
    max-width: 90vw;

    .img-upload {
      margin-top: 2rem;

      .con-img-upload {
        padding: 0;
      }

      .con-input-upload {
        width: 100%;
        margin: 0;
      }
    }
  }
}

.scroll-area--data-list-add-new {
    // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
    height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);

    &:not(.ps) {
      overflow-y: auto;
    }
}
</style>
