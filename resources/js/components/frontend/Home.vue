<template>
<div class="home">
    <md-app md-mode="reveal">

        <md-app-drawer :md-active.sync="menuVisible">
            <md-toolbar class="md-transparent" md-elevation="0">Navigation</md-toolbar>

            <AdminSideMenu v-on:hideSideMenu="toggleSideMenu" v-if="authenticated && user.role[0].name === 'admin'" />
            <WebSideMenu v-on:hideSideMenu="toggleSideMenu" v-else />
        </md-app-drawer>

        <md-app-content>
            <router-view v-on:menu-togal="menuTogal"></router-view>
        </md-app-content>
    </md-app>

</div>
</template>

<script>
import AdminSideMenu from "../components/AdminSideMenu";
import WebSideMenu from "../components/WebSideMenu";
import axios from "axios";
import {
    mapGetters,
    mapActions
} from "vuex";
export default {
    name: "Home",
    data: () => ({
        menuVisible: false,
        toggleCard: false,
        activeRoute: "home",
        notifications: [],
        notificationsLength: 0,
        closeOnClick: false,
        closeOnSelect: true,
        windowWidth: window.innerWidth,
    }),
    watch: {
        /*         '$route'() {
                    if (this.$route.name == "home") {
                        console.log("home is active")
                        this.activeRoute = "home";
                    } else if (this.$route.name == "services") {
                        this.activeRoute = "services";
                    }
                }, */
    },
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
        toggleSideMenu() {
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
            if (this.authenticated) {
                this.notifications = this.user.notifications;
                Echo.private("App.User." + this.user.id).notification((res) => {
                    this.notifications.push(res.notification);
                });
            }
        },
        menuTogal() {
            this.menuVisible = !this.menuVisible
            console.log("ohk. working event")
        }
    },
    created() {
        this.getNotifications();
        console.log("current rout name", this.$route.name)
    },
    components: {
        AdminSideMenu,
        WebSideMenu,
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

    .md-app {
        height: 100%;
        border: 1px solid rgba(#000, 0.12);

        /*         .md-app-toolbar {
            background: #fff;
            box-shadow: 0 2px 4px -3px rgba(0, 0, 0, 0.2),
                0 0px 5px 0 rgba(0, 0, 0, 0.14), 0 1px 10px 0 rgba(0, 0, 0, 0.12);
            box-shadow: 0 1px 2px #11111142;

        } */

        .md-app-toolbar {
            background: #2D2E2E;
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
    }

    .md-app-content {
        background: #f0f2f5;
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
