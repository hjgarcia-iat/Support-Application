<template>
    <div class="p-6">
        <h1 class="text-5xl text-blue-700 font-medium text-center">Calculate your digital Savings</h1>
        <div v-if="step === 1" class="border-t-2 border-black py-4">

            <p class="text-2xl mb-4">Calculate how much you could save by switching your IQWST paper workbooks for IQWST Interactive Digital
                Edition.
            </p>

            <div class="mb-3">
                <p class="mb-3 font-bold">1. In your area, about how many students use IQWST?</p>
                <input type="text" class="border px-2 py-2 border-gray-500 w-1/2 rounded outline-none focus:shadow-outline" name="number_of_students"
                    v-model="number_of_students">
            </div>


            <div class="mb-3">
                <p class="mb-3 font-bold">2. In your area, about how many teachers use IQWST?</p>
                <input type="text" class="border px-2 py-2 border-gray-500 w-1/2 rounded outline-none focus:shadow-outline" name="number_of_teachers"
                    v-model="number_of_teachers">
            </div>

            <div class="mt-6">
                <button :disabled="number_of_students <= 0 && number_of_teachers <= 0" type="submit" @click="calculate" class="rounded py-2 px-3 bg-blue-500 hover:bg-blue-500 text-white cursor-auto" :class="{'cursor-pointer bg-blue-700': number_of_students > 0 && number_of_teachers > 0}">Calculate</button>
            </div>
        </div>
        <div v-if="step === 2">
            <div class="flex gap-3 mt-6">
                <div class="text-center p-4 border-2 border-gray-300">
                    <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                    <p class="text-xl">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">1-Year</p>
                    <p class="text-xl">Subscriptions</p>
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ one_year_dollar_savings | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ one_year_percentage_savings | percent }}</p>
                    <p class="text-xl">each year</p>
                </div>
                <div class="text-center p-4 border-2 border-gray-300">
                    <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                    <p class="text-xl">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">3-Year</p>
                    <p class="text-xl">Subscriptions</p>
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ three_year_dollar_savings | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ three_year_percentage_savings | percent}}</p>
                    <p class="text-xl">each year</p>
                </div>
                <div class="text-center  border-2 border-blue-700">
                    <p class="font-bold bg-blue-700 text-white py-1">Best Savings</p>
                    <div class="p-4">
                        <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                        <p class="text-xl">Interactive Digital Edition</p>
                        <p class="text-3xl font-bold">6-Year</p>
                        <p class="text-xl">Subscriptions</p>
                        <h3 class="text-2xl font-bold">You would save</h3>

                        <p class="text-3xl text-orange-500">{{ six_year_dollar_savings | currency }}</p>
                        <p class="text-xl">&ndash; or &ndash;</p>
                        <p class="text-3xl text-orange-500">{{ six_year_percentage_savings | percent }}</p>
                        <p class="text-xl">each year</p>
                    </div>

                </div>
            </div>
            <div class="mt-6 flex justify-end items-center">
                <a href="http://activatelearning.com/request-product-info/" class="rounded py-2 px-3 bg-blue-700 hover:bg-blue-500 text-white mr-3">Contact Us</a>
                <a href="#" class="text-blue-700 hover:text-blue-500 font-bold" @click.prevent="step=1">Previous</a>
            </div>

        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import Vue2Filters from 'vue2-filters'

Vue.use(Vue2Filters)

export default {
    name: "Calculator",
    data() {
        return {
            step: 1,
            number_of_teachers: 0,
            number_of_students: 0,
            one_year_dollar_savings: 0,
            one_year_percentage_savings: 0,
            three_year_dollar_savings: 0,
            three_year_percentage_savings: 0,
            six_year_dollar_savings: 0,
            six_year_percentage_savings: 0,
        }
    },
    methods: {
        calculate() {
            this.step = 2;

            this.one_year_dollar_savings = (this.number_of_students * 25.172)-((this.number_of_students * 15.35)+(this.number_of_teachers*80));

            this.one_year_percentage_savings = (this.one_year_dollar_savings / (this.number_of_students * 25.172));


            this.three_year_dollar_savings = (3* (this.number_of_students * 25.172)) - ((this.number_of_students * 41.99) + (this.number_of_teachers * (80 * 3)));

            this.three_year_percentage_savings = (this.three_year_dollar_savings / (3 * (this.number_of_students * 25.172)));

            this.six_year_dollar_savings = (6 * (this.number_of_students * 25.172)) - ((this.number_of_students * 68.50) + (this.number_of_teachers * (80 * 6)));

            this.six_year_percentage_savings = (this.six_year_dollar_savings / (6 * (this.number_of_students * 25.172)));
        }
    }
}
</script>