require('./bootstrap');

import Vue from 'vue';
import ReturnRequestForm from './pages/return-request/ReturnRequest.vue';

new Vue({
    el: '#request-quote-form',
    components: {
        'return-request-form': ReturnRequestForm
    }
});