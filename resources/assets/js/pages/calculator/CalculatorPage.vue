<template>
    <div class="p-6">
        <div v-if="step===1">
            <calculator-form :number_of_students="number_of_students" :number_of_teachers="number_of_teachers"
                :usage="usage"></calculator-form>
        </div>
        <div v-if="step===2">
            <calculator :number_of_students="number_of_students" :number_of_teachers="number_of_teachers"
                :usage="usage"></calculator>
        </div>
        <div v-if="step===3">
            <contact-form></contact-form>
        </div>
    </div>
</template>

<script>

import Alert from '../../components/partials/FormAlert'
import FormError from "../../components/partials/FormError";
import CalculatorForm from "./partials/CalculatorForm";
import Calculator from "./partials/CalculatorView";
import ContactForm from "./partials/GetInTouchView";
import {EventBus} from '../../calculator';

export default {
    components: {
        Alert,
        FormError,
        CalculatorForm,
        Calculator,
        ContactForm
    },
    name: "CalculatorPage",
    data() {
        return {
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

    }
}
</script>
