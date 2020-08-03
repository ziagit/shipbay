<template>
  <div class="origin">
    <div class="icon">
      <img src="http://localhost:8000/images/a-b.svg" width="100" />
    </div>
    <span class="md-display-1">Where are you shipping from?</span>
    <form>
      <div class="search-container">
        <md-field>
          <label>City/Zip code</label>
          <md-input v-model="keywords" required></md-input>
        </md-field>

        <ul v-if="isFound">
          <li
            v-for="result in results"
            :key="result.id"
            @click="select(result)"
          >{{result.cities[0].name}} - {{result.postal_code}}</li>
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
        <md-button class="md-icon-button md-raised md-primary" @click="nextStep(14)" type="submit">
          <md-icon>keyboard_arrow_right</md-icon>
        </md-button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  name: "Origin",
  data: () => ({
    keywords: null,
    results: [],
    accessoryList: null,
    order: {
      src: {
        city: null,
        cityName: null,
        postalCode: null,
        postalCodeName: null,
        accessories: ["bs"],
        appointmentTime: null
      }
    }
  }),
  watch: {
    keywords(after, before) {
      this.fetch();
    }
  },
  methods: {
    fetch() {
      axios
        .get("search-city", { params: { keywords: this.keywords } })
        .then(res => {
          this.results = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    select(selected) {
      this.keywords = selected.cities[0].name + " - " + selected.postal_code;
      this.order.src.city = selected.cities[0].id;
      this.order.src.cityName = selected.cities[0].name;
      this.order.src.postalCode = selected.id;
      this.order.src.postalCodeName = selected.postal_code;
    },
    nextStep(prgValue) {
      if (this.validator()) {
        localStorage.setItem("order", JSON.stringify(this.order));
        this.$router.push("pickup-services");
        this.$emit("progress", prgValue);
      }
    },
    validator() {
      if (this.keywords === null) {
        console.log("required feild is empty");
      } else {
        return true;
      }
    },
    isFound() {
      if (this.results.length > 0) {
        return true;
      } else {
        return false;
      }
    },
    watchLocalstorage() {
      if (localStorage.getItem("order")) {
        let storage = JSON.parse(localStorage.getItem("order"));
        this.keywords =
          storage.src.cityName + " - " + storage.src.postalCodeName;
        this.order.src.city = storage.src.city;
        this.order.src.cityName = storage.src.cityName;
        this.order.src.accessories = storage.src.accessories;
        console.log("order exist: ", JSON.parse(localStorage.getItem("order")));
      }
    },
    getAccessories() {
      axios
        .get("location-type")
        .then(res => {
          this.cityList = res.data.cities;
          this.accessoryList = res.data.services;
        })
        .catch(err => {
          console.log("Error: ", err);
        });
    }
  },
  created() {
    this.watchLocalstorage();
    this.getAccessories();
  }
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
    }
  }
  .icon,
  .options,
  .action {
    margin: 20px auto;
  }
  .md-display-1 {
    font-size: 30px;
  }
}
</style>