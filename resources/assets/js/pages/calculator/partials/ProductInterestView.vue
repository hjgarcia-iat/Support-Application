<template>
    <div>

        <h1 class="text-4xl text-blue-brand font-medium border-b-2 border-black mb-4 pb-4">
            Calculate Your Digital Savings
        </h1>

        <div class="mb-6">
            <form-label field="product_interest" :required="true">Select a product</form-label>
            <select
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                name="number_of_students"
                v-model="product_interest">
                <option value="">Product...</option>
                <option value="IQWST">IQWST</option>
                <option value="Active Chemistry">Active Chemistry</option>
                <option value="Active Physics">Active Physics</option>
                <option value="EarthComm">EarthComm</option>
            </select>
        </div>
        <div class="mt-6 flex items-center">
            <button :disabled="product_interest === ''"
                type="submit"
                @click="nextStep"
                class="bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-center"
                :class="{'cursor-pointer bg-blue-brand': product_interest !== '', 'bg-blue-brand-medium cursor-default': product_interest === ''}">

                Next Step
                <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </button>
        </div>
    </div>

</template>

<script>
import FormLabel from "../../../components/forms/FormLabel";
import FormSelect from "../../../components/forms/FormSelect";

export default {
    name: "ProductInterestView",
    components: {
        FormLabel,
        FormSelect,
    },
    computed: {
        product_interest: {
            get() {
                return this.$store.state.product_interest
            },
            set(value) {
                this.$store.commit('updateProductInterest', value)
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
        nextStep() {

            if(this.product_interest === 'IQWST') {
                this.step = 2
            }

            if (this.product_interest === 'Active Chemistry') {
                this.step = 3
            }

            if (this.product_interest === 'Active Physics') {
                this.step = 4
            }

            if (this.product_interest === 'EarthComm') {
                this.step = 5
            }
        }
    }
}
</script>

<style scoped>

</style>