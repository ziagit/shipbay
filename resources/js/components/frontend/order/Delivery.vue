<template>
  <div class="destination">
    <span class="md-display-1">Shipment destination</span>
    <form @submit.prevent="nextStep()">
      <div class="search-container">
        <GoogleAddress
          v-on:google-valid-address="googleValidAddress"
          v-on:google-invalid-address="googleInvalidAddress"
          :initialData="initialData"
        />
      </div>
      <div class="break"></div>
      <div class="break"></div>
      <div class="options">
        <md-radio
          v-for="service in accessoryList"
          :key="service.id"
          v-model="des.accessories[0]"
          :value="service.code"
          >{{ service.name }}</md-radio
        >
      </div>
      <div v-if="supportedArea">
        <div class="break"></div>
        <div class="break"></div>
        <md-card>
          <md-card-content>
            <span style="color: red"
              >Sorry! <b>"{{ supportedArea }}" </b> is not in our coverage area yet.</span
            >
          </md-card-content>
        </md-card>
      </div>
      <div class="break"></div>
      <div class="break"></div>
      <div class="action">
        <md-button class="custom-button-outline" @click="$router.back()">
          Back
        </md-button>
        <div class="tab"></div>
        <md-button class="custom-button" type="submit"> Continue </md-button>
      </div>
    </form>
    <Snackbar :data="snackbar" />
  </div>
</template>

<script>
import Snackbar from "../../shared/Snackbar";
import GoogleAddress from "../../shared/GoogleAddress";
export default {
  name: "Destination",
  data: () => ({
    supportedArea: null,
    initialData: null,
    accessoryList: null,
    des: {
      country: "",
      state: "",
      city: "",
      zip: "",
      street: "",
      street_number: "",
      accessories: ["bs"],
      appointmentTime: "",
    },
    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
  }),

  methods: {
    nextStep() {
      if (this.des.country === "" || this.des.state === "" || this.des.city === "") {
        this.snackbar.show = true;
        this.snackbar.message = "Please provide a valid address!";
        this.snackbar.statusCode = 404;
      } else {
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
    googleValidAddress(address) {
      this.supportedArea = "";
      this.des.country = address.country;
      this.des.state = address.state;
      this.des.city = address.city;
      this.des.zip = address.zip;
      this.des.street = address.street;
      this.des.street_number = address.street_number;
      console.log("valid add", address);
    },
    googleInvalidAddress(address) {
      this.supportedArea = address.state;
      this.des.country = null;
      this.des.state = null;
      this.des.city = null;
      this.des.zip = null;
      this.des.street = null;
      this.des.street_number = null;
      console.log("invalid add", address);
    },

    init() {
      let storage = JSON.parse(localStorage.getItem("order"));
      if (storage.des) {
        this.initialData = storage.des;
        this.des.country = storage.des.country;
        this.des.state = storage.des.state;
        this.des.city = storage.des.city;
        this.des.zip = storage.des.zip;
        this.des.street = storage.des.street;
        this.des.street_number = storage.des.street_number;
        this.des.address = storage.des.address;
        this.des.accessories = storage.des.accessories;
        this.des.appointmentTime = storage.des.appointmentTime;
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
  },

  created() {
    this.$emit("progress", 3);
    this.init();
    this.getAccessories();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
  components: {
    Snackbar,
    GoogleAddress,
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
  }
  .action {
    display: flex;
    justify-content: center;
  }
}
</style>
