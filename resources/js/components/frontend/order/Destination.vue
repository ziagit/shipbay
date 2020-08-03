<template>
  <div class="destination">
    <div class="icon">
      <img src="http://localhost:8000/images/a-b.svg" width="100" />
    </div>
    <span class="md-display-1">Where are you shipping to?</span>
    <form>
      <div class="search-container">
        <md-field>
          <label>City/Zip code</label>
          <md-input v-model="keywords" required></md-input>
        </md-field>

        <ul v-if="results.length > 0">
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
          v-model="des.accessories[0]"
          :value="service.code"
          class="md-primary"
        >{{service.name}}</md-radio>
      </div>

      <div class="action">
        <md-button @click="prevStep(-14)" class="md-icon-button md-raised">
          <md-icon>keyboard_arrow_left</md-icon>
        </md-button>
        <md-button class="md-icon-button md-raised md-primary" @click="nextStep(14)" type="submit">
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
    accessoryList: null,
    des: {
      city: null,
      cityName: null,
      postalCode: null,
      postalCodeName: null,
      accessories: ["bs"]
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
      this.des.city = selected.cities[0].id;
      this.des.cityName = selected.cities[0].name;
      this.des.postalCode = selected.id;
      this.des.postalCodeName = selected.postal_code;
    },

    nextStep(prgValue) {
      if (this.validator()) {
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
    prevStep(prgValue) {
      this.$router.back("pickup-services");
      this.$emit("progress", prgValue);
    },
    watchLocalstorage() {
      let storage = JSON.parse(localStorage.getItem("order"));
      if (storage.des) {
        this.keywords =
          storage.des.cityName + " - " + storage.des.postalCodeName;
        this.des.city = storage.des.city;
        this.des.cityName = storage.des.cityName;
        this.des.accessories = storage.des.accessories;
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
    console.log("in destination: ", JSON.parse(localStorage.getItem("order")));
    this.watchLocalstorage();
    this.getAccessories();
  }
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