<template>
    <div class="bg-red-lightest border border-red-light text-red-dark px-4 py-3 rounded relative mb-6"
         :class="{'bg-green-lightest border border-green-light text-green-dark' : type==='success', 'bg-red-lightest border border-red-light' : type=='error'}"
         v-if="message"
         role="alert">
        {{ message }}
        <p class="mt-4" v-if="type === 'success'">
            Go Back to
            <a href="http://activatelearning.com">Activate Learning</a>
        </p>
    </div>
</template>

<script>
    export default {
        props: ['message', 'type']
    }
</script>
