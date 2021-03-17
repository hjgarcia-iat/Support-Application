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
                <button type="submit" @click="calculate" class="rounded py-2 px-3 bg-gray-400 bg-blue-700 hover:bg-blue-500 text-white">Calculate</button>
            </div>
        </div>
        <div v-if="step === 2">
            <div class="text-center">
                <h2>IQWST</h2>
                <p>Interactive Digital Edition</p>
                <p>1-Year Subscriptions</p>
                <h3>You would save</h3>

                <p>${{ one_year_dollar_savings }}</p>
                <p>&ndash; or &ndash;</p>
                <p>{{ one_year_percentage_savings }}%</p>
                <p>each year</p>
            </div>
            <div class="text-center">
                <h2>IQWST</h2>
                <p>Interactive Digital Edition</p>
                <p>1-Year Subscriptions</p>
                <h3>You would save</h3>

                <p>${{ three_year_dollar_savings }}</p>
                <p>&ndash; or &ndash;</p>
                <p>{{ three_year_percentage_savings }}%</p>
                <p>each year</p>
            </div>
            <div class="text-center">
                <h2>IQWST</h2>
                <p>Interactive Digital Edition</p>
                <p>1-Year Subscriptions</p>
                <h3>You would save</h3>

                <p>${{ six_year_dollar_savings }}</p>
                <p>&ndash; or &ndash;</p>
                <p>{{ six_year_percentage_savings }}%</p>
                <p>each year</p>
            </div>
            <button>Contact Us</button>
            <a href="" @click="step=1">Previous</a>
        </div>
    </div>
</template>

<script>
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

            this.one_year_percentage_savings = (this.one_year_dollar_savings/(this.number_of_students*25.172))*100;

            this.three_year_dollar_savings = (3* (this.number_of_students * 25.172)) - ((this.number_of_students * 41.99) + (this.number_of_teachers * (80 * 3)));

            this.three_year_percentage_savings = (this.three_year_dollar_savings / (3* (this.number_of_students * 25.172))) * 100;

            this.six_year_dollar_savings = (6 * (this.number_of_students * 25.172)) - ((this.number_of_students * 68.50) + (this.number_of_teachers * (80 * 6)));

            this.six_year_percentage_savings = (this.six_year_dollar_savings / (6 * (this.number_of_students * 25.172))) * 100;
        }
    }
}
</script>