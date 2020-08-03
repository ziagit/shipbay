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
              <label>First name</label>
              <md-input type="text" v-model="form.first_name" placeholder="First name" required></md-input>
            </md-field>
            <md-field>
              <label>Last name</label>
              <md-input type="text" v-model="form.last_name" placeholder="Last name" required></md-input>
            </md-field>
            <md-field>
              <label>Address</label>
              <md-input type="text" v-model="form.address" placeholder="Address" required></md-input>
            </md-field>
            <md-field>
              <label>Phone</label>
              <md-input type="tel" v-model="form.phone" placeholder="Phone" required></md-input>
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
                @input="getStates($event)"
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
                @input="getCities($event)"
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
                @input="getCityZip($event)"
              >
                <md-option v-for="city in cityList" :key="city.id" :value="city.id">{{city.name}}</md-option>
              </md-select>
            </md-field>

            <md-field v-if="citycodeList != null">
              <md-select
                v-model="form.citycode"
                name="citycode"
                id="citycode"
                placeholder="Postal code"
                required
              >
                <md-option
                  v-for="code in citycodeList"
                  :key="code.id"
                  :value="code.id"
                >{{code.postal_code}}</md-option>
              </md-select>
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
import Axios from "axios";
import CONFIG from "../../../../config";
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
    config: CONFIG,
  }),
  methods: {
    imageOnChange(e) {
      this.logo = e.target.files[0];
    },
    submit() {
      let token = localStorage.getItem("token");
      let fd = new FormData();
      fd.append("logo", this.form.logo);
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

      Axios.post("add-carrier", fd, {
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
    getCountries() {
      Axios.get(this.config.baseUrl + "countries")
        .then((res) => {
          this.countryList = res.data;
          console.log("countries : ", this.countryList);
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    getStates(countryId) {
      this.stateList = null;
      this.countryList.forEach((element) => {
        if (element.id == countryId) {
          this.stateList = element.state_list;
        }
      });
    },
    getCities(stateId) {
      this.cityList = null;
      this.stateList.forEach(element => {
        if(element.id == stateId){
          this.cityList = element.city_list
        }
      });
    },
    getCityZip(id) {
      this.citycodeList = null;
      this.cityList.forEach(element => {
        if(element.id == id){
          this.citycodeList = element.citycodes
        }
      });
    },
  },
  created() {
    this.getCountries();
  },
  components: {},
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