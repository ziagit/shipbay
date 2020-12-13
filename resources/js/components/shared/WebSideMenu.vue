<template>
  <div class="web-menu">
    <md-list :md-expand-single="expandSingle">
      <md-list-item to="/home" @click="hideMenu()">
        <!--<md-icon v-bind:class="{active: $route.name == 'home'}">home</md-icon>-->
        <span class="md-list-item-text" v-bind:class="{ active: $route.name == 'home' }"
          >Home</span
        >
      </md-list-item>
      <md-list-item to="/about" @click="hideMenu()">
        <!--<md-icon v-bind:class="{active: $route.name == 'about'}">info</md-icon>-->
        <span class="md-list-item-text" v-bind:class="{ active: $route.name == 'about' }"
          >About</span
        >
      </md-list-item>

      <md-list-item to="/shippers" @click="hideMenu()">
        <!--<md-icon v-bind:class="{active: $route.name == 'shippers'}">local_mall</md-icon>-->
        <span
          class="md-list-item-text"
          v-bind:class="{ active: $route.name == 'our-shippers' }"
          >Shippers</span
        >
      </md-list-item>

      <!--     <md-list-item md-expand :md-expanded.sync="expandShippers">
            <md-icon>local_mall</md-icon>
            <span class="md-list-item-text">Shippers</span>
            <md-list slot="md-expand">
                <md-list-item class="md-inset" to="/admin/carriers" @click="hideMenu()">Get Free Quotes</md-list-item>
                <md-list-item class="md-inset" to="/admin/rates" @click="hideMenu()">Shipper FAQ</md-list-item>
                <md-list-item class="md-inset" to="/admin/carrier/accessories" @click="hideMenu()">Help Center</md-list-item>
            </md-list>
        </md-list-item>-->

      <md-list-item to="/carriers" @click="hideMenu()">
        <!--<md-icon v-bind:class="{active: $route.name == 'carriers'}">local_shipping</md-icon>-->
        <span
          class="md-list-item-text"
          v-bind:class="{ active: $route.name == 'our-carriers' }"
          >Carriers</span
        >
      </md-list-item>
      <md-list-item to="/help" @click="hideMenu()">
        <!--<md-icon v-bind:class="{active: $route.name == 'help'}">help</md-icon>-->
        <span class="md-list-item-text" v-bind:class="{ active: $route.name == 'help' }"
          >Help Center</span
        >
      </md-list-item>

      <md-divider></md-divider>
      <div v-if="authenticated">
        <md-list-item md-expand :md-expanded.sync="expandUser">
          <span class="md-list-item-text">User</span>
          <md-list slot="md-expand">
            <md-list-item class="md-inset" @click="profile()">Profile</md-list-item>
            <md-list-item class="md-inset" @click="signOut()">Logout</md-list-item>
          </md-list>
        </md-list-item>
        <md-badge class="md-danger" :md-content="notifications.length" md-dense>
          <md-list-item md-expand :md-expanded.sync="expandNotification">
            <span class="md-list-item-text">Notifications</span>

            <md-list slot="md-expand" v-if="user.role[0].name === 'carrier'">
              <md-list-item
                class="md-inset"
                v-for="notification in notifications"
                :key="notification.id"
                @click="notificationDetails(notification)"
                >Assigned job: {{ notification.data.job.id }}</md-list-item
              >
            </md-list>

            <md-list slot="md-expand" v-if="user.role[0].name === 'shipper'">
              <md-list-item
                class="md-inset"
                v-for="notification in notifications"
                :key="notification.id"
                @click="notificationDetails(notification)"
                >Your order({{ notification.data.job.order_id }}) is:
                {{ notification.data.job.jobstatus.title }}
                <md-tooltip>Click to mark as read.</md-tooltip>
              </md-list-item>
            </md-list>

            <md-list slot="md-expand" v-if="user.role[0].name === 'admin'">
              <md-list-item
                class="md-inset"
                v-for="notification in notifications"
                :key="notification.id"
                @click="notificationDetails(notification)"
                >Job ({{ notification.data.job.order_id }})</md-list-item
              >
            </md-list>
          </md-list-item>
        </md-badge>
      </div>
      <div v-else>
        <md-list-item to="/login" @click="hideMenu()">
          <span
            class="md-list-item-text"
            v-bind:class="{ active: $route.name == 'signin' }"
            >Sign In</span
          >
        </md-list-item>
        <md-list-item to="/register" @click="hideMenu()">
          <span
            class="md-list-item-text"
            v-bind:class="{ active: $route.name == 'signup' }"
            >Sign Up</span
          >
        </md-list-item>
      </div>
    </md-list>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "WebMenu",
  data: () => ({
    expandNews: false,
    expandSingle: false,
    menuVisible: false,
    windowWidth: window.innerWidth,
    expandNotification: false,
    notifications: [],
    expandUser: false,
  }),
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  methods: {
    ...mapActions({
      signOutAction: "auth/signOut",
      setNotification: "shared/setNotification",
    }),
    signOut() {
      this.signOutAction().then(() => {
        this.$router.push("/");
      });
      this.hideMenu();
    },
    profile() {
      switch (this.user.role[0].name) {
        case "shipper":
          this.$router.push("/shipper");
          this.toggleCard = !this.toggleCard;
          break;
        case "carrier":
          this.$router.push("/carrier");
          this.toggleCard = !this.toggleCard;
          break;
        case "admin":
          this.$router.push("/admin");
          this.toggleCard = !this.toggleCard;
          break;
        default:
          this.$router.push("/");
      }
      this.hideMenu();
    },
    notificationDetails(notification) {
      this.setNotification(notification.id).then((res) => {});
      switch (this.user.role[0].name) {
        case "shipper":
          this.$router.push("/shipper/orders/details/" + notification.data.job.order_id);
          break;
        case "carrier":
          this.$router.push("/carrier/history/details/" + notification.data.job.id);
          break;
        case "admin":
          this.$router.push("/admin/order/" + notification.data.job.order_id);
          break;
        default:
          this.$router.push("/");
      }
      this.hideMenu();
    },
    markAsRead(id) {
      axios
        .get("auth/read-notification/" + id)
        .then((res) => {
          this.getNotifications();
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getNotifications() {
      if (this.authenticated) {
        this.notifications = this.user.notifications;
        Echo.private("App.User." + this.user.id).notification((res) => {
          this.notifications.push(res.notification);
        });
      }
    },
    hideMenu() {
      this.$emit("hideSideMenu");
    },
  },
  created() {
    this.getNotifications();
  },
};
</script>

<style lang="scss" scoped>
.md-badge-content {
  width: 97% !important;
}
.md-icon {
  color: #000 !important;
}

.active {
  color: #ffa500 !important;
}
.md-list-item-text {
  font-size: 16px;
}
</style>
