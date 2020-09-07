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
    <!-- edit dialog -->
    <md-dialog :md-active.sync="editTogal">
      <md-dialog-title>Update accessory data</md-dialog-title>
      <md-dialog-content>
        <EditAccessory v-on:close-dialog="refresh" :accessory="accessory" />
      </md-dialog-content>
    </md-dialog>
    <!-- add dialog -->
    <md-dialog :md-active.sync="addTogal">
      <md-dialog-title>Add new accessory</md-dialog-title>
      <md-dialog-content>
        <AddAccessory v-on:close-dialog="refresh" />
      </md-dialog-content>
    </md-dialog>

    <md-table md-sort="name" md-sort-order="asc" md-card>
      <md-table-toolbar>
        <div class="md-toolbar-section-start">
          <h1 class="md-title">Accessories</h1>
        </div>

        <md-field md-clearable class="md-toolbar-section-end">
          <md-input placeholder="Search by name..." v-model="keywords" />
        </md-field>
      </md-table-toolbar>

      <md-table-empty-state
        md-label="No state found"
        :md-description="`No state found for this query. Try a different search term or create a new state.`"
      >
        <md-button class="md-primary md-raised" @click="add()">Create new accessory</md-button>
      </md-table-empty-state>
      <md-table-row>
        <md-table-head md-numeric>ID</md-table-head>
        <md-table-head>Name</md-table-head>
        <md-table-head>Code</md-table-head>
        <md-table-head>Actions</md-table-head>
      </md-table-row>
      <md-table-row v-for="accessory in accessories.data" :key="accessory.id">
        <md-table-cell md-numeric>{{ accessory.id }}</md-table-cell>
        <md-table-cell >{{ accessory.name }}</md-table-cell>
        <md-table-cell >{{ accessory.code }}</md-table-cell>

        <md-table-cell md-label="Actions">
          <md-button class="md-icon-button md-primary" @click="edit(accessory)">
            <md-icon>edit</md-icon>
          </md-button>
          <md-button class="md-icon-button md-accent" @click="remove(accessory.id)">
            <md-icon>delete</md-icon>
          </md-button>
        </md-table-cell>
      </md-table-row>
      
    </md-table>
    <pagination :limit="4" :data="accessories" @pagination-change-page="get"></pagination>
    <md-button class="md-fab md-primary add-btn" @click="add()">
      <md-icon>add</md-icon>
      <md-tooltip>Add new accessory</md-tooltip>
    </md-button>
  </div>
</template>

<script>
import AddAccessory from "./AddAccessory";
import EditAccessory from "./EditAccessory";
import axios from "axios";


export default {
  name: "accessory",
  data: () => ({
    keywords: null,
    accessories: null,
    accessory: null,
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
        .get("admin/search-accessory", { params: { keywords: this.keywords } })
        .then((res) => {
          this.accessories = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    get(page=1) {
      axios
        .get("admin/accessories?page="+page)
        .then((res) => {
          this.accessories = res.data;
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
      this.accessory = data;
    },
    remove(id) {
      this.deleteTogal = true;
      this.selectedId = id;
    },

    confirm() {
      axios
        .delete("admin/accessories/" + this.selectedId)
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

  components: {
    AddAccessory,
    EditAccessory,
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