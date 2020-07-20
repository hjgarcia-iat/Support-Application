<template>
  <div class="p-8">
    <h1 class="mb-4">Remote Learning Support</h1>
    <p class="mb-4">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci blanditiis, hic ipsa ipsum maxime nam perferendis quidem suscipit? Error excepturi facere incidunt magni necessitatibus nihil, perferendis suscipit temporibus! Sed, velit!
    </p>
    <form method="POST" @submit.prevent="submitForm">
      <alert :message=formMessage :type=formMessageType :visible=alertVisible @alert-hide="hideAlert"></alert>

      <div class="mb-6">
        <label for="name" class="block text-grey-darker text-sm font-bold mb-2">
          <small class="text-lg text-red">*</small>
          Full Name</label>
        <input type="text"
            class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            id="name" placeholder="Full Name" name="name" v-model="name">

        <form-error :error=formErrors.name[0] v-if="formErrors.name"></form-error>
      </div>

      <div class="mb-6">
        <label for="email" class="block text-grey-darker text-sm font-bold mb-2">
          <small class="text-lg text-red">*</small>
          Email</label>
        <input type="text"
            class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            id="email" placeholder="Email" name="email" v-model="email">

        <form-error :error=formErrors.email[0] v-if="formErrors.email"></form-error>
      </div>


      <div class="mb-6">
        <label for="student_name" class="block text-grey-darker text-sm font-bold mb-2">
          <small class="text-lg text-red">*</small>
          Student Full Name</label>
        <input type="text"
            class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            id="student_name" placeholder="Student Full Name" name="student_name" v-model="student_name">

        <form-error :error=formErrors.student_name[0] v-if="formErrors.student_name"></form-error>
      </div>

      <div class="mb-6">
        <label for="teacher_name" class="block text-grey-darker text-sm font-bold mb-2">
          <small class="text-lg text-red">*</small>
          Teacher Full Name</label>
        <input type="text"
            class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            id="teacher_name" placeholder="Teacher Full Name" name="teacher_name" v-model="teacher_name">

        <form-error :error=formErrors.teacher_name[0] v-if="formErrors.teacher_name"></form-error>
      </div>

      <div class="mb-6">
        <label for="district" class="block text-grey-darker text-sm font-bold mb-2">
          <small class="text-lg text-red">*</small>
          School District</label>
        <input type="text"
            class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            id="district" placeholder="School District" name="district" v-model="district">

        <form-error :error=formErrors.district[0] v-if="formErrors.district"></form-error>
      </div>


      <div class="mb-6">
        <label for="state" class="block text-grey-darker text-sm font-bold mb-2">
          <small class="text-lg text-red">*</small>
          State
        </label>
        <select name="state" id="state"
            class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-grey"
            v-model="state">
          <option value="" selected>Select a state</option>
          <option value="AL">Alabama</option>
          <option value="AK">Alaska</option>
          <option value="AZ">Arizona</option>
          <option value="AR">Arkansas</option>
          <option value="CA">California</option>
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DE">Delaware</option>
          <option value="DC">District Of Columbia</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="ME">Maine</option>
          <option value="MD">Maryland</option>
          <option value="MA">Massachusetts</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NV">Nevada</option>
          <option value="NH">New Hampshire</option>
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NY">New York</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="OH">Ohio</option>
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VT">Vermont</option>
          <option value="VA">Virginia</option>
          <option value="WA">Washington</option>
          <option value="WV">West Virginia</option>
          <option value="WI">Wisconsin</option>
          <option value="WY">Wyoming</option>
          <option value="WY">Other</option>
        </select>

        <form-error :error=formErrors.state[0] v-if="formErrors.state"></form-error>
      </div>


      <div class="mb-6">
        <label for="subject" class="block text-grey-darker text-sm font-bold mb-2">Subject</label>
        <input type="text"
            class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            id="subject" placeholder="Subject" name="subject" v-model="subject">
        <form-error :error=formErrors.subject[0] v-if="formErrors.subject"></form-error>
      </div>

      <div class="mb-6">
        <label for="comment" class="block text-grey-darker text-sm font-bold mb-2"><small class="text-lg text-red">*</small>Comments</label>

        <textarea name="comment" id="comment"
            class="appearance-none block w-full bg-grey-lighter text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            cols="30" placeholder="Comments" rows="5" v-model="comment"></textarea>
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
  name: "StudentRequest",
  components: {
    Alert,
    FormError
  },
  data() {
    return {
      subject: '',
      name: '',
      email: '',
      student_name: '',
      teacher_name: '',
      district: '',
      state: '',
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
      this.subject = '';
      this.name = '';
      this.email = '';
      this.student_name = '';
      this.teacher_name = '';
      this.district = '';
      this.state = '';
      this.comment = '';
      this.loading = false;
      this.formErrors = {};
      this.formMessage = '';
      this.formMessageType = 'success';
    },
    submitForm() {
      this.loading = true;

      axios.post('/student-support', {
        'subject': this.subject,
        'name': this.name,
        'email': this.email,
        'student_name': this.student_name,
        'teacher_name': this.teacher_name,
        'district': this.district,
        'state': this.state,
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