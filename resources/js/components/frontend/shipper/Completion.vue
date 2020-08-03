<template>
  <div>
    <div v-show="dataLoading" class="loading">
      <span class="md-display-1">Your order is in process...</span>
      <br />
      <span class="md-title">Please wait</span>
      <br />
      <ion-spinner mode="ios" name="lines" color="primary" class="primary"></ion-spinner>
    </div>
    <md-card v-show="!dataLoading">
      <p style="font-size:20px">Perfect! 👌</p>
      <p>The selected carrier recieved a notification</p>
      <p>Stay in touch, they will contact you as soon as arrive to the pickup location</p>
    </md-card>
  </div>
</template>
<script>
export default {
  name: "Complation",
  data: () => ({
    dataLoading: true
  }),
  created() {
    setTimeout(() => {
      this.dataLoading = false;
    }, 5000);
  }
};
</script>
<style lang="scss" scoped>
.md-card {
  padding: 20px;
  text-align: center;
}
</style>