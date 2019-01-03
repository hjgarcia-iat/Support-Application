require('./bootstrap');

import Vue from 'vue';
import ConceptuaCaseStudyRequest from './components/ConceptuaCaseRequest.vue';

new Vue({
    el: '#request-case-form',
    components: {
        'request-demo-form': ConceptuaCaseStudyRequest
    }
});