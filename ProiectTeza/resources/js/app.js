require('./bootstrap');
require('./costum');
require('locutus/php/datetime/strtotime');

// window.Vue = require('vue');
import Vue from 'vue';
// import App from './App.vue';
import InstantSearch from 'vue-instantsearch';
// import VueSweetalert2 from 'vue-sweetalert2';
import VueRouter from 'vue-router'

// https://www.antdv.com/components/date-picker/ <--from here
import Antd from 'ant-design-vue'
import { Button, message } from 'ant-design-vue'

import BootstrapVue from 'bootstrap-vue'

import PortalVue from 'portal-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'ant-design-vue/dist/antd.css'
import moment from 'moment'
import Vuelidate from 'vuelidate'
import Swal from 'sweetalert2'


// import VModal from 'vue-js-modal'


Vue.component(Button.name, Button)
Vue.component(Button.Group.name, Button.Group)

Vue.use(InstantSearch);
// Vue.use(VueSweetalert2);
Vue.use(VueRouter);
Vue.use(Antd)
Vue.use(Button)
Vue.use(PortalVue)
Vue.use(BootstrapVue)
Vue.use(Vuelidate)

// Vue.use(require('vue-moment'));

// Vue.use(VModal)

Vue.config.productionTip = false
Vue.config.devtools=false



const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: 'bookings',
      name: 'user'
    },
  ]
})

Vue.component('room_in_roomlist', require('./components/room_in_roomlist.vue'));
Vue.component('datepicker', require('./components/datepicker.vue'));
// Vue.component('instantsearch', require('./App.vue'));
Vue.component('app', require('./app.vue'));
Vue.component('clientstatusmodal', require('./components/clientstatusmodal.vue'));
// Vue.component('examplecomponent', require('./components/testing_phase/ExampleComponent.vue'));

//====The Sections====
Vue.component('roomssection', require('./components/roomssection.vue'));
Vue.component('bookingssection', require('./components/bookingssection.vue'));
Vue.component('settingssection', require('./components/settingssection.vue'));

Vue.component('room_in_roomlist', require('./components/room_in_roomlist.vue'));
Vue.component('booking_in_bookingslist', require('./components/booking_in_bookingslist.vue'));

Vue.component('vuepopper', require('./components/vuepopper.vue'));

//====The modals====
Vue.component('generalinfomodal', require('./components/generalinfomodal.vue'));
Vue.component('edit_booking_modal', require('./components/modals/edit_booking_modal.vue'));
Vue.component('new_booking_modal', require('./components/modals/new_booking_modal.vue'));
Vue.component('edit_rooms_modal', require('./components/modals/edit_rooms_modal.vue'));
Vue.component('clientdeletemodal', require('./components/modals/clientdeletemodal.vue'));
// import Reusable from 'testing_phase/examplecomponentjs';

// export const Reusable = {
//      template: '<div>{{ name }} {{ bar }} lol </div>',

//       props: {
//         name: {
//           type: String
//         }
//       },
      
//       data () {
//         return {
//           bar: 'Bar'
//         }
//       }
//     };
export const bus = new Vue();
const axios = require('axios').default;

const app = new Vue({
 		el: '#app',
 		components:{
 		}
});
