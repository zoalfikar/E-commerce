require('./bootstrap');
window.Vue = require('vue');
import vuetify from './vuetify';
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    vuetify
});