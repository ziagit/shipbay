<template>
  <div class="rates" v-if="rates">
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
    <!--add -->
    <md-dialog :md-active.sync="addTogal">
      <md-dialog-title>Add New Rate</md-dialog-title>
      <md-dialog-content>
        <AddRate v-on:close-dialog="refresh" />
      </md-dialog-content>
    </md-dialog>
    <!--edit -->
    <md-dialog :md-active.sync="editTogal">
      <md-dialog-title>Update Rate</md-dialog-title>
      <md-dialog-content>
        <EditRate v-on:close-dialog="refresh" :rate="rate" />
      </md-dialog-content>
    </md-dialog>

    <md-table md-sort="name" md-sort-order="asc" md-card>
      <md-table-toolbar>
        <div class="md-toolbar-section-start">
          <h1 class="md-title">Rates</h1>
        </div>

        <md-field md-clearable class="md-toolbar-section-end">
          <md-input placeholder="Search by name..." v-model="keywords" />
        </md-field>
      </md-table-toolbar>

      <md-table-empty-state
        md-label="No state found"
        :md-description="`No state found for this query. Try a different search term or create a new state.`"
      ></md-table-empty-state>
      <div class="table-content">
        <md-table-row>
          <md-table-head md-numeric>ID</md-table-head>
          <md-table-head>Origin</md-table-head>
          <md-table-head>Destination</md-table-head>
          <md-table-head>Min Charge</md-table-head>
          <md-table-head>0K-1K</md-table-head>
          <md-table-head>1K-2K</md-table-head>
          <md-table-head>2K-3K</md-table-head>
          <md-table-head>3K-4K</md-table-head>
          <md-table-head>4K-5K</md-table-head>
          <md-table-head>5K-10K</md-table-head>
          <md-table-head>Above-10K</md-table-head>
          <md-table-head>FSC%</md-table-head>
          <md-table-head>Transit Day</md-table-head>
          <md-table-head>Carrier</md-table-head>
          <md-table-head>Actions</md-table-head>
        </md-table-row>
        <md-table-row v-for="rate in rates.data" :key="rate.id">
          <md-table-cell md-numeric>{{ rate.id }}</md-table-cell>
          <md-table-cell>{{ rate.addresses[0].city }}</md-table-cell>
          <md-table-cell>{{ rate.addresses[1].city }}</md-table-cell>
          <md-table-cell>{{ rate.min_rate }}</md-table-cell>
          <md-table-cell>{{ rate._0k_1k }}</md-table-cell>
          <md-table-cell>{{ rate._1k_2k }}</md-table-cell>
          <md-table-cell>{{ rate._2k_3k }}</md-table-cell>
          <md-table-cell>{{ rate._3k_4k }}</md-table-cell>
          <md-table-cell>{{ rate._4k_5k }}</md-table-cell>
          <md-table-cell>{{ rate._5k_10k }}</md-table-cell>
          <md-table-cell>{{ rate.above_10k }}</md-table-cell>
          <md-table-cell>{{ rate.fsc }}</md-table-cell>
          <md-table-cell>{{ rate.transit_day }}</md-table-cell>
          <!--<md-table-cell v-if="rate.carriers[0].company">{{
            rate.carriers[0].company
          }}</md-table-cell>
          <md-table-cell v-else>{{ rate.carriers[0].first_name }}</md-table-cell>
-->
          <md-table-cell md-label="Actions">
            <md-button class="md-icon-button md-primary" @click="edit(rate)">
              <md-icon>edit</md-icon>
            </md-button>
            <md-button class="md-icon-button md-accent" @click="remove(rate.id)">
              <md-icon>delete</md-icon>
            </md-button>
          </md-table-cell>
        </md-table-row>
      </div>
    </md-table>
    <pagination :limit="4" :data="rates" @pagination-change-page="get"></pagination>
  </div>
</template>

<script>
import axios from "axios";
import AddRate from "./AddRate";
import EditRate from "./EditRate";
export default {
  name: "rate",
  data: () => ({
    keywords: null,
    rates: null,
    rate: null,
    deleteTogal: false,
    addTogal: false,
    editTogal: false,
  }),
  watch: {
    keywords(after, before) {
      this.search();
    },
  },
  methods: {
    search() {
      axios
        .get("admin/search-rate", {
          params: {
            keywords: this.keywords,
          },
        })
        .then((res) => {
          this.rates = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    get(page = 1) {
      axios
        .get("admin/rates?page=" + page)
        .then((res) => {
          this.rates = res.data;
          console.log("rates ", res.data.data);
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },

    add() {
      this.addTogal = true;
    },
    refresh() {
      this.addTogal = false;
      this.editTogal = false;
      this.get();
    },
    edit(data) {
      this.editTogal = true;
      this.rate = data;
    },
    remove(id) {
      this.deleteTogal = true;
      this.selectedId = id;
    },

    confirm() {
      axios
        .delete("admin/rates/" + this.selectedId)
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
    AddRate,
    EditRate,
  },
};
</script>

<style lang="scss" scoped>
.rates {
  width: 100%;

  .add-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
  }
}
</style>
