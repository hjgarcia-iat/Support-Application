require('./bootstrap');

import Vue from 'vue';
import RequestProductInfoForm from './pages/request-product-info/RequestProductInfoForm';

export const EventBus = new Vue();

new Vue({
    el: '#request-product-info-form',
    components: {
        'request-product-info-form': RequestProductInfoForm
    }
});