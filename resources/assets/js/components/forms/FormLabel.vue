<template>
    <label :for="field"
        class="block text-grey-darker text-sm font-bold mb-2">
        <small class="text-lg text-red-600" v-if="required">*</small>
        <slot></slot>
    </label>
</template>

<script>

export default {
    props: [
        'field',
        'required'
    ]
}
</script>
