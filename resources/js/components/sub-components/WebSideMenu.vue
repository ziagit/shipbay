<template>
  <div class="web-menu">
    <md-list :md-expand-single="expandSingle">
      <md-list-item to="/" @click="menuVisible = !menuVisible">
        <md-icon>home</md-icon>
        <span class="md-list-item-text">Home</span>
      </md-list-item>

      <md-list-item to="/about" @click="menuVisible = !menuVisible">
        <md-icon>business</md-icon>
        <span class="md-list-item-text">About Us</span>
      </md-list-item>

      <md-list-item to="/services" @click="menuVisible = !menuVisible">
        <md-icon>stars</md-icon>
        <span class="md-list-item-text">Our Services</span>
      </md-list-item>

      <md-list-item to="/help" @click="menuVisible = !menuVisible">
        <md-icon>help</md-icon>
        <span class="md-list-item-text">Help</span>
      </md-list-item>
      <md-divider></md-divider>

      <md-list-item to="/facebook" @click="menuVisible = !menuVisible">
        <md-icon>info</md-icon>
        <span class="md-list-item-text">Facebook</span>
      </md-list-item>

      <md-list-item to="/twitter" @click="menuVisible = !menuVisible">
        <md-icon>info</md-icon>
        <span class="md-list-item-text">Twitter</span>
      </md-list-item>

      <md-list-item to="/google" @click="menuVisible = !menuVisible">
        <md-icon>info</md-icon>
        <span class="md-list-item-text">Google</span>
      </md-list-item>
    </md-list>
  </div>
</template>
<script>
export default {
  name: "WebMenu",
  data: () => ({
    expandNews: false,
    expandSingle: false,
    menuVisible:false,
  }),
};
</script>
<style lang="scss" scoped>
</style>