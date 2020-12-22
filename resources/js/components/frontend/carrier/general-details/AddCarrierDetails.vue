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
              <label for="">First name</label>
              <md-input
                type="text"
                v-model="form.first_name"
                required
                ref="focusable"
              ></md-input>
            </md-field>
            <md-field>
              <label for="">Last name</label>
              <md-input type="text" v-model="form.last_name" required></md-input>
            </md-field>
            <md-field>
              <label for="">Phone</label>
              <md-input type="tel" v-model="form.phone" required></md-input>
            </md-field>
          </div>
          <div class="row">
            <md-field>
              <label for="">Select country</label>
              <md-select v-model="form.country" name="country" id="country">
                <md-option
                  v-for="country in countries"
                  :value="country.id"
                  :key="country.id"
                  >{{ country.name }}</md-option
                >
              </md-select>
              <input class="hidden-input" v-model="form.country" required />
            </md-field>

            <md-field>
              <label for="">State</label>
              <md-input v-model="form.state" required></md-input>
            </md-field>

            <md-field>
              <label for="">City</label>
              <md-input v-model="form.city" required></md-input>
            </md-field>
          </div>
          <div class="row">
            <md-field>
              <label for="">Postal code</label>
              <md-input v-model="form.zip" required></md-input>
            </md-field>

            <md-field>
              <label for="">Address</label>
              <md-input v-model="form.address" required></md-input>
            </md-field>
          </div>
        </div>
        <md-switch v-model="hasCompany" class="md-primary"
          >Do you have a company?</md-switch
        >
        <div class="company" v-if="hasCompany">
          <div class="row">
            <md-field>
              <label>Company Name</label>
              <md-input
                v-model="form.company"
                placeholder="Company name"
                :required="hasCompany"
              ></md-input>
            </md-field>
            <md-field>
              <label>Website</label>
              <md-input
                type="url"
                v-model="form.website"
                placeholder="Website (optional)"
              ></md-input>
            </md-field>
          </div>
          <div class="row">
            <md-field>
              <label>About your company</label>
              <md-textarea v-model="form.detail" :required="hasCompany"></md-textarea>
            </md-field>
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
import Snackbar from "../../../shared/Snackbar";
export default {
  name: "AddGeneralInfo",
  data: () => ({
    form: {
      first_name: null,
      last_name: null,
      addressId: null,
      country: null,
      state: null,
      city: null,
      zip: null,
      address: null,
      phone: null,
      website: null,
      company: null,
      detail: null,
    },
    logo: null,
    countries: null,
    hasCompany: false,

    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
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
      fd.append("addressId", this.form.addressId);
      fd.append("country", this.form.country);
      fd.append("state", this.form.state);
      fd.append("city", this.form.city);
      fd.append("zip", this.form.zip);
      fd.append("address", this.form.address);
      fd.append("phone", this.form.phone);
      fd.append("website", this.form.website);
      fd.append("company", this.form.company);
      fd.append("detail", this.form.detail);
      axios
        .post("carrier/details", fd)
        .then((res) => {
          console.log("response ", res.data);
          this.$router.push("/carrier");
        })
        .catch((error) => {
          console.log("eerrr: ", error.response);
          this.snackbar.message = error.response.data.errors;
          this.snackbar.statusCode = error.response.status;
          this.snackbar.show = true;
        });
    },

    getCountries() {
      axios
        .get("countries")
        .then((res) => {
          this.countries = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
  },
  mounted() {
    this.$refs.focusable.$el.focus();
  },
  created() {
    this.getCountries();
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
        flex: 32%;
      }

      .zip-address {
        flex: 50%;
      }
    }
  }
}
</style>
