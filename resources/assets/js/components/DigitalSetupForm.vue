<template>
    <div class="p-8">
        <h1 class="mb-4">Digital Setup Request Form</h1>
        <form @submit.prevent="submit">
            <alert :message=formMessage :type=formMessageType></alert>
            <div class="mb-6">
                <label for="name" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Name</label> <input type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                    id="name" placeholder="Enter Your Full Name"
                    name="name" v-model="name">

                <form-error :error=formErrors.name[0] v-if="formErrors.name"></form-error>
            </div>

            <div class="mb-6">
                <label for="po_number" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    PO Number</label> <input type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                    id="po_number" placeholder="Enter PO Number"
                    name="po_number" v-model="po_number">

                <form-error :error=formErrors.po_number[0] v-if="formErrors.po_number"></form-error>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Email Address</label> <input type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                    id="email" placeholder="Enter your Email Address"
                    name="email" v-model="email">

                <form-error :error=formErrors.email[0] v-if="formErrors.email"></form-error>
            </div>
            <div class="mb-6">
                <label for="district" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    District Name</label> <input type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                    id="district" placeholder="Enter District Name"
                    name="district" v-model="district">

                <form-error :error=formErrors.district[0] v-if="formErrors.district"></form-error>
            </div>

            <div class="mb-6">
                <label for="start_date" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    School Start Date</label>
                <datepicker :format="'M/d/yyyy'" v-model="start_date" :id="start_date"
                        :input-class="'shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline'"
                        :placeholder="'Select School Start Date'"></datepicker>

                <form-error :error=formErrors.start_date[0] v-if="formErrors.start_date"></form-error>
            </div>

            <div class="mb-6">
                <label for="curriculum" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Curriculum</label> <select name="curriculum" id="curriculum" v-model="curriculum"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select a curriculum</option>
                <option value="Active Science">Active Science</option>
                <option value="Conceptua Math">Conceptua Math</option>
                <option value="IQWST IDE">IQWST IDE</option>
                <option value="IQWST Teacher Portal">IQWST Teacher Portal</option>
            </select>

                <form-error :error=formErrors.curriculum[0] v-if="formErrors.curriculum"></form-error>
            </div>

            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Is there a District/IT Manager Available?</label>
                <div class="form-check form-check-inline">
                    <input type="radio" name="district_manager"
                            id="district_manager_1" value="yes" v-model="district_manager"> <label
                        class="ml-2 text-grey-darker text-sm font-bold mb-2" for="district_manager_1">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="district_manager"
                            id="district_manager_2" value="no" v-model="district_manager"> <label
                        class="ml-2 text-grey-darker text-sm font-bold mb-2" for="district_manager_2">No</label>
                </div>

                <form-error :error=formErrors.district_manager[0] v-if="formErrors.district_manager"></form-error>
            </div>

            <div class="mb-4" v-if="district_manager === 'yes'">
                <p>
                    If you have a District Manager /IT coordinator that will be setting up your district in IDE, Please
                    provide their information here. You do not need to provide specific teacher information if you have
                    a District/IT Manager.
                </p>

                <div class="mb-6">
                    <label for="dm_name" class="block text-grey-darker text-sm font-bold mb-2">
                        <small class="text-lg text-red">*</small>
                        Name</label> <input type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                        id="dm_name"
                        placeholder="District/IT Manager's Name" name="dm_name" v-model="dm_name">
                    <form-error :error=formErrors.dm_name[0] v-if="formErrors.dm_name"></form-error>
                </div>
                <div class="mb-6">
                    <label for="dm_email" class="block text-grey-darker text-sm font-bold mb-2">
                        <small class="text-lg text-red">*</small>
                        Email</label> <input type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                        id="dm_email"
                        placeholder="District/IT Manager's Email Address" name="dm_email"
                        v-model="dm_email">

                    <form-error :error=formErrors.dm_email[0] v-if="formErrors.dm_email"></form-error>
                </div>

            </div>

            <div class="mb-4" v-if="district_manager === 'no'">

                <p>
                    If you do not have a dedicated District/IT Manager please complete the teacher information below.
                </p>
                <p>If you need to add more than one teacher click the button below

                </p>
                <p class="text-right">
                    <a href="" @click.prevent="addTeacher" class="btn btn-primary">Add More Teachers <i
                            class="fa fa-plus-circle"></i> </a>
                </p>
                <section class="flex justify-between items-center" v-for="(teacher, key, index) in teachers">
                    <div class="mr-2">
                        <label :for="'teacher_name_' + index"
                                class="block text-grey-darker text-sm font-bold mb-2">
                            <small class="text-lg text-red">*</small>
                            Name</label> <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                            :id="'teacher_name_' + index"
                            placeholder="Teacher Full Name" name="teachers[]['name']"
                            v-model="teacher.name">
                        <form-error :error="getErrorForArray(key, 'name')"
                                v-if="checkForArrayError('teachers.' + key + '.name')"></form-error>
                    </div>
                    <div class="mr-2">
                        <label :for="'teacher_email_' + index" class="block text-grey-darker text-sm font-bold mb-2">
                            <small class="text-lg text-red">*</small>
                            Email</label> <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                            :id="'teacher_email_' + index"
                            placeholder="Teacher Email Address" name="teachers[]['email']"
                            v-model="teacher.email">
                        <form-error :error="getErrorForArray(key,'email')"
                                v-if="checkForArrayError('teachers.' + key + '.email')"></form-error>
                    </div>
                    <div class="mr-2">
                        <label :for="'teacher_school_'+index" class="block text-grey-darker text-sm font-bold mb-2">
                            <small class="text-lg text-red">*</small>
                            School</label> <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                            :id="'teacher_school_'+index"
                            placeholder="School Name" name="teachers[]['school']"
                            v-model="teacher.school">

                        <form-error :error="getErrorForArray(key,'school')"
                                v-if="checkForArrayError('teachers.' + key + '.school')"></form-error>
                    </div>
                    <div class="flex items-end h-full">
                        <a href="" @click.prevent="removeTeacher(key)"
                                class="block bg-grey hover:bg-grey-dark text-grey-darkest font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <i class="fa fa-trash"></i> </a>
                    </div>
                </section>
            </div>

            <hr>
            <section class="d-flex justify-content-end">
                <button type="submit"
                        class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        :disabled="loading">
                    <i class="fa fa-refresh fa-spin" v-if="loading"></i> Send Request
                </button>
            </section>
        </form>
    </div>
</template>

<script>
    import Datepicker from "vuejs-datepicker"
    import * as Vue from "vue"
    import Alert from "../components/partials/FormAlert"
    import FormError from "../components/partials/FormError"

    export default {
        components: {
            Datepicker,
            Alert,
            FormError
        },
        data() {
            return {
                name: '',
                email: '',
                po_number: '',
                district: '',
                district_manager: '',
                start_date: '',
                curriculum: '',
                dm_name: '',
                dm_email: '',
                teachers: [
                    {
                        name: '',
                        email: '',
                        school: '',
                    }
                ],
                teacher: {
                    name: '',
                    email: '',
                    school: '',
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
                return this.formErrors['teachers.' + key + '.' + field][0];
            },
            addTeacher() {
                this.teachers.push(Vue.util.extend({}, this.teacher))
            },
            removeTeacher(index) {
                Vue.delete(this.teachers, index);
            },
            submit() {
                this.loading = true;
                axios.post('/digital-setup-request', {
                    name: this.name,
                    email: this.email,
                    po_number: this.po_number,
                    district: this.district,
                    district_manager: this.district_manager,
                    start_date: this.start_date,
                    curriculum: this.curriculum,
                    dm_name: this.dm_name,
                    dm_email: this.dm_email,
                    teachers: this.teachers,
                }).then(response => {
                    if (response.data.success) {
                        this.reset();
                        this.formMessageType = 'success';
                        this.formMessage = response.data.message;
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
                this.po_number = '';
                this.district = '';
                this.district_manager = '';
                this.start_date = '';
                this.curriculum = '';
                this.dm_name = '';
                this.dm_email = '';
                this.teachers = [
                    {
                        name: '',
                        email: '',
                        school: '',
                    }
                ];
                this.teacher = {
                    'name': '',
                    'email': '',
                    'school': '',
                };
                this.formErrors = [];
                this.formMessage = '';
            }
        },
        watch: {
            district_manager() {
                if (this.district_manager === 'yes') {
                    this.teachers = [];
                    this.teacher = {
                        'name': '',
                        'email': '',
                        'school': '',
                    };
                }

                if (this.district_manager === 'no') {
                    this.dm_name = '';
                    this.dm_email = '';
                }
            }
        },
    }
</script>