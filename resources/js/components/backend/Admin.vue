<template>
  <div class="home">
    <md-app md-mode="reveal">
      <md-app-toolbar class="md-default">
        <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
          <md-icon>menu</md-icon>
        </md-button>
        <router-link to="/">
          <span class="logo">ShipBay</span>
        </router-link>

        <div class="md-toolbar-section-end">
          <md-button to="/register">Register</md-button>
          <md-button to="/login">Login</md-button>
        </div>
      </md-app-toolbar>

      <md-app-drawer :md-active.sync="menuVisible">
        <md-toolbar class="md-transparent" md-elevation="0">Navigation</md-toolbar>
        <md-divider></md-divider>

        <md-list :md-expand-single="expandSingle">
          <md-list-item to="/admin" @click="menuVisible = !menuVisible">
            <md-icon>dashboard</md-icon>
            <span class="md-list-item-text">Dashboard</span>
          </md-list-item>

          <md-list-item md-expand :md-expanded.sync="expandNews">
            <md-icon>whatshot</md-icon>
            <span class="md-list-item-text">Static data</span>
            <md-list slot="md-expand">
              <md-list-item
                class="md-inset"
                to="/countries"
                @click="menuVisible = !menuVisible"
              >Country</md-list-item>
              <md-list-item class="md-inset" to="/states" @click="menuVisible = !menuVisible">States</md-list-item>
              <md-list-item class="md-inset" to="cities" @click="menuVisible = !menuVisible">Cities</md-list-item>
            </md-list>
          </md-list-item>

          <md-list-item to="/carriers" @click="menuVisible = !menuVisible">
            <md-icon>stars</md-icon>
            <span class="md-list-item-text">Carriers</span>
          </md-list-item>
        </md-list>
      </md-app-drawer>

      <md-app-content>
        <router-view></router-view>
      </md-app-content>
    </md-app>
  </div>
</template>

<style lang="scss" scoped>
.home {
  height: 100%;
  min-height: 100%;
  .md-app {
    height: 100%;
    min-height: 100%;
    /* border: 1px solid rgba(#000, 0.12); */
    .md-app-content {
      background: #fafafa;
      padding: 0;
    }
  }
}

// Demo purposes only
.md-drawer {
  width: 230px;
  max-width: calc(100vw - 125px);
}
.live-chat {
  position: fixed;
  right: 10px;
  bottom: 10px;
}
</style>

<script>
export default {
  name: "Reveal",
  data: () => ({
    menuVisible: false,
    expandNews: false,
    expandSingle: false
  }),
  components: {}
};
</script>