require('./bootstrap');

import Vue from 'vue';
import VeeValidate from 'vee-validate';
import Calculator from './components/Calculator';


Vue.use(VeeValidate);

new Vue({
    el: '#calculator',
    components: {
        'calculator': Calculator
    }
});