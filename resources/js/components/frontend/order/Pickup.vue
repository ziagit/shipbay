<template>
  <div class="origin padding-20">
    <form @submit.prevent="nextStep()">
      <div class="search-container">
        <md-field>
          <label>City/State</label>
          <md-input
            v-model="order.src.address"
            required
            ref="focusable"
            id="autocomplete"
          ></md-input>
        </md-field>
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
      <!--     <md-card v-if="isAddSelected">
        <md-button @click="edit()" class="md-icon-button md-primary edit">
          <md-icon class="md-primary">edit</md-icon>
        </md-button>
        <md-card-content>
          <span
            >{{ order.src.street_number }} {{ order.src.street }},
            {{ order.src.city }} - {{ order.src.zip }}</span
          ><br />
          <span>{{ order.src.state }}, {{ order.src.country }}</span>
        </md-card-content>
      </md-card>-->
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
    accessoryList: null,
    order: {
      src: {
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
      pickDate: null,
      des: null,
      myItem: null,
      billing: {
        email: null,
        status: null,
      },
    },
  }),

  methods: {
    nextStep() {
      localStorage.setItem("order", JSON.stringify(this.order));
      this.$emit("progress", "first", "second", 1, "/order/pickup-services");
    },
    edit() {
      this.$refs.focusable.$el.focus();
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
    var autocomplete = new google.maps.places.Autocomplete(
      document.getElementById("autocomplete"),
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

        if (types.indexOf("street_number") > -1) {
          $vm.order.src.street_number = component.long_name;
        }
        if (types.indexOf("route") > -1) {
          $vm.order.src.street = component.long_name;
        }
        $vm.order.src.address =
          $vm.order.src.street_number +
          ", " +
          $vm.order.src.street +
          ", " +
          $vm.order.src.city +
          ", " +
          $vm.order.src.state +
          ", " +
          $vm.order.src.country;
      });
    });

    this.$refs.focusable.$el.focus();
  },
  created() {
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
  .action {
    text-align: right;
  }

  .md-card {
    margin: 0 !important;
    .edit {
      position: absolute;
      top: 0;
      right: 0;
    }
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
