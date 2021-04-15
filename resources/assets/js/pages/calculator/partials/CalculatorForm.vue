<template>
    <div>
        <h1 class="text-4xl text-blue-brand font-medium border-b-2 border-black mb-4 pb-4">
            Calculate Your Digital Savings
        </h1>
        <p class="text-2xl mb-4">
            Calculate how much you could save by upgrading to IQWST Interactive Digital Edition or increasing your
            current subscription terms.
        </p>

        <div class="mb-6">
            <p class="mb-3 font-bold">
                1. Approximately how many students use IQWST in your classroom, school, or district?
            </p>
            <input type="text"
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                name="number_of_students"
                v-model="number_of_students">
        </div>
        <div class="mb-6">
            <p class="mb-3 font-bold">
                2. Approximately how many teachers use IQWST in your classroom, school, or district?
            </p>
            <input type="text"
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                name="number_of_teachers"
                v-model="number_of_teachers">
        </div>
        <div class="mb-6">
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

        <div class="mt-6 flex items-center">
            <a href="#"
                class="text-orange-500 hover:text-orange-600 hover:underline focus:outline-none focus:underline mr-2"
                @click.prevent="step_back">Previous</a>
            <button :disabled="number_of_students <= 0 && number_of_teachers <= 0"
                type="submit"
                @click="next_step"
                class="bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-center"
                :class="{'cursor-pointer bg-blue-brand': number_of_students > 0 && number_of_teachers > 0, 'bg-blue-brand-medium cursor-default': number_of_students <= 0 && number_of_teachers <= 0}">
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

export default {
    name: "CalculatorForm",
    computed: {
        product_interest() {
            return this.$store.state.product_interest
        },
        number_of_teachers: {
            get() {
                return parseInt(this.$store.state.number_of_teachers)
            },
            set(value) {
                this.$store.commit('updateNumberOfTeachers', parseInt(value))
            }
        },
        number_of_students: {
            get() {
                return parseInt(this.$store.state.number_of_students)
            },
            set(value) {
                this.$store.commit('updateNumberOfStudents', parseInt(value))
            }
        },
        usage: {
            get() {
                return this.$store.state.usage
            },
            set(value) {
                this.$store.commit('updateUsage', value)
            }
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
    methods: {
        step_back() {
            this.step = 1
        },
        next_step() {
            if (parseInt(this.number_of_teachers) >= parseInt(this.number_of_students)) {
                this.$store.commit('showAlert')
                this.$store.commit('setAlertType','info')
                this.$store.commit('setAlertMessage','The number of teachers cannot be equal or higher than then the number of students.')
            } else {
                this.step = 3
            }
        }
    }
}
</script>
