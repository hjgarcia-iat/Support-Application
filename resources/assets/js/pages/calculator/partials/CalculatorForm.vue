<template>
    <div>
        <h1 class="text-5xl text-blue-700 font-medium text-center border-b-2 border-black mb-4">
            Calculate Your Digital Savings
        </h1>
        <p class="text-2xl mb-4 text-center">
            Calculate how much you could save by upgrading to IQWST Interactive Digital Edition or increasing your
            current subscription term.
        </p>

        <div class="mb-3">
            <p class="mb-3 font-bold">
                1. Approximately how many students use IQWST in your classroom, school, or
                district?
            </p>
            <input type="text"
                   class="border px-2 py-2 border-gray-500 w-1/2 rounded outline-none focus:shadow-outline"
                   name="number_of_students"
                   v-model="number_of_students">
        </div>
        <div class="mb-3">
            <p class="mb-3 font-bold">
                2. Approximately how many teachers use IQWST in your classroom, school, or district?
            </p>
            <input type="text"
                   class="border px-2 py-2 border-gray-500 w-1/2 rounded outline-none focus:shadow-outline"
                   name="number_of_teachers"
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

                <label class="ml-2 text-grey-darker cursor-pointer"
                       for="usage_1">IQWST Print Student Workbooks</label>
            </div>
            <div class="flex items-center">
                <input type="radio"
                       name="reason"
                       id="usage_2"
                       value="IQWST Interactive Digital Edition"
                       v-model="usage">

                <label class="ml-2 text-grey-darker cursor-pointer"
                       for="usage_2">IQWST Interactive Digital Edition</label>
            </div>
        </div>

        <div class="mt-6">
            <button :disabled="number_of_students <= 0 && number_of_teachers <= 0"
                    type="submit"
                    @click="calculate"
                    class="rounded py-2 px-3 bg-blue-500 hover:bg-blue-500 text-white cursor-auto"
                    :class="{'cursor-pointer bg-blue-700': number_of_students > 0 && number_of_teachers > 0}">
                Calculate
            </button>
        </div>

    </div>
</template>

<script>
import { EventBus } from '../../../event-bus';

export default {
    name: "CalculatorForm",
    data() {
        return {
            number_of_students: 0,
            number_of_teachers: 0,
            usage: ''
        }
    },
    methods: {
        calculate() {
            EventBus.$emit('calculate', {
                number_of_students: this.number_of_students,
                number_of_teachers: this.number_of_teachers,
                usage: this.usage,
            });
        }
    }
}
</script>

<style scoped>

</style>