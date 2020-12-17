<template>
  <div class="destination">
    <span class="md-display-1">Where are you shipping to?</span>
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
      <!--<md-card v-if="isAddSelected">
        <md-button @click="edit()" class="md-icon-button md-primary edit">
          <md-icon class="md-primary">edit</md-icon>
        </md-button>
        <md-card-content>
          <span
            >{{ des.street_number }} {{ des.street }},
            {{ des.city }} - {{ des.zip }}</span
          ><br />
          <span>{{ des.state }}, {{ des.country }}</span>
        </md-card-content>
      </md-card>-->
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
  </div>
</template>

<script>
export default {
  name: "Destination",
  data: () => ({
    address: null,
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
  }),

  methods: {
    edit() {
      this.isSelected = false;
      this.$refs.focusable.$el.focus();
    },
    nextStep() {
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
    var autocomplete = new google.maps.places.Autocomplete(
      document.getElementById("des-autocomplete"),
      {
        bounds: new google.maps.LatLngBounds(
          new google.maps.LatLng(49.246292, -123.116226)
        ),
      }
    );

    google.maps.event.addListener(autocomplete, "place_changed", function () {
      var data = autocomplete.getPlace();

      data.address_components.forEach(function (component) {
        var types = component.types;

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
          " " +
          $vm.des.street +
          ", " +
          $vm.des.city +
          ", " +
          $vm.des.state +
          ", " +
          $vm.des.country;
      });
    });
    this.$refs.focusable.$el.focus();
  },

  created() {
    this.$emit("progress", 3);
    this.init();
    this.getAccessories();
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
  }
  .action {
    display: flex;
    justify-content: center;
  }
}
</style>
