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
                v-on:change="imageOnChange($event)"
              />
            </md-field>
          </md-avatar>
        </div>
        <div class="carrier-details">
          <div class="row">
            <md-field>
              <md-input type="text" v-model="form.first_name" placeholder="First name" required></md-input>
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
                <md-input v-model="form.company" placeholder="Company name"></md-input>
              </md-field>
              <md-field>
                <label>Website</label>
                <md-input type="url" v-model="form.website" placeholder="Website"></md-input>
              </md-field>
            </div>
            <div class="row">
              <md-field>
                <label>About your company</label>
                <md-textarea v-model="form.detail"></md-textarea>
              </md-field>
            </div>
          </div>
        </div>
        <md-button type="submit" class="md-primary md-small-fab">Save</md-button>
      </md-card>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "AddGeneralInfo",
  data: () => ({
    form: {
      logo: null,
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
    countryList: null,
    stateList: null,
    cityList: null,
    citycodeList: null,
    hasCompany: false,
  }),
  methods: {
    imageOnChange(e) {
      this.logo = e.target.files[0];
    },
    submit() {
      let token = localStorage.getItem("token");
      axios
        .post("carrier/details", this.form, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
        .then((res) => {
          this.$router.push("/carrier");
        })
        .catch((err) => {
          console.log("Error: ", err);
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
      this.stateList = null;
      this.countryList.forEach((element) => {
        if (element.id == countryId) {
          this.stateList = element.state_list;
        }
      });
    },
    cities(stateId) {
      this.cityList = null;
      this.stateList.forEach((element) => {
        if (element.id == stateId) {
          this.cityList = element.city_list;
        }
      });
    },
    zips(id) {
      this.citycodeList = null;
      this.cityList.forEach((element) => {
        if (element.id == id) {
          this.citycodeList = element.citycodes;
        }
      });
    },
  },
  created() {
    this.countries();
  },
};
</script>

<style lang="scss" scoped>
.main-card {
  padding: 30px;
  margin-top: 60px;
  text-align: center;
  box-shadow: none;
  border: solid 1px #ddd;
  .carrier-logo {
    text-align: center;
    margin-top: -50px;
    .md-large {
      background: #ddd;
    }
  }
  .carrier-details {
    .row {
      display: flex;
      justify-content: space-between;
    }
  }
}
</style>