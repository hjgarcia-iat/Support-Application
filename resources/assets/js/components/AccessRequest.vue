<template>
    <div class="p-8">
        <h1 class="mb-4">Access Request</h1>
        <form method="POST" @submit.prevent="submitForm">
            <alert :message=formMessage :type=formMessageType :visible=alertVisible @alert-hide="hideAlert"></alert>

            <h2 class="mb-6">Sales Rep Information</h2>
            <div class="mb-6">
                <label for="sales_rep" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Sales Representative requesting access
                </label>

                <select name="sales_rep" id="sales_rep"
                        class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                        v-model="rep">
                    <option value="">Make a selection...</option>
                    <option value="alandrum@activatelearning.com">Andrew Landrum</option>
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
                    <option value="tmarmolejo@activatelearning.com">Tracy Marmolejo</option>
                </select>

                <form-error :error=formErrors.sales_rep[0] v-if="formErrors.sales_rep"></form-error>
            </div>

            <hr class="border-t my-8">
            <h2 class="mb-6">Customer Information</h2>
            <div class="mb-6">
                <label for="first_name" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Customer First
                    Name</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="first_name"
                        placeholder="First Name" name="first_name" v-model="first_name">

                <form-error :error=formErrors.first_name[0] v-if="formErrors.first_name"></form-error>
            </div>

            <div class="mb-6">
                <label for="last_name" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Customer Last
                    Name</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="last_name"
                        placeholder="Last Name" name="last_name" v-model="last_name">

                <form-error :error=formErrors.last_name[0] v-if="formErrors.last_name"></form-error>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Customer Email
                    Address</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="email"
                        placeholder="Email Address" name="email" v-model="email">
                <small id="emailHelp"
                        class="mt-3 block text-grey-dark">This MUST be a
                    school email address (not gmail, yahoo, etc...)
                </small>

                <form-error :error=formErrors.email[0] v-if="formErrors.email"></form-error>
            </div>

            <hr class="border-t my-8">
            <h2 class="mb-6">School Information</h2>

            <div class="mb-6">
                <label for="district" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    District</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="district"
                        placeholder="District Name" name="district" v-model="district">
                <small class="mt-3 block text-grey-dark">Please enter
                    the name of the school district associated with this customer
                </small>

                <form-error :error=formErrors.district[0] v-if="formErrors.district"></form-error>
            </div>
            <div class="mb-6">

                <label for="school" class="block text-grey-darker text-sm font-bold mb-2">
                    School</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="school"
                        placeholder="School Name" name="school" v-model="school">
                <small class="mt-3 block text-grey-dark">Please enter
                    the name of the school associated with this customer
                </small>

                <form-error :error=formErrors.school[0] v-if="formErrors.school"></form-error>
            </div>

            <div class="mb-6">
                <label for="zip_code" class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Zip Code</label>
                <input type="text"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="zip_code" placeholder="School Zip code"
                        name="zip_code" v-model="zip">

                <form-error :error=formErrors.zip_code[0] v-if="formErrors.zip_code"></form-error>
            </div>

            <hr class="border-t my-8">
            <h2 class="mb-6">Resource Information</h2>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Digital Resources</label>

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
                        Active Physics / Active Chemistry Professional Development Website (Haiku)
                    </label>
                </div>
                <div class="mb-3">
                    <input id="resource-9" name="resource[]"
                            type="checkbox" value="IMP/MM Cyberpd" v-model="resources">

                    <label class="ml-2" for="resource-9">
                        IMP/MM CyberPD
                    </label>
                </div>
                <small class="mt-3 block text-grey-dark">Select one or
                    more of the following resources.
                </small>

                <form-error :error=formErrors.resource[0] v-if="formErrors.resource"></form-error>
            </div>

            <div v-show="showEbooks">
                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="ebook_list">
                        <small class="text-lg text-red">*</small>
                        E-Book List</label>
                    <select name="ebook_list" id="ebook_list"
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            v-model="ebook" multiple>
                        <option value="">Select an E-Book...</option>
                        <option value="Active Physics">Active Physics</option>
                        <option value="Active Chemistry">Active Chemistry</option>
                        <option value="Active Physical Science">Active Physical Science</option>
                        <option value="Astrobiology">Astrobiology</option>
                        <option value="EarthComm">EarthComm</option>
                        <option value="Engineering the Future">Engineering the Future</option>
                        <option value="Environmental Science and Biocomplexity">Environmental Science and
                            Biocomplexity
                        </option>
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
                    <small class="mt-3 block text-grey-dark">Select one
                        or more e-books. Use the Command
                        or Control key to select more than one.
                    </small>
                    <form-error :error=formErrors.ebook_list[0] v-if="formErrors.ebook_list"></form-error>
                </div>
            </div>


            <div class="mb-6" v-show="showVersion">

                <label class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Version</label>

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
                        IQWST 3.0
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
                    <input id="version-5" name="version"
                            type="radio" value="IQWST Integrated" v-model="ide_version">
                    <label class="ml-2" for="version-5">
                        IQWST Integreated
                    </label>
                </div>
                <div class="mb-3">
                    <input id="version-4" name="version"
                            type="radio" value="IQWSTOK" v-model="ide_version">
                    <label class="ml-2" for="version-4">
                        IQWST Oklahoma
                    </label>
                </div>
                <small class="mt-3 block text-grey-dark">Please indicate
                    which version of IQWST IDE you will need.
                </small>

                <form-error :error=formErrors.version[0] v-if="formErrors.version"></form-error>
            </div>


            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    <small class="text-lg text-red">*</small>
                    Requested time frame for access</label>

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
                <small class="mt-3 block text-grey-dark">Please indicate
                    the length of time access is to be granted.
                </small>

                <form-error :error=formErrors.time_frame[0] v-if="formErrors.time_frame"></form-error>
            </div>

            <div class="mb-6">
                <label for="note" class="block text-grey-darker text-sm font-bold mb-2">Notes</label>

                <textarea name="note" id="note"
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        cols="30"
                        placeholder="Notes" rows="5" v-model="notes"></textarea>
                <small class="mt-3 block text-grey-dark">Any additional information you need to convey to Support.
                </small>
            </div>

            <hr class="border-t mt-8 mb-6">

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
        components: {
            Alert,
            FormError
        },
        data() {
            return {
                rep: '',
                first_name: '',
                last_name: '',
                email: '',
                district: '',
                school: '',
                zip: '',
                resources: [],
                ebook: [],
                ide_version: '',
                time_frame: '',
                notes: '',
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
            },
            submitForm() {
                this.loading = true;

                axios.post('/access-request', {
                    'sales_rep': this.rep,
                    'first_name': this.first_name,
                    'last_name': this.last_name,
                    'email': this.email,
                    'district': this.district,
                    'school': this.school,
                    'resource': this.resources,
                    'version': this.ide_version,
                    'time_frame': this.time_frame,
                    'zip_code': this.zip,
                    'ebook_list': this.ebook,
                    'note': this.notes,
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