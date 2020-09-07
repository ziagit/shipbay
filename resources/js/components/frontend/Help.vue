<template>
  <div class="help">
    <md-card mode="ios">
      <md-card-header>
        <span class="md-display-1">help</span>
      </md-card-header>
      <md-card-content></md-card-content>
    </md-card>
  </div>
</template>

<script>
import axio from "axios";
export default {
  name: "help",
  data: () => ({}),
  methods: {},
};
</script>

<style lang="scss" scoped>
.help {
  width: 100%;
  height: calc(100vh - 200px);
  .md-card {
    margin: auto;
    padding: 20px;
    background: #fff;

    .md-display-1 {
      font-size: 24px;
    }
  }
}
@media only screen and (min-width: 600px) {
  .help {
    .md-card {
      width: 90%;
      margin: 3em auto;
      .md-display-1 {
        font-size: 30px;
      }
    }
  }
}
</style>