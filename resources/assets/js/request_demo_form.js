require('./bootstrap');

import Vue from 'vue';
import RequestDemoForm from './components/ConceptuaDemoRequest';

new Vue({
    el        : '#request-demo-form',
    components: {
        'request-demo-form': RequestDemoForm
    }
});