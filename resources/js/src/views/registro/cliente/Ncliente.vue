
<template>

  <vs-sidebar click-not-close position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
    <div class="mt-6 flex items-center justify-between px-6">
        <h4>{{ Object.entries(this.data).length === 0 ? "Nuevo" : "Actualizar" }} Cliente</h4>
        <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>
    <component :is="scrollbarTag" class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">

      <div class="p-6">

        <div class="vx-row">
            <div class="vx-col sm:w-1/2 w-full">
              <p>Tipo de Doc.(*)</p>
              <v-select  v-model="sdoc" label="label" :options="docs" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
            </div>
            <div class="vx-col sm:w-1/2 w-full">
              <p>Número(*)</p>
              <vx-input-group >
                <vs-input
                  v-model="ndoc"
                  />
                <template v-if="sdoc.value == 2 || sdoc.value == 3 " slot="append">
                  <div class="append-text btn-addon">
                    <vs-button ref="loadableButton" id="button-with-loading" class="vs-con-loading__container" @click="mostrarDato"  type="relief">
                      <template v-if="sdoc.value == 2">
                        RENIEC
                      </template>
                      <template v-if="sdoc.value == 3">
                        SUNAT
                      </template>
                    </vs-button>
                  </div>
                </template>
              </vx-input-group>
            </div>
        </div>
        <div class="vx-row">
          <div class="vx-col sm:w-1/2 w-full">
            <vs-input label="Nombre(*)" v-model="nombre" class="mt-5 w-full" name="nombre" v-validate="'required'" />
            <span class="text-danger text-sm" v-show="errors.has('nombre')">{{ errors.first('nombre') }}</span>
          </div>
          <div class="vx-col sm:w-1/2 w-full mb-2">
            <vs-input label="Nombre Comercial o Razón" v-model="ncomercial" class="mt-5 w-full" name="nombre" />
            <span class="text-danger text-sm" v-show="errors.has('nombre')">{{ errors.first('nombre') }}</span>
          </div>
        </div>
        <div class="vx-row">
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <p>País</p>
            <v-select v-model="spaises" label="pais" :options="paises" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="país" placeholder="Selecione País" @input="llenarDepartamento"/>
          </div>
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <p>Departamento</p>
            <v-select v-model="sdepartamento" label="depa_nombre" :options="departamentos" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="marca" placeholder="Selecione Departamento" @input="llenarProvincia" />
          </div>
          <!-- <div class="vx-col sm:w-1/2 w-full mb-3"> -->
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <p>Provincia</p>
            <v-select v-model="sprovincia" label="vincia_nombre" :options="provincias" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="tipo" placeholder="Selecione Provincia" @input="llenarDistrito" />
          </div>
        </div>
        <div class="vx-row">
          <div class="vx-col sm:w-1/3 w-full pt-6">
            <p>Distrito</p>
            <v-select v-model="sdistrito" label="distri_nombre" :options="distritos" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="tipo" placeholder="Selecione Distrito" />
          </div>
          <div class="vx-col sm:w-2/3 w-full">
            <vs-input label="Dirección" v-model="direc" class="mt-5 w-full" name="Dirección"/>
          </div>
        </div>

        <div class="vx-row">

        </div>
        <div class="vx-row">
          <div class="vx-col sm:w-1/3 w-full">
            <vs-input
              label="Teléfono / Celular"
              v-model="telefono"
              class="mt-5 w-full"
              v-validate="{ regex: /\d+(\.\d+)?$/ }"
              name="Teléfono" />
            <span class="text-danger text-sm" v-show="errors.has('Teléfono')">{{ errors.first('Teléfono') }}</span>
          </div>
          <div class="vx-col sm:w-1/3 w-full">
            <vs-input
              label="E-mail"
              v-model="email"
              class="mt-5 w-full"
              v-validate="'email'"
              name="email" />
            <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
          </div>
          <!-- <div class="vx-col sm:w-1/2 w-full mb-3"> -->
          <div class="vx-col sm:w-1/3 w-full">
            <vs-input
              label="Web"
              v-model="web"
              class="mt-5 w-full"
              v-validate="'url:require_protocol'"
              name="web" />
            <span class="text-danger text-sm" v-show="errors.has('web')">{{ errors.first('web') }}</span>
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
import axios from 'axios'
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
      sdoc: {label:"DNI",value:2},
      docs:[{label:"Sin-doc_sin-dni",value:1},
            {label:"DNI",value:2},
            {label:"RUC",value:3},
            {label:"PASAPORTE",value:4},
          ],
      paises:[
        {pais: "Perú", value: 1},
        {pais: "Bolivia", value: 2},
        {pais: "Colombia", value: 3},
        {pais: "Venezuela", value: 4}
        ],
        spaises:'',
      tiempo:false,
      boton:'',
      ndoc:'',
      sdistrito:'',
      // distritos:'',
      sprovincia:'',
      // provincias:'',
      sdepartamento:'',
      // departamentos:'',
      pais:'',
      web:'',
      email:'',
      telefono:'',
      nombre:'',
      ncomercial:'',
      direc:'',

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
        const { cli_doc, cli_nombre, cli_docnum, cli_razon, cli_pais, cli_departamento, cli_provincia, cli_distrito, cli_direccion, cli_telefono, cli_email, cli_web} = JSON.parse(JSON.stringify(this.data))
        this.nombre = cli_nombre
        this.sdoc = cli_doc
        this.ncomercial = cli_razon
        this.ndoc = cli_docnum
        this.spaises = cli_pais
        this.sdepartamento = cli_departamento
        if (this.sdepartamento.iddepartamento) {
          this.llenarDepartamento();
        }
        this.sprovincia = cli_provincia
        if (this.sprovincia.idprovincia) {
          this.llenarProvincia(this.sdepartamento.iddepartamento);
        }
        this.sdistrito = cli_distrito
        if (this.sdistrito.iddistrito) {
          this.llenarDistrito(this.sprovincia.idprovincia);
        }
        this.direc = cli_direccion
        this.telefono = cli_telefono
        this.email = cli_email
        this.web = cli_web
        this.initValues()
      }
      // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataName, this.dataCategory, this.dataOrder_status, this.dataPrice } = JSON.parse(JSON.stringify(this.data))
    }
  },
  computed: {
    ...mapState('ciudad', ['departamentos','provincias','distritos']),

    ...mapState('marca', ['marcas']),
    ...mapState('cliente', ['respuesta']),
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
      return !this.errors.any() && this.sdoc && this.ndoc && this.nombre
    },
    scrollbarTag () { return this.$store.getters.scrollbarTag }
  },
  methods: {
      ...mapActions('ciudad',['listarDepartamentos','listarProvincias','listarDistritos','iniciarDepartamento','iniciarProvincia','iniciarDistrito']),

      ...mapActions('marca',['listarMarca']),
      ...mapActions('categoria',['listarCategoria']),
      ...mapActions('tipo',['listarTipo']),
      ...mapActions('unidad',['listarUnidad']),
    successUpload(){
      this.$vs.notify({color:'success',title:'Upload Success',text:'Lorem ipsum dolor sit amet, consectetur'})
    },
    llenarDepartamento(){
      if (this.spaises.value == 1) {
        this.listarDepartamentos();
      }else {
        this.iniciarDepartamento();
        this.iniciarProvincia();
        this.iniciarDistrito();
        this.sdepartamento = '';
        this.sprovincia = '';
        this.sdistrito = '';
      }
    },
    llenarProvincia(){
      if (this.sdepartamento.iddepartamento!=0) {
        this.listarProvincias(this.sdepartamento.iddepartamento);
      }
    },
    llenarDistrito(){
      if (this.sprovincia.idprovincia!=0) {
        this.listarDistritos(this.sprovincia.idprovincia);
      }
    },
    openLoadingContained(){
      this.$vs.loading({
      background: this.backgroundLoading,
      color: this.colorLoading,
      container: "#button-with-loading",
      scale: 0.45
    })
    },
    activar(){
      openLoadingContained();
    },
    desactivar(){
        this.$vs.loading.close("#button-with-loading > .con-vs-loading");
    },
    mostrarDato(){
      let me = this;
      if (this.ndoc == '') {
        this.notificacion('Ingrese el número a buscar','danger','clear');
        return
      }
      if (this.sdoc.value == 2) { var td = 'dni'; }
      if (this.sdoc.value == 3) { var td = 'ruc';  }
      me.openLoadingContained();
      var url='/service/'+td+'/'+this.ndoc;
        axios.get(url).then(function(response) {
          if(response.data.success) {
            var respuesta = response.data;
          me.nombre = respuesta.data.name;
          me.ncomercial = respuesta.data.trade_name;
          me.spaises = {pais: "Perú", value: 1};
          me.llenarDepartamento();
          me.sdepartamento = {depa_nombre: respuesta.data.department, iddepartamento: respuesta.data.department_id}
          me.llenarProvincia();
          me.sprovincia = {idprovincia: respuesta.data.province_id, vincia_nombre: respuesta.data.province}
          me.llenarDistrito();
          me.sdistrito = {iddistrito: respuesta.data.district_id, distri_nombre: respuesta.data.district}
          me.direc = respuesta.data.address;
          }else {
            me.notificacion(response.data.message,'danger','clear');
          }
        me.desactivar();
        }).catch(function(error) {
            console.log(error);
        })
        .finally(function() {
            // always executed
        });
    },
    initValues () {
      if (this.data.idcliente) return
      this.nombre = ''
      this.ndoc = ''
      this.ncomercial = ''
      this.spaises = ''
      this.sdoc = {label:"DNI",value:2}
      this.iniciarDepartamento();
      this.sdepartamento = ''
      this.iniciarProvincia();
      this.sprovincia = ''
      this.iniciarDistrito();
      this.sdistrito = ''
      this.direc = ''
      this.telefono = ''
      this.email = ''
      this.web = ''
    },
    async submitData (){
      const result = await this.$validator.validateAll();
      if (result) {
          try {
              const obj = {
                  idcliente: this.data.idcliente,
                  cli_doc: this.sdoc,
                  cli_docnum: this.ndoc,
                  cli_nombre: this.nombre,
                  cli_razon: this.ncomercial,
                  cli_pais: this.spaises,
                  cli_departamento: this.sdepartamento,
                  cli_provincia: this.sprovincia,
                  cli_distrito: this.sdistrito,
                  cli_direccion: this.direc,
                  cli_telefono: this.telefono,
                  cli_email: this.email,
                  cli_web: this.web
              }
              if (this.data.idcliente !== null && this.data.idcliente >= 0) {
                  await this.$store.dispatch('dataCliente/updateCliente', obj)
              } else {
                await this.$store.dispatch('dataCliente/addCliente', obj)
                  if (this.respuesta) {
                      await this.notificacion('ya se encuentra registrado','warning','warning');
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
      title:'Cliente',
      text:a,
      color:b,
      icon:c,
      position:'bottom-center'
      })
    }
  },
  mounted() {
    // this.listarDepartamentos(),

    // this.listarMarca(),
    // this.listarCategoria(),
    // this.listarTipo(),
    // this.listarUnidad()
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
