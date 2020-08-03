<template>
  <md-card>
    <md-card-content>
      <div class="buttons">
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
        <md-button to="/carrier/history" v-bind:class="{active: $route.name == 'jobs' || $route.name == 'job-details'}">Job history</md-button>
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
  width: 90%;
  margin: 3em auto;
  background: #fff;
  box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14),
    0 1px 5px 0 rgba(0, 0, 0, 0.12);
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

/* 
@media only screen and (max-width: 600px) {
  .carrier-profile {
    height: 100vh;
    padding-top: 10px;
    .main-card {
      width: 95%;
    }
  }
  .section2 {
    text-align: center;
    padding-top: 10px;
  }
} */
</style>