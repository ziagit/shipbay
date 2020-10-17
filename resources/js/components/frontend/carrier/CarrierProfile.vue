<template>
<div class="carrier">
    <md-card>
        <md-card-header>
            <md-menu :mdCloseOnClick="closeOnClick" :mdCloseOnSelect="closeOnSelect" md-size="auto" class="mobile-menu" md-dense>
                <md-button md-menu-trigger class="md-icon-button">
                    <md-icon>more_vert</md-icon>
                </md-button>

                <md-menu-content>
                    <md-menu-item @click="navigateTo('/carrier/account')">Account</md-menu-item>
                    <md-menu-item @click="navigateTo('/carrier/profile')">General info</md-menu-item>
                    <md-menu-item @click="navigateTo('/carrier/accessories')">Accessories</md-menu-item>
                    <md-menu-item @click="navigateTo('/carrier/rates')">Rates</md-menu-item>
                    <md-menu-item @click="navigateTo('/carrier/history')">Job history</md-menu-item>
                </md-menu-content>
            </md-menu>
            <div class="tablet-menu">
                <md-button to="/carrier/account" v-bind:class="{active: $route.name == 'carrier-account' || $route.name == 'edit-account'}">Account</md-button>
                <md-button to="/carrier/profile" v-bind:class="{active: $route.name == 'carrier-details' || $route.name == 'edit-carrier'}">General</md-button>
                <md-button to="/carrier/accessories" v-bind:class="{active: $route.name == 'accessory-list' || $route.name == 'add-accessory' || $route.name == 'edit-accessory'}">Accessories</md-button>
                <md-button to="/carrier/rates" v-bind:class="{active: $route.name == 'rate-list' || $route.name == 'add-rate' || $route.name == 'edit-rate'}">Rates</md-button>
                <md-button to="/carrier/history" v-bind:class="{active: $route.name == 'jobs' || $route.name == 'job-details'}">Job history</md-button>
            </div>
        </md-card-header>
        <md-card-content>
            <router-view></router-view>
        </md-card-content>
    </md-card>
</div>
</template>

<script>
export default {
    name: "CarrierProfile",
    data: () => ({
        closeOnSelect: true,
        closeOnClick: true,
    }),

    methods: {
        navigateTo(route) {
            this.$router.push(route);
        },
    },
};
</script>

<style lang="scss" scoped>
.carrier {
    .md-card {
        margin: auto;

        .md-card-content {
            text-align: center;
        }

        .tablet-menu {
            display: none;
        }
    }
}

@media only screen and (min-width: 650px) {
    .carrier {
        padding-top: 20px;

        .mobile-menu {
            display: none;
        }

        .tablet-menu {
            display: flex !important;
            text-align: left !important;
        }

        .md-card {
            width: 90%;
        }
    }

}
</style>
