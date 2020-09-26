<template>
  <div>
    <md-dialog-confirm
      :md-active.sync="active"
      md-title="Do you whant to delete?"
      md-content="Make sure it's not an Accident"
      md-confirm-text="Agree"
      md-cancel-text="Disagree"
      @md-cancel="cancel"
      @md-confirm="confirm"
    />
        <!-- edit dialog -->
    <md-dialog :md-active.sync="editTogal">
      <md-dialog-title>Update accessory data</md-dialog-title>
      <md-dialog-content>
        <EditCarrierAccessory v-on:close-dialog="refresh" :accessory="accessory" />
      </md-dialog-content>
    </md-dialog>
    <!-- add dialog -->
    <md-dialog :md-active.sync="addTogal">
      <md-dialog-title>Add new accessory</md-dialog-title>
      <md-dialog-content>
        <AddCarrierAccessory v-on:close-dialog="refresh" />
      </md-dialog-content>
    </md-dialog>

    <md-card>
      <md-card-header>
        <div class="md-title">Accessories</div>
            <md-button
          @click="add()"
          class="md-icon-button add-btn"
          v-show="accessories"
        >
          <md-icon>add</md-icon>
          <md-tooltip>Add new accessory</md-tooltip>
        </md-button>
      </md-card-header>

      <md-card-content>
        <table class="table" v-if="accessories">
          <thead>
            <tr>
              <th rowspan="2">NAME</th>
              <th colspan="2">PRICES</th>
              <th colspan="2" rowspan="2">ACTIONS</th>
            </tr>
            <tr>
              <th scope="col">Origin</th>
              <th scope="col">Destination</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="accessory in accessories" :key="accessory.id">
              <td>{{accessory.name}}</td>
              <td>
                <span v-show="accessory.pivot.src_value != 0">${{accessory.pivot.src_value}}</span>
              </td>
              <td>${{accessory.pivot.des_value}}</td>
              <td>
                <md-button
                  @click="edit(accessory)"
                  class="md-primay md-icon-button"
                >
                  <md-icon>edit</md-icon>
                  <md-tooltip>Edit Accessory</md-tooltip>
                </md-button>
              </td>
              <td>
                <md-button class="md-icon-button md-accent" @click="remove(accessory.id)">
                  <md-icon>delete</md-icon>
                  <md-tooltip>Delete accessory</md-tooltip>
                </md-button>
              </td>
            </tr>
          </tbody>
        </table>
        <md-empty-state
          v-else
          class="md-primary"
          md-icon="sentiment_satisfied_alt"
          md-label="Not available"
          md-description="Click + icon to add"
        >
          <md-button to="add" class="md-icon-button md-raised">
            <md-icon>add</md-icon>
            <md-tooltip>Add new accessory</md-tooltip>
          </md-button>
        </md-empty-state>
      </md-card-content>
    </md-card>
  </div>
</template>
<script>
import EditCarrierAccessory from './EditCarrierAccessory'
import AddCarrierAccessory from './AddCarrierAccessory'
import axios from "axios";
export default {
  name: "Accessory",
  data: () => ({
    active: false,
    acsIdToDelete: null,
    accessories: null,
    accessory:null,
    dataLoaded: false,
      addTogal: false,
    editTogal: false,
  }),
  methods: {
    get() {
      axios
        .get("admin/carrier/accessories/"+this.$route.params.id)
        .then((res) => {
            console.log('accessories:', res.data)
          this.accessories = res.data.accessories;
        })
        .catch((err) => {
          console.log(err);
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
      this.accessory = data;
    },
    remove(id) {
      this.active = true;
      this.acsIdToDelete = id;
    },
    confirm() {
      axios
        .delete("admin/carrier/accessories/"+this.$route.params.id+"/"+ this.acsIdToDelete)
        .then((res) => {
          this.$emit("show-snackbar");
          this.get();
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    cancel() {
      this.value = "Disagreed";
    },
  },
  created() {
    this.get();
  },
  components:{
      EditCarrierAccessory,
      AddCarrierAccessory
  }
};
</script>
<style lang="scss" scoped>
.md-card {
  text-align: center;
  .md-card-content {
    overflow-x: auto;
  }

  .table {
    width: 100%;
    border-collapse: collapse;
    th{
      font-size: 11px;
      color: #666;
    }
    th,
    td {
      border: 1px solid #ddd;
    }
  }
    .add-btn {
    position: absolute;
    top: 0;
    right: 0;
  }
}
</style>