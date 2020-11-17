<template>
<div class="web-menu">
    <md-list :md-expand-single="expandSingle">
        <md-list-item to="/home" @click="hideMenu()">
            <md-icon v-bind:class="{active: $route.name == 'home'}">home</md-icon>
            <span class="md-list-item-text" v-bind:class="{active: $route.name == 'home'}">Home</span>
        </md-list-item>
        <md-list-item to="/about" @click="hideMenu()">
            <md-icon v-bind:class="{active: $route.name == 'about'}">info</md-icon>
            <span class="md-list-item-text" v-bind:class="{active: $route.name == 'about'}">About</span>
        </md-list-item>

        <md-list-item to="/shippers" @click="hideMenu()">
            <md-icon v-bind:class="{active: $route.name == 'shippers'}">local_mall</md-icon>
            <span class="md-list-item-text" v-bind:class="{active: $route.name == 'shippers'}">Shippers</span>
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
            <md-icon v-bind:class="{active: $route.name == 'carriers'}">local_shipping</md-icon>
            <span class="md-list-item-text" v-bind:class="{active: $route.name == 'carriers'}">Carriers</span>
        </md-list-item>
        <md-list-item to="/help" @click="hideMenu()">
            <md-icon v-bind:class="{active: $route.name == 'help'}">help</md-icon>
            <span class="md-list-item-text" v-bind:class="{active: $route.name == 'help'}">How It Works</span>
        </md-list-item>
        <md-divider></md-divider>

        <md-list-item to="/login" @click="hideMenu()">
            <md-icon v-bind:class="{active: $route.name == 'login'}">login</md-icon>
            <span class="md-list-item-text" v-bind:class="{active: $route.name == 'login'}">Sign In</span>
        </md-list-item>
        <md-list-item to="/register" @click="hideMenu()">
            <md-icon v-bind:class="{active: $route.name == 'register'}">supervised_user_circle</md-icon>
            <span class="md-list-item-text" v-bind:class="{active: $route.name == 'register'}">Sign Up</span>
        </md-list-item>

    </md-list>
</div>
</template>

<script>
export default {
    name: "WebMenu",
    data: () => ({
        expandNews: false,
        expandSingle: false,
        menuVisible: false,
        windowWidth: window.innerWidth,
        expandCarriers: false,
        expandShippers: false,
    }),
    methods: {
        hideMenu() {
            this.$emit('hideSideMenu');
        }
    }
};
</script>

<style lang="scss" scoped>
.md-icon {
    color: #000 !important;
}

.active {
    color: #ffa500 !important;
}
</style>
