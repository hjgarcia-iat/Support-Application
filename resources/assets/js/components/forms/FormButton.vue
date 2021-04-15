<template>
    <button type="submit"
        class="bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-centerW"
        :disabled="is_working"
        :class="{'cursor-default bg-blue-brand-medium hover:bg-blue-brand-medium' : is_working}">
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

