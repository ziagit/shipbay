<template>
  <div class="add-shipper">
    <md-card class="no-shadow-bordered">
      <md-card-header>
        <div class="md-title">Edit shipper details</div>
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
              <md-input v-model="form.firstName" required></md-input>
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
            <md-field>
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
            <md-field>
              <md-select
                v-model="form.city"
                name="city"
                id="city"
                placeholder="City"
              >
                <md-option v-for="city in cityList" :key="city.id" :value="city.id">{{city.name}}</md-option>
              </md-select>
              <input class="hidden-input" v-model="form.city" required />
            </md-field>
            <md-field>
              <label>Postal code</label>
              <md-input v-model="form.citycode" required></md-input>
            </md-field>
          </div>
          <md-button type="submit">Done</md-button>
        </form>
      </md-card-content>
    </md-card>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters } from "vuex";
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
      addressId: null,
    },
    countryList: null,
    stateList: null,
    cityList: null,
    citycodeList: null,
  }),
  computed: {
    ...mapGetters({
      temp: "shared/temp",
    }),
  },
  methods: {
    submit() {
      axios
        .put("shipper/details/" + this.temp.me, this.form)
        .then((res) => {
          this.$router.push("/shipper");
        })
        .catch((err) => console.log(err));
    },
    edit() {
      axios.get("shipper/details/" + this.temp.me).then(
        (res) => {
          console.log("shipper details ", res.data);
          this.form.firstName = res.data.first_name;
          this.form.lastName = res.data.last_name;
          this.form.address = res.data.full_address.address;
          this.form.addressId = res.data.full_address.id;
          this.form.phone = res.data.phone;
          this.form.country = res.data.full_address.country.id;
          this.form.state = res.data.full_address.state.id;
          this.form.city = res.data.full_address.city.id;
          this.form.citycode = res.data.full_address.citycode;
        },
        (err) => console.log(err)
      );
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
/*     zips(id) {
            this.cityList.forEach((element) => {
        if (element.id == id) {
          this.citycodeList = element.citycodes;
        }
      });
    }, */
  },
  created() {
    this.getCountries();
  },
};
</script>
<style lang="scss" scoped>
.md-card {
  text-align: center;
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