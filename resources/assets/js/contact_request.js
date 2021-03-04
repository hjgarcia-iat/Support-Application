require('./bootstrap');

import Vue from 'vue';
import VeeValidate from 'vee-validate';
import ContactRequest from './components/ContactRequest';


Vue.use(VeeValidate);

new Vue({
    el        : '#contact-request',
    components: {
        'contact_request_form': ContactRequest
    }
});