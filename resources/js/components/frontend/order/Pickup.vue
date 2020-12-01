<template>
  <div class="origin padding-20">
    <form @submit.prevent="nextStep()">
      <div class="search-container">
        <md-field v-if="!isSelected">
          <label>City/State</label>
          <md-input
            v-model="keywords"
            required
            ref="focusable"
            @keydown="clearCity($event)"
          ></md-input>
        </md-field>
        <md-field v-if="isSelected">
          <label>Address</label>
          <md-input
            v-model="addKeywords"
            required
            ref="focusable"
            @keydown="clearAddress($event)"
          ></md-input>
        </md-field>
        <ul>
          <li v-if="notFound !== null" class="not-found">
            {{ this.notFound }}
          </li>
        </ul>
        <ul v-if="!isSelected">
          <li
            class="city-list"
            v-for="list in cities"
            :key="list.id"
            @click="selectStateCity(list)"
          >
            {{ list.city }},
            {{ list.state }}
          </li>
        </ul>
        <ul v-if="!isAddSelected">
          <li
            class="address-list"
            v-for="list in addresses"
            :key="list.id"
            @click="selectZipAddress(list)"
          >
            {{ list.address }},
            {{ list.zip }}
          </li>
        </ul>
      </div>

      <div class="options">
        <md-radio
          v-for="service in accessoryList"
          :key="service.id"
          v-model="order.src.accessories[0]"
          :value="service.code"
          >{{ service.name }}</md-radio
        >
      </div>
      <md-card v-if="isAddSelected">
        <md-button @click="edit()" class="md-icon-button md-primary edit">
          <md-icon class="md-primary">edit</md-icon>
        </md-button>
        <md-card-content>
          <span
            >{{ order.src.address.city }}, {{ order.src.address.state }}</span
          ><br />
          <span v-if="order.src.address.address"
            >{{ order.src.address.address }}, {{ order.src.address.zip }}</span
          >
        </md-card-content>
      </md-card>
      <div class="action">
        <md-button class="custom-button" type="submit"> Continue </md-button>
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
    addKeywords: null,
    cities: [],
    city: null,
    addresses: [],
    notFound: null,
    isSelected: false,
    isAddSelected: false,
    accessoryList: null,
    order: {
      src: {
        country: null,
        countryName: null,
        address: null,
        accessories: ["bs"],
        appointmentTime: null,
      },
      pickDate: null,
      des: null,
      myItem: null,
      billing: {
        email: null,
        status: null,
      },
    },
  }),
  watch: {
    keywords(after, before) {
      this.searchStateCity();
    },
    addKeywords(after, before) {
      this.searchZipAddress();
    },
    cities(data) {
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
    addresses(data) {
      if (data.length === 0) {
        if (this.isAddSelected === true) {
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
    searchStateCity() {
      axios
        .get("search-state-city/" + 1, {
          params: {
            keywords: this.keywords,
          },
        })
        .then((res) => {
          console.log("found cities: ", res.data.data);

          this.cities = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    searchZipAddress() {
      axios
        .get("search-zip-address/" + this.city, {
          params: {
            keywords: this.addKeywords,
          },
        })
        .then((res) => {
          console.log("found addresses: ", res.data.data);
          this.addresses = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    selectStateCity(selected) {
      this.$refs.focusable.$el.focus();
      this.city = selected.city;
      this.isSelected = true;
      localStorage.setItem("sflug", this.isSelected);
    },
    selectZipAddress(selected) {
      this.order.src.address = selected;
      this.addKeywords = selected.address;
      this.isAddSelected = true;
      localStorage.setItem("aflug", this.isAddSelected);
    },
    clearCity(e) {
      if (e.key === "Backspace" || e.key === "Delete") {
        this.isSelected = false;
      }
    },
    clearAddress(e) {
      if (e.key === "Backspace" || e.key === "Delete") {
        this.isAddSelected = false;
      }
    },
    validator() {
      if (
        this.order.src.city === null ||
        this.order.src.stateName === null ||
        this.order.src.cityName === null ||
        this.order.src.postalCode === null ||
        this.order.src.postalCodeName === null ||
        this.order.src.address === null
      ) {
        console.log("these fields are req:", this.order.src);
      } else {
        this.nextStep();
      }
    },
    nextStep() {
      this.$emit("progress", 'first', 'second', 'pickup-services', 1);
      localStorage.setItem("order", JSON.stringify(this.order));
    },
    edit() {
      this.isSelected = false;
      this.$refs.focusable.$el.focus();
    },
    init() {
      if (localStorage.getItem("order")) {
        let storage = JSON.parse(localStorage.getItem("order"));
        this.isSelected = localStorage.getItem("sflug");
        this.isAddSelected = localStorage.getItem("aflug");
        this.order.src.country = storage.src.country;
        this.order.src.countryName = storage.src.countryName;
        this.order.src.address = storage.src.address;
        this.order.src.accessories = storage.src.accessories;
        this.order.pickDate = storage.pickDate;
        this.order.src.appointmentTime = storage.src.appointmentTime;
        this.order.des = storage.des;
        this.order.myItem = storage.myItem;
        this.addKeywords = storage.src.address.address;
      }
    },
    getAccessories() {
      axios
        .get("location-type")
        .then((res) => {
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
  mounted() {
    this.$refs.focusable.$el.focus();
  },
  created() {
    this.getCountries();
    this.init();
    this.getAccessories();
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

      .select-country {
        position: absolute;
        top: 0;
        right: 0;
      }
    }

    ul {
      background: #fff;
      margin-top: 0;
      padding: 0;
      position: absolute;
      z-index: 10;
      box-shadow: 1px 2px 3px #ddd;
      width: 100%;
      border-bottom-right-radius: 8px;
      border-bottom-left-radius: 8px;

      li {
        text-align: left;
        list-style-type: none;
        padding: 10px;
      }

      .city-list:hover,
      .address-list:hover {
        background: #f0f2f5;
        cursor: pointer;
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

  .md-card {
    .edit {
      position: absolute;
      top: 0;
      right: 0;
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
