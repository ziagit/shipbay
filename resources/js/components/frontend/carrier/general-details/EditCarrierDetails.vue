<template>
  <div>
    <form @submit.prevent="update" enctype="multipart/form-data">
      <md-card class="main-card">
        <md-button @click="$router.back()" class="md-icon-button add-btn">
          <md-icon>close</md-icon>
          <md-tooltip>Cancel</md-tooltip>
        </md-button>
        <div class="carrier-logo">
          <md-avatar v-if="hasCompany" class="md-large">
            <img :src="'/images/uploads/'+oldLogo" alt="Logo" />
            <md-field class="select-logo">
              <md-tooltip>Select new logo</md-tooltip>
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
              <md-input type="tel" v-model="form.phone" placeholder="Phone" required></md-input>
            </md-field>
            <md-field>
              <label>Address</label>
              <md-input v-model="form.address" placeholder="Address"></md-input>
            </md-field>
          </div>
          <div class="row">
            <md-field>
              <label for="country">Country</label>
              <md-select v-model="form.country" name="country" id="country" @input="states($event)">
                <md-option
                  v-for="country in countryList"
                  :value="country.id"
                  :key="country.id"
                >{{country.name}}</md-option>
              </md-select>
              <input class="hidden-input" v-model="form.country" required />
            </md-field>

            <md-field>
              <label for="state">State</label>
              <md-select v-model="form.state" name="state" id="state" @input="cities($event)">
                <md-option
                  v-for="state in stateList"
                  :key="state.id"
                  :value="state.id"
                >{{state.name}}</md-option>
              </md-select>
              <input class="hidden-input" v-model="form.state" required />
            </md-field>

            <md-field>
              <label for="city">City</label>
              <md-select v-model="form.city" name="city" id="city" @input="zips($event)">
                <md-option v-for="city in cityList" :key="city.id" :value="city.id">{{city.name}}</md-option>
              </md-select>
              <input class="hidden-input" v-model="form.city" required />
            </md-field>

            <md-field>
              <md-input
                type="number"
                v-model="form.citycode"
                min="1"
                placeholder="Postalcode"
                required
              ></md-input>
            </md-field>
          </div>
          <md-switch v-model="hasCompany" class="md-primary">Do you have a company?</md-switch>
          <div class="company" v-if="hasCompany">
            <div class="row">
              <md-field>
                <label>Website</label>
                <md-input v-model="form.website" placeholder="Website"></md-input>
              </md-field>
              <md-field>
                <label>Company Name</label>
                <md-input v-model="form.company" placeholder="Company name" :required="hasCompany"></md-input>
              </md-field>
            </div>
            <div class="row"></div>
            <div class="row">
              <md-field>
                <label>About your company</label>
                <md-textarea v-model="form.detail" :required="hasCompany"></md-textarea>
              </md-field>
            </div>
          </div>
        </div>
        <md-button type="submit" class="md-primary md-small-fab">Done</md-button>
      </md-card>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  name: "EditGeneralInfo",
  data: () => ({
    form: {
      first_name: null,
      last_name: null,
      address: null,
      addressId: null,
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
    oldLogo: null,
    countryList: null,
    stateList: null,
    cityList: null,
    hasCompany: false,
  }),
  computed: {
    ...mapGetters({
      temp: "shared/temp",
    }),
  },
  methods: {
    onChange(e) {
      this.logo = e.target.files[0];
    },
    update() {
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
      fd.append("addressId", this.form.addressId);
      fd.append("_method", "put");
      axios
        .post("carrier/details/" + this.temp.me, fd)
        .then((res) => {
          console.log("response ", res.data);
          this.$router.push("/carrier");
        })
        .catch((error) => {
          console.log("eerrr: ", error);
          this.snackbar.message = error.response.data.errors;
          this.snackbar.statusCode = error.response.status;
          this.snackbar.show = true;
        });
    },

    getCountries() {
      axios
        .get("countries-with-states")
        .then((res) => {
          this.countryList = res.data;
          this.edit();
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    states(countryId) {
      this.countryList.forEach((element) => {
        if (element.id == countryId) {
          this.stateList = element.state_list;
        }
      });
    },
    cities(stateId) {
      this.stateList.forEach((element) => {
        if (element.id == stateId) {
          this.cityList = element.city_list;
        }
      });
    },
    zips(id) {
      this.cityList.forEach((element) => {
        if (element.id == id) {
          this.citycodeList = element.citycodes;
        }
      });
    },
    edit() {
      axios.get("carrier/details/" + this.temp.me).then(
        (res) => {
          if(res.data.company !== "null"){
            this.hasCompany= true
          }
          this.form.first_name = res.data.first_name;
          this.form.last_name = res.data.last_name;
          this.form.address = res.data.full_address.address;
          this.form.addressId = res.data.full_address.id;
          this.form.phone = res.data.phone;
          this.form.website = res.data.website;
          this.form.company = res.data.company;
          this.form.detail = res.data.detail;
          this.form.country = res.data.full_address.country.id;
          this.form.state = res.data.full_address.state.id;
          this.form.city = res.data.full_address.city.id;
          this.form.citycode = res.data.full_address.citycode;
          this.oldLogo = res.data.logo;
        },
        (err) => {
          console.log(err);
        }
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
  text-align: center;
  box-shadow: none;
  border: solid 1px #ddd;
  .carrier-logo {
    text-align: center;
    margin-top: -40px;
    .md-large {
      background: #ddd;
    }
    .select-logo {
      position: absolute;
    }
  }
  .row {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    .md-field {
      flex: 25%;
    }
  }
  .add-btn {
    position: absolute;
    top: 0;
    right: 0;
  }
}
</style>