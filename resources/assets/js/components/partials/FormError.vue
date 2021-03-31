<template>
  <div class="text-sm text-red-600 mt-3">
    {{ error }}
  </div>
</template>

<script>
export default {
  props: ["error"]
};
</script>
