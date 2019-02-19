require('./bootstrap');

import Vue from 'vue';
import NextGenPetRequest from './components/NextGenPetRequest.vue';

new Vue({
    el: '#nextgenpet-form',
    components: {
        'nextgenpet-form': NextGenPetRequest
    }
});