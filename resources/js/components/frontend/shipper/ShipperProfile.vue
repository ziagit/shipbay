<template>
  <div>
    <md-card>
      <md-card-header>
        <md-menu
          :mdCloseOnClick="closeOnClick"
          :mdCloseOnSelect="closeOnSelect"
          md-size="auto"
          v-if="windowWidth < 600"
        >
          <md-button md-menu-trigger class="md-icon-button">
            <md-icon>more_vert</md-icon>
          </md-button>

          <md-menu-content>
            <md-menu-item @click="navigateTo('/shipper')">General</md-menu-item>
            <md-menu-item @click="navigateTo('/shipper/account')">Account</md-menu-item>
            <md-menu-item @click="navigateTo('/shipper/orders')">Orders</md-menu-item>
            <md-menu-item @click="navigateTo('/shipper/card')">Card</md-menu-item>
          </md-menu-content>
        </md-menu>

        <div class="buttons" v-else>
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
      </md-card-header>
      <md-card-content>
        <router-view></router-view>
      </md-card-content>
    </md-card>
  </div>
</template>

<script>
export default {
  name: "CarrierProfile",
  data: () => ({
    windowWidth: 600,
    closeOnSelect: true,
    closeOnClick: true,
  }),
  mounted() {
    window.addEventListener("resize", () => {
      this.windowWidth = window.innerWidth;
    });
  },
  methods:{
    navigateTo(route){
      this.$router.push(route);
    }
  }
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