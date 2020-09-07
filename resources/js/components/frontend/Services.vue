<template>
  <div class="services">
    <ion-card mode="ios">
      <ion-card-header>
        <span class="md-display-1">services</span>
      </ion-card-header>
      <ion-card-content></ion-card-content>
    </ion-card>
  </div>
</template>

<script>
import axio from "axios";
export default {
  name: "services",
  data: () => ({}),
  methods: {},
};
</script>

<style lang="scss" scoped>
.services {
  width: 100%;
  height: calc(100vh - 200px);
  ion-card {
    margin: auto;
    padding: 20px;
    background: #fff;

    .md-display-1 {
      font-size: 24px;
    }
  }
}
@media only screen and (min-width: 600px) {
  .services {
    ion-card {
      width: 90%;
      margin: 3em auto;
      .md-display-1 {
        font-size: 30px;
      }
    }
  }
}
</style>