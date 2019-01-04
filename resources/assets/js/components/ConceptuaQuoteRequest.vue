<template>
    <div class="p-8">
        <loader :load=pre_load></loader>
        <form @submit.prevent="submit" v-if="pre_load === false">
            <h1 class="mb-6">Request a Demo</h1>
            <alert :message=formMessage :type=formMessageType></alert>

            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="first_name">
                    <span class="text-red">*</span>
                    First Name
                </label>
                <input v-model="first_name"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                       id="first_name" type="text" name="first_name"
                       placeholder="Enter First Name">
                
                <form-error :error=formErrors.first_name[0] v-if="formErrors.first_name"></form-error>
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="last_name">
                    <span class="text-red">*</span>
                    Last Name
                </label>
                <input v-model="last_name"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                       id="last_name" type="text" name="last_name"
                       placeholder="Enter Last Name">
            
                <form-error :error=formErrors.last_name[0] v-if="formErrors.last_name"></form-error>
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                    <span class="text-red">*</span>
                    Work Email
                </label>
                <input v-model="email"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                       id="email" type="text" name="email"
                       placeholder="Work Email Address">
            
                <form-error :error=formErrors.email[0] v-if="formErrors.email"></form-error>
            </div>

            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="phone">
                    Phone Number
                </label>
                <input v-model="phone"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                       id="phone" type="text" name="phone"
                       placeholder="Enter Phone Number">
            
                <form-error :error=formErrors.phone[0] v-if="formErrors.phone"></form-error>
            </div>

            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="title">
                    <span class="text-red">*</span>
                    Role
                </label>
                <select v-model="title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                        id="title" name="title">
                    <option value="">Choose One</option>
                    <option value="Classroom Teacher">Classroom Teacher</option>
                    <option value="Instructional Coach">Instructional Coach</option>
                    <option value="Administrator">Administrator</option>
                </select>
                
                <form-error :error=formErrors.title[0] v-if="formErrors.title"></form-error>
            </div>

            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="license">
                    <span class="text-red">*</span>
                    License Type
                </label>
                <select v-model="license"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                        id="license" name="license">
                    <option value="">Choose One</option>
                    <option value="Classroom">Classroom</option>
                    <option value="Campus">Campus</option>
                    <option value="Multi-Campus or District">Multi-Campus or District</option>
                </select>
                <form-error :error=formErrors.license[0] v-if="formErrors.license"></form-error>
            </div>

            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="company">
                    <span class="text-red">*</span>
                    School, District Or Organization Name
                </label>
                <input v-model="company"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                       id="company" type="text" name="company"
                       placeholder="Enter School, District Or Organization Name">
                <form-error :error=formErrors.company[0] v-if="formErrors.company"></form-error>
            </div>

            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="city">
                    <span class="text-red">*</span>
                    City
                </label>
                <input v-model="city"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                       id="city" type="text" name="city"
                       placeholder="Enter City">
                
                <form-error :error=formErrors.city[0] v-if="formErrors.city"></form-error>
            </div>

            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="state">
                    <span class="text-red">*</span>
                    State
                </label>
                <select name="state" id="state"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                        v-model="state">
                    <option value="" selected>Select a State</option>
                    <option value="Canada">Canada</option>
                    <option value="Other">Other</option>
                    <option value="AL">AL</option>
                    <option value="AK">AK</option>
                    <option value="AZ">AZ</option>
                    <option value="AR">AR</option>
                    <option value="CA">CA</option>
                    <option value="CO">CO</option>
                    <option value="CT">CT</option>
                    <option value="DE">DE</option>
                    <option value="DC">DC</option>
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
                </select>
                <form-error :error=formErrors.state[0] v-if="formErrors.state"></form-error>
            </div>

            <section class="flex">
                <button type="submit" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" :disabled="loading">
                    <i class="fa fa-refresh fa-spin" v-if="loading"></i>
                    Send Request
                </button>
            </section>
        </form>
    </div>
</template>

<script>
    import Loader from '../components/partials/Loader.vue'
    import Alert from '../components/partials/FormAlert.vue'
    import FormError from '../components/partials/FormError.vue'

    export default {
        components: {
            Loader,
            Alert,
            FormError
        },
        data() {
            return {
                "pre_load": false,
                first_name: '',
                last_name: '',
                email: '',
                company: '',
                title: '',
                license: '',
                city: '',
                state: '',
                phone: '',
                loading: false,
                formErrors: {},
                formMessage: '',
                formMessageType: 'success',
            }
        },
        methods: {
            formData() {
                return {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    company: this.company,
                    city: this.city,
                    state: this.state,
                    title: this.title,
                    license: this.license,
                    phone: this.phone,
                }
            },
            submit() {
                this.loading = true;

                axios.post('/conceptua-math/request-a-quote', this.formData())
                    .then(response => {
                        if (response.data.success) {
                            window.location = "http://www.conceptuamath.com/request-success";
                            return;
                        }

                        this.reset();
                        this.formMessageType = 'error';
                        this.formMessage = 'There was a system error. Please try again later.';
                        this.loading = false;
                    })
                    .catch(error => {
                        this.formErrors = error.response.data;
                        this.formMessageType = 'error';
                        this.formMessage = 'Please see errors below!';
                        this.loading = false;
                    });
            },
            reset() {
                this.first_name = '';
                this.last_name = '';
                this.email = '';
                this.company = '';
                this.title = '';
                this.license = '';
                this.city = '';
                this.state = '';
                this.phone = '';
            },
        },
        created() {
            this.pre_load = true;

            setTimeout(() => {
                this.pre_load = false;
            }, 300);
        }

    }
</script>
