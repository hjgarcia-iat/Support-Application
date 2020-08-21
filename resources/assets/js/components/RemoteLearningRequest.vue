<template>
    <div class="p-8">
        <h1 class="mb-4 text-3xl uppercase leading-loose">Remote Learning Request</h1>

        <form @submit.prevent="submit">
            <alert :message=formMessage :type=formMessageType :visible=alertVisible @alert-hide="hideAlert"></alert>
            <div class="mb-6">
                <label for="name" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Name</label>
                <input type="text"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="name" placeholder="Enter name" name="name" v-model="name">

                <form-error :error=formErrors.name[0] v-if="formErrors.name"></form-error>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Email Address</label>
                <input type="text"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="email" placeholder="Enter Email Address" name="email" v-model="email">

                <form-error :error=formErrors.email[0] v-if="formErrors.email"></form-error>
            </div>

            <div class="mb-6">
                <label for="school" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    School Name</label>
                <input type="text"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="school" placeholder="Enter School Name" name="school" v-model="school">

                <form-error :error=formErrors.school[0] v-if="formErrors.school"></form-error>
            </div>

            <div class="mb-6">
                <label for="district" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    District Name</label>
                <input type="text"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="district" placeholder="Enter District Name" name="district" v-model="district">

                <form-error :error=formErrors.district[0] v-if="formErrors.district"></form-error>
            </div>

            <div class="mb-6">
                <label for="state" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    State</label>
                <select name="state" id="state" v-model="state"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
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
                </select>
                <form-error :error=formErrors.state[0] v-if="formErrors.state"></form-error>
            </div>

            <div class="mb-6">
                <label for="units" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Units</label>
                <select name="units" id="units" v-model="units"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                    <option value="LS1">LS1</option>
                    <option value="LS2">LS2</option>
                    <option value="LS3">LS3</option>
                    <option value="IC1">IC1</option>
                    <option value="IC2">IC2</option>
                    <option value="IC3">IC3</option>
                    <option value="ES1">ES1</option>
                    <option value="ES2">ES2</option>
                    <option value="ES3">ES3</option>
                    <option value="PS1">PS1</option>
                    <option value="PS2">PS2</option>
                    <option value="PS3">PS3</option>
                </select>
                <form-error :error=formErrors.units[0] v-if="formErrors.units"></form-error>
            </div>


            <button type="submit"
                class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                :disabled="loading" :class="{'cursor-default bg-blue-light hover:bg-blue-light' : loading}">
                <i class="fa fa-refresh fa-spin" v-if="loading"></i>
                Process Return
            </button>
        </form>
    </div>
</template>

<script>
import * as Vue from "vue"
import Alert from "../components/partials/FormAlert"
import FormError from "../components/partials/FormError"

export default {
    components: {
        Alert,
        FormError
    },
    data() {
        return {
            name: '',
            email: '',
            school: '',
            district: '',
            state: '',
            units: [],
            formErrors: [],
            formMessageType: 'success',
            formMessage: '',
            loading: false,
            alertVisible: true
        }
    },
    methods: {
        hideAlert() {
            this.alertVisible = false;
        },
        submit() {
            this.loading = true;
            axios.post('/remote-learning-request', {
                name: this.name,
                email: this.email,
                school: this.school,
                district: this.district,
                state: this.state,
                units: this.units,
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
            this.name = '';
            this.email = '';
            this.school = '';
            this.district = '';
            this.state = '';
            this.units = [];
            this.formErrors = [];
            this.formMessage = '';
        }
    }
}
</script>