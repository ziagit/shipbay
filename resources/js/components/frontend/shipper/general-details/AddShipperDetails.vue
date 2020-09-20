<template>
  <div class="add-shipper">
    <md-card class="no-shadow-bordered">
      <md-card-header>
        <div class="md-title">Add shipper details</div>
        <md-button @click="$router.back()" class="md-icon-button close-btn">
          <md-icon>close</md-icon>
          <md-tooltip>Cancel</md-tooltip>
        </md-button>
      </md-card-header>

      <md-card-content>
        <form @submit.prevent="submit">
          <div class="row">
            <md-field>
              <label>First name</label>
              <md-input v-model="form.firstName" required ref="focusable"></md-input>
            </md-field>
            <md-field>
              <label>Last name</label>
              <md-input v-model="form.lastName" required></md-input>
            </md-field>
            <md-field>
              <label>Address</label>
              <md-input v-model="form.address" required></md-input>
            </md-field>
            <md-field>
              <label>Phone</label>
              <md-input v-model="form.phone" required></md-input>
            </md-field>
          </div>

          <div class="row">
            <md-field>
              <md-select
                v-model="form.country"
                name="country"
                id="country"
                placeholder="Country"
                @input="states($event)"
              >
                <md-option
                  v-for="country in countryList"
                  :value="country.id"
                  :key="country.id"
                >{{country.name}}</md-option>
              </md-select>
              <input class="hidden-input" v-model="form.country" required />
            </md-field>
            <md-field v-if="stateList != null">
              <md-select
                v-model="form.state"
                name="state"
                id="state"
                placeholder="State"
                @input="cities($event)"
              >
                <md-option
                  v-for="state in stateList"
                  :key="state.id"
                  :value="state.id"
                >{{state.name}}</md-option>
              </md-select>
              <input class="hidden-input" v-model="form.state" required />
            </md-field>
            <md-field v-if="cityList != null">
              <md-select
                v-model="form.city"
                name="city"
                id="city"
                placeholder="City"
                @input="zips($event)"
              >
                <md-option v-for="city in cityList" :key="city.id" :value="city.id">{{city.name}}</md-option>
              </md-select>
              <input class="hidden-input" v-model="form.city" required />
            </md-field>
            <md-field>
              <label>Postalcode</label>
              <md-input v-model="form.citycode" required></md-input>
            </md-field>
          </div>
          <md-button type="submit">Save</md-button>
        </form>
      </md-card-content>
    </md-card>
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
export default {
  name: "ShipperGeneralInfo",
  data: () => ({
    form: {
      firstName: null,
      lastName: null,
      address: null,
      city: null,
      state: null,
      citycode: null,
      country: null,
      phone: null,
    },
    countryList: null,
    stateList: null,
    cityList: null,
    citycodeList: null,
    snackbar: {
      show: false,
      position: "center",
      duration: 5000,
      isInfinity: false,
      message: null,
      errorStatus: null,
    },
  }),
  methods: {
    submit() {
      axios
        .post("shipper/details", this.form)
        .then((res) => {
          if (localStorage.getItem("cRoute") === "/order/select-carrier") {
            this.$router.push("/shipment/additional-details");
          } else {
            this.$router.push(this.$route.query.redirect || "/shipper");
          }
        })
        .catch((error) => {
          this.snackbar.show = true;
          this.snackbar.message = error.response.data.errors;
          this.snackbar.errorStatus = error.response.status;
        });
    },
    getCountries() {
      axios
        .get("countries-with-states")
        .then((res) => {
          this.countryList = res.data;
        })
        .catch((error) => {
          console.log("Error: ", error);
        });
    },
    states(countryId) {
      this.form.state = null;
      this.countryList.forEach((element) => {
        if (element.id == countryId) {
          this.stateList = element.state_list;
        }
      });
    },
    cities(stateId) {
      this.form.city = null;
      this.stateList.forEach((element) => {
        if (element.id == stateId) {
          this.cityList = element.city_list;
        }
      });
    },
    zips(id) {
      this.form.citycode = null;
      /*       this.cityList.forEach((element) => {
        if (element.id == id) {
          this.citycodeList = element.citycodes;
        }
      }); */
    },
  },
  mounted() {
    this.$refs.focusable.$el.focus();
  },
  created() {
    this.getCountries();
  },
};
</script>
<style lang="scss" scoped>
.md-card {
  padding: 30px;
  text-align: center;
  .card-container {
    margin: auto;
    max-width: 600px;
  }
  .row {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    .md-field {
      flex: 25%;
    }
  }
  .md-display-1 {
    font-size: 30px;
  }
  .close-btn {
    position: absolute;
    top: 0;
    right: 0;
  }
}
</style>