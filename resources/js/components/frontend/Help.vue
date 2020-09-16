<template>
  <md-card>
    <md-card-header>
      <span class="md-display-1">help</span>
    </md-card-header>
    <md-card-content></md-card-content>
  </md-card>
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
.md-card {
  height: calc(100vh - 200px);

  .md-display-1 {
    font-size: 24px;
  }
}
@media only screen and (min-width: 600px) {
  .md-card {
    .md-display-1 {
      font-size: 30px;
    }
  }
}
</style>