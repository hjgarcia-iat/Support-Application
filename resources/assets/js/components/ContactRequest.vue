<template>
    <div class="p-8">
        <div v-show="step === 1">
            <div class="flex mb-4 items-center justify-between">
                <h1 class="text-3xl uppercase leading-loose">Contact Us</h1>
                <h2 class="text-2xl uppercase text-gray-500">1 of 2</h2>
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2"> <small
                    class="text-lg text-red-600">*</small> Reason:</label>
                <div class="flex items-center">
                    <input type="radio"
                        name="reason"
                        id="reason_1"
                        value="Curriculum"
                        v-model="reason"> <label
                    class="ml-2 text-grey-darker text-sm mb-2"
                    for="reason_1"><strong>Curriculum Question</strong>
                    &mdash;
                    Questions about how our curriculum is to be used in the classroom. Can't find curriculum resources.</label>
                </div>
                <div class="flex items-center">
                    <input type="radio"
                        name="reason"
                        id="reason_2"
                        value="Feedback"
                        v-model="reason"> <label
                    class="ml-2 text-grey-darker text-sm mb-2"
                    for="reason_2"><strong>Feedback/Feature Request</strong>
                    &mdash;
                    Let us know your ideas for improving our products or provide feedback about our products.</label>
                </div>

                <div class="flex items-center">
                    <input type="radio"
                        name="reason"
                        id="reason_3"
                        value="Tech Issue"
                        v-model="reason"> <label
                    class="ml-2 text-grey-darker text-sm mb-2"
                    for="reason_3"><strong>Technical Problem</strong> &mdash;
                    Something is not working as it should. I this category too broad?</label>
                </div>

                <div class="flex items-center">
                    <input type="radio"
                        name="reason"
                        id="reason_4"
                        value="Login Issue"
                        v-model="reason"> <label
                    class="ml-2 text-grey-darker text-sm mb-2"
                    for="reason_4"><strong>Login Issue</strong> &mdash;
                    Login issues not related to any of our integrations.</label>
                </div>

                <form-error :error=formErrors.reason[0]
                    v-if="formErrors.reason"></form-error>
            </div>
            <button @click.prevent="next()"
                type="submit"
                :disabled="!disabled()"
                class="bg-blue-600 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                :class="{'cursor-default hover:bg-blue-600':!disabled(), 'hover:bg-blue-800': disabled()}">
                Next
            </button>
        </div>

        <div v-show="step === 2">
            <div class="flex mb-4 items-center justify-between">
                <h1 class="text-3xl uppercase leading-loose">Contact Us</h1>
                <h2 class="text-2xl uppercase text-gray-500">2 of 2</h2>
            </div>
            <form method="POST"
                enctype="multipart/form-data"
                @submit.prevent="submitForm">
                <alert :message=formMessage
                    :type=formMessageType
                    :visible=alertVisible
                    @alert-hide="hideAlert"></alert>
                <div class="mb-6">
                    <label for="name"
                        class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> Name</label> <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="name"
                    placeholder="Name"
                    name="name"
                    v-model="name">

                    <form-error :error=formErrors.name[0]
                        v-if="formErrors.name"></form-error>
                </div>
                <div class="mb-6">
                    <label for="email"
                        class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> Email</label> <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="email"
                    placeholder="Email Address"
                    name="email"
                    v-model="email">

                    <form-error :error=formErrors.email[0]
                        v-if="formErrors.email"></form-error>
                </div>
                <div class="mb-6">
                    <label for="district"
                        class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> School District</label> <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="district"
                    placeholder="School District"
                    name="district"
                    v-model="district">

                    <form-error :error=formErrors.district[0]
                        v-if="formErrors.district"></form-error>
                </div>
                <div class="mb-6">
                    <label for="subject"
                        class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> Subject</label> <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="subject"
                    placeholder="School District"
                    name="subject"
                    v-model="subject">

                    <form-error :error=formErrors.subject[0]
                        v-if="formErrors.subject"></form-error>
                </div>

                <div class="mb-6">
                    <label for="details"
                        class="block text-grey-darker text-sm font-bold mb-2">Details</label>

                    <textarea name="details"
                        id="details"
                        class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        cols="30"
                        placeholder="Details"
                        rows="5"
                        v-model="details"></textarea>
                    <form-error :error=formErrors.details[0]
                        v-if="formErrors.details"></form-error>
                </div>


                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2">File</label> <input type="file"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    name="file"
                    v-on:change="selectFile">
                    <div class="flex justify-between items-center text-gray-500"><span>Accepted file type: jpg, png, gif, doc, pdf</span>
                    </div>

                    <form-error :error=formErrors.file[0]
                        v-if="formErrors.file"></form-error>
                </div>


                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                    :disabled="loading"
                    :class="{'cursor-default bg-blue-600 hover:bg-blue-600' : loading}">
                    <i class="fa fa-refresh fa-spin"
                        v-if="loading"></i> Submit
                </button>
                <a @click.prevent="prev()"
                    type="submit"
                    v-if="isInvalid()"
                    class="text-blue-500 hover:text-blue-600 font-bold py-2 px-4 cursor-pointer"> Previous </a>
            </form>
        </div>
    </div>
</template>

<script>
import Alert from '../components/partials/FormAlert.vue'
import FormError from '../components/partials/FormError';

export default {
    name: "ContactRequest",
    components: {
        Alert,
        FormError
    },
    data() {
        return {
            step: 1,
            reason: '',
            name: '',
            email: '',
            district: '',
            subject: '',
            details: '',
            file: '',
            loading: false,
            formErrors: {},
            formMessage: '',
            formMessageType: 'success',
            alertVisible: true
        }
    },
    methods: {
        selectFile(e) {
            this.file = e.target.files[0];
        },
        isInvalid() {
            if (this.reason !== '' && this.name !== '' && this.email !== '' && this.district !== '' && this.subject !== '' && this.details !== '') {
                return false
            }

            return true;
        },
        disabled() {
            return this.reason !== "";
        },
        prev() {
            this.step--;
        },
        next() {
            this.step++;
        },
        hideAlert() {
            this.alertVisible = false;
        },
        resetData() {
            this.reason = '';
            this.name = '';
            this.email = '';
            this.district = '';
            this.subject = '';
            this.details = '';
            this.file = '';
            this.loading = false;
            this.formErrors = {};
            this.formMessage = '';
            this.formMessageType = 'success';
        },
        submitForm() {
            this.loading = true;


            let formData = new FormData();
            const config = {
                headers: {'content-type': 'multipart/form-data'}
            }

            formData.append('reason', this.reason);
            formData.append('name', this.name);
            formData.append('email', this.email);
            formData.append('district', this.district);
            formData.append('subject', this.subject);
            formData.append('details', this.details);
            formData.append('file', this.file);

            axios.post('/contact-request', formData, config).then(response => {
                this.resetData();
                this.alertVisible = true;
                this.formMessageType = 'success';
                this.formMessage = response.data.message;
                this.loading = false;
            }).catch(error => {
                this.alertVisible = true;
                this.formErrors = error.response.data.errors;
                this.formMessageType = 'error';
                this.formMessage = 'Please see errors below!';
                this.loading = false;
            });
        }

    }
}
</script>