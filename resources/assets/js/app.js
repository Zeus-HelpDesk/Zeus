/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';


import VueTimeago from 'vue-timeago';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueTimeago, {
    autoUpdate: 30
});

Vue.component('markdown-input', require('./components/MarkdownInput').default);

Vue.component('passport-clients', require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-tokens', require('./components/passport/PersonalAccessTokens.vue').default);

const app = new Vue({
    el: '#app'
});
