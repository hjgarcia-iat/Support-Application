<template>
    <div class="p-6">
        <alert :message=formMessage :type=formMessageType :visible=alertVisible @alert-hide="hideAlert"></alert>
        <div v-if="step === 1">
            <h1 class="text-5xl text-blue-700 font-medium text-center border-b-2 border-black mb-4">Calculate Your
                Digital Savings
            </h1>
            <p class="text-2xl mb-4 text-center">Calculate how much you could save by upgrading to IQWST Interactive
                Digital Edition or increasing your current subscription term.
            </p>

            <div class="mb-3">
                <p class="mb-3 font-bold">1. Approximately how many students use IQWST in your classroom, school, or
                    district?
                </p>
                <input type="text"
                    class="border px-2 py-2 border-gray-500 w-1/2 rounded outline-none focus:shadow-outline"
                    name="number_of_students"
                    v-model="number_of_students">
            </div>
            <div class="mb-3">
                <p class="mb-3 font-bold">2. Approximately how many teachers use IQWST in your classroom, school, or
                    district?
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

                    <label class="ml-2 text-grey-darker cursor-pointer" for="usage_1">IQWST Print Student
                        Workbooks</label>
                </div>
                <div class="flex items-center">
                    <input type="radio"
                        name="reason"
                        id="usage_2"
                        value="IQWST Interactive Digital Edition"
                        v-model="usage">

                    <label class="ml-2 text-grey-darker cursor-pointer" for="usage_2">IQWST Interactive Digital
                        Edition</label>
                </div>
            </div>

            <div class="mt-6">
                <button :disabled="number_of_students <= 0 && number_of_teachers <= 0" type="submit" @click="calculate"
                    class="rounded py-2 px-3 bg-blue-500 hover:bg-blue-500 text-white cursor-auto"
                    :class="{'cursor-pointer bg-blue-700': number_of_students > 0 && number_of_teachers > 0}">Calculate
                </button>
            </div>
        </div>
        <div v-if="step === 2">
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

                    <p class="text-3xl text-orange-500">{{ print_one_year_dollar_savings | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ print_one_year_percentage_savings | percent }}</p>
                    <p class="text-xl">each year</p>
                </div>
                <div class="text-center p-4 border-2 border-gray-300 mx-2">
                    <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                    <p class="text-xl">Interactive Digital Edition</p>
                    <p class="text-3xl font-bold">3-Year</p>
                    <p class="text-xl">Subscription</p>
                    <h3 class="text-2xl font-bold">You would save</h3>

                    <p class="text-3xl text-orange-500">{{ print_three_year_dollar_savings | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ print_three_year_percentage_savings | percent }}</p>
                    <p class="text-xl">over 3 years</p>
                </div>
                <div class="text-center  border-2 border-blue-700 mx-2">
                    <div class="p-4">
                        <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                        <p class="text-xl">Interactive Digital Edition</p>
                        <p class="text-3xl font-bold">6-Year</p>
                        <p class="text-xl">Subscription</p>
                        <h3 class="text-2xl font-bold">You would save</h3>

                        <p class="text-3xl text-orange-500">{{ print_six_year_dollar_savings | currency }}</p>
                        <p class="text-xl">&ndash; or &ndash;</p>
                        <p class="text-3xl text-orange-500">{{ print_six_year_percentage_savings | percent }}</p>
                        <p class="text-xl">over 6 years</p>
                    </div>

                </div>
            </div>
            <div class="mt-6 flex justify-end items-center">
                <a href=""
                    class="rounded py-2 px-3 bg-blue-700 hover:bg-blue-500 text-white mr-3" @click.prevent="step=4">Get
                    in Touch</a> <a href="#"
                class="text-blue-700 hover:text-blue-500 font-bold" @click.prevent="step=1">Previous</a>
            </div>
        </div>

        <div v-if="step === 3">
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

                    <p class="text-3xl text-orange-500">{{ digital_three_year_dollar_savings | currency }}</p>
                    <p class="text-xl">&ndash; or &ndash;</p>
                    <p class="text-3xl text-orange-500">{{ digital_three_year_percentage_savings | percent }}</p>
                    <p class="text-xl">over 3 years</p>
                </div>
                <div class="text-center  border-2 border-blue-700 mx-2">
                    <div class="p-4">
                        <h2 class="text-4xl text-blue-700 font-medium">IQWST</h2>
                        <p class="text-xl">Interactive Digital Edition</p>
                        <p class="text-3xl font-bold">6-Year</p>
                        <p class="text-xl">Subscription</p>
                        <h3 class="text-2xl font-bold">You would save</h3>

                        <p class="text-3xl text-orange-500">{{ digital_six_year_dollar_savings | currency }}</p>
                        <p class="text-xl">&ndash; or &ndash;</p>
                        <p class="text-3xl text-orange-500">{{ digital_six_year_percentage_savings | percent }}</p>
                        <p class="text-xl">over 6 years</p>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end items-center">
                <a href=""
                    class="rounded py-2 px-3 bg-blue-700 hover:bg-blue-500 text-white mr-3" @click.prevent="step=4">Get
                    in Touch</a> <a href="#"
                class="text-blue-700 hover:text-blue-500 font-bold" @click.prevent="step=1">Previous</a>
            </div>
        </div>

        <div v-if="step===4">
            <h1 class="text-5xl text-blue-700 font-medium text-center border-b-2 border-black mb-4">Get in Touch</h1>

            <form method="POST"
                @submit.prevent="submitForm">

                <div class="mb-6">
                    <label for="first_name" class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> First Name</label> <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="first_name" placeholder="Enter your first name"
                    name="first_name" v-model="first_name">
                    <form-error :error=formErrors.first_name[0] v-if="formErrors.first_name"></form-error>
                </div>

                <div class="mb-6">
                    <label for="last_name" class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> Last Name</label> <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="last_name" placeholder="Enter your last name"
                    name="last_name" v-model="last_name">
                    <form-error :error=formErrors.last_name[0] v-if="formErrors.last_name"></form-error>
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> Email</label> <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="email" placeholder="Enter your email"
                    name="email" v-model="email">
                    <form-error :error=formErrors.email[0] v-if="formErrors.email"></form-error>
                </div>

                <div class="mb-6">
                    <label for="phone" class="block text-grey-darker text-sm font-bold mb-2">Phone</label>

                    <input
                        type="text"
                        class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="phone" placeholder="Enter your phone"
                        name="phone" v-model="phone">
                    <form-error :error=formErrors.phone[0] v-if="formErrors.phone"></form-error>
                </div>

                <div class="mb-6">
                    <label for="role" class="block text-grey-darker text-sm font-bold mb-2"><small
                        class="text-lg text-red-600">*</small> Role</label>
                    <select name="role" v-model="role" id="role"
                        class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                        <option value="">Select a role</option>
                        <option value="Classroom Teacher">Classroom Teacher</option>
                        <option value="School Administrator">School Administrator</option>
                        <option value="Other">Other</option>
                    </select>
                    <form-error :error=formErrors.role[0] v-if="formErrors.role"></form-error>
                </div>

                <div class="mb-6">
                    <label for="district" class="block text-grey-darker text-sm font-bold mb-2">District</label>

                    <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="district" placeholder="Enter your district name"
                    name="district" v-model="district">
                    <form-error :error=formErrors.district[0] v-if="formErrors.district"></form-error>
                </div>

                <div class="mb-6">
                    <label for="school" class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> School</label> <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="school" placeholder="Enter your school name"
                    name="school" v-model="school">
                    <form-error :error=formErrors.school[0] v-if="formErrors.school"></form-error>
                </div>

                <div class="mb-6">
                    <label for="city" class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> City</label> <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="city" placeholder="Enter your city name"
                    name="city" v-model="city">
                    <form-error :error=formErrors.city[0] v-if="formErrors.city"></form-error>
                </div>

                <div class="mb-6">
                    <label for="state" class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> State</label>

                    <select name="state" v-model="state" id="state"
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

                    <form-error :error=formErrors.state[0] v-if="formErrors.state"></form-error>
                </div>


                <div class="mt-8 flex justify-end items-center">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 mr-2 focus:outline-none focus:shadow-outline"
                        :disabled="loading" :class="{'cursor-default bg-blue-light hover:bg-blue-light' : loading}">
                        <i class="fa fa-refresh fa-spin" v-if="loading"></i> Contact Us
                    </button>
                    <a href="#"
                        class="text-blue-700 hover:text-blue-500 font-bold"
                        @click.prevent="usage==='IQWST Print Student Workbooks' ? step=2: step=3">Previous</a>
                </div>
            </form>
        </div>

        <p class="text-center text-sm text-gray-600 mt-8">Estimated digital savings. Your actual savings may vary.</p>
    </div>
</template>

<script>
import Vue from 'vue'
import Alert from './partials/FormAlert.vue'
import Vue2Filters from 'vue2-filters'
import FormError from "./partials/FormError";

Vue.use(Vue2Filters)

export default {
    components: {
        Alert,
        FormError
    },
    name: "Calculator",
    data() {
        return {
            formMessage: '',
            formMessageType: 'success',
            alertVisible: false,
            formErrors: [],
            loading: false,
            step: 1,
            number_of_teachers: 0,
            number_of_students: 0,
            usage: "",
            print_one_year_dollar_savings: 0,
            print_one_year_percentage_savings: 0,
            print_three_year_dollar_savings: 0,
            print_three_year_percentage_savings: 0,
            print_six_year_dollar_savings: 0,
            print_six_year_percentage_savings: 0,
            digital_three_year_dollar_savings: 0,
            digital_three_year_percentage_savings: 0,
            digital_six_year_dollar_savings: 0,
            digital_six_year_percentage_savings: 0,
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
    methods: {
        hideAlert() {
            this.alertVisible = false;
        },
        calculate() {

            if (parseInt(this.number_of_teachers) > parseInt(this.number_of_students)) {
                this.formMessage = 'The number of teachers cannot be higher than the number of students.'
                this.formMessageType = 'error';
                this.alertVisible = true;
                return;
            }

            this.hideAlert();

            if (this.usage === "IQWST Print Student Workbooks")
                this.step = 2;

            if (this.usage === "IQWST Interactive Digital Edition")
                this.step = 3;

            this.print_one_year_dollar_savings = (this.number_of_students * 25.172) - ((this.number_of_students * 15.35) + (this.number_of_teachers * 80));

            this.print_one_year_percentage_savings = (this.print_one_year_dollar_savings / (this.number_of_students * 25.172));

            this.print_three_year_dollar_savings = (3 * (this.number_of_students * 25.172)) - ((this.number_of_students * 41.99) + (this.number_of_teachers * (80 * 3)));

            this.print_three_year_percentage_savings = (this.print_three_year_dollar_savings / (3 * (this.number_of_students * 25.172)));

            this.print_six_year_dollar_savings = (6 * (this.number_of_students * 25.172)) - ((this.number_of_students * 68.50) + (this.number_of_teachers * (80 * 6)));

            this.print_six_year_percentage_savings = (this.print_six_year_dollar_savings / (6 * (this.number_of_students * 25.172)));

            this.digital_three_year_dollar_savings = ((3 * (this.number_of_students * 25.172)) - ((this.number_of_students * 41.99) + (this.number_of_teachers * (80 * 3)))) - (3 * this.print_one_year_dollar_savings);

            this.digital_three_year_percentage_savings = (this.digital_three_year_dollar_savings / (3 * (this.number_of_students * 25.172)));

            this.digital_six_year_dollar_savings = ((6 * (this.number_of_students * 25.172)) - ((this.number_of_students * 68.50) + (this.number_of_teachers * (80 * 6)))) - (6 * this.print_one_year_dollar_savings);

            this.digital_six_year_percentage_savings = (this.digital_six_year_dollar_savings / (6 * (this.number_of_students * 25.172)));
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
                usage: this.usage
            }).then(response => {
                if (response.data.success) {
                    this.alertVisible = true;
                    this.reset();
                    this.formMessageType = 'success';
                    this.formMessage = response.data.message;
                }
                this.loading = false;
            }).catch(error => {
                this.alertVisible = true;
                this.formMessage = 'Please see errors below!';
                this.formErrors = error.response.data.errors;
                this.formMessageType = 'error';
                this.loading = false;
            });
        },
        reset() {
            this.step = 1;
            this.first_name = '';
            this.last_name = '';
            this.email = '';
            this.phone = '';
            this.role = '';
            this.city = '';
            this.school = '';
            this.district = '';
            this.state = '';
            this.formErrors = [];
            this.formMessage = '';
            this.number_of_teachers = 0;
            this.number_of_students = 0;
            this.usage = '';
            this.print_one_year_dollar_savings = 0;
            this.print_one_year_percentage_savings = 0;
            this.print_three_year_dollar_savings = 0;
            this.print_three_year_percentage_savings = 0;
            this.print_six_year_dollar_savings = 0;
            this.print_six_year_percentage_savings = 0;
            this.digital_one_year_dollar_savings = 0;
            this.digital_one_year_percentage_savings = 0;
            this.digital_three_year_dollar_savings = 0;
            this.digital_three_year_percentage_savings = 0;
            this.digital_six_year_dollar_savings = 0;
            this.digital_six_year_percentage_savings = 0;
        }
    }
}
</script>

<style>
.grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
}
</style>