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
          <h1 class="md-title">Users</h1>
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
        <md-table-head>Name</md-table-head>
        <md-table-head>Email</md-table-head>
        <md-table-head>Roles</md-table-head>
      </md-table-row>
      <md-table-row v-for="user in users.data" :key="user.id">
        <md-table-cell md-numeric>{{ user.id }}</md-table-cell>
        <md-table-cell  >{{ user.name }}</md-table-cell>
        <md-table-cell  >{{ user.email }}</md-table-cell>
        <md-table-cell>{{ user.roles[0].name }}</md-table-cell>

        <md-table-cell md-label="Actions">
          <md-button class="md-icon-button md-primary" @click="edit(user)">
            <md-icon>edit</md-icon>
          </md-button>
          <md-button class="md-icon-button md-accent" @click="remove(user.id)">
            <md-icon>delete</md-icon>
          </md-button>
        </md-table-cell>
      </md-table-row>
      
    </md-table>
    <pagination :limit="4" :data="users" @pagination-change-page="get"></pagination>
  </div>
</template>

<script>

import axios from "axios";


export default {
  name: "user",
  data: () => ({
    keywords: null,
    users: null,
    user: null,
    addTogal: false,
    editTogal: false,
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
        .get("admin/search-user", { params: { keywords: this.keywords } })
        .then((res) => {
          this.users = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    get(page=1) {
      axios
        .get("admin/users?page="+page)
        .then((res) => {
          this.users = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },

    add() {
      this.addTogal = true;
      this.stateData = this.states;
    },
    refresh() {
      this.addTogal = false;
      this.editTogal = false;
      this.get();
    },
    edit(data) {
      this.editTogal = true;
      this.user = data;
    },
    remove(id) {
      this.deleteTogal = true;
      this.selectedId = id;
    },

    confirm() {
      axios
        .delete("admin/users/" + this.selectedId)
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
  }
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