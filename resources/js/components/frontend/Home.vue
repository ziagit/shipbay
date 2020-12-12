<template>
  <div class="home">
    <md-app md-mode="reveal">
      <md-app-drawer :md-active.sync="menuVisible">
        <md-toolbar class="md-transparent" md-elevation="0"
          ><span class="logo">Shipping </span> TAP</md-toolbar
        >

        <AdminSideMenu
          v-on:hideSideMenu="menuVisible = !menuVisible"
          v-if="authenticated && user.role[0].name === 'admin'"
        />
        <WebSideMenu v-on:hideSideMenu="menuVisible = !menuVisible" v-else />
      </md-app-drawer>
      <md-app-content>
        <div class="scrollbar md-scrollbar" @scroll="onScroll">
          <router-view
            v-on:togal-menu="menuVisible = !menuVisible"
            :scrollValue="scrollPosition"
          ></router-view>
        </div>
      </md-app-content>
    </md-app>
  </div>
</template>

<script>
import AdminSideMenu from "../shared/AdminSideMenu";
import WebSideMenu from "../shared/WebSideMenu";
import Footer from "../shared/Footer";
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Home",
  data: () => ({
    scrollPosition: 0,
    menuVisible: false,
    toggleCard: false,
    activeRoute: "home",
    notifications: [],
    notificationsLength: 0,
    closeOnClick: false,
    closeOnSelect: true,
    windowWidth: window.innerWidth,
  }),

  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  methods: {
    onScroll(e) {
      this.scrollPosition = e.srcElement.scrollTop;
    },
  },

  components: {
    AdminSideMenu,
    WebSideMenu,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
/* .scrollbar {
  max-height: 100vh;
  overflow-y: auto;
} */
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

  .md-app {
    height: 100%;

    .md-toolbar {
      span {
        font-family: "Segoe Script", Helvetica, Arial;
        margin-right: 5px;
        font-size: 18px;
      }
    }

    .md-app-toolbar {
      background: #2d2e2e;
      box-shadow: none;
      color: #fff !important;
      border-bottom: #6b6b6b3b solid 1px;

      .md-title {
        color: #fff;
      }

      .md-button,
      .md-icon-button,
      .md-icon {
        color: #fff;
      }
    }
  }

  // Demo purposes only
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
    z-index: 10;
  }

  .md-app-content {
    background: #f0f2f5;
    /* background-image: linear-gradient(#fff, #F0F2F5); */
    padding: 0;
    /* background-image: linear-gradient(#2f2f65, #2a6ab3); */
    /* padding-bottom: 20px; */
  }

  .live-chat {
    position: fixed;
    right: 10px;
    bottom: 10px;
  }

  .navigation {
    display: flex;
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

@media only screen and (max-width: 600px) {
  .logo {
    font-size: 16px;
    padding: 0;
    margin: 0 !important;

    img {
      width: 20px;
    }
  }
}
</style>
