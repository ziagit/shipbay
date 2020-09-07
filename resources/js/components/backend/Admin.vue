<template>
  <div class="admin">
    <router-view></router-view>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  name: 'Admin'

/*   watch: {
    $route() {
      if (this.$route.name == "accessory-list") {
        this.activeRoute = "accessory-list";
      } else if (this.$route.name == "rate-list") {
        this.activeRoute = "rate-liste";
      }
      console.log("route: ", this.$route.name);
    },
  }, */
};
</script>
<style lang="scss" scoped>
.admin {
}
</style>