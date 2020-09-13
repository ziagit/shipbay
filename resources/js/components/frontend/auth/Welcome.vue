<template>
  <div class="section1">
    <md-card class="main-card">
      <md-empty-state
        md-icon="devices_other"
        md-label="Welcome to Shipbay"
        md-description="Please complete your registeration"
      >
        <md-button @click="completRegisteration()" class="md-primary md-raised">Start</md-button>
      </md-empty-state>
    </md-card>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Welcome",
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  methods: {
    completRegisteration() {
      if (this.user.role[0].name == "shipper") {
        this.$router.push("/shipper/profile/add-details");
      } else if (this.user.role[0].name == "carrier") {
        this.$router.push("/carrier/general-info/add-carrier");
      }
    },
  },
};
</script>
<style lang="scss" scoped>
.section1 {
  width: 100%;
  height: calc(100vh - 200px);
  .main-card {
    width: 90%;
    min-height: 500px;
    margin: auto;
    padding: 20px;
    margin-bottom: 18px;
    text-align: center;
  }
}
</style>