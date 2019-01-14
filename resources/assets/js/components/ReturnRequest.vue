<template>
    <div class="p-8">
        <h1 class="mb-4">Return Request</h1>
        <p class="mb-4">The district or school will be responsible for shipment of returned items. All returns are subject to approval to ensure items have not be used, stamped or damaged and are in saleable condition. A credit
            memo will be issued for the approved returned items along with a restocking fee of 20%.  If you have questions regarding your return please contact our Customer Service Group at
            <a href="mailto:csr@activatelearning.com">csr@activatelearning.com</a>.
        </p>
        <form @submit.prevent="submit">
            <alert :message=formMessage :type=formMessageType :visible=alertVisible @alert-hide="hideAlert"></alert>
            <h2 class="mb-4">General Information</h2>
            <div class="mb-6">
                <label for="name" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Name</label>
                <input type="text"
                       class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="name" placeholder="Enter name"
                       name="name" v-model="name">

                <form-error :error=formErrors.name[0] v-if="formErrors.name"></form-error>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Email Address</label>
                <input type="text"
                       class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="email" placeholder="Enter Email Address"
                       name="email" v-model="email">

                <form-error :error=formErrors.email[0] v-if="formErrors.email"></form-error>
            </div>

            <div class="mb-6">
                <label for="district" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    District Name</label>
                <input type="text"
                       class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="district" placeholder="Enter District Name"
                       name="district" v-model="district">

                <form-error :error=formErrors.district[0] v-if="formErrors.district"></form-error>
            </div>

            <div class="mb-6">
                <label for="order_number" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Order Number or PO Number</label>
                <input type="text"
                       class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="order_number" placeholder="Order Number or PO Number"
                       name="order_number" v-model="order_number">

                <form-error :error=formErrors.order_number[0] v-if="formErrors.order_number"></form-error>
            </div>

            <div class="mb-6">
                <label for="rma_number" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    RMA Number</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="rma_number" placeholder="RMA Number"
                        name="rma_number" v-model="rma_number">

                <form-error :error=formErrors.rma_number[0] v-if="formErrors.rma_number"></form-error>
            </div>

            <div class="mb-6">
                <label for="reason" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Reason for Return:</label>
                <select name="reason" id="reason" v-model="reason" class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                    <option value="">Select a Reason for Return</option>
                    <option value="Overstock">Overstock</option>
                    <option value="Ordered in error">Ordered in error</option>
                    <option value="Never implemented program">Never implemented program</option>
                    <option value="Incorrect items received">Incorrect items received</option>
                </select>
                <form-error :error=formErrors.reason[0] v-if="formErrors.reason"></form-error>
            </div>

            <hr class="border-t my-8">

            <div class="flex items-center mb-4">
                <h2 class="mr-auto mb-0">Products to Return</h2>
                <a href="" @click.prevent="addProduct"
                   class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline no-underline">
                    <small><i class="fa fa-plus mr-2"></i>Add Product</small>
                </a>
            </div>

            <div class="mb-4">
                <section class="flex justify-between items-center mb-4" v-for="(product, key, index) in products">
                    <div class="mr-2 w-full">
                        <label :for="'sku_' + index"
                               class="block text-grey-darker text-sm font-bold mb-2">
                            <small class="text-lg text-red">*</small>
                            SKU</label>
                        <input type="text"
                               class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                               :id="'sku_' + index"
                               placeholder="Enter SKU" name="teachers[]['name']" v-model="product.sku">
                        <form-error :error="getErrorForArray(key, 'sku')"
                                    v-if="checkForArrayError('products.' + key + '.sku')"></form-error>
                    </div>
                    <div class="mr-2 w-full">
                        <label :for="'quantity_'+index"
                               class="block text-grey-darker text-sm font-bold mb-2">
                            <small class="text-lg text-red">*</small>
                            Quantity</label>
                        <input type="text"
                               class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                               :id="'quantity_'+index"
                               placeholder="Enter Quantity" name="teachers[]['school']" v-model="product.quantity">

                        <form-error :error="getErrorForArray(key,'quantity')"
                                    v-if="checkForArrayError('products.' + key + '.quantity')"></form-error>
                    </div>
                    <div>
                        <a href="" @click.prevent="removeProduct(key)"
                           class="block bg-grey hover:bg-grey-dark text-grey-darkest font-bold py-2 px-4 focus:outline-none focus:shadow-outline block">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </section>
            </div>

            <section class="mt-6">
                <button type="submit"
                        class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                        :disabled="loading">
                    <i class="fa fa-refresh fa-spin mr-1" v-if="loading"></i>
                    Process Return
                </button>
            </section>
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
            hideAlert() {
                this.alertVisible = false;
            },
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
                    this.formErrors = error.response.data;
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