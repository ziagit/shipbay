<template>
  <div class="home">
    <md-app>
      <md-app-toolbar class="md-default">
        <md-button class="md-icon-button" @click="toggleMenu" v-if="!menuVisible">
          <md-icon>menu</md-icon>
        </md-button>
        <router-link to="/">
          <span class="logo">ShipBay</span>
        </router-link>

        <div class="md-toolbar-section-end">
          <div v-if="authenticated">
            <md-badge class="md-primary" :md-content="notifications.length" md-dense>
              <md-menu>
                <md-button md-menu-trigger class="md-icon-button">
                  <md-icon>notifications</md-icon>
                </md-button>
                <md-menu-content v-if="user.role[0].name === 'carrier'">
                  <md-menu-item
                    v-for="notification in notifications"
                    :key="notification.id"
                    @click="notificationDetails(notification)"
                  >Job: {{notification.data.job.id}}</md-menu-item>
                </md-menu-content>
                <md-menu-content v-if="user.role[0].name === 'shipper'">
                  <md-menu-item
                    v-for="notification in notifications"
                    :key="notification.id"
                    @click="markAsRead(notification.id)"
                  >Your order({{notification.data.job.order_id}}) is: {{notification.data.job.jobstatus.title}}</md-menu-item>
                  <md-tooltip>Click to mark as read.</md-tooltip>
                </md-menu-content>
                <md-menu-content v-if="user.role[0].name === 'admin'">
                  <md-menu-item
                    v-for="notification in notifications"
                    :key="notification.id"
                    @click="notificationDetails(notification)"
                  >Job ({{notification.data.job.order_id}})</md-menu-item>
                </md-menu-content>
              </md-menu>
            </md-badge>
            <md-menu
              md-size="big"
              md-direction="bottom-end"
              :mdCloseOnClick="closeOnClick"
              :mdCloseOnSelect="closeOnSelect"
            >
              <md-button md-menu-trigger class="md-icon-button">
                <md-icon>account_circle</md-icon>
              </md-button>

              <md-menu-content>
                <div class="menu-head">
                  <md-avatar class="md-large">
                    <md-icon>face</md-icon>
                  </md-avatar>
                  <div>
                    <div>{{user.name}}</div>
                    <div>{{user.email}}</div>
                  </div>
                </div>
                <md-menu-item @click="profile">Profile</md-menu-item>
                <md-menu-item @click="signOut">Signout</md-menu-item>
              </md-menu-content>
            </md-menu>
          </div>
          <div v-else>
            <md-button to="/register">Register</md-button>
            <md-button to="/login">Login</md-button>
          </div>
        </div>
      </md-app-toolbar>

      <md-app-drawer :md-active.sync="menuVisible" md-persistent="full">
        <md-toolbar class="md-transparent" md-elevation="0">
          <span>Navigation</span>
          <div class="md-toolbar-section-end">
            <md-button class="md-icon-button md-dense" @click="toggleMenu">
              <md-icon>keyboard_arrow_left</md-icon>
            </md-button>
          </div>
        </md-toolbar>

        <div class="side-menu">
          <AdminSideMenu v-on:hideSideMenu="toggleMenu" v-if="authenticated && user.role[0].name === 'admin'" />
          <WebSideMenu v-on:hideSideMenu="toggleMenu" v-else />
        </div>
      </md-app-drawer>

      <md-app-content>
        <router-view></router-view>
      </md-app-content>
    </md-app>
    <div v-if="authenticated && user.role[0].name !=='admin'" class="live-chat">
      <LiveChat></LiveChat>
    </div>
  </div>
</template>

<script>
import AdminSideMenu from "../sub-components/AdminSideMenu";
import WebSideMenu from "../sub-components/WebSideMenu";
import LiveChat from "./LiveChat";
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Home",
  data: () => ({
    menuVisible: false,
    toggleCard: false,
    activeRoute: "carrier-details",
    notifications: [],
    notificationsLength: 0,
    closeOnClick: false,
    closeOnSelect: true,
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
    },
    toggleMenu() {
      this.menuVisible = !this.menuVisible;
    },
    notificationDetails(notification) {
      this.setNotification(notification.id).then((res) => {});
      switch (this.user.role[0].name) {
        case "shipper":
          this.$router.push(
            "/shipper/orders/details/" + notification.data.job.order_id
          );
          break;
        case "carrier":
          this.$router.push(
            "/carrier/history/details/" + notification.data.job.id
          );
          break;
        case "admin":
          this.$router.push("/admin/order/" + notification.data.job.order_id);
          break;
        default:
          this.$router.push("/");
      }
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
    },
    getNotifications() {
        this.notifications = this.user.notifications;
        Echo.private("App.User." + this.user.id).notification((res) => {
          this.notifications.push(res.notification);
        });
        console.log("notifications: ", this.notifications.length);
    },
  },
  created() {
    this.getNotifications();
  },
  components: {
    LiveChat,
    AdminSideMenu,
    WebSideMenu,
  },
  watch: {
    $route() {
      if (this.$route.name == "accessory-list") {
        this.activeRoute = "accessory-list";
      } else if (this.$route.name == "rate-list") {
        this.activeRoute = "rate-liste";
      }
      console.log("route: ", this.$route.name);
    },
  },
};
</script>

<style lang="scss" scoped>
.md-menu-content {
  border-radius: 7px;
  .md-menu-content-container {
    border-radius: 7px !important;
    .md-list {
      border-radius: 7px !important;
    }
  }
}
.home {
  height: 100%;
  .md-default {
    background: #fff;
    box-shadow: 0 2px 4px -3px rgba(0, 0, 0, 0.2),
      0 0px 5px 0 rgba(0, 0, 0, 0.14), 0 1px 10px 0 rgba(0, 0, 0, 0.12);
  }
  .md-app {
    height: 100%;
    border: 1px solid rgba(#000, 0.12);
  }

  // Demo purposes only
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
  }
  .md-app-content {
    background: #f0f2f5;
    /* background-image: linear-gradient(#2f2f65, #2a6ab3); */
    /* padding-bottom: 20px; */
  }

  .live-chat {
    position: fixed;
    right: 10px;
    bottom: 10px;
  }
}
.menu-head {
  text-align: center;
  margin-bottom: 18px;
  .md-avatar {
    margin: 7px;
    background: #f0f2f5;
  }
}
</style>
