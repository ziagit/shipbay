<template>
  <md-card mode="ios">
    <md-card-header>
      <md-menu
        :mdCloseOnClick="closeOnClick"
        :mdCloseOnSelect="closeOnSelect"
        md-size="auto"
        v-if="windowWidth < 666"
      >
        <md-button md-menu-trigger class="md-icon-button">
          <md-icon>more_vert</md-icon>
        </md-button>

        <md-menu-content>
          <md-menu-item @click="navigateTo('/carrier/account')">Account</md-menu-item>
          <md-menu-item @click="navigateTo('/carrier/general-info')">General info</md-menu-item>
          <md-menu-item @click="navigateTo('/carrier/accessories')">Accessories</md-menu-item>
          <md-menu-item @click="navigateTo('/carrier/rates')">Rates</md-menu-item>
          <md-menu-item @click="navigateTo('/carrier/history')">Job history</md-menu-item>
        </md-menu-content>
      </md-menu>
      <div v-else class="buttons">
        <md-button
          to="/carrier/account"
          v-bind:class="{active: $route.name == 'carrier-account' || $route.name == 'edit-account'}"
        >Account</md-button>
        <md-button
          to="/carrier/general-info"
          v-bind:class="{active: $route.name == 'carrier-details' || $route.name == 'edit-carrier'}"
        >General info</md-button>
        <md-button
          to="/carrier/accessories"
          v-bind:class="{active: $route.name == 'accessory-list' || $route.name == 'add-accessory' || $route.name == 'edit-accessory'}"
        >Accessories</md-button>
        <md-button
          to="/carrier/rates"
          v-bind:class="{active: $route.name == 'rate-list' || $route.name == 'add-rate' || $route.name == 'edit-rate'}"
        >Rates</md-button>
        <md-button
          to="/carrier/history"
          v-bind:class="{active: $route.name == 'jobs' || $route.name == 'job-details'}"
        >Job history</md-button>
        <!--     <md-button
          to="/carrier/card"
          v-bind:class="{active: $route.name == 'carrier-card' }"
        >Card</md-button>-->
      </div>
    </md-card-header>
    <md-card-content>
      <router-view></router-view>
    </md-card-content>
  </md-card>
</template>

<script>
export default {
  name: "CarrierProfile",
  data: () => ({
    windowWidth: 666,
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
};
</script>

<style lang="scss" scoped>
.md-card {
  margin: auto;
  background: #fff;
  md-card-content {
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
  .md-card {
    margin: 3em auto;
    width: 90%;
  }
}
</style>