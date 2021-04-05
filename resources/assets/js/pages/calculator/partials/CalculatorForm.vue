<template>
    <div>
        <h1 class="text-5xl text-blue-brand font-medium border-b-2 border-black mb-4 pb-4">
            Calculate Your Digital Savings
        </h1>
        <p class="text-2xl mb-4">
            Calculate how much you could save by upgrading to IQWST Interactive Digital Edition or increasing your
            current subscription term.
        </p>

        <div class="mb-6">
            <p class="mb-3 font-bold">
                1. Approximately how many students use IQWST in your classroom, school, or district?
            </p>
            <input type="text"
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                name="number_of_students"
                v-model="no_students">
        </div>
        <div class="mb-6">
            <p class="mb-3 font-bold">
                2. Approximately how many teachers use IQWST in your classroom, school, or district?
            </p>
            <input type="text"
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                name="number_of_teachers"
                v-model="no_teachers">
        </div>
        <div class="mb-6">
            <p class="mb-3 font-bold">3. We currently use:</p>
            <div class="flex items-center mb-3">
                <input type="radio"
                    name="reason"
                    id="usage_1"
                    value="IQWST Print Student Workbooks"
                    v-model="reason">

                <label class="ml-2 text-grey-darker cursor-pointer"
                    for="usage_1">IQWST Print Student Workbooks</label>
            </div>
            <div class="flex items-center">
                <input type="radio"
                    name="reason"
                    id="usage_2"
                    value="IQWST Interactive Digital Edition"
                    v-model="reason">

                <label class="ml-2 text-grey-darker cursor-pointer"
                    for="usage_2">IQWST Interactive Digital Edition</label>
            </div>
        </div>

        <div class="mt-6">
            <button :disabled="no_students <= 0 && no_teachers <= 0"
                type="submit"
                @click="calculate"
                class="bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-center"
                :class="{'cursor-pointer bg-blue-brand': no_students > 0 && no_teachers > 0, 'bg-blue-brand-medium cursor-default': no_students <= 0 && no_teachers <= 0}">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                Calculate
            </button>
        </div>

    </div>
</template>

<script>
import {EventBus} from '../../../calculator'

export default {
    name: "CalculatorForm",
    props: [
        'number_of_teachers',
        'number_of_students',
        'usage',
    ],
    data() {
        return {
            no_students: this.number_of_students,
            no_teachers: this.number_of_teachers,
            reason: this.usage
        }
    },
    methods: {
        calculate() {


            if (parseInt(this.no_teachers) >= parseInt(this.no_students)) {
                EventBus.$emit('form_error', {
                    number_of_students: this.no_students,
                    number_of_teachers: this.no_teachers,
                    usage: this.reason,
                    formMessage: 'Number of teachers cannot be higher or equal to the number of students.',
                })
            } else {
                EventBus.$emit('calculate', {
                    number_of_students: this.no_students,
                    number_of_teachers: this.no_teachers,
                    usage: this.reason,
                });
            }
        }
    }
}
</script>
