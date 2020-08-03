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
      <md-dialog-title>Update carrier data</md-dialog-title>
      <md-dialog-content>
        <EditCarrierList v-on:close-dialog="refresh" :cityData="cityData" :stateData="stateData" />
      </md-dialog-content>
    </md-dialog>

    <md-table v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header>
      <md-table-toolbar>
        <div class="md-toolbar-section-start">
          <h1 class="md-title">Carrier</h1>
        </div>

        <md-field md-clearable class="md-toolbar-section-end">
          <md-input placeholder="Search by name..." v-model="search" @input="searchOnTable" />
        </md-field>
      </md-table-toolbar>

      <md-table-empty-state
        md-label="No state found"
        :md-description="`No state found for this '${search}' query. Try a different search term or create a new state.`"
      >
        <md-button class="md-primary md-raised" @click="addData()">Create new city</md-button>
      </md-table-empty-state>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
        <md-table-cell md-label="Name" md-sort-by="name">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Postal code" md-sort-by="postal_Code">
          <span v-for="code in item.citycodes" :key="code.id">{{code.postal_code}},</span>
        </md-table-cell>
        <md-table-cell md-label="State" md-sort-by="country_id">{{ item.state.name }}</md-table-cell>
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
  </div>
</template>

<script>
import CONFIG from "../../../config";
import EditCarrierList from "./EditCarrierList";
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
  name: "CarrierList",
  data: () => ({
    search: null,
    searched: [],
    users: [
      {
        id: 1,
        name: "Afghanistan",
        code: "AF"
      },
      {
        id: 2,
        name: "India",
        code: "IN"
      },
      {
        id: 3,
        name: "Iran",
        code: "IR"
      },
      {
        id: 4,
        name: "Tajikistan",
        code: "TK"
      }
    ],
    states: [],
    states: [],
    editDialog: false,
    deleteDialog: false,
    selectedId: 0,
    cityData: {},
    stateData: [],
    config: CONFIG
  }),
  methods: {
    newUser() {
      window.alert("Noop");
    },
    searchOnTable() {
      this.searched = searchByName(this.users, this.search);
    },

    getData() {
      Axios.get("admin/carrier")
        .then(res => {
          this.searched = res.data.cities;
          this.states = res.data.states;
          console.log("eee: ", res.data);
        })
        .catch(err => {
          console.log("Error: ", err);
        });
    },

    refresh() {
      this.addDialog = false;
      this.editDialog = false;
      this.getData();
    },
    editData(data) {
      this.editDialog = true;
      this.cityData = data;
      this.stateData = this.states;
    },
    deleteData(id) {
      this.deleteDialog = true;
      this.selectedId = id;
    },

    onConfirm() {
      Axios.delete("admin/carrier/delete/" + this.selectedId)
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
    /* this.searched = this.users; */
  },

  components: {
    EditCarrierList
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