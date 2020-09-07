<template>
  <md-card mode="ios">
    <md-card-content>
      <div class="buttons">
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
        <md-button
          to="/shipper/card"
          v-bind:class="{active: $route.name == 'card'}"
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
md-card {
  margin: auto;
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
  ion-card {
    margin: 3em auto;
    width: 90%;
  }
}
</style>