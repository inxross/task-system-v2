import Vue from 'vue';
import Axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import router from "./router";
import store from "./store";
// bootstrap-vueからBootstrapVue,IconPluginをインポートする
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Bootstrap と BootstrapVueのCSSファイルをインポート（順序はBootstrap⇒BootstrapVue）
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueAxios, Axios, BootstrapVue, IconsPlugin);

Vue.config.productionTip = false;

new Vue({
  router: router,
  store: store,
  render: h => h(App),
  created() {
    this.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
  }
}).$mount('#app');
