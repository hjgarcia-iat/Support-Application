<template>
    <button type="submit"
        class="bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-center ml-4"
        :disabled="is_working"
        :class="{'cursor-default bg-blue-brand-medium hover:bg-blue-brand-medium' : is_working}">
        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg" v-if="!is_working">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
        <svg class="animate-spin mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" v-if="is_working">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: "FormButton",
    props: {
        is_working: {
            type: Boolean,
            default: false
        }
    },
}
</script>

