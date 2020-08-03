<template>
  <div>
    <form @submit.prevent="update" enctype="multipart/form-data">
      <md-card class="main-card">
        <md-button @click="$router.back()" class="md-icon-button add-btn">
          <md-icon>close</md-icon>
          <md-tooltip>Cancel</md-tooltip>
        </md-button>
        <div class="carrier-logo">
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
              <md-input v-model="form.first_name" placeholder="First name"></md-input>
            </md-field>
            <md-field>
              <label>Last name</label>
              <md-input v-model="form.last_name" placeholder="Last name"></md-input>
            </md-field>
            <md-field>
              <label>Address</label>
              <md-input v-model="form.address" placeholder="Address"></md-input>
            </md-field>
          </div>
          <div class="row">
            <md-field>
              <label for="country">Country</label>
              <md-select
                v-model="form.country"
                name="country"
                id="country"
                @input="getStates($event)"
              >
                <md-option
                  v-for="country in countryList"
                  :value="country.id"
                  :key="country.id"
                >{{country.name}}</md-option>
              </md-select>
            </md-field>

            <md-field>
              <label for="state">State</label>
              <md-select v-model="form.state" name="state" id="state" @input="getCities($event)">
                <md-option
                  v-for="state in stateList"
                  :key="state.id"
                  :value="state.id"
                >{{state.name}}</md-option>
              </md-select>
            </md-field>

            <md-field>
              <label for="city">City</label>
              <md-select v-model="form.city" name="city" id="city" @input="getZips($event)">
                <md-option v-for="city in cityList" :key="city.id" :value="city.id">{{city.name}}</md-option>
              </md-select>
            </md-field>

            <md-field>
              <label for="citycode">Postal code</label>
              <md-select v-model="form.citycode" name="citycode" id="citycode">
                <md-option
                  v-for="code in citycodeList"
                  :key="code.id"
                  :value="code.id"
                >{{code.postal_code}}</md-option>
              </md-select>
            </md-field>
          </div>
          <div class="row">
            <md-field>
              <label>Phone</label>
              <md-input v-model="form.phone" placeholder="Phone"></md-input>
            </md-field>
            <md-field>
              <label>Website</label>
              <md-input v-model="form.website" placeholder="Website"></md-input>
            </md-field>
            <md-field>
              <label>Company Name</label>
              <md-input v-model="form.company" placeholder="Company name"></md-input>
            </md-field>
          </div>
          <div class="row"></div>
          <div class="row">
            <md-field>
              <label>About your company</label>
              <md-textarea v-model="form.detail"></md-textarea>
            </md-field>
          </div>
        </div>
        <md-button type="submit" class="md-primary md-small-fab">Save</md-button>
      </md-card>
    </form>
  </div>
</template>

<script>
import Axios from "axios";
export default {
  name: "EditGeneralInfo",
  props: ["isInfoUpdated"],
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
  }),
  methods: {
    imageOnChange(e) {
      this.logo = e.target.files[0];
    },
    update() {
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
      Axios.post("update-carrier/" + this.$route.params.id, fd, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
        .then((res) => {
          this.$emit("show-snackbar");
          this.$router.back();
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },

    getCountries() {
      Axios.get("countries")
        .then((res) => {
          this.countryList = res.data;
          this.edit();
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    getStates(countryId) {
      console.log("country changed")
      this.countryList.forEach((element) => {
        if (element.id == countryId) {
          this.stateList = element.state_list;
        }
      });
    },
    getCities(stateId) {
      this.stateList.forEach((element) => {
        if (element.id == stateId) {
          this.cityList = element.city_list;
        }
      });
    },
    getZips(id) {
      this.cityList.forEach((element) => {
        if (element.id == id) {
          this.citycodeList = element.citycodes;
        }
      });
    },
    edit() {
      Axios.get("edit-carrier/" + this.$route.params.id).then(
        (res) => {
          this.form.first_name = res.data[0].first_name;
          this.form.last_name = res.data[0].last_name;
          this.form.address = res.data[0].address;
          this.form.phone = res.data[0].phone;
          this.form.website = res.data[0].website;
          this.form.company = res.data[0].company;
          this.form.detail = res.data[0].detail;
          this.form.country = res.data[0].country.id;
          this.form.state = res.data[0].state.id;
          this.form.city = res.data[0].city.id;
          this.form.citycode = res.data[0].citycode.id;
        },
        (err) => {}
      );
    },
  },
  created() {
    this.getCountries();
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
  .add-btn {
    position: absolute;
    top: 0;
    right: 0;
  }
}
</style>