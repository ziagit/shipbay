<template>
  <md-card mode="ios">
    <md-card-content>
      <div class="buttons">
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
        >Rate</md-button>
        <md-button
          to="/carrier/history"
          v-bind:class="{active: $route.name == 'jobs' || $route.name == 'job-details'}"
        >Job history</md-button>
         <md-button
          to="/carrier/card"
          v-bind:class="{active: $route.name == 'carrier-card' }"
        >Card</md-button>
      </div>
      <router-view></router-view>
    </md-card-content>
  </md-card>
</template>

<script>
export default {
  name: "CarrierProfile",
  data: () => ({}),
  created() {
    console.log("xxx ", this.$route.name);
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
  margin-bottom: 14px;
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