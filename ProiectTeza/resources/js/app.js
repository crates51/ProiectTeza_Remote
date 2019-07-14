require('./bootstrap');
require('./costum');


// window.Vue = require('vue');
import Vue from 'vue';
// import App from './App.vue';
import InstantSearch from 'vue-instantsearch';
import VueSweetalert2 from 'vue-sweetalert2';
import VueRouter from 'vue-router'


Vue.use(InstantSearch);
Vue.use(VueSweetalert2);
Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: 'bookings',
      name: 'user'
    },
  ]
})

Vue.component('Datepicker2', require('./components/Datepicker2.vue'));
Vue.component('instantsearch', require('./App.vue'));
Vue.component('clientstatusmodal', require('./components/clientstatusmodal.vue'));
Vue.component('clientdeletemodal', require('./components/clientdeletemodal.vue'));
Vue.component('generalinfomodal', require('./components/generalinfomodal.vue'));



const app = new Vue({
 		el: '#app',
 		// router: router,
});
