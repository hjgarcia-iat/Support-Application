<template>
    <div>
        <h1
            class="text-4xl text-blue-brand font-medium border-b-2 border-black mb-4 pb-4"
        >
            Learn More
        </h1>

        <form method="POST" @submit.prevent="submitForm">
            <div class="mb-6">
                <form-label field="first_name" :required="true"
                    >First Name</form-label
                >
                <form-input
                    v-model="first_name"
                    field="first_name"
                    type="text"
                    placeholder="Enter your first name"
                />
                <form-error
                    :error="formErrors.first_name[0]"
                    v-if="formErrors.first_name"
                ></form-error>
            </div>

            <div class="mb-6">
                <form-label field="last_name" :required="true"
                    >Last Name</form-label
                >
                <form-input
                    v-model="last_name"
                    field="last_name"
                    type="text"
                    placeholder="Enter your last name"
                />
                <form-error
                    :error="formErrors.last_name[0]"
                    v-if="formErrors.last_name"
                ></form-error>
            </div>

            <div class="mb-6">
                <form-label field="email" :required="true">Email</form-label>
                <form-input
                    v-model="email"
                    field="email"
                    type="text"
                    placeholder="Enter your email"
                />
                <form-error
                    :error="formErrors.email[0]"
                    v-if="formErrors.email"
                ></form-error>
            </div>

            <div class="mb-6">
                <form-label field="phone" :required="false">Email</form-label>
                <form-input
                    v-model="phone"
                    field="phone"
                    type="text"
                    placeholder="Enter your phone"
                />
                <form-error
                    :error="formErrors.phone[0]"
                    v-if="formErrors.phone"
                ></form-error>
            </div>

            <div class="mb-6">
                <form-label field="role" :required="true">Role</form-label>

                <form-select field="role" v-model="role">
                    <option value="">Select a role</option>
                    <option value="Classroom Teacher">Classroom Teacher</option>
                    <option value="School Administrator"
                        >School Administrator</option
                    >
                    <option value="Other">Other</option>
                </form-select>

                <form-error
                    :error="formErrors.role[0]"
                    v-if="formErrors.role"
                ></form-error>
            </div>

            <div class="mb-6">
                <form-label field="district" :required="false"
                    >District</form-label
                >
                <form-input
                    v-model="district"
                    field="district"
                    type="text"
                    placeholder="Enter the district name"
                />
                <form-error
                    :error="formErrors.district[0]"
                    v-if="formErrors.district"
                ></form-error>
            </div>

            <div class="mb-6">
                <form-label field="school" :required="true">School</form-label>
                <form-input
                    v-model="school"
                    field="school"
                    type="text"
                    placeholder="Enter the school name"
                />
                <form-error
                    :error="formErrors.school[0]"
                    v-if="formErrors.school"
                ></form-error>
            </div>

            <div class="mb-6">
                <form-label field="city" :required="true">City</form-label>
                <form-input
                    v-model="city"
                    field="city"
                    type="text"
                    placeholder="Enter the city name"
                />
                <form-error
                    :error="formErrors.city[0]"
                    v-if="formErrors.city"
                ></form-error>
            </div>

            <div class="mb-6">
                <form-label field="state" :required="true">State</form-label>

                <form-select field="state" v-model="state">
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
                </form-select>

                <form-error
                    :error="formErrors.state[0]"
                    v-if="formErrors.state"
                ></form-error>
            </div>

            <div class="mt-8 flex items-center">
                <a
                    href="#"
                    class="text-blue-500 hover:text-blue-600 hover:underline focus:outline-none focus:underline mr-2"
                    @click.prevent="step_back"
                    >Previous</a
                >

                <form-button :is_working="loading">Send</form-button>
                
                <a
                    href="#"
                    class="ml-auto text-gray-700 hover:text-gray-600 hover:underline focus:outline-none focus:underline"
                    @click.prevent="reset_form"
                    >Reset</a
                >
            </div>
        </form>
    </div>
</template>

<script>
    import FormError from "../../../components/partials/FormError";
    import FormLabel from "../../../components/forms/FormLabel";
    import FormInput from "../../../components/forms/FormInput";
    import FormSelect from "../../../components/forms/FormSelect";
    import FormButton from "../../../components/forms/FormButton";

    export default {
        name: "ContactForm",
        components: {
            FormError,
            FormLabel,
            FormInput,
            FormSelect,
            FormButton,
        },
        data() {
            return {
                formErrors: [],
                loading: false,
                first_name: "",
                last_name: "",
                email: "",
                phone: "",
                role: "",
                school: "",
                district: "",
                city: "",
                state: "",
            };
        },
        computed: {
            product_interest() {
                return this.$store.state.product_interest;
            },
            number_of_students() {
                return parseInt(this.$store.state.number_of_students);
            },
            number_of_teachers() {
                return parseInt(this.$store.state.number_of_teachers);
            },
            usage() {
                return this.$store.state.usage;
            },
            step: {
                get() {
                    return this.$store.state.step;
                },
                set(value) {
                    this.$store.commit("updateStep", value);
                },
            },
        },
        methods: {
            step_back() {
                if (this.product_interest === "IQWST") {
                    this.step = 6;
                }

                if (this.product_interest === 'Active Physics') {
                    this.step = 7
                }
                
                if (this.product_interest === 'Active Chemistry') {
                    this.step = 7
                }
                
                if (this.product_interest === 'EarthComm') {
                    this.step = 7
                }
            },
            submitForm() {
                this.loading = true;

                axios
                    .post("/calculator", {
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
                        usage: this.usage,
                    })
                    .then((response) => {
                        if (response.data.success) {
                            this.reset();
                            this.step = 9;
                        }
                        this.loading = false;
                    })
                    .catch((error) => {
                        this.formErrors = error.response.data.errors;

                        this.$store.commit("showAlert");
                        this.$store.commit("setAlertType", "error");
                        this.$store.commit(
                            "setAlertMessage",
                            "Please see errors below."
                        );

                        this.loading = false;
                    });
            },
            reset() {
                this.first_name = "";
                this.last_name = "";
                this.email = "";
                this.phone = "";
                this.role = "";
                this.city = "";
                this.school = "";
                this.district = "";
                this.state = "";
                this.formErrors = [];

                this.$store.commit("reset");
            },
            reset_form() {
                this.reset();

                this.$store.commit("updateStep", 1);
                this.$store.commit("showAlert");
                this.$store.commit("setAlertType", "info");
                this.$store.commit(
                    "setAlertMessage",
                    "You have been set back to the beginning."
                );
            },
        },
    };
</script>
