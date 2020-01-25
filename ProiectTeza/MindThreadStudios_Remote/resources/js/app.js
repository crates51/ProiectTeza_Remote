
require('./bootstrap');

import Vue from 'vue';

Vue.component('test', require('./components/test.vue').default);
Vue.component('app', require('./components/app.vue').default);
Vue.component('historyplayedgames_section', require('./components/sections/historyplayedgames_section.vue').default);
Vue.component('leaderbord_section', require('./components/sections/leaderbord_section.vue').default);

const axios = require('axios').default;

const app = new Vue({
    el: '#app',
    components:{
 	}
});
