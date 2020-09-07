<template>
  <div class="info">
    <div v-if="detail !== undefined" class="content">
      <div class="md-body-2">About {{name}}</div>
      <p class="details">{{detail}}</p>
    </div>
    <div v-else class="content">
      <p class="details">There is no more information about this carrier</p>
    </div>
  </div>
</template>
<script>
export default {
  name: "CarrierInfor",
  props: ["detail","name"],
};
</script>
<style lang="scss" scoped>
.info {
  min-width: 100%;
  min-height: 100%;
  .content {
    padding: 20px;
    .md-body-1 {
      display: flex;
      justify-content: space-between;
    }
    .details {
      white-space: initial;
    }
  }
}
</style>