<template>
    <div class="border-l-4 p-4 mb-6"
            :class="{'bg-green-200 border-green-800 text-green-800' : type==='success', 'bg-red-200 border-red-800 text-red-800' : type==='error'}"
            v-if="message"
            v-show="visible"
            role="alert">

        {{ message }}
        <p class="mt-4" v-if="type === 'success'">
            Go Back to
            <a href="http://activatelearning.com">Activate Learning</a>
        </p>

        <a href="" @click.prevent="hide" class="no-underline float-right" :class="{'text-green-dark' : type==='success', 'text-red-dark' : type==='error'}">
            <i class="fa fa-remove"></i>
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
