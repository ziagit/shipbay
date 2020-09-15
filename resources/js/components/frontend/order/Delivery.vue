<template>
  <div class="destination">
    <div class="icon">
      <img :src="'/images/a-b.svg'" width="100" />
    </div>
    <span class="md-display-1">Where are you shipping to?</span>
    <form @submit.prevent="nextStep()">
      <div class="search-container">
        <md-field>
          <label>City/Zip code</label>
          <md-input v-model="keywords" required></md-input>
        </md-field>
        <ul>
          <li v-if="notFound !== null" class="not-found">{{this.notFound}}</li>
        </ul>
        <ul v-if="results.length > 0">
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
          v-model="des.accessories[0]"
          :value="service.code"
          class="md-primary"
        >{{service.name}}</md-radio>
      </div>

      <div class="action">
        <md-button to="pickup-date" class="md-icon-button md-raised">
          <md-icon>keyboard_arrow_left</md-icon>
        </md-button>
        <md-button class="md-icon-button md-raised md-primary" type="submit">
          <md-icon>keyboard_arrow_right</md-icon>
        </md-button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  name: "Destination",
  data: () => ({
    keywords: null,
    results: [],
    isSelected: false,
    notFound: null,
    accessoryList: null,
    des: {
      country: null,
      countryName: null,
      state: null,
      stateName: null,
      city: null,
      cityName: null,
      postalCode: null,
      postalCodeName: null,
      accessories: ["bs"],
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
      this.des.state = selected.citycode_city[0].state.id;
      this.des.stateName = selected.citycode_city[0].state.name;
      this.des.city = selected.citycode_city[0].id;
      this.des.cityName = selected.citycode_city[0].name;
      this.des.postalCode = selected.id;
      this.des.postalCodeName = selected.postal_code;
      this.isSelected = true;
    },

    nextStep(prgValue) {
      if (this.keywords) {
        let storage = JSON.parse(localStorage.getItem("order"));
        if (storage.des) {
          for (let i = 0; i < storage.des.accessories.length; i++) {
            if (
              storage.des.accessories[i] === "bs" ||
              storage.des.accessories[i] === "rs" ||
              storage.des.accessories[i] === "sp"
            ) {
              storage.des.accessories.splice(i, 1);
            }
          }
        }
        storage.des = this.des;
        localStorage.setItem("order", JSON.stringify(storage));
        this.$router.push("delivery-services");
      }
    },

    init() {
      let storage = JSON.parse(localStorage.getItem("order"));
      if (storage.des) {
        this.keywords =
          storage.des.stateName +
          ", " +
          storage.des.cityName +
          " - " +
          storage.des.postalCodeName;
        this.des.country = storage.des.country;
        this.des.countryName = storage.des.countryName;
        this.des.state = storage.des.state;
        this.des.stateName = storage.des.stateName;
        this.des.city = storage.des.city;
        this.des.cityName = storage.des.cityName;
        this.des.postalCode = storage.des.postalCode;
        this.des.postalCodeName = storage.des.postalCodeName;
        this.des.accessories = storage.des.accessories;
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
        this.des.country = res.data[0].id;
        this.des.countryName = res.data[0].name;
      });
    },
  },
  created() {
    this.$emit("progress", 42);
    console.log("in destination: ", JSON.parse(localStorage.getItem("order")));
    this.init();
    this.getAccessories();
    this.getCountries();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
};
</script>

<style lang="scss" scoped>
.destination {
  text-align: center;
  .search-container {
    position: relative;
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
}

</style>