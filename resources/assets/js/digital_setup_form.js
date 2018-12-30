require('./bootstrap');

import Vue from 'vue';
import DigitalSetupForm from './components/DigitalSetupForm';

new Vue({
    el        : '#digital-setup',
    components: {
        'digital-setup-form': DigitalSetupForm
    }
});