<template>
    <div class="border-l-4  p-4 mb-6 relative"
            :class="{'bg-green-lightest border-green text-green-dark' : type==='success', 'bg-red-lightest border-red text-red-dark' : type==='error'}"
            v-if="message"
            v-show="visible"
            role="alert">
        {{ message }}
        <p class="mt-4" v-if="type === 'success'">
            Go Back to
            <a href="http://activatelearning.com">Activate Learning</a>
        </p>
        <span class="absolute pin-t pin-b pin-r px-4 py-3" @click="hide">
    <svg class="fill-current h-6 w-6 text-red" role="button" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"><title>Close</title><path
            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
  </span>
    </div>
</template>

<script>
    export default {
        props: ['message', 'type', 'visible'],
        methods: {
            hide() {
                this.$emit("alert-hide", false) ;
            }
        }
    }
</script>
