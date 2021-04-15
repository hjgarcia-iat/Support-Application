<template>
    <div>
        <div v-if="usage==='IQWST Print Student Workbooks'">
            <h1 class="text-4xl text-blue-brand font-medium border-b-2 border-black mb-4 pb-4">Digital Savings
                Compared To Print
            </h1>
            <div class="md:grid grid-cols-3 gap-x-4 mt-6">
                <div class="hidden md:block">&nbsp;</div>
                <div class="hidden md:block">&nbsp;</div>
                <div class="hidden md:block">
                    <p class="font-bold bg-blue-brand text-white py-1 text-center">Best Savings</p>
                </div>
                <div class="text-center p-4 border-2 border-gray-300 mb-6 md:mb-0">
                    <h2 class="text-4xl text-blue-brand font-medium">IQWST</h2>
                    <p class="text-xl text-gray-600 mb-3">with ONPAR</p>
                    <p class="text-xl mb-3 text-gray-600">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">1-Year</p>
                    <p class="text-xl">Subscription</p>
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ print_one_year_cost | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ print_one_year_savings | percent }}</p>
                    <p class="text-xl">next year</p>
                </div>
                <div class="text-center p-4 border-2 border-gray-300 mb-6 md:mb-0">
                    <h2 class="text-4xl text-blue-brand font-medium">IQWST</h2>
                    <p class="text-xl text-gray-600 mb-3">with ONPAR</p>
                    <p class="text-xl mb-3 text-gray-600">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">3-Year</p>
                    <p class="text-xl">Subscription</p>
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ print_three_year_cost | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ print_three_year_savings | percent }}</p>
                    <p class="text-xl">over 3 years</p>
                </div>
                <div class="text-center border-2 border-blue-brand">
                    <p class="font-bold bg-blue-brand text-white py-1 text-center block md:hidden">Best Savings</p>
                    <div class="p-4">
                        <h2 class="text-4xl text-blue-brand font-medium">IQWST</h2>
                        <p class="text-xl text-gray-600 mb-3">with ONPAR</p>
                        <p class="text-xl mb-3 text-gray-600">Interactive Digital Edition</p>
                        <p class="text-3xl font-bold">6-Year</p>
                        <p class="text-xl">Subscription</p>
                        <h3 class="text-2xl font-bold">You would save</h3>

                        <p class="text-3xl text-orange-500">{{ print_six_year_cost | currency }}</p>
                        <p class="text-xl">&ndash; or &ndash;</p>
                        <p class="text-3xl text-orange-500">{{ print_six_year_savings | percent }}</p>
                        <p class="text-xl">over 6 years</p>
                    </div>

                </div>
            </div>

        </div>

        <div v-if="usage==='IQWST Interactive Digital Edition'">
            <h1 class="text-5xl text-blue-brand font-medium border-b-2 border-black mb-4 pb-4">Multi-Year Digital
                Savings
            </h1>
            <div class="grid">
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>
                    <p class="font-bold bg-blue-brand text-white py-1 text-center">Best Savings</p>
                </div>
                <div class="text-center p-4 border-2 border-gray-300 mb-6 md:mb-0">
                    <h2 class="text-4xl text-blue-brand font-medium">IQWST</h2>
                    <p class="text-xl text-gray-600 mb-3">with ONPAR</p>
                    <p class="text-xl mb-3 text-gray-600">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">1-Year</p>
                    <p class="text-xl">Subscription</p>
                    <p class="text-2xl">Current Subscription</p>
                </div>
                <div class="text-center p-4 border-2 border-gray-300">
                    <h2 class="text-4xl text-blue-brand font-medium">IQWST</h2>
                    <p class="text-xl text-gray-600 mb-3">with ONPAR</p>
                    <p class="text-xl mb-3 text-gray-600">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">3-Year</p>
                    <p class="text-xl">Subscription</p>
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ digital_three_year_cost | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ digital_three_year_savings | percent }}</p>
                    <p>Compared to renewing a 1-yr subscription each of the 3 years</p>
                </div>
                <div class="text-center  border-2 border-blue-brand">
                    <div class="p-4">
                        <h2 class="text-4xl text-blue-brand font-medium">IQWST</h2>
                        <p class="text-xl text-gray-600 mb-3">with ONPAR</p>
                        <p class="text-xl mb-3 text-gray-600">Interactive Digital Edition</p>
                        <p class="text-3xl font-bold">6-Year</p>
                        <p class="text-xl">Subscription</p>
                        <h3 class="text-2xl font-bold">You would save</h3>

                        <p class="text-3xl text-orange-500">{{ digital_six_year_cost | currency }}</p>
                        <p class="text-xl">&ndash; or &ndash;</p>
                        <p class="text-3xl text-orange-500">{{ digital_six_year_savings | percent }}</p>
                        <p>Compared to renewing a 1-yr subscription each of the 6 years</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center">
            <a href="#"
                class="text-orange-500 hover:text-orange-600 hover:underline focus:outline-none focus:underline"
                @click.prevent="step_back">Previous</a>

            <a href=""
                class="ml-4 bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-center"
                @click.prevent="next_step">Learn More/Contact Rep</a>
        </div>

    </div>
</template>

<script>
import Vue2Filters from 'vue2-filters'
import Vue from "vue";

Vue.use(Vue2Filters)

export default {
    name: "CalculatorView",
    data() {
        return {
            workbook_cost: 22.48,
            shipping_rate: .12,
            ide_one_year_cost_per_student: 18.40,
            ide_one_year_cost_per_teacher: 80.00,
            ide_three_year_cost_per_student: 41.99,
            ide_three_year_cost_per_teacher: 210.00,
            ide_six_year_cost_per_student: 68.50,
            ide_six_year_cost_per_teacher: 360.00,
            print_one_year_cost: 0,
            print_one_year_savings: 0,
            print_three_year_cost: 0,
            print_three_year_savings: 0,
            print_six_year_cost: 0,
            print_six_year_savings: 0,
            digital_one_year_cost: 0,
            digital_one_year_savings: 0,
            digital_three_year_cost: 0,
            digital_three_year_savings: 0,
            digital_six_year_cost: 0,
            digital_six_year_savings: 0,
        }
    },

    computed: {
        product_interest() {
            return this.$store.state.product_interest
        },
        number_of_students() {
            return parseInt(this.$store.state.number_of_students)
        },
        number_of_teachers() {
            return parseInt(this.$store.state.number_of_teachers)
        },
        usage() {
            return this.$store.state.usage
        },
        step: {
            get() {
                return this.$store.state.step
            },
            set(value) {
                this.$store.commit('updateStep', value)
            }
        },
    },

    mounted() {
        this.calculate();
    },

    methods: {
        step_back() {
            this.step = 2
        },
        next_step(){
            this.step = 4
        },
        calculate() {
            //print calculations
            let workbook_total_cost = (this.number_of_students * this.workbook_cost);
            let workbook_yearly_cost = workbook_total_cost + (workbook_total_cost * this.shipping_rate)

            //print -> to digital one year savings calculations
            this.print_one_year_cost = (this.number_of_students * this.ide_one_year_cost_per_student) + (this.number_of_teachers * this.ide_one_year_cost_per_teacher)
            this.print_one_year_savings = (workbook_yearly_cost - this.print_one_year_cost) / workbook_yearly_cost
            //print -> to digital three year savings calculations
            this.print_three_year_cost = (this.number_of_students * this.ide_three_year_cost_per_student) + (this.number_of_teachers * this.ide_three_year_cost_per_teacher);
            this.print_three_year_savings = (((workbook_total_cost * 3) + (workbook_total_cost * this.shipping_rate)) - this.print_three_year_cost) / ((workbook_total_cost * 3) + (workbook_total_cost * this.shipping_rate));
            //print -> to digital six year savings calculations
            this.print_six_year_cost = (this.number_of_students * this.ide_six_year_cost_per_student) + (this.number_of_teachers * this.ide_six_year_cost_per_teacher);

            this.print_six_year_savings = (((workbook_total_cost * 6) + (workbook_total_cost * this.shipping_rate)) - this.print_six_year_cost) / ((workbook_total_cost * 6) + (workbook_total_cost * this.shipping_rate));

            //digital calculations
            //one year calculations
            this.digital_one_year_cost = (this.number_of_students * this.ide_one_year_cost_per_student) + (this.number_of_teachers * this.ide_one_year_cost_per_teacher);
            //three year calculations
            this.digital_three_year_cost = (this.number_of_students * this.ide_three_year_cost_per_student) + (this.number_of_teachers * this.ide_three_year_cost_per_teacher);
            this.digital_three_year_savings = ((this.digital_one_year_cost * 3) - this.digital_three_year_cost) / (this.digital_one_year_cost * 3);
            //six year calculations
            this.digital_six_year_cost = (this.number_of_students * this.ide_six_year_cost_per_student) + (this.number_of_teachers * this.ide_six_year_cost_per_teacher);
            this.digital_six_year_savings = ((this.digital_one_year_cost * 6) - this.digital_six_year_cost) / (this.digital_one_year_cost * 6);
        }
    },
}
</script>

<style scoped>
.grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 0 1em;
}
</style>
