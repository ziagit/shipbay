<template>
  <div class="destination">
    <span class="md-display-1">Shipment destination</span>
    <form @submit.prevent="nextStep()">
      <div class="search-container">
        <md-field>
          <label>Postal code</label>
          <md-input
            v-model="des.address"
            required
            ref="focusable"
            id="des-autocomplete"
          ></md-input>
        </md-field>
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
              >Sorry! <b>"{{ supportedArea }}" </b> is not in our coverage yet.</span
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
export default {
  name: "Destination",
  data: () => ({
    supportedArea: null,
    supportTogal: false,
    accessoryList: null,
    des: {
      country: null,
      state: null,
      city: null,
      zip: null,
      street: null,
      street_number: null,
      address: null,
      accessories: ["bs"],
      appointmentTime: null,
    },
    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
  }),

  methods: {
    getAddress(components) {
      let $vm = this;
      this.supportTogal = true;
      components.forEach(function (component) {
        let types = component.types;
        if (types.indexOf("locality") > -1) {
          $vm.des.city = component.long_name;
        }
        if (types.indexOf("administrative_area_level_1") > -1) {
          $vm.des.state = component.short_name;
        }
        if (types.indexOf("postal_code") > -1) {
          $vm.des.zip = component.long_name;
        }
        if (types.indexOf("country") > -1) {
          $vm.des.country = component.long_name;
        }
        if (types.indexOf("street_number") > -1) {
          $vm.des.street_number = component.long_name;
        }
        if (types.indexOf("route") > -1) {
          $vm.des.street = component.long_name;
        }
        $vm.des.address =
          $vm.des.street_number +
          ", " +
          $vm.des.street +
          ", " +
          $vm.des.zip +
          " " +
          $vm.des.city +
          ", " +
          $vm.des.state +
          ", " +
          $vm.des.country;
      });
    },
    nextStep() {
      if (this.supportTogal) {
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
      } else {
        this.snackbar.show = true;
        this.snackbar.message = "Please provide a valid address!";
        this.snackbar.statusCode = 404;
      }
    },

    init() {
      let storage = JSON.parse(localStorage.getItem("order"));
      if (storage.des) {
        this.isAddSelected = localStorage.getItem("adflug");
        this.des.country = storage.des.country;
        this.des.state = storage.des.state;
        this.des.city = storage.des.city;
        this.des.zip = storage.des.zip;
        this.des.street = storage.des.street;
        this.des.street_number = storage.des.street_number;
        this.des.address = storage.des.address;
        this.des.accessories = storage.des.accessories;
        this.des.appointmentTime = storage.des.appointmentTime;
        //this.supportTogal = true;
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
  mounted() {
    let $vm = this;
    this.$refs.focusable.$el.focus();

    var autocomplete = new google.maps.places.Autocomplete(
      document.getElementById("des-autocomplete"),
      {
        componentRestrictions: { country: "ca" },
        bounds: new google.maps.LatLngBounds(
          new google.maps.LatLng(49.246292, -123.116226)
        ),
      }
    );

    google.maps.event.addListener(autocomplete, "place_changed", function () {
      var data = autocomplete.getPlace();
      data.address_components.forEach((component) => {
        if (component.types.indexOf("administrative_area_level_1") > -1) {
          if (component.short_name != "BC") {
            $vm.supportedArea = component.short_name;
          } else {
            $vm.getAddress(data.address_components);
          }
        }
      });
    });
  },

  created() {
    this.$emit("progress", 3);
    this.init();
    this.getAccessories();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
  components: {
    Snackbar,
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
