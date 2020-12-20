<template>
  <div class="origin">
    <span class="md-display-1">Shipment source</span>
    <div class="break"></div>
    <form @submit.prevent="nextStep()">
      <div class="search-container">
        <md-field>
          <label>Postal code</label>
          <md-input
            v-model="order.src.address"
            required
            ref="focusable"
            id="autocomplete"
          ></md-input>
        </md-field>
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
              >Sorry! <b>"{{ supportedArea }}" </b> is not in our coverage yet.</span
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
export default {
  name: "Origin",
  data: () => ({
    supportedArea: null,
    supportTogal: false,
    accessoryList: null,
    invalidAdd: "",
    order: {
      src: {
        country: "",
        state: "",
        city: "",
        zip: "",
        street: "",
        street_number: "",
        address: "",
        accessories: ["bs"],
        appointmentTime: "",
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
    validAddress(components) {
      let $vm = this;
      this.supportTogal = true;
      components.forEach(function (component) {
        let types = component.types;
        if (types.indexOf("street_number") > -1) {
          $vm.order.src.street_number = component.long_name;
        }
        if (types.indexOf("route") > -1) {
          $vm.order.src.street = component.long_name;
        }
        if (types.indexOf("locality") > -1) {
          $vm.order.src.city = component.long_name;
        }
        if (types.indexOf("administrative_area_level_1") > -1) {
          $vm.order.src.state = component.short_name;
        }
        if (types.indexOf("postal_code") > -1) {
          $vm.order.src.zip = component.long_name;
        }
        if (types.indexOf("country") > -1) {
          $vm.order.src.country = component.long_name;
        }
      });
      $vm.order.src.address =
        $vm.order.src.street_number +
        " " +
        $vm.order.src.street +
        ", " +
        $vm.order.src.city +
        ", " +
        $vm.order.src.state +
        " " +
        $vm.order.src.zip +
        ", " +
        $vm.order.src.country;
    },
    invalidAddress(components) {
      let $vm = this;
      this.supportTogal = false;
      components.forEach(function (component) {
        let types = component.types;

        if (types.indexOf("administrative_area_level_1") > -1) {
          $vm.supportedArea = component.long_name;
        }
      });
      console.log("XXX ", $vm.supportedArea);
    },
    nextStep() {
      if (this.supportTogal) {
        localStorage.setItem("order", JSON.stringify(this.order));
        this.$router.push("pickup-services");
      } else {
        this.snackbar.show = true;
        this.snackbar.message = "Please provide a valid address!";
        this.snackbar.statusCode = 404;
      }
    },

    init() {
      if (localStorage.getItem("order")) {
        let storage = JSON.parse(localStorage.getItem("order"));
        this.isAddSelected = localStorage.getItem("aflug");
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
        //this.supportTogal = true;
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
  mounted() {
    let $vm = this;
    this.$refs.focusable.$el.focus();
    var autocomplete = new google.maps.places.Autocomplete(
      document.getElementById("autocomplete"),
      {
        //types: ["address"],
        componentRestrictions: { country: "ca" },
        bounds: new google.maps.LatLngBounds(
          new google.maps.LatLng(49.246292, -123.116226)
        ),
        //strictbounds: true,
      }
    );

    google.maps.event.addListener(autocomplete, "place_changed", function () {
      var data = autocomplete.getPlace();
      data.address_components.forEach((component) => {
        if (component.types.indexOf("administrative_area_level_1") > -1) {
          if (component.short_name != "BC") {
            $vm.invalidAddress(data.address_components);
          } else {
            $vm.validAddress(data.address_components);
          }
        }
      });
    });
  },
  created() {
    this.$emit("progress", 0);
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
