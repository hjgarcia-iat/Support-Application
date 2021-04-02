require('./bootstrap');

import Vue from 'vue';
import VeeValidate from 'vee-validate';
import Calculator from './components/Calculator';
import CalculatorPage from './pages/calculator/CalculatorPage';


Vue.use(VeeValidate);

new Vue({
    el: '#calculator',
    components: {
        'calculator': CalculatorPage
    }
});