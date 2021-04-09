<template>
    <div class="p-8">
        <alert :message=formMessage :type=formMessageType :visible=alertVisible
            @alert-hide="alertVisible=false"></alert>

        <h1 class="text-4xl text-blue-brand font-medium border-b-2 border-black mb-4 pb-4">Return Request</h1>
        <p class="mb-4">The district or school will be responsible for shipment of returned items. All returns are
            subject
            to approval to ensure items have not be used, stamped or damaged and are in saleable condition. A credit
            memo will be issued for the approved returned items along with a restocking fee of 20%. If you have
            questions
            regarding your return please contact our Customer Service Group at
            <a href="mailto:csr@activatelearning.com" class="text-orange-500 hover:text-orange-600 hover:underline focus:outline-none focus:underline">csr@activatelearning.com</a>.
        </p>
        <form @submit.prevent="submit">
            <h2 class="text-3xl text-blue-brand font-medium mb-4">General Information</h2>
            <div class="mb-6">
                <label for="name" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Name</label>
                <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 focus:outline-none focus:bg-white"
                    id="name" placeholder="Enter name" name="name" v-model="name">

                <form-error :error=formErrors.name[0] v-if="formErrors.name"></form-error>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Email Address</label>
                <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 focus:outline-none focus:bg-white"
                    id="email" placeholder="Enter Email Address" name="email" v-model="email">

                <form-error :error=formErrors.email[0] v-if="formErrors.email"></form-error>
            </div>

            <div class="mb-6">
                <label for="district" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    District Name</label>
                <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 focus:outline-none focus:bg-white"
                    id="district" placeholder="Enter District Name" name="district" v-model="district">

                <form-error :error=formErrors.district[0] v-if="formErrors.district"></form-error>
            </div>

            <div class="mb-6">
                <label for="order_number" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Order Number or PO Number</label>
                <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 focus:outline-none focus:bg-white"
                    id="order_number" placeholder="Order Number or PO Number" name="order_number"
                    v-model="order_number">

                <form-error :error=formErrors.order_number[0] v-if="formErrors.order_number"></form-error>
            </div>

            <div class="mb-6">
                <label for="rma_number" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    RMA Number</label>
                <input type="text"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 focus:outline-none focus:bg-white"
                    id="rma_number" placeholder="RMA Number" name="rma_number" v-model="rma_number">

                <form-error :error=formErrors.rma_number[0] v-if="formErrors.rma_number"></form-error>
            </div>

            <div class="mb-6">
                <label for="reason" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red-600">*</small>
                    Reason for Return:</label>
                <select name="reason" id="reason" v-model="reason"
                    class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 focus:outline-none focus:bg-white">
                    <option value="">Select a Reason for Return</option>
                    <option value="Overstock">Overstock</option>
                    <option value="Ordered in error">Ordered in error</option>
                    <option value="Never implemented program">Never implemented program</option>
                    <option value="Incorrect items received">Incorrect items received</option>
                </select>
                <form-error :error=formErrors.reason[0] v-if="formErrors.reason"></form-error>
            </div>

            <div class="flex items-center mb-4">
                <h2 class="text-3xl text-blue-brand font-medium mb-4 mr-auto">Products to Return</h2>

                <button @click.prevent="addProduct"
                    class="bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-center">
                    <small class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Product
                    </small>
                </button>
            </div>


            <section class="mb-5">
                <div class="grid grid-cols-9 gap-x-2 mb-2">
                    <div class="col-span-1"></div>
                    <div class="col-span-4">SKU</div>
                    <div class="col-span-4">Quantity</div>
                </div>

                <div class="grid grid-cols-9 mb-3 gap-x-2" v-for="(product, key, index) in products">
                    <div class="col-span-1 h-full">
                        <div class="flex justify-center items-center h-full">
                            <a href="" @click.prevent="removeProduct(key)"
                                class="bg-red-300 text-center hover:text-red-800 text-red-600 font-bold py-2 px-3 focus:outline-none focus:text-red-800 focus:ring focus:ring-red-400 focus:ring-opacity-50 inline-block">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="col-span-4 flex flex-col">
                        <input type="text"
                            class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 focus:outline-none focus:bg-white"
                            :id="'sku_' + index" placeholder="Enter SKU" name="products[]['name']"
                            v-model="product.sku">
                        <form-error :error="getErrorForArray(key, 'sku')"
                            v-if="checkForArrayError('products.' + key + '.sku')"></form-error>

                    </div>
                    <div class="col-span-4 flex flex-col">
                        <input type="text"
                            class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 focus:outline-none focus:bg-white"
                            :id="'quantity_'+index" placeholder="Enter Quantity" name="products[]['school']"
                            v-model="product.quantity">

                        <form-error :error="getErrorForArray(key,'quantity')"
                            v-if="checkForArrayError('products.' + key + '.quantity')"></form-error>
                    </div>
                </div>
            </section>

            <button type="submit"
                class="bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-center"
                :disabled="loading" :class="{'cursor-default bg-blue-brand-medium hover:bg-blue-brand-medium' : loading}">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" v-if="!loading">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <svg class="animate-spin mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" v-if="loading">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Submit
            </button>
        </form>
    </div>
</template>

<script>
import Vue from "vue"
import Alert from "../../components/partials/FormAlert"
import FormError from "../../components/partials/FormError"

export default {
    components: {
        Alert,
        FormError
    },
    data() {
        return {
            name: '',
            email: '',
            district: '',
            order_number: '',
            rma_number: '',
            reason: '',
            products: [
                {
                    sku: '',
                    quantity: ''
                }
            ],
            product: {
                sku: '',
                quantity: ''
            },
            formErrors: [],
            formMessageType: 'success',
            formMessage: '',
            loading: false,
            alertVisible: true
        }
    },
    methods: {
        checkForArrayError(field) {
            return this.formErrors.hasOwnProperty(field);
        },
        getErrorForArray(key, field) {
            return this.formErrors['products.' + key + '.' + field][0];
        },
        addProduct() {
            this.products.push(Vue.util.extend({}, this.product))
        },
        removeProduct(index) {
            Vue.delete(this.products, index);
        },
        submit() {
            this.loading = true;
            axios.post('/return-request', {
                name: this.name,
                email: this.email,
                order_number: this.order_number,
                rma_number: this.rma_number,
                district: this.district,
                reason: this.reason,
                products: this.products,
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
            this.order_number = '';
            this.rma_number = '';
            this.district = '';
            this.reason = '';
            this.products = [
                {
                    name: '',
                    email: '',
                    school: '',
                }
            ];
            this.product = {
                'name': '',
                'email': '',
                'school': '',
            };
            this.formErrors = [];
            this.formMessage = '';
        }
    }
}
</script>