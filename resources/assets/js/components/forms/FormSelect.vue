<template>
    <select :name="field"
        v-on:change="updateValue($event.target.value)"
        :id="field"
        class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
        <slot></slot>
    </select>
</template>

<script>
export default {
    name: "FormSelect",
    props: [
        'field',
        'value'
    ],
    methods: {
        updateValue: function (value) {
            this.$emit('input', value)
        }
    }
}
</script>

<style scoped>

</style>