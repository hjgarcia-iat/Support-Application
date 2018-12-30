<template>
    <div>
        <form @submit.prevent="submit">
            <div class="alert mb-5" :class="{'alert-success' : formMessageType=='success', 'alert-danger' :
            formMessageType=='error'}" v-if="formMessage" role="alert">
                {{ formMessage }}
            </div>

            <div class="row mb-4">
                <div class="col-12 col-lg-3">
                    <p>Customer Information</p>
                </div>
                <div class="col-12 col-lg-9 d-flex bg-light px-4 py-4 justify-content-center">
                    <section class="flex-fill d-flex flex-column justify-content-around">
                        <div class="form-group">
                            <label for="name" class="sr-only">PO Number:*</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Your Full Name"
                                   name="name" v-model="name">
                            <div class="invalid-feedback" v-if="formErrors.name">
                                {{ formErrors.name[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">PO Number:*</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter your Email Address"
                                   name="email" v-model="email">
                            <div class="invalid-feedback" v-if="formErrors.email">
                                {{ formErrors.email[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="po_number" class="sr-only">PO Number:*</label>
                            <input type="text" class="form-control" id="po_number" placeholder="Enter PO Number"
                                   name="po_number" v-model="po_number">
                            <div class="invalid-feedback" v-if="formErrors.po_number">
                                {{ formErrors.po_number[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="district" class="sr-only">District Name:*</label>
                            <input type="text" class="form-control" id="district" placeholder="Enter District Name"
                                   name="district" v-model="district">
                            <div class="invalid-feedback" v-if="formErrors.district">
                                {{ formErrors.district[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start_date" class="sr-only">School Start Date:*</label>
                            <datepicker :format="'M/d/yyyy'" v-model="start_date" :id="start_date"
                                        :bootstrap-styling="true"
                                        :placeholder="'Select School Start Date'"></datepicker>
                            <div class="invalid-feedback" v-if="formErrors.start_date">
                                {{ formErrors.start_date[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="curriculum" class="sr-only">Curriculum</label>
                            <select name="curriculum" id="curriculum" v-model="curriculum" class="form-control">
                                <option value="">Select a curriculum</option>
                                <option value="Active Science">Active Science</option>
                                <option value="Conceptua Math">Conceptua Math</option>
                                <option value="IQWST IDE">IQWST IDE</option>
                                <option value="IQWST Teacher Portal">IQWST Teacher Portal</option>
                            </select>
                            <div class="invalid-feedback" v-if="formErrors.curriculum">
                                {{ formErrors.curriculum[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>
                                <strong>Is there a District/IT Manager Available?</strong>
                            </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="district_manager"
                                       id="district_manager_1" value="yes" v-model="district_manager">
                                <label class="form-check-label" for="district_manager_1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="district_manager"
                                       id="district_manager_2" value="no" v-model="district_manager">
                                <label class="form-check-label" for="district_manager_2">No</label>
                            </div>
                            <div class="invalid-feedback" v-if="formErrors.district_manager">
                                {{ formErrors.district_manager[0] }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="row mb-4" v-if="district_manager === 'yes'">
                <div class="col-12 col-lg-3">
                    <p>District Manager Information</p>
                </div>
                <div class="col-12 col-lg-9 bg-light px-4 py-4">
                    <p>
                        If you have a District Manager /IT coordinator that will be setting up your district in IDE, Please provide their information here. You do not need to provide specific teacher information if you have a District/IT Manager.
                    </p>
                    <div class="d-flex justify-content-between">
                        <div class="form-group w-100 mr-2">
                            <label for="dm_name" class="sr-only">Name</label>
                            <input type="text" class="form-control" id="dm_name"
                                   placeholder="District/IT Manager's Name" name="dm_name" v-model="dm_name">
                            <div class="invalid-feedback" v-if="formErrors.dm_name">
                                {{ formErrors.dm_name[0] }}
                            </div>
                        </div>
                        <div class="form-group w-100 ml-2">
                            <label for="dm_email" class="sr-only">Email</label>
                            <input type="text" class="form-control" id="dm_email"
                                   placeholder="District/IT Manager's Email Address" name="dm_email" v-model="dm_email">
                            <div class="invalid-feedback" v-if="formErrors.dm_email">
                                {{ formErrors.dm_email[0] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4" v-if="district_manager === 'no'">
                <div class="col-12 col-lg-3">
                    <p>Teacher Information</p>
                </div>
                <div class="col-12 col-lg-9 bg-light px-4 py-4">
                    <p>
                        If you do not have a dedicated District/IT Manager please complete the teacher information below.
                    </p>
                    <p>If you need to add more than one teacher click the button below

                    </p>
                    <p class="text-right">
                        <a href="" @click.prevent="addTeacher" class="btn btn-primary">Add More Teachers
                            <i class="fa fa-plus-circle"></i>
                        </a>
                    </p>
                    <section class="d-flex justify-content-between" v-for="(teacher, key, index) in teachers">
                        <div class="form-group">
                            <label :for="'teacher_name_' + index" class="sr-only">Name</label>
                            <input type="text" class="form-control" :id="'teacher_name_' + index"
                                   placeholder="Teacher Full Name" name="teachers[]['name']" v-model="teacher.name">
                            <div class="invalid-feedback" v-if="checkForArrayError('teachers.' + key + '.name')">
                                {{ formErrors['teachers.' + key + '.name'][0] }}
                            </div>
                        </div>
                        <div class="form-group mx-3">
                            <label :for="'teacher_email_' + index" class="sr-only">Email</label>
                            <input type="text" class="form-control" :id="'teacher_email_' + index"
                                   placeholder="Teacher Email Address" name="teachers[]['email']"
                                   v-model="teacher.email">
                            <div class="invalid-feedback" v-if="checkForArrayError('teachers.' + key + '.email')">
                                {{ formErrors['teachers.' + key + '.email'][0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label :for="'teacher_school_'+index" class="sr-only">School</label>
                            <input type="text" class="form-control" :id="'teacher_school_'+index"
                                   placeholder="School Name" name="teachers[]['school']" v-model="teacher.school">
                            <div class="invalid-feedback" v-if="checkForArrayError('teachers.' + key + '.school')">
                                {{ formErrors['teachers.' + key + '.school'][0] }}
                            </div>
                        </div>
                        <div class="ml-3">
                            <a href="" @click.prevent="removeTeacher(key)" class="btn btn-sm btn-default">
                                <i class="fa fa-remove"></i>
                            </a>
                        </div>
                    </section>

                </div>
            </div>

            <hr>
            <section class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-2" :disabled="loading">
                    <i class="fa" :class="{'fa-refresh fa-spin' : loading, 'fa-send': !loading}"></i>
                    Send
                </button>
                <button type="reset" class="btn btn-default" @click.prevent="clear">
                    <i class="fa fa-remove"></i>
                    Clear
                </button>
            </section>
        </form>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        components: {
            Datepicker
        },
        data() {
            return {
                name            : '',
                email           : '',
                po_number       : '',
                district        : '',
                district_manager: '',
                start_date      : '',
                curriculum      : '',
                dm_name         : '',
                dm_email        : '',
                teachers        : [
                    {
                        name  : '',
                        email : '',
                        school: '',
                    }
                ],
                teacher         : {
                    name  : '',
                    email : '',
                    school: '',
                },
                formErrors      : [],
                formMessageType : 'success',
                formMessage     : '',
                loading         : false,
            }
        },
        methods   : {
            checkForArrayError(field) {
                return this.formErrors.hasOwnProperty(field);
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
                    name            : this.name,
                    email           : this.email,
                    po_number       : this.po_number,
                    district        : this.district,
                    district_manager: this.district_manager,
                    start_date      : this.start_date,
                    curriculum      : this.curriculum,
                    dm_name         : this.dm_name,
                    dm_email        : this.dm_email,
                    teachers        : this.teachers,
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
            clear() {
                this.reset();
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
                        name  : '',
                        email : '',
                        school: '',
                    }
                ];
                this.teacher = {
                    'name'  : '',
                    'email' : '',
                    'school': '',
                };
                this.formErrors = [];
                this.formMessage = '';
            }
        },
        watch     : {
            district_manager() {
                if (this.district_manager === 'yes') {
                    this.teachers = [];
                    this.teacher = {
                        'name'  : '',
                        'email' : '',
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