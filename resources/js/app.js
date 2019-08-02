/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('opcion-movimiento', require('./components/OpcionMovimiento.vue').default);
Vue.component('tipo-ingreso', require('./components/TipoIngreso.vue').default);
Vue.component('ingreso-compra', require('./components/IngresoCompra.vue').default);
Vue.component('ingreso-retorno-obra', require('./components/IngresoRetornoObra.vue').default);
Vue.component('salida-uso-obra', require('./components/SalidaUsoObra.vue').default);
Vue.component('modal-busqueda', require('./components/ModalBusqueda.vue').default);
Vue.component('reporte-historico', require('./components/ReporteHistorico.vue').default);
Vue.component('consulta-general', require('./components/GeneralQueryWarehouse.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
