<template>
  <div class="shipper">
    <div class="input-container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "StepperLinear",
  data: () => ({})
};
</script>

<style lang="scss" scoped>
.shipper {
  width: 100%;
  margin: auto;
  padding: 30px;
  text-align: center;
  .input-container {
    padding: 10px;
    max-width: 600px;
    margin: auto;
  }
}
</style>