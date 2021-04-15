require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex'

import CalculatorPage from './pages/calculator/CalculatorPage';

Vue.use(Vuex)

export const EventBus = new Vue();

const store = new Vuex.Store({
    state: {
        number_of_teachers: 0,
        number_of_students: 0,
        usage: '',
        product_interest: '',
        step: 1,
    },
    mutations: {
        updateStep(state, step) {
            state.step = step
        },
        updateProductInterest(state, product) {
            state.product_interest = product
        },
        updateNumberOfStudents(state, number_of_students) {
            state.number_of_students = number_of_students
        },
        updateNumberOfTeachers(state, number_of_teachers) {
            state.number_of_teachers = number_of_teachers
        },
        updateUsage(state, usage) {
            state.usage = usage
        },
        reset(state) {
            state.number_of_teachers = 0
            state.number_of_students = 0
            state.usage = 0
            state.product_interest = 0
            state.step = 1
        }
    }
})

new Vue({
    el: '#calculator',
    store,
    components: {
        'calculator': CalculatorPage
    }
});