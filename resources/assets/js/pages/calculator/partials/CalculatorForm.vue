<template>
    <div>
        <h1 class="text-5xl text-blue-700 font-medium text-center border-b-2 border-black mb-4 pb-4">
            Calculate Your <br>Digital Savings
        </h1>
        <p class="text-2xl mb-4 text-center">
            Calculate how much you could save by upgrading to IQWST Interactive Digital Edition or increasing your
            current subscription term.
        </p>

        <div class="mb-6">
            <p class="mb-3 font-bold">
                1. Approximately how many students use IQWST in your classroom, school, or district?
            </p>
            <input type="text"
                class="border px-2 py-2 border-gray-500 w-full  md:w-1/2 rounded outline-none focus:shadow-outline"
                name="number_of_students"
                v-model="no_students">
        </div>
        <div class="mb-6">
            <p class="mb-3 font-bold">
                2. Approximately how many teachers use IQWST in your classroom, school, or district?
            </p>
            <input type="text"
                class="border px-2 py-2 border-gray-500 w-full  md:w-1/2 rounded outline-none focus:shadow-outline"
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
                class="rounded py-2 px-3 bg-blue-500 hover:bg-blue-500 text-white cursor-auto"
                :class="{'cursor-pointer bg-blue-700': no_students > 0 && no_teachers > 0}">
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
