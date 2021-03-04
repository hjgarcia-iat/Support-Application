<template>
    <div class="p-8">
        <h1 class="mb-4 text-3xl uppercase leading-loose">Contact Us</h1>
        <form method="POST"
              @submit.prevent="submitForm">
            <alert :message=formMessage
                   :type=formMessageType
                   :visible=alertVisible
                   @alert-hide="hideAlert"></alert>
            <div class="mb-6">
                <label for="name"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Name</label>
                <input type="text"
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
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Email</label>
                <input type="text"
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
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Order Number or PO Number</label>
                <input type="text"
                       class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="district"
                       placeholder="Order Number or PO Number"
                       name="district"
                       v-model="district">

                <form-error :error=formErrors.district[0]
                            v-if="formErrors.district"></form-error>
            </div>
            <div class="mb-6">
                <label for="inquiry"
                       class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Please Choose Your Inquiry
                </label>

                <select name="inquiry"
                        id="inquiry"
                        class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                        v-model="inquiry">
                    <option value="">Make a selection...</option>
                    <option value="Order Modification">Order Modification</option>
                    <option value="Order Cancellation">Order Cancellation</option>
                    <option value="Shipping Status">Shipping Status</option>
                    <option value="Item Missing">Item Missing</option>
                    <option value="Item Damaged">Item Damaged</option>
                    <option value="Other">Other</option>
                </select>

                <form-error :error=formErrors.inquiry[0]
                            v-if="formErrors.inquiry"></form-error>
            </div>
            <div class="mb-6">
                <label for="comment"
                       class="block text-grey-darker text-sm font-bold mb-2">Comments</label>

                <textarea name="comment"
                          id="comment"
                          class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                          cols="30"
                          placeholder="Comments"
                          rows="5"
                          v-model="comment"></textarea>
                <form-error :error=formErrors.comment[0]
                            v-if="formErrors.comment"></form-error>
            </div>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                    :disabled="loading"
                    :class="{'cursor-default bg-blue-light hover:bg-blue-light' : loading}">
                <i class="fa fa-refresh fa-spin"
                   v-if="loading"></i>
                Send Request
            </button>
        </form>
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
            reason: '',
            name: '',
            email: '',
            district: '',
            subject: '',
            details: '',
            loading: false,
            formErrors: {},
            formMessage: '',
            formMessageType: 'success',
            alertVisible: true
        }
    },
    methods: {
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
            this.loading = false;
            this.formErrors = {};
            this.formMessage = '';
            this.formMessageType = 'success';
        },
        submitForm() {
            this.loading = true;

            axios.post('/contact-request', {
                'reason': this.reason,
                'name': this.name,
                'email': this.email,
                'district': this.district,
                'subject': this.subject,
                'details': this.details,
            }).then(response => {
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