<template>
    <div class="p-6">
        <alert :message=formMessage :type=formMessageType :visible=alertVisible @alert-hide="hideAlert"></alert>

        <div v-if="step === 1">
            <h1 class="text-5xl text-blue-700 font-medium text-center border-b-2 border-black mb-4">Calculate Your Digital Savings</h1>
            <p class="text-2xl mb-4 text-center">Calculate how much you could save by upgrading to IQWST Interactive Digital Edition or increasing your current subscription term.</p>

            <div class="mb-3">
                <p class="mb-3 font-bold">1. Approximately how many students use IQWST in your classroom, school, or
                    district?</p>
                <input type="text" class="border px-2 py-2 border-gray-500 w-1/2 rounded outline-none focus:shadow-outline" name="number_of_students"
                    v-model="number_of_students">
            </div>


            <div class="mb-3">
                <p class="mb-3 font-bold">2. Approximately how many teachers use IQWST in your classroom, school, or district?</p>
                <input type="text" class="border px-2 py-2 border-gray-500 w-1/2 rounded outline-none focus:shadow-outline" name="number_of_teachers"
                    v-model="number_of_teachers">
            </div>
            <div class="mb-3">
                <p class="mb-3 font-bold">3. We currently use:</p>
                <div class="flex items-center mb-3">
                    <input type="radio"
                        name="reason"
                        id="usage_1"
                        value="IQWST Print Student Workbooks"
                        v-model="usage">

                    <label class="ml-2 text-grey-darker cursor-pointer" for="usage_1">IQWST Print Student Workbooks</label>
                </div>
                <div class="flex items-center">
                    <input type="radio"
                        name="reason"
                        id="usage_2"
                        value="IQWST Interactive Digital Edition"
                        v-model="usage">

                    <label class="ml-2 text-grey-darker cursor-pointer" for="usage_2">IQWST Interactive Digital Edition</label>
                </div>
            </div>


            <div class="mt-6">
                <button :disabled="number_of_students <= 0 && number_of_teachers <= 0" type="submit" @click="calculate" class="rounded py-2 px-3 bg-blue-500 hover:bg-blue-500 text-white cursor-auto" :class="{'cursor-pointer bg-blue-700': number_of_students > 0 && number_of_teachers > 0}">Calculate</button>
            </div>
        </div>
        <div v-if="step === 2">
            <h1 class="text-5xl text-blue-700 font-medium text-center border-b-2 border-black mb-4">Digital Savings Compared To Print</h1>
            <div class="grid mt-6">
                <div class="mx-2">&nbsp;</div>
                <div class="mx-2">&nbsp;</div>
                <div class="mx-2"><p class="font-bold bg-blue-700 text-white py-1 text-center">Best Savings</p></div>
                <div class="text-center p-4 border-2 border-gray-300 mx-2">
                    <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                    <p class="text-xl">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">1-Year</p>
                    <p class="text-xl">Subscription</p>
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ print_one_year_dollar_savings | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ print_one_year_percentage_savings | percent }}</p>
                    <p class="text-xl">each year</p>
                </div>
                <div class="text-center p-4 border-2 border-gray-300 mx-2">
                    <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                    <p class="text-xl">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">3-Year</p>
                    <p class="text-xl">Subscription</p>
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ print_three_year_dollar_savings | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ print_three_year_percentage_savings | percent}}</p>
                    <p class="text-xl">over 3 years</p>
                </div>
                <div class="text-center  border-2 border-blue-700 mx-2">
                    <div class="p-4">
                        <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                        <p class="text-xl">Interactive Digital Edition</p>
                        <p class="text-3xl font-bold">6-Year</p>
                        <p class="text-xl">Subscription</p>
                        <h3 class="text-2xl font-bold">You would save</h3>

                        <p class="text-3xl text-orange-500">{{ print_six_year_dollar_savings | currency }}</p>
                        <p class="text-xl">&ndash; or &ndash;</p>
                        <p class="text-3xl text-orange-500">{{ print_six_year_percentage_savings | percent }}</p>
                        <p class="text-xl">over 6 years</p>
                    </div>

                </div>
            </div>
            <div class="mt-6 flex justify-end items-center">
                <a href="http://activatelearning.com/request-product-info/" class="rounded py-2 px-3 bg-blue-700 hover:bg-blue-500 text-white mr-3">Contact Us</a>
                <a href="#" class="text-blue-700 hover:text-blue-500 font-bold" @click.prevent="step=1">Previous</a>
            </div>
        </div>

        <div v-if="step === 3">
            <h1 class="text-5xl text-blue-700 font-medium text-center border-b-2 border-black mb-4">Multi-Year Digital Savings</h1>
            <div class="grid mt-6">
                <div class="mx-2">&nbsp;</div>
                <div class="mx-2">&nbsp;</div>
                <div class="mx-2">
                    <p class="font-bold bg-blue-700 text-white py-1 text-center">Best Savings</p>
                </div>
                <div class="text-center p-4 border-2 border-gray-300 mx-2">
                    <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                    <p class="text-xl">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">1-Year</p>
                    <p class="text-xl">Subscription</p>
                    <p class="text-2xl">Current Subscription</p>
                </div>
                    <div class="text-center p-4 border-2 border-gray-300 mx-2">
                    <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                    <p class="text-xl">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">3-Year</p>
                    <p class="text-xl">Subscription</p>
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ digital_three_year_dollar_savings | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ digital_three_year_percentage_savings | percent}}</p>
                    <p class="text-xl">over 3 years</p>
                </div>
                <div class="text-center  border-2 border-blue-700 mx-2">
                    <div class="p-4">
                        <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                        <p class="text-xl">Interactive Digital Edition</p>
                        <p class="text-3xl font-bold">6-Year</p>
                        <p class="text-xl">Subscription</p>
                        <h3 class="text-2xl font-bold">You would save</h3>

                        <p class="text-3xl text-orange-500">{{ digital_six_year_dollar_savings | currency }}</p>
                        <p class="text-xl">&ndash; or &ndash;</p>
                        <p class="text-3xl text-orange-500">{{ digital_six_year_percentage_savings | percent }}</p>
                        <p class="text-xl">over 6 years</p>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end items-center">
                <a href="http://activatelearning.com/request-product-info/"
                    class="rounded py-2 px-3 bg-blue-700 hover:bg-blue-500 text-white mr-3">Contact Us</a> <a href="#"
                class="text-blue-700 hover:text-blue-500 font-bold" @click.prevent="step=1">Previous</a>
            </div>

        </div>
        <p class="text-center text-sm text-gray-600 mt-8">Estimated digital savings. Your actual savings may vary.</p>
    </div>
</template>

<script>
import Vue from 'vue'
import Alert from './partials/FormAlert.vue'
import Vue2Filters from 'vue2-filters'
import FormError from "./partials/FormError";

Vue.use(Vue2Filters)

export default {
    components: {
        Alert
    },
    name: "Calculator",
    data() {
        return {
            formMessage: '',
            formMessageType: 'success',
            alertVisible: false,
            step: 1,
            number_of_teachers: 0,
            number_of_students: 0,
            usage: "",
            print_one_year_dollar_savings: 0,
            print_one_year_percentage_savings: 0,
            print_three_year_dollar_savings: 0,
            print_three_year_percentage_savings: 0,
            print_six_year_dollar_savings: 0,
            print_six_year_percentage_savings: 0,
            digital_three_year_dollar_savings: 0,
            digital_three_year_percentage_savings: 0,
            digital_six_year_dollar_savings: 0,
            digital_six_year_percentage_savings: 0,
        }
    },
    methods: {
        hideAlert() {
            this.alertVisible = false;
        },
        calculate() {

            if(parseInt(this.number_of_teachers) > parseInt(this.number_of_students)) {
                this.formMessage = 'The number of teachers cannot be higher than the number of students.'
                this.formMessageType = 'error';
                this.alertVisible = true;
                return;
            }

            this.hideAlert();

            if(this.usage === "IQWST Print Student Workbooks")
                this.step = 2;

            if(this.usage === "IQWST Interactive Digital Edition")
                this.step = 3;

            this.print_one_year_dollar_savings = (this.number_of_students * 25.172)-((this.number_of_students * 15.35)+(this.number_of_teachers*80));

            this.print_one_year_percentage_savings = (this.print_one_year_dollar_savings / (this.number_of_students * 25.172));

            this.print_three_year_dollar_savings = (3* (this.number_of_students * 25.172)) - ((this.number_of_students * 41.99) + (this.number_of_teachers * (80 * 3)));

            this.print_three_year_percentage_savings = (this.print_three_year_dollar_savings / (3 * (this.number_of_students * 25.172)));

            this.print_six_year_dollar_savings = (6 * (this.number_of_students * 25.172)) - ((this.number_of_students * 68.50) + (this.number_of_teachers * (80 * 6)));

            this.print_six_year_percentage_savings = (this.print_six_year_dollar_savings / (6 * (this.number_of_students * 25.172)));

            this.digital_three_year_dollar_savings = ((3 * (this.number_of_students * 25.172)) - ((this.number_of_students * 41.99) + (this.number_of_teachers * (80 * 3)))) - (3 * this.print_one_year_dollar_savings);

            this.digital_three_year_percentage_savings = (this.digital_three_year_dollar_savings / (3 * (this.number_of_students * 25.172)));

            this.digital_six_year_dollar_savings = ((6 * (this.number_of_students * 25.172)) - ((this.number_of_students * 68.50) + (this.number_of_teachers * (80 * 6)))) - (6 * this.print_one_year_dollar_savings);

            this.digital_six_year_percentage_savings = (this.digital_six_year_dollar_savings / (6 * (this.number_of_students * 25.172)));
        }
    }
}
</script>

<style>
.grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
}
</style>