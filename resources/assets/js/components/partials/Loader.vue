<template>
  <div class="loader flex items-center flex-col" v-if="load===true">
    <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>
    <span class="block">Loading...</span>
  </div>
</template>

<script>
export default {
  props: ['load']
};
</script>
