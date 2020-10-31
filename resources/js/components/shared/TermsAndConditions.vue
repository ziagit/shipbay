<template>
  <div class="info">
    <div class="content">
      <div class="md-body-2">ShipBay Terms and Conditions</div>
    </div>
    <div class="content">
      <ul>
          <li>Term 1</li>
          <li>Term 2</li>
          <li>Term 3</li>
          <li>Term 4</li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "TermsAndConditions",
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