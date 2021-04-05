<template>
    <div class="p-8">
        <alert :message=alertMessage
               :type=alertType
               :visible=alertVisible
               @alert-hide="alertVisible=false"></alert>

        <h1 class="mb-4 text-3xl uppercase leading-loose border-b border-gray-700">Request Product Information</h1>

        <form @submit.prevent="submit">
            <div class="mb-6">
                <label for="first_name"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    First Name</label>

                <input type="text"
                       class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="first_name"
                       placeholder="Enter first name"
                       name="first_name"
                       v-model="first_name">

                <form-error :error=formErrors.first_name[0]
                            v-if="formErrors.first_name"></form-error>
            </div>

            <div class="mb-6">
                <label for="last_name"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Last Name</label>

                <input type="text"
                       class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="last_name"
                       placeholder="Enter last name"
                       name="last_name"
                       v-model="last_name">

                <form-error :error=formErrors.last_name[0]
                            v-if="formErrors.last_name"></form-error>
            </div>

            <div class="mb-6">
                <label for="email"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Email Address</label>

                <input type="text"
                       class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="email"
                       placeholder="Enter email address"
                       name="email"
                       v-model="email">

                <form-error :error=formErrors.email[0]
                            v-if="formErrors.email"></form-error>
            </div>

            <div class="mb-6">
                <label for="phone"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    Phone Number</label>

                <input type="text"
                       class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="phone"
                       placeholder="Enter phone number"
                       name="phone"
                       v-model="phone">

                <form-error :error=formErrors.phone[0]
                            v-if="formErrors.phone"></form-error>
            </div>

            <div class="mb-6">
                <label for="role"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Role</label>

                <select name="role"
                        class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        v-model="role"
                        id="role">
                    <option value="">Select a role</option>
                    <option value="Classroom Teacher">Classroom Teacher</option>
                    <option value="Instructional Coach">Instructional Coach</option>
                    <option value="Administrator">Administrator</option>
                </select>

                <form-error :error=formErrors.role[0]
                            v-if="formErrors.role"></form-error>
            </div>

            <div class="mb-6">
                <label for="product_interest"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Product Interest</label>

                <select name="product_interest"
                        class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        v-model="product_interest"
                        id="product_interest">

                    <option value="">Select a product</option>
                    <optgroup label="K-8">
                        <option value="Activate Learning PRIME">Activate Learning PRIME</option>
                        <option value="IQWST (all editions)">IQWST (all editions)</option>
                        <option value="PBI Science">PBI Science</option>
                    </optgroup>

                    <optgroup label="Middle School Science">
                        <option value="IQWST (all editions)">IQWST (all editions)</option>
                        <option value="PBI Science">PBI Science</option>
                        <option value="OnPar">OnPar</option>
                    </optgroup>

                    <optgroup label="High School Science & Engineering">
                        <option value="Active Chemistry">Active Chemistry</option>
                        <option value="Active Physics">Active Physics</option>
                        <option value="Active Physical Science">Active Physical Science</option>
                        <option value="EarthCOMM">EarthCOMM</option>
                        <option value="Engineering the Future">Engineering the Future</option>
                    </optgroup>

                    <optgroup label="High School Math">
                        <option value="Interactive Mathematics Program">Interactive Mathematics Program</option>
                        <option value="Meaningful Math">Meaningful Math</option>
                    </optgroup>

                    <optgroup label="College Science">
                        <option value="Next Generation PET">Next Generation PET</option>
                    </optgroup>

                </select>

                <form-error :error=formErrors.product_interest[0]
                            v-if="formErrors.product_interest"></form-error>
            </div>

            <div class="mb-6">
                <label for="school"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    School Name</label>

                <input type="text"
                       class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="school"
                       placeholder="Enter school name"
                       name="school"
                       v-model="school">

                <form-error :error=formErrors.school[0]
                            v-if="formErrors.school"></form-error>
            </div>

            <div class="mb-6">
                <label for="district"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    District Name</label>

                <input type="text"
                       class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="district"
                       placeholder="Enter district name"
                       name="district"
                       v-model="district">

                <form-error :error=formErrors.district[0]
                            v-if="formErrors.district"></form-error>
            </div>

            <div class="mb-6">
                <label for="city"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    City
                </label>

                <input type="text"
                       class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="city"
                       placeholder="Enter city name"
                       name="city"
                       v-model="city">

                <form-error :error=formErrors.city[0]
                            v-if="formErrors.city"></form-error>
            </div>

            <div class="mb-6">
                <label for="state"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    State/Territory</label>

                <select name="state"
                        class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        v-model="state"
                        id="state">

                    <option value="">Select a state/territory</option>
                    <option value="AL">AL</option>
                    <option value="AK">AK</option>
                    <option value="AZ">AZ</option>
                    <option value="AR">AR</option>
                    <option value="CA">CA</option>
                    <option value="CO">CO</option>
                    <option value="CT">CT</option>
                    <option value="DE">DE</option>
                    <option value="FL">FL</option>
                    <option value="GA">GA</option>
                    <option value="HI">HI</option>
                    <option value="ID">ID</option>
                    <option value="IL">IL</option>
                    <option value="IN">IN</option>
                    <option value="IA">IA</option>
                    <option value="KS">KS</option>
                    <option value="KY">KY</option>
                    <option value="LA">LA</option>
                    <option value="ME">ME</option>
                    <option value="MD">MD</option>
                    <option value="MA">MA</option>
                    <option value="MI">MI</option>
                    <option value="MN">MN</option>
                    <option value="MS">MS</option>
                    <option value="MO">MO</option>
                    <option value="MT">MT</option>
                    <option value="NE">NE</option>
                    <option value="NV">NV</option>
                    <option value="NH">NH</option>
                    <option value="NJ">NJ</option>
                    <option value="NM">NM</option>
                    <option value="NY">NY</option>
                    <option value="NC">NC</option>
                    <option value="ND">ND</option>
                    <option value="OH">OH</option>
                    <option value="OK">OK</option>
                    <option value="OR">OR</option>
                    <option value="PA">PA</option>
                    <option value="RI">RI</option>
                    <option value="SC">SC</option>
                    <option value="SD">SD</option>
                    <option value="TN">TN</option>
                    <option value="TX">TX</option>
                    <option value="UT">UT</option>
                    <option value="VT">VT</option>
                    <option value="VA">VA</option>
                    <option value="WA">WA</option>
                    <option value="WV">WV</option>
                    <option value="WI">WI</option>
                    <option value="WY">WY</option>
                    <option value="DC">DC</option>
                    <option value="PR">PR</option>
                    <option value="VI">VI</option>
                    <option value="Canada">Canada</option>
                    <option value="Other Country">Other Country</option>

                </select>

                <form-error :error=formErrors.state[0]
                            v-if="formErrors.state"></form-error>
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                    :disabled="loading"
                    :class="{'cursor-default bg-blue-light hover:bg-blue-light' : loading}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block fill-current mr-2" v-if="!loading" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
                <svg version="1.1"
                     class="h-8 w-8 inline-block fill-current"
                     v-if="loading"
                     id="L9"
                     xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px"
                     y="0px"
                     viewBox="0 0 100 100"
                     enable-background="new 0 0 0 0"
                     xml:space="preserve">
                    <path fill="#fff"
                          d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                      <animateTransform
                          attributeName="transform"
                          attributeType="XML"
                          type="rotate"
                          dur="1s"
                          from="0 50 50"
                          to="360 50 50"
                          repeatCount="indefinite"/>
                  </path>
                </svg>
                Submit
            </button>
        </form>
    </div>
</template>

<script>
import Alert from "../../components/partials/FormAlert"
import FormError from "../../components/partials/FormError"


export default {
    name: "RequestProductInfoForm",
    components: {
        Alert,
        FormError
    },
    data() {
        return {
            loading: false,
            alertVisible: false,
            alertType: '',
            alertMessage: '',
            formErrors: {},
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            school: '',
            district: '',
            city: '',
            state: '',
            product_interest: '',
            role: '',
        }
    },
    methods: {
        submit() {
            {
                this.loading = true;
                axios.post('/request-product-information', {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    phone: this.phone,
                    role: this.role,
                    product_interest: this.product_interest,
                    school: this.school,
                    district: this.district,
                    city: this.city,
                    state: this.state,
                }).then(response => {
                    if (response.data.success) {
                        this.alertVisible = true

                        this.alertType = 'success'
                        this.alertMessage = response.data.message
                        this.reset();
                    }

                    this.loading = false;
                }).catch(error => {
                    this.alertVisible = true
                    this.alertMessage = 'Please see errors below!'
                    this.formErrors = error.response.data.errors
                    this.alertType = 'error'
                    this.loading = false;
                });

            }
        },
        reset() {
            this.loading = false
            this.formErrors = {}
            this.first_name = ''
            this.last_name = ''
            this.email = ''
            this.phone = ''
            this.school = ''
            this.district = ''
            this.city = ''
            this.state = ''
            this.product_interest = ''
            this.role = ''
        }
    }
}
</script>