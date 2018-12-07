
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Toasted from 'vue-toasted';
import VueContentPlaceholders from 'vue-content-placeholders';
import Multiselect from 'vue-multiselect';
import swal from 'sweetalert';
const moment = require('moment');
require('moment/locale/es');

Vue.use(Toasted);
Vue.use(VueContentPlaceholders);
Vue.use(require('vue-moment'), {
    moment
});
Vue.toasted.register('error', message => message, {
    position : 'top-center',
    duration : 5000
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.mixin({
    methods: {
        route: route
    }
});
Vue.component('multiselect', Multiselect);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('options', require('./components/options/Options.vue'));
Vue.component('sa-index', require('./components/users/sa/SAIndex.vue'));
Vue.component('sa-show', require('./components/users/sa/SAShow.vue'));
Vue.component('sa-add', require('./components/users/sa/SAAdd.vue'));
Vue.component('sa-edit', require('./components/users/sa/SAEdit.vue'));
Vue.component('ad-index', require('./components/users/ad/ADIndex.vue'));
Vue.component('ad-show', require('./components/users/ad/ADShow.vue'));
Vue.component('ad-add', require('./components/users/ad/ADAdd.vue'));
Vue.component('ad-edit', require('./components/users/ad/ADEdit.vue'));
Vue.component('co-index', require('./components/users/co/COIndex.vue'));
Vue.component('co-show', require('./components/users/co/COShow.vue'));
Vue.component('co-add', require('./components/users/co/COAdd.vue'));
Vue.component('co-edit', require('./components/users/co/COEdit.vue'));
Vue.component('te-index', require('./components/users/te/TEIndex.vue'));
Vue.component('te-show', require('./components/users/te/TEShow.vue'));
Vue.component('te-add', require('./components/users/te/TEAdd.vue'));
Vue.component('te-edit', require('./components/users/te/TEEdit.vue'));

const app = new Vue({
    el: '#app'
});


$('div.alert').not('.alert-important').delay(7000).fadeOut(350);
