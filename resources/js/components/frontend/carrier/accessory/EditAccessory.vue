<template>
  <div>
    <form @submit.prevent="submit" enctype="multipart/form-data">
      <md-card>
        <md-card-header>
          <div class="md-title">Edit accessories</div>
          <md-button @click="$router.back()" class="md-icon-button add-btn">
            <md-icon>close</md-icon>
            <md-tooltip>Cancel</md-tooltip>
          </md-button>
        </md-card-header>

        <md-card-content>
          <table class="table">
            <thead>
              <tr>
                <th rowspan="2">NAME</th>
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
                    <md-input v-model="form.desValue"></md-input>
                  </md-field>
                </td>
              </tr>
            </tbody>
          </table>
        </md-card-content>
        <md-card-actions>
          <md-button type="submit" class="md-primary md-small-fab">Done</md-button>
        </md-card-actions>
      </md-card>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "EditAccessory",
  data: () => ({
    form: {
      name: null,
      srcValue: null,
      desValue: null
    },
    accessories: null,
    acType: true,
    carrierId:null,
  }),
  methods: {
    submit() {
      if (this.form.name == 6 || this.form.name == 7 || this.form.name == 8) {
        if (this.form.srcValue == null) {
          this.form.srcValue = 0;
        }
      }
      axios.post(
        "update-accessory/" + this.$route.params.id + "/" + this.carrierId,
        this.form
      )
        .then(res => {
          this.$emit("accessory-refresher");
          this.$router.back();
          this.$emit('show-snackbar');
        })
        .catch(err => {
          console.log("Error: ", err);
        });
    },

    edit() {
      axios.get(
        "edit-accessory/" + this.$route.params.id + "/" + this.carrierId
      )
        .then(res => {
          this.form.name = res.data.id;
          this.form.srcValue = res.data.pivot.src_value;
          this.form.desValue = res.data.pivot.des_value;
        })
        .catch(err => {
          console.log(err);
        });
    },
    get() {
      axios.get("get-accessories")
        .then(res => {
          this.accessories = res.data;
        })
        .catch(err => {
          console.log("error: ", err);
        });
    },
    onInput(e) {
      if (e == 6 || e == 7 || e == 8) {
        this.acType = false;
      }else{
        this.acType = true;
      }
    }
  },
  created() {
    this.carrierId = this.$store.state.shared.carrierData.carrierId;
    this.get();
    this.edit();
  }
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