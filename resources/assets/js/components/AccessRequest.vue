<template>
    <div>
        <form method="POST" @submit.prevent="submitForm">
            <div class="bg-red-lightest border border-red-light text-red-dark px-4 py-3 rounded relative mb-6" :class="{'alert-success' : formMessageType=='success', 'alert-danger' :
            formMessageType=='error'}" v-if="formMessage"
                 role="alert">
                {{ formMessage }}
            </div>

            <h3 class="mb-6">Rep Information</h3>
            <div class="mb-6">
                <label for="sales_rep" class="block text-grey-darker text-sm font-bold mb-2">
                    Sales Representative requesting access:*
                </label>

                <select name="sales_rep" id="sales_rep" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                        v-model="rep">
                    <option value="">Make a selection...</option>
                    <option value="bspears@activatelearning.com">Brian Spears</option>
                    <option value="cweller@activatelearning.com">Cynthia Weller</option>
                    <option value="dtoberman@activatelearning.com">Dan Toberman</option>
                    <option value="jdivito@activatelearning.com">Jon Divito</option>
                    <option value="kangelo@activatelearning.com">Kelly Angelo</option>
                    <option value="kmitchell@activatelearning.com">Kristina Mitchell</option>
                    <option value="lsalerno@activatlearning.com">Lindsey Salerno</option>
                    <option value="lbefanis@activatelearning.com">Lisa Befanis</option>
                    <option value="lpabon@activatelearning.com">Liz Pabon</option>
                    <option value="rantinori@activatelearning.com">Ron Antinori</option>
                    <option value="tpence@activatelearning.com">Tom Pence</option>
                </select>

                <div class="text-sm text-red-dark mt-3" v-if="formErrors.sales_rep">
                    {{ formErrors.sales_rep[0] }}
                </div>
            </div>

            <hr class="border-t my-8">
            <h3 class="mb-6">Customer Information</h3>
           <div class="mb-6">
               <label for="first_name" class="block text-grey-darker text-sm font-bold mb-2">Customer First Name:*</label>
               <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="first_name"
                      placeholder="First Name" name="first_name" v-model="first_name">
               <div class="text-sm text-red-dark mt-3" v-if="formErrors.first_name">
                   {{ formErrors.first_name[0] }}
               </div>
           </div>

            <div class="mb-6">
                <label for="last_name" class="block text-grey-darker text-sm font-bold mb-2">Customer Last Name:*</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="last_name"
                       placeholder="Last Name" name="last_name" v-model="last_name">
                <div class="text-sm text-red-dark mt-3" v-if="formErrors.last_name">
                    {{ formErrors.last_name[0] }}
                </div>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-grey-darker text-sm font-bold mb-2">Customer Email Address:*</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="email"
                       placeholder="Email Address" name="email" v-model="email">
                <small id="emailHelp"
                       class="mt-3 text-grey-darkest block bg-grey-light p-2 border border-grey rounded">This MUST be a school email address (not gmail, yahoo, etc...)
                </small>
                <div class="text-sm text-red-dark mt-3" v-if="formErrors.email">
                    {{ formErrors.email[0] }}
                </div>
            </div>

            <hr class="border-t my-8">
            <h3 class="mb-6">School Information</h3>

            <div class="mb-6">
                <label for="district" class="block text-grey-darker text-sm font-bold mb-2">School District:*</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="district"
                       placeholder="District Name" name="district" v-model="district">
                <small class="mt-3 text-grey-darkest block bg-grey-light p-2 border border-grey rounded">Please enter the name of the school district associated with this customer
                </small>
                <div class="text-sm text-red-dark mt-3" v-if="formErrors.district">
                    {{ formErrors.district[0] }}
                </div>
            </div>
            <div class="mb-6">
                <label for="school" class="block text-grey-darker text-sm font-bold mb-2">School:*</label>

                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="school"
                       placeholder="School Name" name="school" v-model="school">
                <small class="mt-3 text-grey-darkest block bg-grey-light p-2 border border-grey rounded">Please enter the name of the school associated with this customer
                </small>
                <div class="text-sm text-red-dark mt-3" v-if="formErrors.school">
                    {{ formErrors.school[0] }}
                </div>
            </div>

            <div class="mb-6">
                <label for="zip_code" class="block text-grey-darker text-sm font-bold mb-2">School:*</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="zip_code" placeholder="School Zip code"
                       name="zip_code" v-model="zip">
                <div class="text-sm text-red-dark mt-3" v-if="formErrors.zip_code">
                    {{ formErrors.zip_code[0] }}
                </div>
            </div>

            <hr class="border-t my-8">
            <h3 class="mb-6">Resource Information</h3>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">Digital Resources:*</label>

                <div class="mb-3">

                    <input id="resource-20" name="resource[]"
                           type="checkbox" value="Active Science" v-model="resources">
                    <label class="ml-2" for="resource-20">
                        Active Science
                    </label>
                </div>
                <div class="mb-3">

                    <input id="resource-1" name="resource[]"
                           type="checkbox" value="IQWST Demo Portal" v-model="resources">
                    <label class="ml-2" for="resource-1">
                        IQWST Demo Portal
                    </label>
                </div>
                <div class="mb-3">
                    <input id="resource-2" name="resource[]"
                           type="checkbox" value="California Demo Portal" v-model="resources">

                    <label class="ml-2" for="resource-2">
                        California Demo Portal
                    </label>
                </div>
                <div class="mb-3">
                    <input id="resource-3" name="resource[]"
                           type="checkbox" value="IQWST IDE Demo" v-model="resources">

                    <label class="ml-2" for="resource-3">
                        IQWST IDE Demo (English Units)
                    </label>
                </div>
                <div class="mb-3">
                    <input id="resource-4" name="resource[]"
                           type="checkbox" value="IQWST IDE Demo - Spanish" v-model="resources">

                    <label class="ml-2" for="resource-4">
                        IQWST IDE Demo (Spanish units)
                    </label>
                </div>
                <div class="mb-3">
                    <input id="resource-8" name="resource[]"
                           type="checkbox" value="IQWST IDE Full Access" v-model="resources">

                    <label class="ml-2" for="resource-8">
                        IQWST IDE Full Access (For State Adoption/RFP's)
                    </label>
                </div>
                <div class="mb-3">
                    <input id="resource-5" name="resource[]"
                           type="checkbox" value="Ebook" v-model="resources">

                    <label class="ml-2" for="resource-5">
                        E-Book
                    </label>
                </div>
                <div class="mb-3">
                    <input id="resource-6" name="resource[]"
                           type="checkbox" value="PBIS Cyberpd" v-model="resources">

                    <label class="ml-2" for="resource-6">
                        PBIScience Cyberpd
                    </label>
                </div>
                <div class="mb-3">

                    <input id="resource-7" name="resource[]"
                           type="checkbox" value="Active Physics-Active Chemistry PD" v-model="resources">
                    <label class="ml-2" for="resource-7">
                        Active Physics / Active Chemistry Professional Development Website
                    </label>
                </div>
                <div class="mb-3">
                    <input id="resource-9" name="resource[]"
                           type="checkbox" value="IMP Cyberpd" v-model="resources">

                    <label class="ml-2" for="resource-9">
                        IMP CyberPD
                    </label>
                </div>
                <small class="mt-3 text-grey-darkest block bg-grey-light p-2 border border-grey rounded">Select one or more of the following resources. - PLEASE NOTE: WHEN DEMO IDE ACCESS IS REQUESTED, DEMO TEACHER PORTAL ACCESS WILL ALSO BE GIVEN UNLESS OTHERWISE SPECIFIED IN THE NOTES SECTION BELOW.</small>
                <div class="text-sm text-red-dark mt-3" v-if="formErrors.resource">
                    {{ formErrors.resource[0] }}
                </div>

            </div>

            <div v-show="showEbooks">
                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="access_ebook_list"> E-Book List</label>
                    <select name="access_ebook_list" id="access_ebook_list" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                            v-model="ebook" multiple>
                        <option value="">Select an E-Book...</option>
                        <option value="Active Physics">Active Physics</option>
                        <option value="Active Chemistry">Active Chemistry</option>
                        <option value="Active Physical Science">Active Physical Science</option>
                        <option value="Astrobiology">Astrobiology</option>
                        <option value="EarthComm">EarthComm</option>
                        <option value="Engineering the Future">Engineering the Future</option>
                        <option value="Environmental Science and Biocomplexity">Environmental Science and Biocomplexity</option>
                        <option value="Investigating Astronomy">Investigating Astronomy</option>
                        <option value="Interactive Mathematics Program">Interactive Mathematics Program</option>
                        <option value="Meaningful Math">Meaningful Math</option>
                        <option value="PBIScience: Animals in Action">PBIScience: Animals in Action</option>
                        <option value="PBIScience: Genetics">PBIScience: Genetics</option>
                        <option value="PBIScience: Good Friends & Germs">PBIScience: Good Friends & Germs</option>
                        <option value="PBIScience: Living Together">PBIScience: Living Together</option>
                        <option value="PBIScience: Digging In">PBIScience: Digging In</option>
                        <option value="PBIScience: Astronomy">PBIScience: Astronomy</option>
                        <option value="PBIScience: Ever-Changing Earth">PBIScience: Ever-Changing Earth</option>
                        <option value="PBIScience: Weather Watch">PBIScience: Weather Watch</option>
                        <option value="PBIScience: Diving Into Science">PBIScience: Diving Into Science</option>
                        <option value="PBIScience: Air Quality">PBIScience: Air Quality</option>
                        <option value="PBIScience: Energy">PBIScience: Energy</option>
                        <option value="PBIScience: Moving Big Things">PBIScience: Moving Big Things</option>
                        <option value="PBIScience: Vehicles in Motion">PBIScience: Vehicles in Motion</option>
                    </select>
                    <small class="mt-3 text-grey-darkest block bg-grey-light p-2 border border-grey rounded">Select one or more e-books. Use the Command
                        or Control key to select more than one.</small>
                    <div class="text-sm text-red-dark mt-3" v-if="formErrors.access_ebook_list">
                        {{ formErrors.access_ebook_list[0] }}
                    </div>
                </div>
            </div>


            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">Version:*</label>

                <div class="mb-3">
                    <input id="version-1" name="version"
                           type="radio" value="IQWST2.0.5" v-model="ide_version">
                    <label class="ml-2" for="version-1">
                        IQWST 2.0.5
                    </label>
                </div>
                <div class="mb-3">
                    <input id="version-2" name="version"
                           type="radio" value="IQWST3.0.0" v-model="ide_version">
                    <label class="ml-2" for="version-2">
                        IQWST 3.0.0 (Please note IQWST 3.0.0 is not yet available in IDE. Expected Release Date early August 2018)
                    </label>
                </div>
                <div class="mb-3">
                    <input id="version-3" name="version"
                           type="radio" value="IQWSTCA" v-model="ide_version">
                    <label class="ml-2" for="version-3">
                        IQWST California
                    </label>
                </div>
                <div class="mb-3">
                    <input id="version-4" name="version"
                           type="radio" value="IQWSTOK" v-model="ide_version">
                    <label class="ml-2" for="version-4">
                        IQWST Oklahoma
                    </label>
                </div>
                <small class="mt-3 text-grey-darkest block bg-grey-light p-2 border border-grey rounded">Please indicate which version of IQWST IDE you will need.</small>
                <div class="text-sm text-red-dark mt-3" v-if="formErrors.access_ide_version">
                    {{ formErrors.access_ide_version[0] }}
                </div>
            </div>


            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">Requested time frame for access:*</label>

                <div class="mb-3">
                    <input id="time_frame-1" name="time_frame"
                           type="radio" value="1 week" v-model="time_frame">
                    <label class="ml-2" for="time_frame-1">
                        1 week
                    </label>
                </div>
                <div class="mb-3">
                    <input id="time_frame-2" name="time_frame"
                           type="radio" value="2 weeks" v-model="time_frame">
                    <label class="ml-2" for="time_frame-2">
                        2 weeks
                    </label>
                </div>
                <div class="mb-3">
                    <input id="time_frame-3" name="time_frame"
                           type="radio" value="30 days" v-model="time_frame">
                    <label class="ml-2" for="time_frame-3">
                        30 days
                    </label>
                </div>
                <div class="mb-3">
                    <input id="time_frame-4" name="time_frame"
                           type="radio" value="60 days" v-model="time_frame">
                    <label class="ml-2" for="time_frame-4">
                        60 days
                    </label>
                </div>
                <div class="mb-3">
                    <input id="time_frame-5" name="time_frame"
                           type="radio" value="Other" v-model="time_frame">
                    <label class="ml-2" for="time_frame-5">
                        Other (please indicate in the Notes section below the length of time you need)
                    </label>
                </div>
                <small class="mt-3 text-grey-darkest block bg-grey-light p-2 border border-grey rounded">Please indicate the length of time access is to be granted.</small>
                <div class="text-sm text-red-dark mt-3" v-if="formErrors.time_frame">
                    {{ formErrors.time_frame[0] }}
                </div>
            </div>


            <div class="mb-6">
                <label for="note" class="block text-grey-darker text-sm font-bold mb-2">Notes</label>

                <textarea name="note" id="note" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" cols="30"
                          placeholder="Notes" rows="5" v-model="notes"></textarea>
                <small class="mt-3 text-grey-darkest block bg-grey-light p-2 border border-grey rounded">Any additional information you may have - e.g. name of the school and/or district, product interest (K-5, 6-8, 9-12), etc.</small>
            </div>

            <hr class="border-t mt-8 mb-6">


            <button type="submit" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" :disabled="loading">
                <i class="fa" :class="{'fa-refresh fa-spin' : loading, 'fa-send': !loading}"></i>
                Send
            </button>
            <button type="reset" class="bg-grey hover:bg-grey-darker text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" @click.prevent="clearForm">
                <i class="fa fa-remove"></i>
                Clear
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                rep        : '',
                first_name : '',
                last_name  : '',
                email      : '',
                district   : '',
                school     : '',
                zip        : '',
                resources  : [],
                ebook      : [],
                ide_version: '',
                time_frame : '',
                notes      : '',
                loading    : false,
                formErrors : {},
                formMessage: '',
            }
        },
        methods : {
            resetData() {
                this.rep = '';
                this.first_name = '';
                this.last_name = '';
                this.email = '';
                this.district = '';
                this.school = '';
                this.zip = '';
                this.resources = [];
                this.ebook = [];
                this.ide_version = '';
                this.time_frame = '';
                this.notes = '';
                this.loading = false;
                this.formErrors = {};
                this.formMessage = '';
                this.formMessageType = 'success';
            },
            clearForm() {
                this.resetData();
            },
            submitForm() {
                this.loading = true;

                axios.post('/access-request', {
                    'sales_rep'     : this.rep,
                    'first_name'     : this.first_name,
                    'last_name'      : this.last_name,
                    'email'          : this.email,
                    'district': this.district,
                    'school'    : this.school,
                    'resource'       : this.resources,
                    'version'        : this.ide_version,
                    'time_frame'     : this.time_frame,
                    'zip_code'                      : this.zip,
                    'access_ebook_list'             : this.ebook,
                    'note'           : this.notes,
                }).then(response => {
                    this.resetData();
                    this.formMessage = response.data.success;
                    this.loading = false;
                }).catch(error => {
                    this.formErrors = error.response.data;
                    this.formMessageType = 'error';
                    this.formMessage = 'Please see errors below!';
                    this.loading = false;
                });
            }
        },
        computed: {
            showVersion() {
                return this.resources.includes("IQWST Demo Portal") ||
                    this.resources.includes("California Demo Portal") ||
                    this.resources.includes("IQWST IDE Demo") ||
                    this.resources.includes("IQWST IDE Demo - Spanish") ||
                    this.resources.includes("IQWST IDE Full Access");
            },

            showEbooks() {
                return this.resources.includes('Ebook');
            }
        }
    }
</script>

<style>
    .btn-primary.disabled, .btn-primary:disabled {
        color            : #ffffff;
        background-color : #007bff;
        border-color     : #007bff;
        cursor           : not-allowed;
    }
</style>