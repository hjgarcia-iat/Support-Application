<template>
    <div class="p-6">
        <alert :message=alertMessage
            :type=alertType
            :visible=alertVisible
            @alert-hide="alertVisible=false"></alert>
        <div v-if="step===1">
            <calculator-form :number_of_students="number_of_students" :number_of_teachers="number_of_teachers"
                :usage="usage"></calculator-form>
        </div>
        <div v-if="step===2">
            <calculator :number_of_students="number_of_students" :number_of_teachers="number_of_teachers"
                :usage="usage"></calculator>
        </div>
        <div v-if="step===3">
            <contact-form :number_of_students="number_of_students" :number_of_teachers="number_of_teachers"
                :usage="usage"></contact-form>
        </div>
        <p class="text-center text-gray-600 mt-4">Note: Estimated savings, actual sayings may vary.</p>
    </div>
</template>

<script>

import Alert from '../../components/partials/FormAlert'
import CalculatorForm from "./partials/CalculatorForm";
import Calculator from "./partials/CalculatorView";
import ContactForm from "./partials/GetInTouchView";
import {EventBus} from '../../calculator';

export default {
    components: {
        Alert,
        CalculatorForm,
        Calculator,
        ContactForm
    },
    name: "CalculatorPage",
    data() {
        return {
            alertVisible: false,
            alertType: '',
            alertMessage: '',
            step: 1,
            number_of_students: 0,
            number_of_teachers: 0,
            usage: '',
        }
    },
    created() {
        EventBus.$on('calculate', (data) => {
            this.number_of_teachers = parseInt(data.number_of_teachers)
            this.number_of_students = parseInt(data.number_of_students)
            this.usage = data.usage
            this.step = 2;
        })

        EventBus.$on('step_back', (data) => {
            this.number_of_teachers = parseInt(data.number_of_teachers)
            this.number_of_students = parseInt(data.number_of_students)
            this.usage = data.usage
            this.step--;
        })

        EventBus.$on('get_in_touch', (data) => {
            this.number_of_teachers = parseInt(data.number_of_teachers)
            this.number_of_students = parseInt(data.number_of_students)
            this.usage = data.usage
            this.step = 3;
        })

        EventBus.$on('form_error', (data) => {
            this.number_of_teachers = parseInt(data.number_of_teachers)
            this.number_of_students = parseInt(data.number_of_students)
            this.usage = data.usage
            this.alertVisible = true
            this.alertMessage = data.formMessage
            this.alertType = 'error'
        })


        EventBus.$on('form_success', (data) => {
            this.number_of_teachers = parseInt(data.number_of_teachers)
            this.number_of_students = parseInt(data.number_of_students)
            this.usage = data.usage
            this.alertVisible = true
            this.alertMessage = data.formMessage
            this.alertType = 'success'
            this.step = 1
        })

    }
}
</script>
