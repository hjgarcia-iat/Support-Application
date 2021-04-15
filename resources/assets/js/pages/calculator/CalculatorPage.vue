<template>
    <div class="p-8">
        <alert :message=alert_message
            :type=alert_type
            :visible=alert_show
            @alert-hide="$store.commit('hideAlert')"></alert>

        <div v-if="step===1">
            <product-interest></product-interest>
        </div>

        <div v-if="step===2">
            <calculator-form></calculator-form>
        </div>

        <div v-if="step===3">
            <calculator-view></calculator-view>
        </div>

        <div v-if="step===4">
            <contact-form></contact-form>
        </div>
        <div v-if="step===5">
            <success-view></success-view>
        </div>
        <p class="text-center text-gray-400 mt-6">Note: Estimated savings, actual sayings may vary.</p>
    </div>
</template>

<script>

import Alert from '../../components/partials/FormAlert'
import CalculatorForm from "./partials/CalculatorForm";
import CalculatorView from "./partials/CalculatorView";
import ContactForm from "./partials/ContactForm";
import SuccessView from "./partials/SuccessView";
import ProductInterest from "./partials/ProductInterestView";

export default {
    components: {
        Alert,
        ProductInterest,
        CalculatorForm,
        CalculatorView,
        ContactForm,
        SuccessView,
    },
    name: "CalculatorPage",
    data() {
        return {
            alertVisible: false,
            alertType: '',
            alertMessage: '',
        }
    },
    computed: {
        alert_message() {
            return this.$store.state.alert_message
        },
        alert_type() {
            return this.$store.state.alert_type
        },
        alert_show() {
            return this.$store.state.alert_show
        },
        step() {
            return this.$store.state.step
        }
    },
}
</script>
