<template>
    <div>
        <div v-if="usage==='IQWST Print Student Workbooks'">
            <h1 class="text-5xl text-blue-700 font-medium text-center border-b-2 border-black mb-4">Digital Savings
                Compared To Print
            </h1>
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
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ print_one_year_cost | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ print_one_year_savings | percent }}</p>
                    <p class="text-xl">each year</p>
                </div>
                <div class="text-center p-4 border-2 border-gray-300 mx-2">
                    <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                    <p class="text-xl">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">3-Year</p>
                    <p class="text-xl">Subscription</p>
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ print_three_year_cost | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ print_three_year_savings | percent }}</p>
                    <p class="text-xl">over 3 years</p>
                </div>
                <div class="text-center  border-2 border-blue-700 mx-2">
                    <div class="p-4">
                        <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                        <p class="text-xl">Interactive Digital Edition</p>
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
            <h1 class="text-5xl text-blue-700 font-medium text-center border-b-2 border-black mb-4">Multi-Year Digital
                Savings
            </h1>
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

                    <p class="text-3xl text-orange-500">{{ digital_three_year_cost | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ digital_three_year_savings | percent }}</p>
                    <p class="text-xl">over 3 years</p>
                </div>
                <div class="text-center  border-2 border-blue-700 mx-2">
                    <div class="p-4">
                        <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                        <p class="text-xl">Interactive Digital Edition</p>
                        <p class="text-3xl font-bold">6-Year</p>
                        <p class="text-xl">Subscription</p>
                        <h3 class="text-2xl font-bold">You would save</h3>

                        <p class="text-3xl text-orange-500">{{ digital_six_year_cost | currency }}</p>
                        <p class="text-xl">&ndash; or &ndash;</p>
                        <p class="text-3xl text-orange-500">{{ digital_six_year_savings | percent }}</p>
                        <p class="text-xl">over 6 years</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center">
            <a href=""
                class="rounded py-2 px-3 bg-blue-700 hover:bg-blue-500 text-white mr-3"
                @click.prevent="get_in_touch">Get in Touch</a> <a href="#"
            class="text-blue-700 hover:text-blue-500 font-bold"
            @click.prevent="step_back">Previous</a>
        </div>

    </div>
</template>

<script>
import Vue2Filters from 'vue2-filters'
import Vue from "vue";
import {EventBus} from '../../../calculator'

Vue.use(Vue2Filters)

export default {
    name: "CalculatorView",
    props: [
        'number_of_teachers',
        'number_of_students',
        'usage',
    ],
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

    mounted() {
        this.calculate();
    },

    methods: {
        step_back() {
            EventBus.$emit('step_back',{
                number_of_students: this.number_of_students,
                number_of_teachers: this.number_of_teachers,
                usage: this.usage,
            });
        },
        get_in_touch(){
            EventBus.$emit('get_in_touch', {
                number_of_students: this.number_of_students,
                number_of_teachers: this.number_of_teachers,
                usage: this.usage,
            });
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
}
</style>
