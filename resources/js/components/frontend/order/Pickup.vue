<template>
  <div class="origin">
    <div class="icon">
      <img :src="'/images/a-b.svg'" width="100" />
    </div>
    <span class="md-display-1">Where are you shipping from?</span>
    <form @submit.prevent="nextStep()">
      <div class="search-container">
        <md-field>
          <label>City/Zip code</label>
          <md-input v-model="keywords" required @keydown="removingChar($event)"></md-input>
        </md-field>

        <ul>
          <li v-if="notFound !== null" class="not-found">{{this.notFound}}</li>
        </ul>
        <ul>
          <li
            v-for="result in results"
            :key="result.id"
            @click="select(result)"
          >{{result.citycode_city[0].state.name}}, {{result.citycode_city[0].name}} - {{result.postal_code}}</li>
        </ul>
      </div>

      <div class="options">
        <md-radio
          v-for="service in accessoryList"
          :key="service.id"
          v-model="order.src.accessories[0]"
          :value="service.code"
          class="md-primary"
        >{{service.name}}</md-radio>
      </div>

      <div class="action">
        <md-button class="md-icon-button md-raised md-primary" type="submit">
          <md-icon>keyboard_arrow_right</md-icon>
        </md-button>
      </div>
    </form>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "Origin",
  data: () => ({
    keywords: null,
    results: [],
    notFound: null,
    isSelected: false,
    accessoryList: null,
    order: {
      src: {
        country: null,
        countryName: null,
        state: null,
        stateName: null,
        city: null,
        cityName: null,
        postalCode: null,
        postalCodeName: null,
        accessories: ["bs"],
        appointmentTime: null,
      },
      billing: {
        email: null,
        status: null,
      },
    },
  }),
  watch: {
    keywords(after, before) {
      this.search();
    },
    results(data) {
      if (data.length === 0) {
        if (this.isSelected === true) {
          this.notFound = null;
        } else {
          this.notFound = "Not found";
        }
      } else {
        this.notFound = null;
      }
    },
  },
  methods: {
    search() {
      axios
        .get("search-city", { params: { keywords: this.keywords } })
        .then((res) => {
          this.results = res.data.data;
          console.log("reslut: ", this.results);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    removingChar(e) {
      if (e.key === "Backspace" || e.key === "Delete") {
        this.isSelected = false;
      }
    },
    select(selected) {
      this.keywords =
        selected.citycode_city[0].state.name +
        ", " +
        selected.citycode_city[0].name +
        " - " +
        selected.postal_code;
      this.order.src.city = selected.citycode_city[0].id;
      this.order.src.cityName = selected.citycode_city[0].name;
      this.order.src.state = selected.citycode_city[0].state.id;
      this.order.src.stateName = selected.citycode_city[0].state.name;
      this.order.src.postalCode = selected.id;
      this.order.src.postalCodeName = selected.postal_code;
      this.isSelected = true;
    },
    nextStep() {
      if (this.validator()) {
        localStorage.setItem("order", JSON.stringify(this.order));
        this.$router.push("pickup-services");
      }
    },
    validator() {
      if (
        this.keywords == null ||
        this.order.src.city == null ||
        this.order.src.stateName == null ||
        this.order.src.cityName == null ||
        this.order.src.postalCode == null ||
        this.order.src.postalCodeName == null
      ) {
        return false;
      } else {
        return true;
      }
    },

    init() {
      if (localStorage.getItem("order")) {
        let storage = JSON.parse(localStorage.getItem("order"));
        this.keywords =
          storage.src.stateName +
          ", " +
          storage.src.cityName +
          " - " +
          storage.src.postalCodeName;
        this.order.src.country = storage.src.country;
        this.order.src.countryName = storage.src.countryName;
        this.order.src.state = storage.src.state;
        this.order.src.stateName = storage.src.stateName;
        this.order.src.city = storage.src.city;
        this.order.src.cityName = storage.src.cityName;
        this.order.src.accessories = storage.src.accessories;
        this.order.src.postalCode = storage.src.postalCode;
        this.order.src.postalCodeName = storage.src.postalCodeName;
      }
    },
    getAccessories() {
      axios
        .get("location-type")
        .then((res) => {
          this.cityList = res.data.cities;
          this.accessoryList = res.data.services;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    getCountries() {
      axios.get("countries").then((res) => {
        this.order.src.country = res.data[0].id;
        this.order.src.countryName = res.data[0].name;
      });
    },
  },
  created() {
    this.$emit("progress", 0);
    this.init();
    this.getAccessories();
    this.getCountries();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
};
</script>

<style lang="scss" scoped>
.origin {
  .search-container {
    position: relative;
    text-align: center;
    .md-field {
      margin-bottom: 0;
    }
    ul {
      background: #fff;
      margin-top: 0;
      padding: 0;
      position: absolute;
      z-index: 10;
      box-shadow: 1px 2px 3px #ddd;
      width: 100%;
      li {
        text-align: left;
        list-style-type: none;
        padding: 10px;
      }
      li:hover {
        background: #ddd;
      }
      .not-found {
        color: red;
      }
    }
  }
  .icon,
  .options,
  .action {
    margin: 20px auto;
  }
  .options {
    .md-radio {
      margin: 8px 16px 8px 0;
    }
  }
}

@media only screen and (min-width: 600px) {
  .origin {
    .options {
      text-align: center;
    }
  }
}
</style>