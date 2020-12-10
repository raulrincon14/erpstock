

<template>
    <div>
        <div class="vx-row">
            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-2/3 xl:w-2/3 mb-base">
              <vx-card title="Compra">
                <div class="vx-row">
                  <div class="vx-col  lg:w-2/3 xl:w-2/3 w-full">
                    <v-select v-model="sbusca" label="pr_completo" :options="productos" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="marca" placeholder="Buscar/Escanear Producto" />
                  </div>
                  <div class="vx-col sm:w-1/4 w-full">
                    <vs-button class="mr-6" @click="mostrar">AGREGAR</vs-button>

                  </div>
                </div>

                <template v-if="most">
                <div class="op-block mt-5">
                <div class="vx-row">
                  <div class="vx-col lg:w-2/3 xl:w-2/3 w-full">
                    <vs-alert v-if="sbusca.pr_lote" icon="done" color="success" title="Producto Seleccionado" active="true">
                      {{this.sbusca.pr_completo}}
                    </vs-alert>
                  </div>
                  <div class="vx-col sm:w-1/3 w-full mb-2">
                    <vs-button type="border" color="danger" @click="ocultar">Cerrar</vs-button>
                  </div>
                </div>

                <div class="vx-row">
                  <div class="vx-col  lg:w-1/3 xl:w-1/3 w-full">
                    <vs-input v-model="lote" class="mt-5 w-full" name="nombre" placeholder="Código de Lote"/>
                  </div>
                  <div class="vx-col  lg:w-1/3 xl:w-1/3 w-full mb-2 pt-5">
                    <flat-pickr :config="configdateTimePicker" v-model="date" placeholder="F. Vencimiento" />
                    <!-- {{this.date}} -->
                  </div>
                  <div class="vx-col sm:w-1/3 w-full mb-2 pt-5">
                    <!-- <vs-button class="mr-6" @click="probar">AGREGAR</vs-button> -->
                  </div>
                </div>

                <!-- Codigo para agregar Serie -->
                <!-- <div class="vx-row">
                  <h1>Finds</h1>
                   <div v-for="(find, index) in finds">
                     <input v-model="find.value" :key="index">
                   </div>
                   <button @click="addFind">
                     New Find
                   </button>
                </div> -->
                </div>
              </template>
                <!-- USER BIO -->
                <div class="caja pt-5">

                <vs-table :data="compra">

                  <template slot="thead">
                    <vs-th>Producto</vs-th>
                    <vs-th>Precio {{this.signos}}</vs-th>
                    <vs-th>Cantidad</vs-th>
                    <vs-th>Subtotal {{this.signos}}</vs-th>
                    <vs-th>Acción</vs-th>
                  </template>

                  <template slot-scope="{data}">
                    <!-- <div class="caja"> -->

                    <vs-tr :key="indextr" v-for="(tr, indextr) in data.slice().reverse()">

                      <vs-td :data="tr.completo">
                        {{ tr.completo }}
                      </vs-td>

                      <vs-td :data="tr.precio">
                        {{ tr.precio }}
                        <template slot="edit">
                        <vs-input-number v-model="tr.precio" />
                        </template>
                      </vs-td>

                      <vs-td :data="tr.cantidad">
                        {{ tr.cantidad }}
                        <template slot="edit">
                          <vs-input-number v-model="tr.cantidad" />
                        </template>
                      </vs-td>

                      <vs-td :data="tr.total">
                        {{ Math.round(tr.precio * tr.cantidad * 100) / 100 }}
                      </vs-td>

                      <vs-td :data="tr.total">
                        <vs-button type="border" size="small" @click="eliminar(tr.idproducto)" icon-pack="feather" icon="icon-trash" color="danger"></vs-button>
                      </vs-td>

                    </vs-tr>
                  </template>
                </vs-table>
              </div>

              </vx-card>
            </div>

            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base">
              <vx-card>
                <div class="vx-row">
                  <div class="vx-col w-full">
                    <v-select v-model="sproveedor" label="pro_prove" :options="proveedores" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="proveedor" v-validate="'required'" placeholder="Selecione Proveedor" />
                    <span class="text-danger text-sm" v-show="errors.has('proveedor')">{{ errors.first('proveedor') }}</span>
                  </div>
                </div>
                <div class="vx-row">
                  <div class="vx-col w-full pt-4">
                    <v-select v-model="scompro" label="compro" :options="comprobantes" :dir="$vs.rtl ? 'rtl' : 'ltr'" name="comprobante" v-validate="'required'" placeholder="Selecione Comprobante" />
                    <span class="text-danger text-sm" v-show="errors.has('comprobante')">{{ errors.first('comprobante') }}</span>
                  </div>
                </div>
                <!-- USER BIO -->
                <div class="vx-row">
                  <div class="vx-col sm:w-1/2 w-full">
                    <vs-input v-model="serie" class="mt-5 w-full" name="serie" placeholder="Serie"/>
                    <span class="text-danger text-sm" v-show="errors.has('serie')">{{ errors.first('serie') }}</span>
                  </div>
                  <div class="vx-col sm:w-1/2 w-full">
                    <vs-input v-model="numero" class="mt-5 w-full" name="numero" placeholder="Número"/>
                    <span class="text-danger text-sm" v-show="errors.has('numero')">{{ errors.first('numero') }}</span>
                  </div>
                </div>
                <div class="vx-row">
                  <div class="vx-col sm:w-1/2 w-full">
                    <flat-pickr :config="configdateTimePicker" class="mt-5 w-full" v-model="femision" placeholder="F. Emision" name="emision" />
                    <span class="text-danger text-sm" v-show="errors.has('emision')">{{ errors.first('emision') }}</span>
                  </div>
                  <div class="vx-col sm:w-1/2 w-full">
                    <flat-pickr :config="configdateTimePicker" class="mt-5 w-full" v-model="fvencimiento" placeholder="F. Vencimiento" name="vencimiento" />
                    <span class="text-danger text-sm" v-show="errors.has('vencimiento')">{{ errors.first('vencimiento') }}</span>
                  </div>
                </div>
                <div class="vx-row">
                  <div class="vx-col pt-3 w-full" vs-justify="center" vs-align="center">
                    <vs-alert color="rgb(30, 144, 255)" active="true" class="content-cente">
                      <h1 class="text-primary"> {{this.signos +' ' + formatPrice(this.calcularTotal)}}</h1>
                    </vs-alert>
                  </div>
                </div>
                <div class="vx-row">
                  <div class="vx-col pt-2 sm:w-1/2 w-full">
                    <vs-radio v-model="moneda" vs-value="soles">(S/) Soles</vs-radio>
                  </div>
                  <div class="vx-col pt-2 sm:w-1/2 w-full">
                    <vs-radio v-model="moneda" vs-value="dolares">($) Dolares </vs-radio>
                  </div>
                </div>
                <div class="vx-row">
                  <div class="vx-col sm:w-1/2 w-full">
                    <vs-button class="mt-5 w-full" :disabled="!isFormValid" @click="registrarCom">Registrar</vs-button>
                  </div>
                  <div class="vx-col sm:w-1/2 w-full">
                    <!-- <vs-button class="mt-5 w-full" type="border" color="danger" @click="isSidebarActiveLocal = false">Cancelar</vs-button> -->
                    <vs-button class="mt-5 w-full" type="border" color="danger" @click="">Cancelar</vs-button>
                  </div>
                </div>
              </vx-card>
            </div>

        </div>
    </div>
</template>

<script>

import axios from 'axios'
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import {Spanish as FrenchLocale} from 'flatpickr/dist/l10n/es.js';
import vSelect from 'vue-select'
import {mapActions, mapState} from 'vuex'
import {find, filter} from 'lodash'

export default{
  components: {
    'v-select': vSelect,
    flatPickr
  },
  data () {
    return {
      configdateTimePicker: {
        locale: FrenchLocale
      },
      sbusca: '',
      sproveedor:'',
      smarca: '',
      compra:[],
      lote: '',
      serie:'',
      numero:'',
      femision:'',
      fvencimiento:'',
      name: '',
      buscar: '',
      most: 0,
      scompro: '',
      comprobantes:[
        {compro: "Boleta"},
        {compro: "Factura"},
        {compro: "Boleta Electrónica"},
        {compro: "Factura Electrónica"}
      ],
      marcas:[
        {label: 'uno', value:1}
      ],
      date: null,
      signo: 'S/',
      moneda: 'soles'
      // finds: [] :: para agregar series
    }
  },
  methods:{
    ...mapActions('producto',['listarProducto']),
    ...mapActions('proveedor',['listarProveedor']),
    agregar(){
      if (this.sbusca=='') {
        this.notificacion('Seleccione un producto','danger','warning');
        return
      }

      if (this.most) {
        if (this.date && this.lote) {
          this.ejemplo();
        }else {
          this.notificacion('Ingrese lote y vencimiento','warning','warning');
        }

      }else {
        this.ejemplo();
      }
      console.log(this.compra);
    },
    // PARA AGREGAR SERIES - MULTI INPUT
  //   addFind: function () {
  //   this.finds.push({ value: '' });
  // },
    eliminar(a ){
      this.compra = filter(this.compra, ({idproducto}) => idproducto != a)
    },
    registrarCom(){
      let me = this;
      if (this.compra.length == 0) {
        this.notificacion('Debe agregar productos','warning','warning');
        return
      }

        axios.post('/admin/compra', {
          'comprobante' : this.scompro.compro,
          'serie': this.serie,
          'numero': this.numero,
          'moneda': this.moneda,
          'total': this.calcularTotal,
          'emision': this.femision,
          'vencimiento': this.fvencimiento,
          'provee': this.sproveedor.idproveedor,
          'data' : this.compra
        }).then(function (response) {
            me.notificacion('Compra registrada','success','check_circle');
            me.iniciar();
        }).catch(function (error) {
                  console.log(error);
                  // mensaje('error','Tarea','No realizada');
                });
    },
    iniciar(){
      this.compra = [];
      this.scompro = "";
      this.serie = "";
      this.numero = "";
      this.moneda = "soles";
      this.femision = "";
      this.fvencimiento = "";
      this.sproveedor = "";

    },
    ejemplo(){
      const productInCart = find(this.productos, { idproducto: this.sbusca.idproducto })
      const product = this.compra.find(item=>item.idproducto == this.sbusca.idproducto)
        if(! product){
          var comprita = {
              idproducto: this.sbusca.idproducto,
              completo: this.sbusca.pr_completo,
              precio: this.sbusca.pr_precioc,
              cantidad: 1,
              lote: this.lote,
              fecha: this.date
            }
            this.compra.push(comprita);
            this.ocultar();
        }else{
          let canti = parseInt(product.cantidad)
          product.cantidad = canti + 1;
          this.sbusca = '';
        }
    },
    mostrar(){
      this.most = this.sbusca.pr_lote;
      this.agregar()
    },
    ocultar(){
      this.most = 0;
      this.lote = '';
      this.date = '';
      this.sbusca = '';
    },
    notificacion(a,b,c){
      this.$vs.notify({
      title:'Compra',
      text:a,
      color:b,
      icon:c,
      position:'bottom-center'
      })
    },
    formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
  },
  computed: {
    scrollbarTag () { return this.$store.getters.scrollbarTag },
    ...mapState('producto', ['productos']),
    ...mapState('proveedor', ['proveedores']),
    calcularTotal: function(){
      return this.compra.reduce((sum,product)=>{
        // {{ Math.round(tr.precio * tr.cantidad * 100) / 100 }}
        // console.log(Math.round(product.precio * product.cantidad * 100) / 100));
        // return (parseFloat(product.precio) * product.cantidad) + sum
        // return (Math.round(product.precio * product.cantidad * 100) / 100) + Math.round(sum)
        return (parseFloat(product.precio) * product.cantidad) + sum
        // console.log(sum);
      }, 0)
    },
    signos: function (){
      if (this.moneda == "soles") {
        return this.signo = "S/";
      }else {
        return this.signo = "$";
      }
    },
    isFormValid () {
      return !this.errors.any() && this.scompro && this.sproveedor && this.serie && this.numero && this.femision && this.fvencimiento
    }

//     export function totalCost (state) {
//   return state.cart.reduce((sum, product) => {
//     return (parseFloat(product.price) * product.qty) + sum
//   }, 0)
// }
  },
  mounted () {
    this.wasSidebarOpen = this.$store.state.reduceButton
    this.$store.commit('TOGGLE_REDUCE_BUTTON', true)
  },
  created () {
    // Subscribers gained - Statistics
    this.listarProducto();
    this.listarProveedor();

  }
}
</script>

<style lang="scss">
.caja{
  width:100%;
  height: 400px;
  overflow-y: scroll;
  display: inline-block;
}
</style>
