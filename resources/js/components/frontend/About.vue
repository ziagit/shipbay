<template>
  <div class="about">
    <ion-card mode="ios">
      <ion-card-header>
        <span class="md-display-1">About</span>
      </ion-card-header>
      <ion-card-content></ion-card-content>
    </ion-card>
  </div>
</template>

<script>
import axio from "axios";
export default {
  name: "about",
  data: () => ({}),
  methods: {},
};
</script>

<style lang="scss" scoped>
.about {
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
  .about {
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