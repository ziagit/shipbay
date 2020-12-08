<template>
  <div class="container">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="content">
      <md-card>
        <p style="font-size: 20px">Perfect! 👌</p>
        <p>The selected carrier recieved a notification</p>
        <p>
          Stay in touch, they will contact you as soon as arrive to the pickup
          location
        </p>
        <md-button to="/" class="md-primary">Back to home</md-button>
        <md-button class="md-primary">Tracking</md-button>
      </md-card>
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from "../../shared/Header";
import Footer from "../../shared/Footer";
export default {
  name: "Complation",
  data: () => ({}),
  updated() {
    window.location.reload();
  },
  components: {
    Header,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
.content {
  max-width: 600px;
  min-height: calc(100vh - 96px);
  margin: auto;

  .md-card {
    padding: 20px;
    text-align: center;
    margin: 44px auto;
  }
}
</style>
