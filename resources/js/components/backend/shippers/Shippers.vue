<template>
  <div class="main-container">
    <!-- delete dialog-->
    <md-dialog-confirm
      :md-active.sync="deleteTogal"
      md-title="I assure what you doing"
      md-content
      md-confirm-text="OK"
      md-cancel-text="Cancel"
      @md-confirm="confirm()"
      @md-cancel="cancel"
    />


    <md-table md-sort="name" md-sort-order="asc" md-card>
      <md-table-toolbar>
        <div class="md-toolbar-section-start">
          <h1 class="md-title">Shippers</h1>
        </div>

        <md-field md-clearable class="md-toolbar-section-end">
          <md-input placeholder="Search by name..." v-model="keywords" />
        </md-field>
      </md-table-toolbar>

      <md-table-empty-state
        md-label="No state found"
        :md-description="`No state found for this query. Try a different search term or create a new state.`"
      >
      </md-table-empty-state>
      <md-table-row>
        <md-table-head md-numeric>ID</md-table-head>
        <md-table-head>First name</md-table-head>
        <md-table-head>Last name</md-table-head>
        <md-table-head>Actions</md-table-head>
      </md-table-row>
      <md-table-row v-for="shipper in shippers.data" :key="shipper.id">
        <md-table-cell md-numeric>{{ shipper.id }}</md-table-cell>
        <md-table-cell>{{ shipper.first_name }}</md-table-cell>
        <md-table-cell>{{ shipper.last_name }}</md-table-cell>

        <md-table-cell md-label="Actions">
          <md-button class="md-icon-button md-accent" @click="remove(shipper.id)">
            <md-icon>delete</md-icon>
          </md-button>
        </md-table-cell>
      </md-table-row>
      
    </md-table>
    <pagination :limit="4" :data="shippers" @pagination-change-page="get"></pagination>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "shipper",
  data: () => ({
    keywords: null,
    shippers: null,
    shipper: null,
    deleteTogal: false,
  }),
  watch: {
    keywords(after, before) {
      this.search();
    },
  },
  methods: {
    search() {
      axios
        .get("admin/search-shipper", { params: { keywords: this.keywords } })
        .then((res) => {
          this.shippers = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    get(page=1) {
      axios
        .get("admin/shippers?page="+page)
        .then((res) => {
          this.shippers = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },

 
    refresh() {
      this.addTogal = false;
      this.editTogal = false;
      this.get();
    },

    remove(id) {
      this.deleteTogal = true;
      this.selectedId = id;
    },

    confirm() {
      axios
        .delete("admin/shippers/" + this.selectedId)
        .then((res) => {
          console.log("deleted", res.data);
          this.get();
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    cancel() {},
  },
  created() {
    this.get();
  },
};
</script>
<style scoped lang="scss">
.main-container {
  width: 100%;
  .add-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
  }
}

</style>