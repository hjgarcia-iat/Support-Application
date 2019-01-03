<template>
  <div class="text-sm text-red-dark mt-3">
    {{ error }}
  </div>
</template>

<script>
export default {
  props: ["error"]
};
</script>
