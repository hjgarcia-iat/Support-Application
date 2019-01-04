<template>
    <div class="p-8">
        <h1 class="mb-4">Return Request</h1>
        <form @submit.prevent="submit">
            <alert :message=formMessage :type=formMessageType></alert>
            <div class="mb-6">
                <label for="name" class="block text-grey-darker text-sm font-bold mb-2">Name:*</label>
                <input type="text"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                       id="name" placeholder="Enter name"
                       name="name" v-model="name">

                <form-error :error=formErrors.name[0] v-if="formErrors.name"></form-error>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-grey-darker text-sm font-bold mb-2">Email Address</label>
                <input type="text"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                       id="email" placeholder="Enter Email Address"
                       name="email" v-model="email">

                <form-error :error=formErrors.email[0] v-if="formErrors.email"></form-error>
            </div>

            <div class="mb-6">
                <label for="district" class="block text-grey-darker text-sm font-bold mb-2">District Name:*</label>
                <input type="text"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                       id="district" placeholder="Enter District Name"
                       name="district" v-model="district">

                <form-error :error=formErrors.district[0] v-if="formErrors.district"></form-error>
            </div>

            <div class="mb-6">
                <label for="order_number" class="block text-grey-darker text-sm font-bold mb-2">Order or PO
                    Number:</label>
                <input type="text"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                       id="order_number" placeholder="Enter Order or PO Number"
                       name="order_number" v-model="order_number">

                <form-error :error=formErrors.order_number[0] v-if="formErrors.order_number"></form-error>
            </div>

            <div class="mb-6">
                <label for="reason" class="block text-grey-darker text-sm font-bold mb-2">Reason for Return</label>
                <textarea name="reason" id="reason" cols="30" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" v-model="reason"></textarea>
                <form-error :error=formErrors.reason[0] v-if="formErrors.reason"></form-error>
            </div>

            <hr class="border-t my-8">

            <div class="flex items-center mb-4">
                <h2 class="mr-auto">Products to Return</h2>
                <a href="" @click.prevent="addProduct"
                   class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline no-underline">
                    <small>Add Product</small>
                </a>
            </div>

            <div class="mb-4">
                <section class="flex justify-between items-center mb-4" v-for="(product, key, index) in products">
                    <div class="mr-2">
                        <label :for="'sku_' + index"
                               class="block text-grey-darker text-sm font-bold mb-2">SKU</label>
                        <input type="text"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                               :id="'sku_' + index"
                               placeholder="Enter SKU" name="teachers[]['name']" v-model="product.sku">
                        <form-error :error="getErrorForArray(key, 'sku')"
                                    v-if="checkForArrayError('products.' + key + '.sku')"></form-error>
                    </div>
                    <div class="mr-2">
                        <label :for="'quantity_'+index" class="block text-grey-darker text-sm font-bold mb-2">Quantity</label>
                        <input type="text"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                               :id="'quantity_'+index"
                               placeholder="Enter Quantity" name="teachers[]['school']" v-model="product.quantity">

                        <form-error :error="getErrorForArray(key,'quantity')"
                                    v-if="checkForArrayError('products.' + key + '.quantity')"></form-error>
                    </div>
                    <div class="flex items-end h-full">
                        <a href="" @click.prevent="removeProduct(key)"
                           class="block bg-red hover:bg-red-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-6">
                            <i class="fa fa-remove"></i>
                        </a>
                    </div>
                </section>
            </div>

            <hr>
            <section class="d-flex justify-content-end">
                <button type="submit"
                        class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        :disabled="loading">
                    <i class="fa" :class="{'fa-refresh fa-spin' : loading, 'fa-send': !loading}"></i>
                    Send
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
                    district: this.district,
                    reason: this.reason,
                    products: this.products,
                }).then(response => {
                    if (response.data.success) {
                        this.reset();
                        this.formMessageType = 'success';
                        this.formMessage = response.data.success;
                    }

                    this.loading = false;
                }).catch(error => {
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