<template>
  <div>
    <md-card>
      <md-card-content>
        <div v-if="windowWidth < 600" class="phone-viewport">
          <md-bottom-bar md-sync-route>
            <md-bottom-bar-item to="/components/bottom-bar" exact md-label="Home" md-icon="home"></md-bottom-bar-item>
            <md-bottom-bar-item to="/components/bottom-bar/posts" md-label="Posts" md-icon="home"></md-bottom-bar-item>
            <md-bottom-bar-item
              to="/components/bottom-bar/favorites"
              md-label="Favorites"
              md-icon="favorite"
            ></md-bottom-bar-item>
          </md-bottom-bar>
        </div>
        <div v-else class="buttons">
          <md-button
            to="/shipper"
            v-bind:class="{active: $route.name == 'details' || $route.name == 'add-details' || $route.name == 'edit-details'}"
          >General</md-button>
          <md-button
            to="/shipper/account"
            v-bind:class="{active: $route.name == 'account-details' || $route.name == 'edit-account'}"
          >Account</md-button>
          <md-button
            to="/shipper/orders"
            v-bind:class="{active: $route.name == 'order-list' || $route.name == 'order-details'}"
          >Orders</md-button>
          <md-button to="/shipper/card" v-bind:class="{active: $route.name == 'card'}">Card</md-button>
        </div>
        <router-view></router-view>
      </md-card-content>
    </md-card>
  </div>
</template>

<script>
export default {
  name: "CarrierProfile",
  data: () => ({
    windowWidth: null,
  }),
  mounted() {
    window.addEventListener("resize", () => {
      this.windowWidth = window.innerWidth;
    });
  },
  created() {
    console.log("xxx ", this.$route.name);
  },
};
</script>

<style lang="scss" scoped>
.phone-viewport {
  width: 100%;
  position: fixed;
  bottom: 0;
}
md-card {
  margin: 0;
  md-card-content {
    padding: 0;
    text-align: center;
  }
}
.buttons {
  display: flex;
  text-align: left !important;
  margin-bottom: 14px;
}
.active {
  color: #448aff;
}

@media only screen and (min-width: 600px) {
  md-card {
    margin: 0;
    padding: 0;
    width: 90%;
  }
}
</style>