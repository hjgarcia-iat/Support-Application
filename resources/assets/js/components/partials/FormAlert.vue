<template>
    <div class="border-l-4 p-4 mb-6 relative"
            :class="{'bg-green-200 border-green-800 text-green-800' : type==='success', 'bg-red-200 border-red-800 text-red-800' : type==='error', 'bg-blue-200 border-blue-800 text-blue-800': type==='info'}"
            v-if="message"
            v-show="visible"
            role="alert">

        {{ message }}
        <p class="mt-4" v-if="type === 'success'">
            Go Back to
            <a href="http://activatelearning.com">Activate Learning</a>
        </p>

        <a href="" @click.prevent="hide" class="no-underline absolute top-1 right-1 close-button" :class="{'text-green-dark' : type==='success', 'text-red-dark' : type==='error'}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </a>
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

