<template>
  <div>
    <form @submit.prevent="update" enctype="multipart/form-data">
      <md-card class="main-card">
        <md-button @click="$router.back()" class="md-icon-button add-btn">
          <md-icon>close</md-icon>
          <md-tooltip>Cancel</md-tooltip>
        </md-button>
        <div class="shipper-details">
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
      country: null,
      state: null,
      city: null,
      zip: null,
      address: null,
      phone: null,
      addressId: null,
      contactId: null,
    },
    countries: null,
    hasCompany: false,
  }),

  methods: {
    update() {
      axios
        .put("shipper/details/" + this.temp.me, this.form)
        .then((res) => {
          console.log("response ", res.data);
          this.$router.push("/shipper");
        })
        .catch((error) => {
          console.log("eerrr: ", error);
          this.snackbar.message = error.response.data.errors;
          this.snackbar.statusCode = error.response.status;
          this.snackbar.show = true;
        });
    },
    init() {
      axios.get("shipper/details/" + this.temp.me).then(
        (res) => {
          if (res.data.company !== "null") {
            this.hasCompany = true;
          }
          this.form.first_name = res.data.first_name;
          this.form.last_name = res.data.last_name;
          this.form.phone = res.data.contact.phone;
          this.form.website = res.data.website;
          this.form.company = res.data.company;
          this.form.detail = res.data.detail;
          this.form.addressId = res.data.full_address.id;
          this.form.contactId = res.data.contact.id;
          this.form.addressId = res.data.full_address.id;
          this.form.country = res.data.full_address.country.id;
          this.form.state = res.data.full_address.state;
          this.form.city = res.data.full_address.city;
          this.form.zip = res.data.full_address.zip;
          this.form.address = res.data.full_address.address;
          this.oldLogo = res.data.logo;
        },
        (err) => {
          console.log(err);
        }
      );
    },
    getCountries() {
      axios
        .get("countries")
        .then((res) => {
          this.countries = res.data;
          this.init();
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
  },
  computed: {
    ...mapGetters({
      temp: "shared/temp",
    }),
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

  .shipper-logo {
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

  .zip-address {
    flex: 50%;
  }
}
</style>
