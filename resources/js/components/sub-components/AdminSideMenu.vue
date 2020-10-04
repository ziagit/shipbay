<template>
<div>
    <md-list :md-expand-single="expandSingle">
        <md-list-item to="/admin" @click="hideMenu()">
            <md-icon>dashboard</md-icon>
            <span class="md-list-item-text">Dashboard</span>
        </md-list-item>

        <md-list-item md-expand :md-expanded.sync="expandLookups">
            <md-icon>whatshot</md-icon>
            <span class="md-list-item-text">Lookups</span>
            <md-list slot="md-expand">
                <md-list-item class="md-inset" to="/admin/countries" @click="hideMenu()">Country</md-list-item>
                <md-list-item class="md-inset" to="/admin/states" @click="hideMenu()">States</md-list-item>
                <md-list-item class="md-inset" to="/admin/cities" @click="hideMenu()">Cities</md-list-item>
                <md-list-item class="md-inset" to="/admin/zips" @click="hideMenu()">Zip codes</md-list-item>
                <md-list-item class="md-inset" to="/admin/accessories" @click="hideMenu()">Accessories</md-list-item>
                <md-list-item class="md-inset" to="/admin/rate-ranges" @click="hideMenu()">Rate ranges</md-list-item>
            </md-list>
        </md-list-item>

        <md-list-item md-expand :md-expanded.sync="expandCarriers">
            <md-icon>stars</md-icon>
            <span class="md-list-item-text">Carriers</span>
            <md-list slot="md-expand">
                <md-list-item class="md-inset" to="/admin/carriers" @click="hideMenu()">Carriers</md-list-item>
                <md-list-item class="md-inset" to="/admin/rates" @click="hideMenu()">Rates</md-list-item>
                <md-list-item class="md-inset" to="/admin/carrier/accessories" @click="hideMenu()">Accessories</md-list-item>
            </md-list>
        </md-list-item>
        <md-list-item md-expand :md-expanded.sync="expandShippers">
            <md-icon>stars</md-icon>
            <span class="md-list-item-text">Shippers</span>
            <md-list slot="md-expand">
                <md-list-item class="md-inset" to="/admin/shippers" @click="hideMenu()">Shippers</md-list-item>
                <md-list-item class="md-inset" to="/admin/orders" @click="hideMenu()">Orders</md-list-item>
            </md-list>
        </md-list-item>
        <md-list-item to="/admin/users" @click="hideMenu()">
            <md-icon>fire</md-icon>
            <span class="md-list-item-text">Users</span>
        </md-list-item>
        <md-list-item md-expand :md-expanded.sync="expandCompany">
            <md-icon>stars</md-icon>
            <span class="md-list-item-text">Company</span>
            <md-list slot="md-expand">
                <md-list-item class="md-inset" to="/admin/about" @click="hideMenu()">About</md-list-item>
                <md-list-item class="md-inset" to="/admin/contact" @click="hideMenu()">Contact</md-list-item>
                <md-list-item class="md-inset" to="/admin/services" @click="hideMenu()">Services</md-list-item>
            </md-list>
        </md-list-item>
    </md-list>
</div>
</template>

<script>
export default {
    name: "AdminMenu",
    data: () => ({
        expandCompany: false,
        expandShippers: false,
        expandLookups: false,
        expandCarriers: false,
        expandSingle: false,
        menuVisible: false,
    }),
    methods: {
        hideMenu() {
            this.$emit("hideSideMenu");
        },
    },
};
</script>

<style lang="scss" scoped>
</style>
