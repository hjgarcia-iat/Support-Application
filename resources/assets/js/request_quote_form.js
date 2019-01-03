require('./bootstrap');

import Vue from 'vue';
import RequestQuoteForm from './components/ConceptuaQuoteRequest.vue';

new Vue({
    el: '#request-quote-form',
    components: {
        'request-quote-form': RequestQuoteForm
    }
});