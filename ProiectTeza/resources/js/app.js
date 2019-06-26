require('./bootstrap');

require('./costum');
const baguetteBox = require('baguettebox.js');


window.Vue = require('vue');

Vue.component('Datepicker', require('./components/Datepicker.vue'));
Vue.component('Subheader', require('./components/Subheader.vue'));
Vue.component('Gallery', require('./components/Gallery.vue'));
Vue.component('Thumbnail', require('./components/Thumbnail.vue'));


const app = new Vue({
    el: '#app',
});
