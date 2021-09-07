/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';


let authorization = require('./authorizations')

Vue.prototype.authorize = function (...params) {
    if (!window.Laravel.signedIn) {
        return false;
    }

    if (typeof params[0] === 'string') {
        return authorization[params[0]](params[1]);
    }

    return params[0](window.Laravel.user);
};



Vue.prototype.signedIn = window.Laravel.signedIn;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


window.events = new Vue();

Vue.component('blog-item', require('./pages/Blog.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('new-comment', require('./components/NewComment.vue').default);
Vue.component('comments', require('./components/Comments.vue').default);
Vue.component('Flash',require('./components/Flash').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level});
};
