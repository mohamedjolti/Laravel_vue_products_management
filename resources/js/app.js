// /resources/js/app.js

window.Vue = require('vue');

import vuetify from './vuetify'
import store from "./store"
import App from './App.vue'

const app = new Vue({
    store,
    vuetify,
    render: h => h(App),
    el: '#app', 
});
