require('./bootstrap');

import Vue from 'vue';
import VeeValidate from 'vee-validate';
import AccessRequest from './components/AccessRequest';


Vue.use(VeeValidate);

new Vue({
    el        : '#access-request',
    components: {
        'access-request-form': AccessRequest
    }
});