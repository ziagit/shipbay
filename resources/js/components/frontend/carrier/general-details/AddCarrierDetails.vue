<template>
  <div>
    <form @submit.prevent="submit" enctype="multipart/form-data">
      <md-card class="main-card">
        <div class="carrier-logo" v-if="hasCompany">
          <md-avatar class="md-large">
            <md-field>
              <md-tooltip>Select logo</md-tooltip>
              <md-file
                v-model="form.logo"
                name="logo"
                accept="image/*"
                ref="logo"
                @change="onChange"
              />
            </md-field>
          </md-avatar>
        </div>
        <div class="inputs-container">
          <div class="row">
            <md-field>
              <md-input type="text" v-model="form.first_name" placeholder="First name" required ref="focusable"></md-input>
            </md-field>
            <md-field>
              <md-input type="text" v-model="form.last_name" placeholder="Last name" required></md-input>
            </md-field>
            <md-field>
              <md-input type="tel" v-model="form.phone" placeholder="Phone" required></md-input>
            </md-field>
            <md-field>
              <md-input type="text" v-model="form.address" placeholder="Address" required></md-input>
            </md-field>
          </div>
          <div class="row">
            <md-field>
              <md-select
                v-model="form.country"
                name="country"
                id="country"
                placeholder="Country"
                required
                @input="states($event)"
              >
                <md-option
                  v-for="country in countryList"
                  :value="country.id"
                  :key="country.id"
                >{{country.name}}</md-option>
              </md-select>
            </md-field>

            <md-field v-if="stateList != null">
              <md-select
                v-model="form.state"
                name="state"
                id="state"
                placeholder="State"
                required
                @input="cities($event)"
              >
                <md-option
                  v-for="state in stateList"
                  :key="state.id"
                  :value="state.id"
                >{{state.name}}</md-option>
              </md-select>
            </md-field>

            <md-field v-if="cityList != null">
              <md-select
                v-model="form.city"
                name="city"
                id="city"
                placeholder="City"
                required
                @input="zips($event)"
              >
                <md-option v-for="city in cityList" :key="city.id" :value="city.id">{{city.name}}</md-option>
              </md-select>
            </md-field>
            <md-field>
              <md-input type="number" v-model="form.citycode" placeholder="Postalcode" required></md-input>
            </md-field>
          </div>
          <md-switch v-model="hasCompany" class="md-primary">Do you have a company?</md-switch>
          <div class="company" v-if="hasCompany">
            <div class="row">
              <md-field>
                <label>Company Name</label>
                <md-input v-model="form.company" placeholder="Company name" :required="hasCompany"></md-input>
              </md-field>
              <md-field>
                <label>Website</label>
                <md-input type="url" v-model="form.website" placeholder="Website (optional)"></md-input>
              </md-field>
            </div>
            <div class="row">
              <md-field>
                <label>About your company</label>
                <md-textarea v-model="form.detail" :required="hasCompany"></md-textarea>
              </md-field>
            </div>
          </div>
        </div>
        <md-button type="submit" class="md-primary md-small-fab">Save</md-button>
      </md-card>
    </form>
    <Snackbar :data="snackbar" />
  </div>
</template>

<script>
import axios from "axios";
import Snackbar from "../../shared/Snackbar";
export default {
  name: "AddGeneralInfo",
  data: () => ({
    form: {
      first_name: null,
      last_name: null,
      address: null,
      country: null,
      state: null,
      city: null,
      citycode: null,
      phone: null,
      website: null,
      company: null,
      detail: null,
    },
    logo: null,

    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
    countryList: null,
    stateList: null,
    cityList: null,
    citycodeList: null,
    hasCompany: false,
  }),
  methods: {
    onChange(e) {
      this.logo = e.target.files[0];
    },
    submit() {
      let fd = new FormData();
      fd.append("logo", this.logo);
      fd.append("first_name", this.form.first_name);
      fd.append("last_name", this.form.last_name);
      fd.append("address", this.form.address);
      fd.append("country", this.form.country);
      fd.append("state", this.form.state);
      fd.append("city", this.form.city);
      fd.append("citycode", this.form.citycode);
      fd.append("phone", this.form.phone);
      fd.append("website", this.form.website);
      fd.append("company", this.form.company);
      fd.append("detail", this.form.detail);
      axios
        .post("carrier/details", fd)
        .then((res) => {
          console.log(">> ", res.data);
          this.$router.push("/carrier");
        })
        .catch((error) => {
          console.log("eerrr: ", error.response);
          this.snackbar.message = error.response.data.errors;
          this.snackbar.statusCode = error.response.status;
          this.snackbar.show = true;
        });
    },

    countries() {
      axios
        .get("countries-with-states")
        .then((res) => {
          this.countryList = res.data;
          console.log("countries : ", this.countryList);
        })
        .catch((err) => {
          console.log("Error: ", err);
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
    this.countries();
  },
  components: {
    Snackbar,
  },
};
</script>

<style lang="scss" scoped>
.main-card {
  padding: 30px;
  text-align: center;
  box-shadow: none;
  border: solid 1px #ddd;
  .carrier-logo {
    text-align: center;
    margin-top: -40px;
    .md-large {
      background: #ddd;
    }
  }
  .inputs-container {
    .row {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      .md-field {
        flex: 25%;
      }
    }
  }
}
</style>