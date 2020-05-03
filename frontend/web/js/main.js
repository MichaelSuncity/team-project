import Vue from 'vue';
import App from './components/App';
import VModal from "vue-js-modal";

import Vuelidate from 'vuelidate';
Vue.use(Vuelidate)

Vue.use(VModal, { dynamic: true, dynamicDefaults: { clickToClose: false } });
Vue.config.productionTip = false;


new Vue({
    el: '#app',
    render(h) {
        return h(App)
    }
})
