<template>
    <div class="p-8 bg-gray-100">

        <div class="border-l-4 p-4 mb-6 relative"
            :class="{'bg-green-200 border-green-800 text-green-800' : formMessageType==='success', 'bg-red-200 border-red-800 text-red-800' : formMessageType==='error'}"
            v-if="alertVisible"
            role="alert">

            {{ formMessage }}

            <a href="" @click.prevent="hide" class="no-underline absolute close-button"
                :class="{'text-green-dark' : formMessageType==='success', 'text-red-dark' : formMessageType==='error'}"> <i
                class="fa fa-remove"></i> </a>
        </div>


        <form method="POST"
            enctype="multipart/form-data"
            @submit.prevent="submitForm">

            <div v-show="step === 1">
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
                        for="reason_1"><strong>Curriculum Usage</strong>
                        &mdash; Questions about how our curriculum is to be used in the classroom or where to find
                        curriculum resources.</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio"
                            name="reason"
                            id="reason_2"
                            value="Errata"
                            v-model="reason"> <label
                        class="ml-2 text-grey-darker text-sm mb-2"
                        for="reason_2"><strong>Curriculum Error</strong>
                        &mdash; Curriculum issues such as typos, incorrect label, or factual correctness.</label>
                    </div>

                    <div class="flex items-center">
                        <input type="radio"
                            name="reason"
                            id="reason_3"
                            value="Integration"
                            v-model="reason"> <label
                        class="ml-2 text-grey-darker text-sm mb-2"
                        for="reason_3"><strong>Integration Issue</strong> &mdash; Rostering or login issues related to
                        integrations with Clever, Canvas, Schoology, Google Classroom, etc.</label>
                    </div>

                    <div class="flex items-center">
                        <input type="radio"
                            name="reason"
                            id="reason_4"
                            value="Operations"
                            v-model="reason"> <label
                        class="ml-2 text-grey-darker text-sm mb-2"
                        for="reason_4"><strong>Coupons, Specimens, Kits</strong> &mdash; Redeem coupons, report missing
                        or damaged materials.</label>
                    </div>

                    <div class="flex items-center">
                        <input type="radio"
                            name="reason"
                            id="reason_5"
                            value="Product"
                            v-model="reason"> <label
                        class="ml-2 text-grey-darker text-sm mb-2"
                        for="reason_5"><strong>Product Usage</strong> &mdash; Questions like how do I do this, Where do
                        I find that. But not about the curriculum.</label>
                    </div>

                    <div class="flex items-center">
                        <input type="radio"
                            name="reason"
                            id="reason_6"
                            value="Feedback"
                            v-model="reason"> <label
                        class="ml-2 text-grey-darker text-sm mb-2"
                        for="reason_6"><strong>Feedback/Feature Request</strong> &mdash;
                        Ideas for improving our products or providing feedback about our products and services.</label>
                    </div>

                    <div class="flex items-center">
                        <input type="radio"
                            name="reason"
                            id="reason_7"
                            value="Other Issue"
                            v-model="reason"> <label
                        class="ml-2 text-grey-darker text-sm mb-2"
                        for="reason_7"><strong>Other Issue</strong> &mdash; Something is not working as it should,
                        forgotten password, or other issue not listed above.</label>
                    </div>

                    <form-error :error=formErrors.reason[0]
                        v-if="formErrors.reason"></form-error>
                </div>

            </div>

            <div v-show="step === 2">
                <div class="mb-6">
                    <label for="name"
                        class="block text-grey-darker text-sm font-bold mb-2"> <small
                        class="text-lg text-red-600">*</small> Name</label> <input type="text"
                    class="appearance-none block w-full border border-gray-500 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-orange-500"
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
                    class="appearance-none block w-full border border-gray-500 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-orange-500"
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
                    class="appearance-none block w-full border border-gray-500 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-orange-500"
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
                    class="appearance-none block w-full border border-gray-500 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-orange-500"
                    id="subject"
                    placeholder="Subject"
                    name="subject"
                    v-model="subject">

                    <form-error :error=formErrors.subject[0]
                        v-if="formErrors.subject"></form-error>
                </div>

                <div class="mb-6">
                    <label for="details"
                        class="block text-grey-darker text-sm font-bold mb-2"><small
                        class="text-lg text-red-600">*</small> Details</label>

                    <textarea name="details"
                        id="details"
                        class="appearance-none block w-full border border-gray-500 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-orange-500"
                        cols="30"
                        placeholder="Details"
                        rows="5"
                        v-model="details"></textarea>
                    <form-error :error=formErrors.details[0]
                        v-if="formErrors.details"></form-error>
                </div>


                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2"
                        for="files">Files</label>
                    <vue-dropzone ref="dropzone"
                        @vdropzone-sending="sendingFiles"
                        @vdropzone-file-added="addedFile"
                        @vdropzone-complete="uploadComplete"
                        id="files"
                        v-model="files"
                        :options="dropzoneOptions"
                        :useCustomSlot="true">
                        <div class="dropzone-custom-content">
                            <h3 class="dropzone-custom-title">Drag and drop to upload content!</h3>
                            <div class="subtitle">...or click to select a file from your computer</div>
                        </div>
                    </vue-dropzone>

                    <div class="flex justify-between items-center text-gray-500"><span>Accepted file type: jpg, png, gif, doc, pdf</span>
                    </div>

                    <form-error :error=formErrors.file[0]
                        v-if="formErrors.file"></form-error>
                </div>
            </div>
            <div class="flex mb-4 items-center justify-between">
                <div v-if="step===1">
                    <button @click.prevent="step++"
                        type="submit"
                        :disabled="reason===''"
                        class="bg-blue-600 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                        :class="{'cursor-default hover:bg-blue-600': reason==='', 'hover:bg-blue-800': reason !== ''}">
                        Next Step
                    </button>
                </div>

                <div v-if="step===2">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                        :disabled="loading"
                        :class="{'cursor-default bg-blue-600 hover:bg-blue-600' : loading}">
                        <i class="fa fa-refresh fa-spin"
                            v-if="loading"></i> Submit
                    </button>
                    <a @click.prevent="step--"
                        type="submit"
                        class="text-blue-500 hover:text-blue-600 font-bold py-2 px-4 cursor-pointer"> Previous Step </a>
                </div>
                <p class="text-2xl uppercase text-gray-500">{{ step }} of 2</p>
            </div>
        </form>
    </div>
</template>

<script>
import Alert from '../components/partials/FormAlert.vue'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import FormError from '../components/partials/FormError';

export default {
    name: "ContactRequest",
    components: {
        Alert,
        FormError,
        vueDropzone: vue2Dropzone
    },
    data() {
        return {
            contact_created: false,
            files_uploaded: false,
            step: 1,
            id: '',
            reason: '',
            name: '',
            email: '',
            district: '',
            subject: '',
            details: '',
            files: [],
            loading: false,
            formErrors: {},
            formMessage: '',
            formMessageType: 'success',
            alertVisible: false,
            dropzoneOptions: {
                url: "/files",
                thumbnailWidth: 70,
                thumbnailHeight: 70,
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.pdf,.doc,.docx",
                addRemoveLinks: true,
                parallelUploads: 5,
                autoProcessQueue: false,
                headers: {
                    'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value,
                }
            }
        }
    },
    methods: {
        resetData() {
            this.contact_created = false;
            this.files_uploaded = false;
            this.id = '';
            this.step = 1;
            this.reason = '';
            this.name = '';
            this.email = '';
            this.district = '';
            this.subject = '';
            this.details = '';
            this.files = [];
            this.loading = false;
            this.formErrors = {};
            this.formMessage = '';
            this.formMessageType = 'success';
        },
        showSuccess(message) {
            this.resetData();
            this.formMessage = message;
            this.displayAlert('success');
        },
        showFormErrors(errors) {
            this.formErrors = errors;
            this.formMessage = 'Please see errors below!';
            this.displayAlert('error');
        },
        showError() {
            this.resetData();
            this.formMessage = 'There was an error please try again.';
            this.displayAlert('error');
        },
        displayAlert(alert_type) {
            this.alertVisible = true;
            this.formMessageType = alert_type;
            this.loading = false;
        },
        formData() {
            let formData = new FormData();
            formData.append('reason', this.reason);
            formData.append('name', this.name);
            formData.append('email', this.email);
            formData.append('district', this.district);
            formData.append('subject', this.subject);
            formData.append('details', this.details);

            return formData;
        },
        submitForm() {
            this.loading = true;

            axios.post('/contact-request', this.formData())
                .then(response => {
                    if (response.data.success === true) {
                        this.id = response.data.id;
                        this.uploadImages();
                        this.showSuccess('Thanks! One of our support agents will respond shortly.');
                    }
                }).catch(error => {
                if (error.response.status === 422) {
                    this.showFormErrors(error.response.data.errors);
                } else {
                    this.showError();
                }
            });
        },
        uploadImages() {
            if (this.files.length > 0) {
                this.$refs.dropzone.processQueue();
            }
        },
        //for dropzone
        sendingFiles(file, xhr, formData) {
            formData.append('id', this.id);
        },
        //for dropzone
        addedFile(file) {
            this.files.push(file);
        },
        //for dropzone
        uploadComplete(response) {
            this.$refs.dropzone.removeAllFiles();
        },
    }
}
</script>