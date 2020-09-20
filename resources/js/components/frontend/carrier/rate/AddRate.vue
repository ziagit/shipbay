<template>
  <div>
    <form @submit.prevent="submit" enctype="multipart/form-data">
      <md-card>
        <md-card-header>
          <div class="md-title">New rates</div>
          <md-button @click="$router.back()" class="md-icon-button add-btn">
            <md-icon>close</md-icon>
            <md-tooltip>Cancel</md-tooltip>
          </md-button>
        </md-card-header>
        <md-card-content>
          <table class="table">
            <thead>
              <tr>
                <th colspan="3">ORIGIN</th>
                <th colspan="3">DESTINITION</th>
                <th rowspan="2">Min charge</th>
                <th colspan="7">RATES PER 100LB WITHIN WEIGHT BRACKETS</th>
                <th rowspan="2">FSC%</th>
                <th rowspan="2">Transit day</th>
              </tr>
              <tr>
                <th scope="col">State</th>
                <th scope="col">City</th>
                <th scope="col">Zip</th>
                <th scope="col">State</th>
                <th scope="col">City</th>
                <th scope="col">Zip</th>
                <th scope="col">0K - 1k</th>
                <th scope="col">1K - 2K</th>
                <th scope="col">2K - 3K</th>
                <th scope="col">3K - 4K</th>
                <th scope="col">4K - 5K</th>
                <th scope="col">5K - 10K</th>
                <th scope="col">Above 10K</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <md-field>
                    <label for="src_state">State</label>
                    <md-select
                      v-model="form.src_state"
                      @input="getSrcCities($event)"
                      name="src_state"
                      id="src_state"
                      md-dense
                    >
                      <md-option
                        v-for="state in states"
                        :key="state.id"
                        :value="state.id"
                      >{{state.name}}</md-option>
                    </md-select>
                    <input class="hidden-input" v-model="form.src_state" required />
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label for="src_city">City</label>
                    <md-select
                      v-model="form.src_city"
                      name="src_city"
                      id="src_city"
                      md-dense
                      @input="getSrcZips($event)"
                    >
                      <md-option
                        v-for="src_city in srcCities"
                        :key="src_city.id"
                        :value="src_city.id"
                      >{{src_city.name}}</md-option>
                    </md-select>
                    <input class="hidden-input" v-model="form.src_city" required />
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label for="src_zip">Zip</label>
                    <md-select v-model="form.src_zip" name="src_zip" id="src_zip" md-dense>
                      <md-option
                        v-for="zip in srcZips"
                        :key="zip.id"
                        :value="zip.id"
                      >{{zip.postal_code}}</md-option>
                    </md-select>
                    <input class="hidden-input" v-model="form.src_zip" required />
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label for="des_state">State</label>
                    <md-select
                      v-model="form.des_state"
                      @input="getDesCities($event)"
                      name="des_state"
                      id="des_state"
                      md-dense
                    >
                      <md-option
                        v-for="des_state in states"
                        :key="des_state.id"
                        :value="des_state.id"
                      >{{des_state.name}}</md-option>
                    </md-select>
                    <input class="hidden-input" v-model="form.des_state" required />
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label for="des_city">City</label>
                    <md-select
                      v-model="form.des_city"
                      name="des_city"
                      id="des_city"
                      md-dense
                      @input="getDesZips($event)"
                    >
                      <md-option
                        v-for="src_city in desCities"
                        :key="src_city.id"
                        :value="src_city.id"
                      >{{src_city.name}}</md-option>
                    </md-select>
                    <input class="hidden-input" v-model="form.des_city" required />
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label for="des_zip">Zip</label>
                    <md-select v-model="form.des_zip" name="des_zip" id="des_zip" md-dens>
                      <md-option
                        v-for="zip in desZips"
                        :key="zip.id"
                        :value="zip.id"
                      >{{zip.postal_code}}</md-option>
                    </md-select>
                    <input class="hidden-input" v-model="form.des_zip" required />
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>($)</label>
                    <md-input v-model="form.min_rate" required></md-input>
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>($)</label>
                    <md-input v-model="form.k0_k1" required></md-input>
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>($)</label>
                    <md-input v-model="form.k1_k2" required></md-input>
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>($)</label>
                    <md-input v-model="form.k2_k3" required></md-input>
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>($)</label>
                    <md-input v-model="form.k3_k4" required></md-input>
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>($)</label>
                    <md-input v-model="form.k4_k5" required></md-input>
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>($)</label>
                    <md-input v-model="form.k5_k10" required></md-input>
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>($)</label>
                    <md-input v-model="form.above_10k" required></md-input>
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>(%)</label>
                    <md-input v-model="form.fsc" required></md-input>
                  </md-field>
                </td>
                <td>
                  <md-field>
                    <label>(day)s</label>
                    <md-input v-model="form.transit_day" required></md-input>
                  </md-field>
                </td>
              </tr>
            </tbody>
          </table>
        </md-card-content>
        <md-card-actions>
          <md-button type="submit" class="md-primary md-small-fab">Save</md-button>
        </md-card-actions>
      </md-card>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  name: "AddRate",
  data: () => ({
    form: {
      src_state: null,
      des_state: null,
      src_city: null,
      des_city: null,
      src_zip: null,
      des_zip: null,
      min_rate: null,
      k0_k1: null,
      k1_k2: null,
      k2_k3: null,
      k3_k4: null,
      k4_k5: null,
      k5_k10: null,
      above_10k: null,
      fsc: null,
      transit_day: null,
      carrierId: null,
    },
    countries: [],
    states: [],
    srcCities: [],
    desCities: [],
    srcZips: [],
    desZips: [],
    carrierId: null,
    countryId: null,
  }),
  computed: {
    ...mapGetters({
      temp: "shared/temp",
    }),
  },
  methods: {
    submit() {
      axios
        .post("carrier/rates", this.form)
        .then((res) => {
          this.$emit("show-snackbar");
          this.$router.back();
          console.log("res ", res.data);
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    getCountries() {
      axios
        .get("countries-with-states")
        .then((res) => {
          this.countries = res.data;
          this.states = res.data[0].state_list;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    getStates(countryId) {
      this.countryList.forEach((element) => {
        if (element.id == countryId) {
          this.stateList = element.state_list;
        }
      });
    },

    getSrcCities(id) {
      this.form.src_city = null
      this.states.forEach((element) => {
        if (element.id == id) {
          this.srcCities = element.city_list;
        }
      });
    },
    getSrcZips(id) {
      this.form.src_zip=null
      this.srcCities.forEach((element) => {
        if (element.id == id) {
          this.srcZips = element.citycodes;
        }
      });
    },
    getDesCities(id) {
      this.form.des_city=null
      this.states.forEach((element) => {
        if (element.id == id) {
          this.desCities = element.city_list;
        }
      });
    },
    getDesZips(id) {
      this.form.des_zip = null
      this.desCities.forEach((element) => {
        if (element.id == id) {
          this.desZips = element.citycodes;
        }
      });
    },
    created() {
      this.getAccessory();
    },
  },

  created() {
    this.form.carrierId = this.temp.me;
    this.countryId = this.temp.country;
    this.getCountries();
  },
  components: {},
};
</script>

<style lang="scss" scoped>
.md-card {
  box-shadow: none;
  border: 1px solid #ddd;
  text-align: center;
  .md-card-content {
    overflow-x: auto;
  }
  .table {
    width: 100%;
    border-collapse: collapse;
    th {
      font-size: 11px;
      color: #666;
    }
    th,
    td {
      border: 1px solid #ddd;
    }
    td {
      .md-field {
        margin: 0;
      }
    }

    .md-select {
      max-width: 100px;
    }
    .md-input {
      max-width: 30px;
    }
  }
  .add-btn {
    position: absolute;
    top: 0;
    right: 0;
  }
}
</style>