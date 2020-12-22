<template>
  <div class="container">
    <md-field>
      <label>Postal code</label>
      <md-input v-model="address" required ref="focusable" id="autocomplete"></md-input>
    </md-field>
  </div>
</template>
<script>
export default {
  props: ["initialData"],
  data: () => ({
    supportedArea: "",
    supportTogal: false,
    address: "",
    list: {
      country: "",
      state: "",
      city: "",
      zip: "",
      street: "",
      street_number: "",
    },
  }),
  created() {
    if (this.initialData) {
      this.address =
        this.initialData.street_number +
        " " +
        this.initialData.street +
        ", " +
        this.initialData.city +
        ", " +
        this.initialData.state +
        " " +
        this.initialData.zip +
        ", " +
        this.initialData.country;
    }
    console.log("initialData ", this.initialData);
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
  methods: {
    validAddress(components) {
      let $vm = this;
      $vm.supportedArea = "";
      console.log("google add ", components);
      components.forEach(function (component) {
        let types = component.types;
        if (types.indexOf("street_number") > -1) {
          $vm.list.street_number = component.long_name;
        }
        if (types.indexOf("route") > -1) {
          $vm.list.street = component.long_name;
        }
        if (types.indexOf("locality") > -1) {
          $vm.list.city = component.long_name;
        }
        if (types.indexOf("administrative_area_level_1") > -1) {
          $vm.list.state = component.short_name;
        }
        if (types.indexOf("postal_code") > -1) {
          $vm.list.zip = component.long_name;
        }
        if (types.indexOf("country") > -1) {
          $vm.list.country = component.long_name;
        }
      });
      this.$emit("google-valid-address", $vm.list);
    },
    invalidAddress(components) {
      let $vm = this;
      components.forEach(function (component) {
        let types = component.types;
        if (types.indexOf("street_number") > -1) {
          $vm.list.street_number = component.long_name;
        }
        if (types.indexOf("route") > -1) {
          $vm.list.street = component.long_name;
        }
        if (types.indexOf("locality") > -1) {
          $vm.list.city = component.long_name;
        }
        if (types.indexOf("administrative_area_level_1") > -1) {
          $vm.list.state = component.long_name;
        }
        if (types.indexOf("postal_code") > -1) {
          $vm.list.zip = component.long_name;
        }
        if (types.indexOf("country") > -1) {
          $vm.list.country = component.long_name;
        }
      });
      $vm.list.isValid = false;
      this.$emit("google-invalid-address", $vm.list);
    },
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
}
</style>
