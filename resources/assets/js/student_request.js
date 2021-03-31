require('./bootstrap');

import Vue from 'vue';
import StudentRequestForm from './components/StudentRequest.vue';

new Vue({
    el: '#student-request-form',
    components: {
        'student-request-form': StudentRequestForm
    }
});