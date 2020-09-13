<template>
  <div class="pickup-details">
    <div class="header">
      <span class="md-display-1">What is the pickup address?</span>
    </div>
    <form>
      <div class="inputs">
        <md-field>
          <label>Company/individual name</label>
          <md-input type="text" v-model="pickDetails.company" required ref="focusable"></md-input>
        </md-field>
        <md-field>
          <label>Address</label>
          <md-input type="text" v-model="pickDetails.address" required></md-input>
        </md-field>
        <md-field>
          <label>City/Zip code</label>
          <md-input type="text" v-model="pickDetails.cityName" disabled required></md-input>
        </md-field>
        <md-field>
          <label>Pickup refrence number</label>
          <md-input type="text" v-model="pickDetails.refrenceNumber"></md-input>
        </md-field>
        <md-field>
          <label>Special instructions</label>
          <md-textarea v-model="pickDetails.instructions"></md-textarea>
        </md-field>
        <md-field>
          <label>Contact name</label>
          <md-input type="text" v-model="pickDetails.name" required></md-input>
        </md-field>
        <div class="row">
          <md-field>
            <label>Phone</label>
            <md-input type="text" v-model="pickDetails.phone" required></md-input>
          </md-field>
          <md-field>
            <label>Email</label>
            <md-input type="email" v-model="pickDetails.email" required></md-input>
          </md-field>
        </div>
      </div>
      <div class="action">
        <md-button @click="prevStep()" class="md-icon-button md-raised">
          <md-icon>keyboard_arrow_left</md-icon>
        </md-button>
        <md-button class="md-icon-button md-raised md-primary" @click="nextStep()" type="submit">
          <md-icon>keyboard_arrow_right</md-icon>
        </md-button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  name: "PickupDetails",
  data: () => ({
    pickDetails: {
      company: null,
      address: null,
      state: null,
      stateName: null,
      city: null,
      cityName: null,
      postalCode: null,
      postalCodeName: null,
      refrenceNumber: null,
      instructions: null,
      name: null,
      phone: null,
      email: null,
    },
  }),
  methods: {
    nextStep() {
      if (this.validator()) {
        let order = JSON.parse(localStorage.getItem("order"));
        order.shipper.pickDetails = this.pickDetails;
        localStorage.setItem("order", JSON.stringify(order));
        this.$router.push("delivery-details");
      }
    },
    prevStep() {
      this.$router.back("additional-details");
    },
    validator() {
      if (
        this.pickDetails.company == null ||
        this.pickDetails.address == null ||
        this.pickDetails.cityName == null ||
        this.pickDetails.name == null ||
        this.pickDetails.phone == null ||
        this.pickDetails.email == null
      ) {
        console.log("All fields with * sign are required");
      } else {
        return true;
      }
    },
    watchLocalstorage() {
      let storage = JSON.parse(localStorage.getItem("order"));
      this.pickDetails.state = storage.src.state;
      this.pickDetails.stateName = storage.src.stateName;
      this.pickDetails.cityName = storage.src.cityName;
      this.pickDetails.city = storage.src.city;
      this.pickDetails.postalCode = storage.src.postalCode;
      this.pickDetails.postalCodeName = storage.src.postalCodeName;
      if (storage.shipper.pickDetails) {
        this.pickDetails.company = storage.shipper.pickDetails.company;
        this.pickDetails.address = storage.shipper.pickDetails.address;
        this.pickDetails.city = storage.shipper.pickDetails.city;
        this.pickDetails.cityName = storage.shipper.pickDetails.cityName;
        this.pickDetails.refrenceNumber =
          storage.shipper.pickDetails.refrenceNumber;
        this.pickDetails.instructions =
          storage.shipper.pickDetails.instructions;
        this.pickDetails.name = storage.shipper.pickDetails.name;
        this.pickDetails.phone = storage.shipper.pickDetails.phone;
        this.pickDetails.email = storage.shipper.pickDetails.email;
      }
    },
  },
  mounted() {
    this.$refs.focusable.$el.focus();
  },
  created() {
    this.watchLocalstorage();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
};
</script>

<style lang="scss" scoped>
.pickup-details {
  max-width: 600px;
  margin: auto;
  .action {
    margin: 20px auto;
  }
  .header {
    .md-display-1 {
      font-size: 24px;
    }
  }
}
@media only screen and (min-width: 600px) {
  .pickup-details {
    .header {
      margin-top: 10px;
      .md-display-1 {
        font-size: 30px;
      }
    }
    .row {
      display: flex;
      justify-content: space-between;
      .md-field {
        width: 48%;
      }
    }
  }
}
</style>