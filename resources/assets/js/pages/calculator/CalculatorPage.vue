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
            <iqwst-calculator-form/>
        </div>

        <div v-if="step===3">
            <active-chemistry-calculator-form/>
        </div>

        <div v-if="step===4">
            <active-physics-calculator-form/>
        </div>

        <div v-if="step===5">
            <earth-comm-calculator-form/>
        </div>

        <div v-if="step===6">
            <iqwst-calculator-view/>
        </div>

        <div v-if="step===7">
            <high-school-calculator-view/>
        </div>

        <div v-if="step===8">
            <contact-form></contact-form>
        </div>

        <div v-if="step===9">
            <success-view></success-view>
        </div>
        <p class="text-center text-gray-600 mt-6">Note: Estimated savings, actual savings may vary.</p>
    </div>
</template>

<script>

import Alert from '../../components/partials/FormAlert'
import IqwstCalculatorForm from "./partials/IqwstCalculatorForm";
import ActivePhysicsCalculatorForm from "./partials/ActivePhysicsCalculatorForm";
import ActiveChemistryCalculatorForm from "./partials/ActiveChemistryCalculatorForm";
import EarthCommCalculatorForm from "./partials/EarthCommCalculatorForm";
import IqwstCalculatorView from "./partials/IqwstCalculatorView";
import HighSchoolCalculatorView from "./partials/HighSchoolCalculatorView";
import ContactForm from "./partials/ContactForm";
import SuccessView from "./partials/SuccessView";
import ProductInterest from "./partials/ProductInterestView";

export default {
    components: {
        Alert,
        ProductInterest,
        IqwstCalculatorForm,
        ActivePhysicsCalculatorForm,
        ActiveChemistryCalculatorForm,
        EarthCommCalculatorForm,
        IqwstCalculatorView,
        HighSchoolCalculatorView,
        ContactForm,
        SuccessView
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
