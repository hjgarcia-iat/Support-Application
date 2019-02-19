<template>
    <div class="p-8">
        <h1 class="mb-4">Next GEN PET Fulfillment Support Form</h1>
        <p class="mb-4">If you have questions or issues regarding an existing order, please complete the form below.
            If you need assistance with placing a new order, please contact our Customer Service Group at <a
                    href="mailto:csr@activatelearning.com">csr@activatelearning.com</a>.
            All purchase orders should be submitted to <a href="mailto:orders@activatelearning.com">orders@activatelearning.com</a>.
        </p>
        <form method="POST" @submit.prevent="submitForm">
            <alert :message=formMessage :type=formMessageType :visible=alertVisible @alert-hide="hideAlert"></alert>
            <div class="mb-6">
                <label for="institution_name" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Institution Name</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="institution_name"
                        placeholder="Institution Name" name="institution_name" v-model="institution_name">
                <form-error :error=formErrors.institution_name[0] v-if="formErrors.institution_name"></form-error>
            </div>
            <div class="mb-6">
                <label for="name" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Name</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="name"
                        placeholder="Name" name="name" v-model="name">

                <form-error :error=formErrors.name[0] v-if="formErrors.name"></form-error>
            </div>
            <div class="mb-6">
                <label for="email" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Email</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="email"
                        placeholder="Email Address" name="email" v-model="email">

                <form-error :error=formErrors.email[0] v-if="formErrors.email"></form-error>
            </div>
            <div class="mb-6">
                <label for="po_number" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Order Number or PO Number</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="po_number"
                        placeholder="Order Number or PO Number" name="po_number" v-model="po_number">

                <form-error :error=formErrors.po_number[0] v-if="formErrors.po_number"></form-error>
            </div>
            <div class="mb-6">
                <label for="inquiry" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Please Choose Your Inquiry
                </label>

                <select name="inquiry" id="inquiry"
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

                <form-error :error=formErrors.inquiry[0] v-if="formErrors.inquiry"></form-error>
            </div>
            <div class="mb-6">
                <label for="comment" class="block text-grey-darker text-sm font-bold mb-2">Comments</label>

                <textarea name="comment" id="comment"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        cols="30"
                        placeholder="Comments" rows="5" v-model="comment"></textarea>
                <form-error :error=formErrors.comment[0] v-if="formErrors.comment"></form-error>
            </div>
            <button type="submit"
                    class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                    :disabled="loading" :class="{'cursor-default bg-blue-light hover:bg-blue-light' : loading}">
                <i class="fa fa-refresh fa-spin" v-if="loading"></i>
                Send Request
            </button>
        </form>
    </div>
</template>

<script>
    import Alert from '../components/partials/FormAlert.vue'
    import FormError from '../components/partials/FormError';

    export default {
        name: "NextGenPetRequest",
        components: {
            Alert,
            FormError
        },
        data() {
            return {
                institution_name: '',
                name: '',
                email: '',
                po_number: '',
                inquiry: '',
                comment: '',
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
                this.institution_name = '';
                this.name = '';
                this.email = '';
                this.po_number = '';
                this.inquiry = '';
                this.comment = '';
                this.loading = false;
                this.formErrors = {};
                this.formMessage = '';
                this.formMessageType = 'success';
            },
            submitForm() {
                this.loading = true;

                axios.post('/next-gen-pet-request', {
                    'institution_name': this.institution_name,
                    'name': this.name,
                    'email': this.email,
                    'po_number': this.po_number,
                    'inquiry': this.inquiry,
                    'comment': this.comment,
                }).then(response => {
                    this.resetData();
                    this.alertVisible = true;
                    this.formMessageType = 'success';
                    this.formMessage = response.data.message;
                    this.loading = false;
                }).catch(error => {
                    this.alertVisible = true;
                    this.formErrors = error.response.data;
                    this.formMessageType = 'error';
                    this.formMessage = 'Please see errors below!';
                    this.loading = false;
                });
            }

        }
    }
</script>