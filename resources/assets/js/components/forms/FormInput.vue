<template>
    <input :type="type"
        class="appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
        :id="field"
        :placeholder="placeholder"
        :value="value"
        :name="field"
        v-on:input="updateValue($event.target.value)">
</template>

<script>
export default {
    props: ['field','placeholder','type','value'],
    methods: {
        updateValue: function (value) {
            this.$emit('input', value)
        }
    }
}
</script>