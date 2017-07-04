
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('bank', require('./components/Bank.vue'));
Vue.component('bank-list', require('./components/BankList.vue'));

const app = new Vue({
    el: '#app',
    data: {
      banks: [],
      total: ''
    },
    created(){
      let url = document.head.querySelector('meta[name="url"]');
      axios.get(url).then(response =>{
        this.banks = response.data;
        let total = document.head.querySelector('meta[name="total"]');
        this.total = total.content;
      });
    }
});
