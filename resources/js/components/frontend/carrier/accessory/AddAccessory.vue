<template>
  <div>
    <form @submit.prevent="submit" enctype="multipart/form-data">
      <md-card>
        <md-card-header>
          <div class="md-title">Add accessories</div>
          <md-button @click="$router.back()" class="md-icon-button add-btn">
            <md-icon>close</md-icon>
            <md-tooltip>Cancel</md-tooltip>
          </md-button>
        </md-card-header>

        <md-card-content>
          <table class="table">
            <thead>
              <tr>
                <th rowspan="2">Name</th>
                <th colspan="2">PRICES</th>
              </tr>
              <tr v-show="acType">
                <th>Origin</th>
                <th>Destination</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <md-field>
                    <label for="name">Name</label>
                    <md-select
                      v-model="form.name"
                      name="name"
                      id="name"
                      md-dense
                      required
                      @input="onInput($event)"
                    >
                      <md-option
                        v-for="accessory in accessories"
                        :key="accessory.id"
                        :value="accessory.id"
                      >{{accessory.name}}</md-option>
                    </md-select>
                  </md-field>
                </td>
                <td v-show="acType">
                  <md-field>
                    <label>($)</label>
                    <md-input v-model="form.srcValue"></md-input>
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>($)</label>
                    <md-input v-model="form.desValue" required></md-input>
                  </md-field>
                </td>
              </tr>
            </tbody>
          </table>
        </md-card-content>
        <md-card-actions>
          <md-button type="submit" class="md-primary md-small-fab">Save</md-button>
        </md-card-actions>
      </md-card>
    </form>
    <md-snackbar
      class="required-feild-error"
      :md-position="snackbar.position"
      :md-duration="snackbar.isInfinity ? Infinity : snackbar.duration"
      :md-active.sync="snackbar.show"
      md-persistent
    >
      <span>{{snackbar.message}}</span>
      <span style="color:red">Status: {{snackbar.errorStatus}}</span>
    </md-snackbar>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  name: "AddAccessory",
  data: () => ({
    form: {
      name: null,
      srcValue: null,
      desValue: null,
      carrierId: null,
    },
    snackbar: {
      show: false,
      position: "center",
      duration: 5000,
      isInfinity: false,
      message: null,
      errorStatus: null,
    },
    accessories: null,
    acType: true,
  }),
  computed: {
    ...mapGetters({
      temp: "shared/temp",
    }),
  },
  methods: {
    submit() {
      if (this.form.name == 7 || this.form.name == 8 || this.form.name == 9) {
        if (this.form.srcValue == null) {
          this.form.srcValue = 0;
        }
      }
      axios
        .post("carrier/accessories", this.form)
        .then((res) => {
          this.$router.back();
          this.$emit("show-snackbar");
        })
        .catch((error) => {
          this.snackbar.show = true;
          this.snackbar.message = error.response.data.message;
          this.snackbar.errorStatus = error.response.status;
        });
    },

    get() {
      axios
        .get("carrier/accessories-lookup")
        .then((res) => {
          console.log("list of acc", res.data);
          this.accessories = res.data;
        })
        .catch((err) => {
          console.log("error: ", err);
        });
    },
    onInput(e) {
      if (e == 7 || e == 8 || e == 9) {
        this.acType = false;
      }
      console.log("your event: ", e);
    },
  },
  created() {
    this.form.carrierId = this.temp.me;
    this.get();
  },
};
</script>

<style lang="scss" scoped>
.md-card {
  box-shadow: none;
  border: 1px solid #ddd;
  text-align: center;
  .carrier-logo {
    text-align: center;
    margin-top: -50px;
    .md-large {
      background: #ddd;
    }
  }
  .md-card-content {
    overflow-x: auto;
  }
  .table {
    width: 100%;
    border-collapse: collapse;
    th {
      font-size: 11px;
      color: #666;
    }
    th,
    td {
      border: 1px solid #ddd;
    }
    td {
      .md-field {
        margin: 0;
      }
    }
  }
  .add-btn {
    position: absolute;
    top: 0;
    right: 0;
  }
}
</style>