<template>
    <div>

        <h1 class="text-4xl text-blue-brand font-medium border-b-2 border-black mb-4 pb-4">Learn More/Contact Rep</h1>

        <form method="POST"
            @submit.prevent="submitForm">

            <div class="mb-6">
                <label for="first_name"
                    class="block text-grey-darker text-sm font-bold mb-2"> <small
                    class="text-lg text-red-600">*</small> First Name</label> <input type="text"
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="first_name"
                placeholder="Enter your first name"
                name="first_name"
                v-model="first_name">
                <form-error :error=formErrors.first_name[0]
                    v-if="formErrors.first_name"></form-error>
            </div>

            <div class="mb-6">
                <label for="last_name"
                    class="block text-grey-darker text-sm font-bold mb-2"> <small
                    class="text-lg text-red-600">*</small> Last Name</label> <input type="text"
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="last_name"
                placeholder="Enter your last name"
                name="last_name"
                v-model="last_name">
                <form-error :error=formErrors.last_name[0]
                    v-if="formErrors.last_name"></form-error>
            </div>

            <div class="mb-6">
                <label for="email"
                    class="block text-grey-darker text-sm font-bold mb-2"> <small
                    class="text-lg text-red-600">*</small> Email</label> <input type="text"
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="email"
                placeholder="Enter your email"
                name="email"
                v-model="email">
                <form-error :error=formErrors.email[0]
                    v-if="formErrors.email"></form-error>
            </div>

            <div class="mb-6">
                <label for="phone"
                    class="block text-grey-darker text-sm font-bold mb-2">Phone</label>

                <input
                    type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="phone"
                    placeholder="Enter your phone"
                    name="phone"
                    v-model="phone">
                <form-error :error=formErrors.phone[0]
                    v-if="formErrors.phone"></form-error>
            </div>

            <div class="mb-6">
                <label for="role"
                    class="block text-grey-darker text-sm font-bold mb-2"><small
                    class="text-lg text-red-600">*</small> Role</label> <select name="role"
                v-model="role"
                id="role"
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                <option value="">Select a role</option>
                <option value="Classroom Teacher">Classroom Teacher</option>
                <option value="School Administrator">School Administrator</option>
                <option value="Other">Other</option>
            </select>
                <form-error :error=formErrors.role[0]
                    v-if="formErrors.role"></form-error>
            </div>

            <div class="mb-6">
                <label for="district"
                    class="block text-grey-darker text-sm font-bold mb-2">District</label>

                <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="district"
                    placeholder="Enter your district name"
                    name="district"
                    v-model="district">
                <form-error :error=formErrors.district[0]
                    v-if="formErrors.district"></form-error>
            </div>

            <div class="mb-6">
                <label for="school"
                    class="block text-grey-darker text-sm font-bold mb-2"> <small
                    class="text-lg text-red-600">*</small> School</label> <input type="text"
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="school"
                placeholder="Enter your school name"
                name="school"
                v-model="school">
                <form-error :error=formErrors.school[0]
                    v-if="formErrors.school"></form-error>
            </div>

            <div class="mb-6">
                <label for="city"
                    class="block text-grey-darker text-sm font-bold mb-2"> <small
                    class="text-lg text-red-600">*</small> City</label> <input type="text"
                class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="city"
                placeholder="Enter your city name"
                name="city"
                v-model="city">
                <form-error :error=formErrors.city[0]
                    v-if="formErrors.city"></form-error>
            </div>

            <div class="mb-6">
                <label for="state"
                    class="block text-grey-darker text-sm font-bold mb-2"> <small
                    class="text-lg text-red-600">*</small> State</label>

                <select name="state"
                    v-model="state"
                    id="state"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                    <option value="">Select a state</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                    <option value="Other">Other</option>
                </select>

                <form-error :error=formErrors.state[0]
                    v-if="formErrors.state"></form-error>
            </div>


            <div class="mt-8 flex items-center">
                <a href="#"
                    class="text-orange-500 hover:text-orange-600 hover:underline focus:outline-none focus:underline"
                    @click.prevent="step_back">Previous</a>
                <button type="submit"
                    class="bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-center ml-4"
                    :disabled="loading"
                    :class="{'cursor-default bg-blue-brand-medium hover:bg-blue-brand-medium' : loading}">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" v-if="!loading">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <svg class="animate-spin mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" v-if="loading">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Send
                </button>
                <a href=""
                    class="ml-auto text-gray-700 hover:text-gray-600 hover:underline focus:outline-none focus:underline"
                    @click.prevent="reset_form">Reset</a>
            </div>
        </form>
    </div>
</template>

<script>

import FormError from "../../../components/partials/FormError";
import {EventBus} from "../../../calculator";

export default {
    name: "ContactForm",
    components: {
        FormError
    },
    data() {
        return {
            formErrors: [],
            loading: false,
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            role: '',
            school: '',
            district: '',
            city: '',
            state: '',
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
    methods: {
        step_back() {
            this.step = 3
        },
        reset_form() {
            this.reset();
        },
        submitForm() {
            this.loading = true;

            axios.post('/calculator', {
                first_name: this.first_name,
                last_name: this.last_name,
                email: this.email,
                phone: this.phone,
                role: this.role,
                city: this.city,
                school: this.school,
                district: this.district,
                state: this.state,
                number_of_teachers: this.number_of_teachers,
                number_of_students: this.number_of_students,
                product_interest: this.product_interest,
                usage: this.usage
            }).then(response => {
                if (response.data.success) {
                    this.reset();
                    this.step = 5
                }
                this.loading = false;
            }).catch(error => {
                this.formErrors = error.response.data.errors;

                EventBus.$emit('form_error', {
                    formMessage: 'Please see errors below!',
                })

                this.loading = false;
            });
        },
        reset() {

            this.first_name = '';
            this.last_name = '';
            this.email = '';
            this.phone = '';
            this.role = '';
            this.city = '';
            this.school = '';
            this.district = '';
            this.state = ''
            this.formErrors = [];

            this.$store.commit('reset')
        }
    }
}
</script>
