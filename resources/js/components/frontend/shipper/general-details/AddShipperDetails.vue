<template>
  <div>
    <form @submit.prevent="submit" enctype="multipart/form-data">
      <md-card class="main-card">
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
    countries: null,
    hasCompany: false,
    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
  }),

  methods: {
    submit() {
      axios
        .post("shipper/details", this.form)
        .then((res) => {
          if (
            localStorage.getItem("order") &&
            localStorage.getItem("cRoute") === "/order/carriers"
          ) {
            this.$router.push("/order/payment-details");
          } else {
            this.$router.push("/shipper/profile");
          }
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

  .shipper-logo {
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
