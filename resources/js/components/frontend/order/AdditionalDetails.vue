<template>
  <div class="additional-details">
    <span class="md-display-1">Additional information</span>
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
      <md-steppers md-vertical :md-active-step.sync="active">
        <md-step
          id="first"
          md-label="Pickup Contacts"
          md-description="Required"
          :md-error="pickupError"
        >
          <md-field>
            <label>Name</label>
            <md-input type="text" v-model="shipper.pickupName" required></md-input>
          </md-field>
          <div class="row">
            <md-field>
              <label>Phone</label>
              <md-input type="text" v-model="shipper.pickupPhone" required></md-input>
            </md-field>
            <md-field>
              <label>Email</label>
              <md-input type="email" v-model="shipper.pickupEmail" required></md-input>
              <md-icon class="md-primary">
                info
                <md-tooltip>Use your account email!</md-tooltip>
              </md-icon>
            </md-field>
          </div>
        </md-step>

        <md-step
          id="second"
          md-label="Delivery Contacts"
          md-description="Required"
          :md-error="deliveryError"
        >
          <md-field>
            <label>Name</label>
            <md-input type="text" v-model="shipper.deliveryName" required></md-input>
          </md-field>
          <div class="row">
            <md-field>
              <label>Phone</label>
              <md-input type="text" v-model="shipper.deliveryPhone" required></md-input>
            </md-field>
            <md-field>
              <label>Email</label>
              <md-input type="email" v-model="shipper.deliveryEmail" required></md-input>
              <md-icon class="md-primary">
                info
                <md-tooltip>Use your account email!</md-tooltip>
              </md-icon>
            </md-field>
          </div>
        </md-step>
      </md-steppers>
      <div class="action">
        <md-button @click="$router.back()" class="custom-button-outline">
          Back
        </md-button>
        <div class="tab"></div>
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
        console.log("u r going");
        let order = JSON.parse(localStorage.getItem("order"));
        order.shipper = this.shipper;
        localStorage.setItem("order", JSON.stringify(order));
        this.$router.push("carriers");
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
    init() {
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
    this.$emit("progress", 6);
    this.init();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
};
</script>

<style lang="scss" scoped>
.additional-details {
  text-align: center;

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

  .md-vertical {
    background: none;
  }
  .action {
    display: flex;
    justify-content: center;
  }
}

@media only screen and (min-width: 600px) {
}
</style>
