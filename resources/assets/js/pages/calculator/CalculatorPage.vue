<template>
    <div class="p-6">
        <div v-if="step===1">
            <calculator-form></calculator-form>
        </div>
        <div v-if="step===2">
            <calculator></calculator>
        </div>
        <div v-if="step===3">
            <calculator></calculator>
        </div>
        <div v-if="step===4">
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
import {EventBus} from '../../event-bus';

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
            this.number_of_students = data.number_of_students
            this.number_of_teachers = data.number_of_teachers
            this.usage = data.usage
            this.step = 2;
        })
    }
}
</script>
