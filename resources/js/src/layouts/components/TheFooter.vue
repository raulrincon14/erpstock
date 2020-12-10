<!-- =========================================================================================
    File Name: TheFooter.vue
    Description: Footer component
    Component Name: TheFooter
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template functional>
    <footer class="the-footer flex-wrap justify-between" :class="classes">
        <p>
          <span>COPYRIGHT &copy;</span>
          <span>{{ new Date().getFullYear() }} </span>
          <a href="https://rincosoft.com" target="_blank" rel="nofollow">RINCOSOFT</a>
          <span class="hidden sm:inline-block">, Todos los derechos reservados</span>
        </p>
        <span class="md:flex hidden items-center">
            <span>Nosotros tenemos a nuestros clientes en el</span>
            <feather-icon icon="HeartIcon" svgClasses="stroke-current text-danger w-6 h-6" class="ml-2" />
        </span>

        <!-- buyNow component -->
    </footer>
</template>

<script>

export default {
  name: 'the-footer',
  props: {
    classes: {
      type: String
    }
  },
  inject: {
    components:{
      default: {
      }
    }
  }
}
</script>
