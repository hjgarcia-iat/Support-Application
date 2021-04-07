require('./bootstrap');

import Vue from 'vue';
import ContactRequest from './pages/contact-request/SupportTicketPage';


new Vue({
    el        : '#contact-request',
    components: {
        'contact_request_form': ContactRequest
    }
});