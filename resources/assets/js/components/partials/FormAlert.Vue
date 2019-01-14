<template>
  <div
    class="border-l-4  p-4 mb-6"
    :class="{'bg-green-lightest border-green text-green-dark' : type==='success', 'bg-red-lightest border-red text-red-dark' : type=='error'}"
    v-if="message"
    role="alert"
  >
    {{ message }}
    <p
      class="mt-4"
      v-if="type === 'success'"
    >
      Go Back to
      <a href="http://activatelearning.com">Activate Learning</a>
    </p>
  </div>
</template>

<script>
export default {
  props: ["message", "type"]
};
</script>
