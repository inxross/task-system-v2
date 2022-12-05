import Vue from 'vue';
import axios from 'axios';
import App from './App.vue';
import router from "./router";
import store from "./store/index.js";
// bootstrap-vueからBootstrapVue,IconPluginをインポートする
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Bootstrap と BootstrapVueのCSSファイルをインポート（順序はBootstrap⇒BootstrapVue）
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

Vue.config.productionTip = false;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.baseURL = "http://vue-laravel-separately-tasksystem.localdomain";

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.isAuthenticated)) {
            if (!store.state.auth.isAuth) {
            next({ name: 'UserLogin' });
        } else {
            next();
        }
    }
    next();
});

new Vue({
  router: router,
  store: store,
  render: h => h(App),
}).$mount('#app');
