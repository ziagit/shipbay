<template>
  <div class="app">
    <router-view></router-view>
  </div>
</template>
<script>
export default {
  name: "App",

};
</script>
<style lang="scss">
.app {
  height: 100%;
}
.md-card{
  border-radius: 7px;
}
.md-checkbox .md-checkbox-container{
  border-radius: 5px;
}
</style>