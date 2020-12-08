<template>
  <div class="additional-details">
    <form @submit.prevent="nextStep()">
      <md-field>
        <label>Estimated shipment value ($)</label>
        <md-input
          type="number"
          v-model="shipper.estimatedValue"
          min="1"
          required
          ref="focusable"
        ></md-input>
      </md-field>
      <md-field>
        <label>Special instructions (optional)</label>
        <md-textarea v-model="shipper.instructions"></md-textarea>
      </md-field>

      <md-tabs class="md-transparent" md-alignment="fixed">
        <md-tab id="tab-pickup" md-label="Pickup Contacts">
          <md-field>
            <label>Name</label>
            <md-input
              type="text"
              v-model="shipper.pickupName"
              required
            ></md-input>
          </md-field>
          <div class="row">
            <md-field>
              <label>Phone</label>
              <md-input
                type="text"
                v-model="shipper.pickupPhone"
                required
              ></md-input>
            </md-field>
            <md-field>
              <label>Email</label>
              <md-input
                type="email"
                v-model="shipper.pickupEmail"
                required
              ></md-input>
            </md-field>
          </div>
        </md-tab>
        <md-tab id="tab-delivery" md-label="Delivery Contacts">
          <md-field>
            <label>Name</label>
            <md-input
              type="text"
              v-model="shipper.deliveryName"
              required
            ></md-input>
          </md-field>
          <div class="row">
            <md-field>
              <label>Phone</label>
              <md-input
                type="text"
                v-model="shipper.deliveryPhone"
                required
              ></md-input>
            </md-field>
            <md-field>
              <label>Email</label>
              <md-input
                type="email"
                v-model="shipper.deliveryEmail"
                required
              ></md-input>
            </md-field>
          </div>
        </md-tab>
      </md-tabs>
      <div class="action">
        <md-button class="custom-button" type="submit"> Continue </md-button>
      </div>
    </form>
  </div>
</template>

<script>
import functions from "../services/functions";
export default {
  name: "additional-details",
  data: () => ({
    shipper: {
      estimatedValue: null,
      instructions: null,
      pickupName: null,
      pickupPhone: null,
      pickupEmail: null,
      deliveryName: null,
      deliveryPhone: null,
      deliveryEmail: null,
    },
    active: "first",
    first: false,
    second: false,
    pickupError: null,
    deliveryError: null,
  }),

  methods: {
    nextStep() {
      if (this.validator()) {
        let order = JSON.parse(localStorage.getItem("order"));
        order.shipper = this.shipper;
        localStorage.setItem("order", JSON.stringify(order));
        this.$emit("progress", "seventh", "eighth", 7, '/order/carriers');
        //this.$router.push("payment-details");
      }
    },
    validator() {
      if (
        this.shipper.pickupName == null ||
        this.shipper.pickupPhone == null ||
        !functions.phoneValidator(this.shipper.pickupPhone) ||
        this.shipper.pickupEmail == null ||
        !functions.emailValidator(this.shipper.pickupEmail)
      ) {
        this.pickupError = "Invalid info!";
        return false;
      } else if (
        this.shipper.deliveryName == null ||
        this.shipper.deliveryPhone == null ||
        !functions.phoneValidator(this.shipper.deliveryPhone) ||
        this.shipper.deliveryEmail == null ||
        !functions.emailValidator(this.shipper.deliveryEmail)
      ) {
        this.deliveryError = "Invalid info!";
        return false;
      } else {
        return true;
      }
    },
    watchLocalstorage() {
      let storage = JSON.parse(localStorage.getItem("order"));
      if (storage.shipper) {
        this.shipper.estimatedValue = storage.shipper.estimatedValue;
        this.shipper.pickupName = storage.shipper.pickupName;
        this.shipper.pickupPhone = storage.shipper.pickupPhone;
        this.shipper.pickupEmail = storage.shipper.pickupEmail;
        this.shipper.deliveryName = storage.shipper.deliveryName;
        this.shipper.deliveryPhone = storage.shipper.deliveryPhone;
        this.shipper.deliveryEmail = storage.shipper.deliveryEmail;
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
.additional-details {
  max-width: 600px;
  margin: auto;

  .header {
    margin-top: 24px;

    .md-display-1 {
      font-size: 24px;
    }
  }

  .pick-time {
    display: flex;
    justify-content: space-between;

    .md-field {
      width: 48%;
    }
  }

  .row {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;

    .md-field {
      flex: 50%;
    }
  }
  .action {
    text-align: right;
  }
}

@media only screen and (max-width: 600px) {
  .additional-details {
    .header {
      .md-display-1 {
        font-size: 30px;
      }
    }
  }
}
</style>
