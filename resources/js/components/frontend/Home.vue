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
            <md-badge :md-content="notifications.length">
              <md-menu>
                <md-button md-menu-trigger class="md-icon-button">
                  <md-icon>notification_important</md-icon>
                </md-button>
                <md-menu-content>
                  <md-menu-item
                    v-for="notification in notifications"
                    :key="notification.id"
                    @click="notificationDetails(notification)"
                  >{{notification.type}}</md-menu-item>
                </md-menu-content>
              </md-menu>
            </md-badge>

            <md-menu md-size="big" md-direction="top-start" :mdCloseOnSelect="true">
              <md-button class="md-icon-button" md-menu-trigger>
                <md-icon>account_circle</md-icon>
              </md-button>
              <md-menu-content>
                <div class="author-card">
                  <md-avatar class="md-large">
                    <img src="https://placeimg.com/40/40/people/1" alt="Marcos Moura" />
                  </md-avatar>

                  <div class="author-card-info">
                    <div>{{user.name}}</div>
                    <div>{{user.email}}</div>
                    <div class="author-card-links">
                      <div class="link" @click="profile">
                        <md-icon>mood</md-icon>Profile
                      </div>
                      <div class="link" @click="signOut">
                        <md-icon>moped</md-icon>Signout
                      </div>
                      <div class="link" @click="profile">
                        <md-icon>enhanced_encryption</md-icon>Change password
                      </div>
                    </div>
                  </div>
                </div>
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

        <md-list :md-expand-single="expandSingle">
          <md-list-item md-expand :md-expanded.sync="expandNews">
            <md-icon>whatshot</md-icon>
            <span class="md-list-item-text">News</span>

            <md-list slot="md-expand">
              <md-list-item class="md-inset">World</md-list-item>
              <md-list-item class="md-inset">Europe</md-list-item>
              <md-list-item class="md-inset">South America</md-list-item>
            </md-list>
          </md-list-item>

          <md-list-item to="/about" @click="menuVisible = !menuVisible">
            <md-icon>business</md-icon>
            <span class="md-list-item-text">About</span>
          </md-list-item>

          <md-list-item to="/services" @click="menuVisible = !menuVisible">
            <md-icon>stars</md-icon>
            <span class="md-list-item-text">Services</span>
          </md-list-item>

          <md-list-item to="/help" @click="menuVisible = !menuVisible">
            <md-icon>help</md-icon>
            <span class="md-list-item-text">Help</span>
          </md-list-item>
          <md-divider></md-divider>

          <md-list-item to="/facebook" @click="menuVisible = !menuVisible">
            <md-icon>info</md-icon>
            <span class="md-list-item-text">Facebook</span>
          </md-list-item>

          <md-list-item to="/twitter" @click="menuVisible = !menuVisible">
            <md-icon>info</md-icon>
            <span class="md-list-item-text">Twitter</span>
          </md-list-item>

          <md-list-item to="/google" @click="menuVisible = !menuVisible">
            <md-icon>info</md-icon>
            <span class="md-list-item-text">Google</span>
          </md-list-item>
        </md-list>
      </md-app-drawer>

      <md-app-content>
        <router-view></router-view>
      </md-app-content>
    </md-app>
    <div class="live-chat">
      <LiveChat></LiveChat>
    </div>
  </div>
</template>

<script>
import LiveChat from "./LiveChat";
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Home",
  data: () => ({
    menuVisible: false,
    toggleCard: false,
    expandNews: false,
    expandSingle: false,
    activeRoute: 'carrier-details',
    notifications: [],
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
      this.$store.commit("setNotificationId", notification.id);
      this.$router.push(
        "/carrier/history/job-details/" + notification.data.job.id
      );
    },
    profile() {
      this.$router.push("/carrier");
      this.$refs["aRef"].close();
    },
  },
  created() {
    this.notifications = this.user.notifications;
    Echo.private("App.User." + this.user.id).notification((res) => {
      this.notifications.push(res.notification);
    });
  },
  components: {
    LiveChat,
  },
  watch: {
    $route() {
      if(this.$route.name == 'accessory-list'){
        this.activeRoute = 'accessory-list'
      }else if(this.$route.name == 'rate-list'){
        this.activeRoute = 'rate-liste'
      }
        console.log("route: ", this.$route.name)
    },
  },
};
</script>


<style lang="scss" scoped>
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
    padding-bottom: 20px;
  }

  .live-chat {
    position: fixed;
    right: 10px;
    bottom: 10px;
  }
}
.author-card {
  text-align: center;
  .md-avatar {
    margin: 7px;
  }
  .author-card-links {
    text-align: left;
    padding: 20px 0;
    font-size: 12px;
    .link {
      padding: 3px 10px;
    }
    div:hover {
      background: #ddd;
      cursor: pointer;
    }
  }
}
</style>
