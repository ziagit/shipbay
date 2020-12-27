<template>
  <div class="origin">
    <span class="md-display-1">Shipment source</span>
    <div class="break"></div>
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
          v-model="order.src.accessories[0]"
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
  name: "Origin",
  data: () => ({
    supportedArea: null,
    initialData: null,
    accessoryList: null,
    order: {
      src: {
        country: "",
        state: "",
        city: "",
        zip: "",
        street: "",
        street_number: "",
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
      shipper: null,
    },
    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
  }),

  methods: {
    nextStep() {
      if (
        this.order.src.country === "" ||
        this.order.src.state === "" ||
        this.order.src.city === "" ||
        this.order.src.zip === ""
      ) {
        this.snackbar.show = true;
        this.snackbar.message = "Please provide a valid address!";
        this.snackbar.statusCode = 404;
      } else {
        localStorage.setItem("order", JSON.stringify(this.order));
        this.$router.push("pickup-services");
      }
    },
    googleValidAddress(address) {
      this.supportedArea = "";
      this.order.src.country = address.country;
      this.order.src.state = address.state;
      this.order.src.city = address.city;
      this.order.src.zip = address.zip;
      this.order.src.street = address.street;
      this.order.src.street_number = address.street_number;
      console.log("valid add", address);
    },
    googleInvalidAddress(address) {
      this.supportedArea = address.state;
      this.order.src.country = null;
      this.order.src.state = null;
      this.order.src.city = null;
      this.order.src.zip = null;
      this.order.src.street = null;
      this.order.src.street_number = null;

      console.log("invalid add", address);
    },
    init() {
      if (localStorage.getItem("order")) {
        let storage = JSON.parse(localStorage.getItem("order"));
        this.initialData = storage.src;
        this.order.src.country = storage.src.country;
        this.order.src.state = storage.src.state;
        this.order.src.city = storage.src.city;
        this.order.src.zip = storage.src.zip;
        this.order.src.street = storage.src.street;
        this.order.src.street_number = storage.src.street_number;
        this.order.src.address = storage.src.address;
        this.order.src.accessories = storage.src.accessories;
        this.order.pickDate = storage.pickDate;
        this.order.src.appointmentTime = storage.src.appointmentTime;
        this.order.des = storage.des;
        this.order.myItem = storage.myItem;
        this.order.shipper = storage.shipper;
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
  },
  created() {
    this.$emit("progress", 0);
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
.origin {
  text-align: center;
  .search-container {
    position: relative;
    .md-field {
      margin-bottom: 0;

      .select-country {
        position: absolute;
        top: 0;
        right: 0;
      }
    }
  }

  .options {
    .md-radio {
      margin: 8px 16px 8px 0;
    }
  }
  .action {
    display: flex;
    justify-content: center;
  }
}

@media only screen and (max-width: 600px) {
  .origin {
    .options {
      text-align: center;
    }
  }
}
</style>
