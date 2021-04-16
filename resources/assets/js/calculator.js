require("./bootstrap");

import Vue from "vue";
import Vuex from "vuex";

import CalculatorPage from "./pages/calculator/CalculatorPage";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        number_of_teachers: 0,
        number_of_students: 0,

        student_ap_digital_one_year_access_cost: 59.55,
        student_ac_digital_one_year_access_cost: 53.60,
        student_ec_digital_one_year_access_cost: 53.60,
        student_ap_digital_six_year_access_cost: 120.55,
        student_ac_digital_six_year_access_cost: 108.60,
        student_ec_digital_six_year_access_cost: 108.60,

        teacher_ap_digital_one_year_access_cost: 25.00,
        teacher_ac_digital_one_year_access_cost: 25.00,
        teacher_ec_digital_one_year_access_cost: 25.00,
        teacher_ap_digital_six_year_access_cost: 75.00,
        teacher_ac_digital_six_year_access_cost: 75.00,
        teacher_ec_digital_six_year_access_cost: 75.00,

        one_year_ap_costs: 0,
        six_year_ap_costs: 0,
        six_year_ap_savings: 0,

        one_year_ac_costs: 0,
        six_year_ac_costs: 0,
        six_year_ac_savings: 0,

        one_year_ec_costs: 0,
        six_year_ec_costs: 0,
        six_year_ec_savings: 0,

        usage: "",
        product_interest: "",
        step: 1,
        alert_type: "",
        alert_message: "",
        alert_show: false,
    },
    mutations: {
        oneYearApCost(state, value) {
            state.one_year_ap_costs = value;
        },
        sixYearApCost(state, value) {
            state.six_year_ap_costs = value;
        },
        sixYearApSavings(state, value) {
            state.six_year_ap_savings = value;
        },

        oneYearAcCost(state, value) {
            state.one_year_ac_costs = value;
        },
        sixYearAcCost(state, value) {
            state.six_year_ac_costs = value;
        },
        sixYearAcSavings(state, value) {
            state.six_year_ac_savings = value;
        },

        oneYearEcCost(state, value) {
            state.one_year_ec_costs = value;
        },
        sixYearEcCost(state, value) {
            state.six_year_ec_costs = value;
        },
        sixYearEcSavings(state, value) {
            state.six_year_ec_savings = value;
        },

        updateStep(state, step) {
            state.step = step;
        },
        updateProductInterest(state, product) {
            state.product_interest = product;
        },
        updateNumberOfStudents(state, number_of_students) {
            state.number_of_students = number_of_students;
        },
        updateNumberOfTeachers(state, number_of_teachers) {
            state.number_of_teachers = number_of_teachers;
        },
        updateUsage(state, usage) {
            state.usage = usage;
        },
        showAlert(state) {
            state.alert_show = true;
        },
        setAlertMessage(state, message) {
            state.alert_message = message;
        },
        setAlertType(state, type) {
            state.alert_type = type;
        },
        hideAlert(state) {
            state.alert_show = false;
            state.alert_message = "";
            state.alert_type = "";
        },
        reset(state) {
            state.number_of_teachers = 0;
            state.number_of_students = 0;
            state.usage = 0;
            state.product_interest = "";
        },
    },
    actions: {
        getApCalculations({commit, state}) {
            let one_year_cost =
                state.student_ap_digital_one_year_access_cost *
                state.number_of_students +
                state.teacher_ap_digital_one_year_access_cost *
                state.number_of_teachers;

            commit("oneYearApCost", one_year_cost);

            let six_year_cost =
                state.student_ap_digital_six_year_access_cost *
                state.number_of_students +
                state.teacher_ap_digital_six_year_access_cost *
                state.number_of_teachers;

            commit("sixYearApCost", six_year_cost);

            let six_year_savings =
                ((one_year_cost * 6) - six_year_cost) / (one_year_cost * 6);

            commit("sixYearApSavings", six_year_savings);
        },

        getAcCalculations({commit, state}) {
            let one_year_cost =
                state.student_ac_digital_one_year_access_cost *
                state.number_of_students +
                state.teacher_ac_digital_one_year_access_cost *
                state.number_of_teachers;

            commit("oneYearAcCost", one_year_cost);

            let six_year_cost =
                state.student_ac_digital_six_year_access_cost * state.number_of_students +
                state.teacher_ac_digital_six_year_access_cost *
                state.number_of_teachers;

            commit("sixYearAcCost", six_year_cost);

            let six_year_savings =
                ((one_year_cost * 6) - six_year_cost) / (one_year_cost * 6);

            commit("sixYearAcSavings", six_year_savings);
        },
        getEcCalculations({commit, state}) {
            let one_year_cost =
                state.student_ec_digital_one_year_access_cost *
                state.number_of_students +
                state.teacher_ec_digital_one_year_access_cost *
                state.number_of_teachers;

            commit("oneYearEcCost", one_year_cost);

            let six_year_cost =
                state.student_ec_digital_six_year_access_cost *
                state.number_of_students +
                state.teacher_ec_digital_six_year_access_cost *
                state.number_of_teachers;

            commit("sixYearEcCost", six_year_cost);

            let six_year_savings =
                ((one_year_cost * 6) - six_year_cost) / (one_year_cost * 6);

            commit("sixYearEcSavings", six_year_savings);
        },
    },
});

new Vue({
    el: "#calculator",
    store,
    components: {
        calculator: CalculatorPage,
    },
});
