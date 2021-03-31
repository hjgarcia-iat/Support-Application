require('./bootstrap');

import Vue from 'vue';
import RemoteLearningRequest from './components/RemoteLearningRequest.vue';

new Vue({
    el: '#remote-learning-request',
    components: {
        'remote-learning-request': RemoteLearningRequest
    }
});