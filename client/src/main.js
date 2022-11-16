import Vue from 'vue';
import Axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import router from "./router";
import store from "./store";

Vue.use(VueAxios, Axios);
Vue.config.productionTip = false;

new Vue({
  router: router,
  store: store,
  render: h => h(App),
  created() {
    this.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
  }
}).$mount('#app');
