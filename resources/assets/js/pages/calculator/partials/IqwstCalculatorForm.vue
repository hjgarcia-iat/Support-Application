<template>
    <div>
        <h1 class="text-4xl text-blue-brand font-medium border-b-2 border-black mb-4 pb-4">
            Calculate Your Digital Savings
        </h1>
        <p class="text-2xl mb-4">
            Calculate how much you could save by upgrading to IQWST Interactive Digital Edition (IDE) or increasing your
            current subscription terms.
        </p>

        <div class="mb-6">
            <form-label :required="true" field="number_of_students">
                1. Approximately how many students use IQWST in your classroom, school, or district?
            </form-label>

            <form-input v-model="number_of_students" field="number_of_students" type="text"
                    placeholder="Enter the number of students"/>
        </div>
        <div class="mb-6">

            <form-label :required="true" field="number_of_teachers">
                2. Approximately how many teachers use IQWST in your classroom, school, or district?
            </form-label>

            <form-input v-model="number_of_teachers" field="number_of_teachers" type="text"
                    placeholder="Enter the number of students"/>
        </div>
        <div class="mb-6">
            <form-label :required="true" field="usage">3. We currently use:</form-label>
            
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
                class="text-blue-500 hover:text-blue-600 hover:underline focus:outline-none focus:underline mr-2"
                @click.prevent="step_back">Previous</a>
                
            <button :disabled="number_of_students <= 0 && number_of_teachers <= 0"
                type="submit"
                @click="next_step"
                class="bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-center"
                :class="{'cursor-pointer bg-blue-brand': number_of_students > 0 && number_of_teachers > 0, 'bg-blue-brand-medium cursor-default': number_of_students <= 0 && number_of_teachers <= 0}">
                
                Calculate
            </button>
        </div>

    </div>
</template>

<script>
import FormLabel from "../../../components/forms/FormLabel";
import FormInput from "../../../components/forms/FormInput";

export default {
    name: "IqwstCalculatorForm",
    components: {
        FormLabel,
        FormInput,
    },
    computed: {
        product_interest() {
            return this.$store.state.product_interest
        },
        number_of_teachers: {
            get() {
                return this.$store.state.number_of_teachers
            },
            set(value) {
                this.$store.commit('updateNumberOfTeachers', value)
            }
        },
        number_of_students: {
            get() {
                return this.$store.state.number_of_students
            },
            set(value) {
                this.$store.commit('updateNumberOfStudents', value)
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
                this.step = 6
            }
        }
    }
}
</script>
