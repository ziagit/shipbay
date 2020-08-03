<template>
  <div>
    <router-view :carrierId="carrierId"></router-view>
  </div>
</template>
<script>
export default {
  name: "AccessoryContainer",
  props: ['carrierId']
};
</script>
<style lang="scss">
</style>