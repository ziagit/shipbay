<template>
  <div class="shipper">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <md-card>
      <md-card-header>
        <md-menu
          :mdCloseOnClick="closeOnClick"
          :mdCloseOnSelect="closeOnSelect"
          md-size="auto"
          md-dense
          class="mobile-menu"
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

        <div class="tablet-menu">
          <md-button
            to="/shipper/account"
            v-bind:class="{
              active: $route.name == 'account-details' || $route.name == 'edit-account',
            }"
            >Account</md-button
          >
          <md-button
            to="/shipper"
            v-bind:class="{
              active:
                $route.name == 'details' ||
                $route.name == 'add-details' ||
                $route.name == 'edit-details',
            }"
            >General</md-button
          >
          <md-button
            to="/shipper/orders"
            v-bind:class="{
              active: $route.name == 'order-list' || $route.name == 'order-details',
            }"
            >Orders</md-button
          >
          <md-button to="/shipper/card" v-bind:class="{ active: $route.name == 'card' }"
            >Card</md-button
          >
        </div>
      </md-card-header>
      <md-card-content>
        <router-view></router-view>
      </md-card-content>
    </md-card>
    <Footer />
  </div>
</template>

<script>
import Footer from "../../shared/Footer";
import Header from "../../shared/Header";
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
  methods: {
    navigateTo(route) {
      this.$router.push(route);
    },
  },
  components: {
    Footer,
    Header,
  },
};
</script>

<style lang="scss" scoped>
.md-card {
  margin: auto;
  margin-bottom: 30px !important;
  padding-bottom: 20px;
  min-height: calc(100vh - 117px);

  .md-card-content {
    padding: 0;
    text-align: center;
  }

  .tablet-menu {
    display: none;
  }
}

@media only screen and (min-width: 600px) {
  .shipper {
    .mobile-menu {
      display: none;
    }

    .tablet-menu {
      display: flex !important;
      text-align: left !important;
    }

    .md-card {
      margin: auto;
      margin-top: 20px;
      width: 90%;
    }
  }
}
</style>
