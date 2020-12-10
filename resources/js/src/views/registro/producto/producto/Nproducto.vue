
<template>

  <vs-sidebar click-not-close position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
    <div class="mt-6 flex items-center justify-between px-6">
        <h4>{{ Object.entries(this.data).length === 0 ? "Nuevo" : "Actualizar" }} Producto</h4>
        <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>
    <component :is="scrollbarTag" class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">

      <div class="p-6">

        <!-- imagen -->
        <div class="vx-row flex content-center">
            <template v-if="dataImg">


               <div class="vx-col w-full">
                <!-- Image Container -->
                 <div class="img-container w-64 mx-auto flex items-center justify-center">
                   <img :src="dataImg" alt="img" class="responsive">
                 </div>
                 <!-- Image upload Buttons -->
                 <div class="modify-img w-full text-center">
                   <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*">
                   <vs-button class="mr-4" type="flat" @click="$refs.updateImgInput.click()">Actualizar Imagen</vs-button>
                   <vs-button type="flat" color="#999" @click="dataImg = null">Quitar Imagen</vs-button>
                 </div>
               </div>
          </template>
          <div class="upload-img w-full text-center" v-if="!dataImg">
            <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
            <vs-button @click="$refs.uploadImgInput.click()">Subir Imagen</vs-button>
          </div>
        </div>






        <div class="vx-row">
            <div class="vx-col sm:w-1/2 w-full mb-2">
              <vs-input label="Nombre(*)" v-model="name" class="mt-5 w-full" name="nombre" v-validate="'required'" />
              <span class="text-danger text-sm" v-show="errors.has('nombre')">{{ errors.first('nombre') }}</span>
            </div>
            <div class="vx-col sm:w-1/2 w-full mb-2">
              <vs-input label="Descripción" v-model="desc" class="mt-5 w-full" name="descripción" />

            </div>
        </div>
        <div class="vx-row">
          <div class="vx-col sm:w-1/4 w-full">
            <vs-input
              label="Precio Compra(*)"
              v-model="pprecioc"
              class="mt-5 w-full"
              v-validate="{ required: true, regex: /\d+(\.\d+)?$/ }"
              name="precio compra" />
            <span class="text-danger text-sm" v-show="errors.has('precio compra')">{{ errors.first('precio compra') }}</span>
          </div>
          <div class="vx-col sm:w-1/4 w-full">
            <vs-input
              label="Precio Venta(*)"
              v-model="ppreciov"
              class="mt-5 w-full"
              v-validate="{ required: true, regex: /\d+(\.\d+)?$/ }"
              name="precio venta" />
            <span class="text-danger text-sm" v-show="errors.has('precio venta')">{{ errors.first('precio venta') }}</span>
          </div>
          <!-- <div class="vx-col sm:w-1/2 w-full mb-3"> -->
          <div class="vx-col sm:w-1/2 w-full">
            <vs-input label="Código de Barra" v-model="codigob" class="mt-5 w-full" name="codigo de barra"/>
            <span class="text-danger text-sm" v-show="errors.has('codigo de barra')">{{ errors.first('codigo de barra') }}</span>
          </div>
        </div>
        <div class="vx-row">
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <p>Categoria(*)</p>
            <v-select v-model="scategoria" label="ca_nombre" :options="categorias" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="categoria" v-validate="'required'" placeholder="Selecione categoria" />
            <span class="text-danger text-sm" v-show="errors.has('categoria')">{{ errors.first('categoria') }}</span>
          </div>
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <p>Marca(*)</p>
            <v-select v-model="smarca" label="ma_nombre" :options="marcas" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="marca" v-validate="'required'" placeholder="Selecione marca" />

            <span class="text-danger text-sm" v-show="errors.has('marca')">{{ errors.first('marca') }}</span>
          </div>
          <!-- <div class="vx-col sm:w-1/2 w-full mb-3"> -->
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <p>Tipo(*)</p>
            <v-select v-model="stipo" label="ti_nombre" :options="tipos" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="tipo" v-validate="'required'" placeholder="Selecione tipo" />
            <span class="text-danger text-sm" v-show="errors.has('tipo')">{{ errors.first('tipo') }}</span>
          </div>
        </div>
        <div class="vx-row">
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <vs-checkbox v-model="lote" vs-value="1">Maneja Lotes?</vs-checkbox>
          </div>
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <vs-checkbox v-model="serie" vs-value="1">Maneja Series?</vs-checkbox>
          </div>
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <vs-checkbox v-model="pigv" vs-value="1">Incluye IGV?</vs-checkbox>
          </div>
        </div>
        <div class="vx-row">
          <div class="vx-col sm:w-1/3 w-full">
            <vs-input
              label="Stock Mínimo"
              v-model="stkmin"
              class="mt-5 w-full"
              v-validate="{ regex: /\d+(\.\d+)?$/ }"
              name="stock" />
            <span class="text-danger text-sm" v-show="errors.has('stock')">{{ errors.first('stock') }}</span>
          </div>
          <div class="vx-col sm:w-1/3 w-full">
            <vs-input
              label="Medida(*)"
              v-model="pmedida"
              class="mt-5 w-full"
              v-validate="{ required: true, regex: /\d+(\.\d+)?$/ }"
              name="medida" />
            <span class="text-danger text-sm" v-show="errors.has('medida')">{{ errors.first('medida') }}</span>
          </div>
          <!-- <div class="vx-col sm:w-1/2 w-full mb-3"> -->
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <p>Unidad de Medida(*)</p>
            <v-select v-model="sunidad" label="u_nombre" :options="unidades" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="unidad" v-validate="'required'" placeholder="Seleccione Unidad de Medida"/>
            <span class="text-danger text-sm" v-show="errors.has('unidad')">{{ errors.first('unidad') }}</span>
          </div>
        </div>




        <!-- <vs-upload action="/fotos" @on-success="successUpload" /> -->
      </div>
    </component>

    <div class="flex flex-wrap items-center p-6" slot="footer">
      <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">Registrar</vs-button>
      <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">Cancelar</vs-button>
      <!-- <vs-button type="border" color="danger" @click="subirImagen">Cancelar</vs-button> -->
    </div>


  </vs-sidebar>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import vSelect from 'vue-select'
// import "toastr";
import {mapActions, mapState} from 'vuex'
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
    'v-select': vSelect,
    VuePerfectScrollbar
  },
  data () {
    return {
      codigob: '',
      coddi:'',
      pprecioc: '',
      ppreciov: '',
      pigv: '',
      stkmin: '',
      pmedida: '',
      scategoria: '',
      smarca: '',
      stipo: '',
      sunidad: '',
      name: '',
      radios1: '',
      desc: '',
      dataImg: null,
    settings: { // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: .60
      },
      lote: false,
      serie: false,
    }
  },
  watch: {
    isSidebarActive (val) {
      if (!val) return
      if (Object.entries(this.data).length === 0) {
        this.initValues()
        this.$validator.reset()
      } else {
        const { pr_nombre,pr_codi, pr_desc, pr_precioc, pr_preciov, pr_cb, pr_stkmin, pr_medida, pr_igv, pr_lote, pr_serie, idcategoria, ca_nombre, idunidad, u_nombre, idmarca, ma_nombre, idtipo, ti_nombre} = JSON.parse(JSON.stringify(this.data))
        this.name = pr_nombre
        this.desc = pr_desc
        this.pprecioc = pr_precioc
        this.ppreciov = pr_preciov
        this.codigob = pr_cb
        this.stkmin = pr_stkmin
        this.pmedida = pr_medida
        this.pigv = pr_igv
        this.lote = pr_lote
        this.coddi= pr_codi
        this.serie = pr_serie
        this.scategoria = {idcategoria: idcategoria, ca_nombre: ca_nombre},
        // this.scategoria = idcategoria
        this.sunidad = {idunidad: idunidad, u_nombre: u_nombre}
        this.smarca = {idmarca: idmarca, ma_nombre: ma_nombre}
        this.stipo = {idtipo: idtipo, ti_nombre: ti_nombre}
        this.initValues()
      }
      // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataName, this.dataCategory, this.dataOrder_status, this.dataPrice } = JSON.parse(JSON.stringify(this.data))
    }
  },
  computed: {
    ...mapState('marca', ['marcas']),
    ...mapState('producto', ['respuesta']),
    ...mapState('categoria', ['categorias']),
    ...mapState('tipo', ['tipos']),
    ...mapState('unidad', ['unidades']),
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
      return !this.errors.any() && this.name && this.pprecioc && this.ppreciov && this.scategoria && this.smarca && this.stipo && this.sunidad && this.pmedida
    },
    scrollbarTag () { return this.$store.getters.scrollbarTag }
  },
  methods: {
      ...mapActions('marca',['listarMarca']),
      ...mapActions('categoria',['listarCategoria']),
      ...mapActions('tipo',['listarTipo']),
      ...mapActions('unidad',['listarUnidad']),
    successUpload(){
      this.$vs.notify({color:'success',title:'Upload Success',text:'Lorem ipsum dolor sit amet, consectetur'})
    },
    initValues () {
      if (this.data.idproducto) return
      this.name = ''
      this.desc = ''
      this.pprecioc = ''
      this.ppreciov = ''
      this.codigob = ''
      this.stkmin = ''
      this.pmedida = ''
      this.pigv = ''
      this.lote = ''
      this.serie = ''
      this.scategoria = ''
      this.sunidad = ''
      this.smarca = ''
      this.stipo = ''
    },
    async submitData (){
      const result = await this.$validator.validateAll();
      if (result) {
          try {
              const obj = {
                  idproducto: this.data.idproducto,
                  pr_codi: this.coddi,
                  pr_nombre: this.name,
                  pr_desc: this.desc,
                  pr_precioc: this.pprecioc,
                  pr_preciov: this.ppreciov,
                  pr_cb: this.codigob,
                  pr_stkmin: this.stkmin,
                  pr_medida: this.pmedida,
                  pr_igv: this.pigv,
                  pr_lote: this.lote,
                  pr_serie: this.serie,
                  idcategoria: this.scategoria.idcategoria,
                  idunidad: this.sunidad.idunidad,
                  idmarca: this.smarca.idmarca,
                  idtipo: this.stipo.idtipo,
                  imagen: this.dataImg
              }
              if (this.data.idproducto !== null && this.data.idproducto >= 0) {
                  await this.$store.dispatch('dataProducto/updateProducto', obj)
              } else {
                await this.$store.dispatch('dataProducto/addProducto', obj)
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
              console.error(e)
          }
      }
},
updateCurrImg (input) {
  console.log(this.scategoria);
  if (input.target.files && input.target.files[0]) {
    const reader = new FileReader()
    reader.onload = e => {
      this.dataImg = e.target.result
    }
    reader.readAsDataURL(input.target.files[0])
  }
},
subirImagen(){

},
    notificacion(a,b,c){
      this.$vs.notify({
      title:'Producto',
      text:a,
      color:b,
      icon:c,
      position:'bottom-center'
      })
    }
  },
  mounted() {
    this.listarMarca(),
    this.listarCategoria(),
    this.listarTipo(),
    this.listarUnidad(),
         console.log(this.marcas)
console.log('esto seria' + this.scategoria);
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
    width: 900px;
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
