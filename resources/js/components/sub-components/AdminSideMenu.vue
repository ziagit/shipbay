<template>
  <div>
    <md-list :md-expand-single="expandSingle">
      <md-list-item to="/admin" @click="menuVisible = !menuVisible">
        <md-icon>dashboard</md-icon>
        <span class="md-list-item-text">Dashboard</span>
      </md-list-item>

      <md-list-item md-expand :md-expanded.sync="expandLookups">
        <md-icon>whatshot</md-icon>
        <span class="md-list-item-text">Lookups</span>
        <md-list slot="md-expand">
          <md-list-item
            class="md-inset"
            to="/admin/countries"
            @click="menuVisible = !menuVisible"
          >Country</md-list-item>
          <md-list-item
            class="md-inset"
            to="/admin/states"
            @click="menuVisible = !menuVisible"
          >States</md-list-item>
          <md-list-item
            class="md-inset"
            to="/admin/cities"
            @click="menuVisible = !menuVisible"
          >Cities</md-list-item>
          <md-list-item
            class="md-inset"
            to="/admin/zips"
            @click="menuVisible = !menuVisible"
          >Zip codes</md-list-item>
        </md-list>
      </md-list-item>

      <md-list-item md-expand :md-expanded.sync="expandCarriers">
        <md-icon>stars</md-icon>
        <span class="md-list-item-text">Carriers</span>
        <md-list slot="md-expand">
          <md-list-item
            class="md-inset"
            to="/admin/carriers"
            @click="menuVisible = !menuVisible"
          >Carriers</md-list-item>
          <md-list-item class="md-inset" to="/admin/rates" @click="menuVisible = !menuVisible">Rates</md-list-item>
          <md-list-item
            class="md-inset"
            to="/admin/accessories"
            @click="menuVisible = !menuVisible"
          >Accessories</md-list-item>
        </md-list>
      </md-list-item>
      <md-list-item md-expand :md-expanded.sync="expandShippers">
        <md-icon>stars</md-icon>
        <span class="md-list-item-text">Shippers</span>
        <md-list slot="md-expand">
          <md-list-item
            class="md-inset"
            to="/admin/shippers"
            @click="menuVisible = !menuVisible"
          >Shippers</md-list-item>
          <md-list-item
            class="md-inset"
            to="/admin/orders"
            @click="menuVisible = !menuVisible"
          >Orders</md-list-item>
        </md-list>
      </md-list-item>
      <md-list-item to="/admin/users" @click="menuVisible = !menuVisible">
        <md-icon>fire</md-icon>
        <span class="md-list-item-text">Users</span>
      </md-list-item>
      <md-list-item md-expand :md-expanded.sync="expandCompany">
        <md-icon>stars</md-icon>
        <span class="md-list-item-text">Company</span>
        <md-list slot="md-expand">
          <md-list-item class="md-inset" to="/admin/about" @click="menuVisible = !menuVisible">About</md-list-item>
          <md-list-item
            class="md-inset"
            to="/admin/contact"
            @click="menuVisible = !menuVisible"
          >Contact</md-list-item>
          <md-list-item
            class="md-inset"
            to="/admin/services"
            @click="menuVisible = !menuVisible"
          >Services</md-list-item>
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
};
</script>
<style lang="scss" scoped>
</style>