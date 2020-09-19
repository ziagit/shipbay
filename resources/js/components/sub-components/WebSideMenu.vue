<template>
  <div class="web-menu">
    <md-list :md-expand-single="expandSingle">
      <md-list-item to="/home" @click="hideMenu()">
        <md-icon>home</md-icon>
        <span class="md-list-item-text">Home</span>
      </md-list-item>

      <md-list-item to="/about" @click="hideMenu()">
        <md-icon>business</md-icon>
        <span class="md-list-item-text">About Us</span>
      </md-list-item>

      <md-list-item to="/services" @click="hideMenu()">
        <md-icon>stars</md-icon>
        <span class="md-list-item-text">Our Services</span>
      </md-list-item>

      <md-list-item to="/help" @click="hideMenu()">
        <md-icon>help</md-icon>
        <span class="md-list-item-text">Help</span>
      </md-list-item>
      <md-divider></md-divider>

      <md-list-item to="/facebook" @click="hideMenu()">
        <md-icon>info</md-icon>
        <span class="md-list-item-text">Facebook</span>
      </md-list-item>

      <md-list-item to="/twitter" @click="hideMenu()">
        <md-icon>info</md-icon>
        <span class="md-list-item-text">Twitter</span>
      </md-list-item>

      <md-list-item to="/google" @click="hideMenu()">
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
  methods:{
    hideMenu(){
      this.$emit('hideSideMenu');
    }
  }
};
</script>
<style lang="scss" scoped>
</style>