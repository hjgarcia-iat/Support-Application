require('./bootstrap');

import Vue from 'vue';
import SupportTicketForm from './pages/support-ticket/SupportTicketPage';


new Vue({
    el        : '#support-ticket-form',
    components: {
        'support_ticket_form': SupportTicketForm
    }
});