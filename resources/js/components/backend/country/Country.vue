<template>
  <div class="main-container">
    <!-- delete dialog-->
    <md-dialog-confirm
      :md-active.sync="deleteDialog"
      md-title="I assure what you doing"
      md-content
      md-confirm-text="OK"
      md-cancel-text="Cancel"
      @md-confirm="onConfirm()"
      @md-cancel="onCancel"
    />
    <!-- edit dialog -->
    <md-dialog :md-active.sync="editDialog">
      <md-dialog-title>Update Country Data</md-dialog-title>
      <md-dialog-content>
        <EditCountry v-on:close-dialog="refresh" :countryData="countryData" />
      </md-dialog-content>
    </md-dialog>
    <!-- add dialog -->
    <md-dialog :md-active.sync="addDialog">
      <md-dialog-title>Add new country</md-dialog-title>
      <md-dialog-content>
        <AddCountry v-on:close-dialog="refresh" />
      </md-dialog-content>
    </md-dialog>

    <md-table v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header>
      <md-table-toolbar>
        <div class="md-toolbar-section-start">
          <h1 class="md-title">Countries</h1>
        </div>

        <md-field md-clearable class="md-toolbar-section-end">
          <md-input placeholder="Search by name..." v-model="search" @input="searchOnTable" />
        </md-field>
      </md-table-toolbar>

      <md-table-empty-state
        md-label="No country found"
        :md-description="`No country found for this '${search}' query. Try a different search term or create a new country.`"
      >
        <md-button class="md-primary md-raised" @click="addData()">Create new country</md-button>
      </md-table-empty-state>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
        <md-table-cell md-label="Name" md-sort-by="name">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Code" md-sort-by="email">{{ item.code }}</md-table-cell>
        <md-table-cell md-label="Actions">
          <md-button class="md-icon-button md-primary" @click="editData(item)">
            <md-icon>edit</md-icon>
          </md-button>
          <md-button class="md-icon-button md-accent" @click="deleteData(item.id)">
            <md-icon>delete</md-icon>
          </md-button>
        </md-table-cell>
      </md-table-row>
    </md-table>
    <md-button class="md-fab md-primary add-btn" @click="addData()">
      <md-icon>add</md-icon>
      <md-tooltip>Add new country</md-tooltip>
    </md-button>
  </div>
</template>

<script>
import AddCountry from "./AddCountry";
import EditCountry from "./EditCountry";
import Axios from "axios";

const toLower = text => {
  return text.toString().toLowerCase();
};

const searchByName = (items, term) => {
  if (term) {
    return items.filter(item => toLower(item.name).includes(toLower(term)));
  }
  return items;
};
export default {
  name: "CompanyAdmin",
  data: () => ({
    search: null,
    searched: [],
    users: [
      {
        id: 1,
        name: "Canada",
        code: "CA"
      },
      {
        id: 2,
        name: "Austereial",
        code: "AS"
      },
      {
        id: 3,
        name: "Jarmany",
        code: "JR"
      },
      {
        id: 4,
        name: "Austeria",
        code: "AT"
      }
    ],
    countries: [],
    addDialog: false,
    editDialog: false,
    deleteDialog: false,
    selectedId: 0,
    countryData: {}
  }),
  methods: {
    newUser() {
      window.alert("Noop");
    },
    searchOnTable() {
      this.searched = searchByName(this.users, this.search);
    },

    getData() {
      Axios.get("admin/country")
        .then(res => {
          this.searched = res.data;
          /* this.searched = res.data; */
          console.log("database countries: ", this.countries);
          console.log("static users: ", this.users);
        })
        .catch(err => {
          console.log("Error: ", err);
        });
    },

    addData() {
      this.addDialog = true;
    },
    refresh() {
      this.addDialog = false;
      this.editDialog = false;
      this.getData();
    },
    editData(data) {
      this.editDialog = true;
      this.countryData = data;
    },
    deleteData(id) {
      this.deleteDialog = true;
      this.selectedId = id;
    },

    onConfirm() {
      Axios.delete("admin/country/delete/" + this.selectedId)
        .then(res => {
          console.log("deleted", res.data);
          this.getData();
        })
        .catch(err => {
          console.log("Error: ", err);
        });
    },
    onCancel() {}
  },
  created() {
    this.getData();
    this.searched = this.users;
  },

  components: {
    AddCountry,
    EditCountry
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
.md-table-content {
  width: 100% !important;
}
</style>