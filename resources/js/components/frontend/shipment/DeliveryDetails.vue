<template>
  <div class="delivry-details">
    <div class="header">
      <span class="md-display-1">What is the delivery address?</span>
    </div>
    <form>
      <div class="inputs">
        <md-field>
          <label>Company/individual name</label>
          <md-input v-model="deliveryDetails.company" required ref="focusable"></md-input>
        </md-field>
        <md-field>
          <label>Address</label>
          <md-input v-model="deliveryDetails.address" required></md-input>
        </md-field>
        <md-field>
          <label>City/Zip code</label>
          <md-input v-model="deliveryDetails.cityName" disabled required></md-input>
        </md-field>
        <md-field>
          <label>Pickup refrence number</label>
          <md-input v-model="deliveryDetails.refrenceNumber"></md-input>
        </md-field>
        <md-field>
          <label>Special instructions</label>
          <md-textarea v-model="deliveryDetails.instructions"></md-textarea>
        </md-field>
        <md-field>
          <label>Contact name</label>
          <md-input v-model="deliveryDetails.name" required></md-input>
        </md-field>
        <div class="row">
          <md-field>
            <label>Phone</label>
            <md-input v-model="deliveryDetails.phone" required></md-input>
          </md-field>
          <md-field>
            <label>Email</label>
            <md-input v-model="deliveryDetails.email" required></md-input>
            <md-icon class="md-primary">
              info
              <md-tooltip>If you are not ش guest, use an email registered with us to receive notification!</md-tooltip>
            </md-icon>
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
  name: "DeliveryDetails",
  data: () => ({
    deliveryDetails: {
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
        order.shipper.deliveryDetails = this.deliveryDetails;
        localStorage.setItem("order", JSON.stringify(order));
        this.$router.push("payment-details");
      }
    },
    prevStep() {
      this.$router.back("pickup-details");
    },
    validator() {
      if (
        this.deliveryDetails.company == null ||
        this.deliveryDetails.address == null ||
        this.deliveryDetails.name == null ||
        this.deliveryDetails.phone == null ||
        this.deliveryDetails.email == null
      ) {
        console.log("all fields with * signs are required");
      } else {
        return true;
      }
    },
    watchLocalstorage() {
      let storage = JSON.parse(localStorage.getItem("order"));
      this.deliveryDetails.state = storage.des.state;
      this.deliveryDetails.stateName = storage.des.stateName;
      this.deliveryDetails.cityName = storage.des.cityName;
      this.deliveryDetails.city = storage.des.city;
      this.deliveryDetails.postalCode = storage.des.postalCode;
      this.deliveryDetails.postalCodeName = storage.des.postalCodeName;
      if (storage.shipper.deliveryDetails) {
        this.deliveryDetails.company = storage.shipper.deliveryDetails.company;
        this.deliveryDetails.address = storage.shipper.deliveryDetails.address;
        this.deliveryDetails.city = storage.shipper.deliveryDetails.city;
        this.deliveryDetails.cityName =
          storage.shipper.deliveryDetails.cityName;
        this.deliveryDetails.refrenceNumber =
          storage.shipper.deliveryDetails.refrenceNumber;
        this.deliveryDetails.instructions =
          storage.shipper.deliveryDetails.instructions;
        this.deliveryDetails.name = storage.shipper.deliveryDetails.name;
        this.deliveryDetails.phone = storage.shipper.deliveryDetails.phone;
        this.deliveryDetails.email = storage.shipper.deliveryDetails.email;
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
.delivry-details {
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
  .delivry-details {
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