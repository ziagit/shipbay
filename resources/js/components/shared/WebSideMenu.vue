<template>
<div class="web-menu">
    <md-list :md-expand-single="expandSingle">
        <md-list-item to="/home" @click="hideMenu()">
            <md-icon>home</md-icon>
            <span class="md-list-item-text">Home</span>
        </md-list-item>
        <md-list-item to="/about" @click="hideMenu()">
            <md-icon>business</md-icon>
            <span class="md-list-item-text">About Us</span>
        </md-list-item>
        <md-list-item to="/contact" @click="hideMenu()">
            <md-icon>phone</md-icon>
            <span class="md-list-item-text">Contact Us</span>
        </md-list-item>
        <md-list-item to="/help" @click="hideMenu()">
            <md-icon>help</md-icon>
            <span class="md-list-item-text">How It Works</span>
        </md-list-item>
        <md-list-item to="/shippers" @click="hideMenu()">
            <md-icon>store_mall_directory</md-icon>
            <span class="md-list-item-text">Shippers</span>
        </md-list-item>
        <md-list-item to="/carriers" @click="hideMenu()">
            <md-icon>send</md-icon>
            <span class="md-list-item-text">Carriers</span>
        </md-list-item>

        <!-- <md-list-item to="/contact" @click="hideMenu()">
            <md-icon>call</md-icon>
            <span class="md-list-item-text">Contact Us</span>
        </md-list-item> -->
        <md-divider></md-divider>

        <md-list-item to="/login" @click="hideMenu()">
            <md-icon>login</md-icon>
            <span class="md-list-item-text">Sign In</span>
        </md-list-item>
        <md-list-item to="/register" @click="hideMenu()">
            <md-icon>add</md-icon>
            <span class="md-list-item-text">Sign Up</span>
        </md-list-item>
        <!--
        <md-list-item to="/facebook" @click="hideMenu()">
            <md-icon>facebook</md-icon>
            <span class="md-list-item-text">Facebook</span>
        </md-list-item>

        <md-list-item to="/twitter" @click="hideMenu()">
            <md-icon>mood</md-icon>
            <span class="md-list-item-text">Twitter</span>
        </md-list-item>

        <md-list-item to="/instagram" @click="hideMenu()">
            <md-icon>mood</md-icon>
            <span class="md-list-item-text">Instagram</span>
        </md-list-item>-->
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
    }),
    methods: {
        hideMenu() {
            this.$emit('hideSideMenu');
        }
    }
};
</script>

<style lang="scss" scoped>
</style>
