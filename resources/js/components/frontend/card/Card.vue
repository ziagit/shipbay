<template>
  <div class="card">
    <div class="header">
      <span class="md-display-1">Card Information</span>
    </div>
    <md-card>
      <form @submit.prevent="getStripeToken" id="payment-form" enctype="multipart/form-data">
        <md-card-content>
          <div v-if="successMessage && !parymentTogal">
            <div class="alert-success">{{successMessage}}</div>
            <br />
            <a
              v-if="authenticated && user.role[0].name === 'shipper'"
              href="/#/shipper/card"
            >Continue to payment</a>
            <a v-else href="/#/shipment/payment-details" target="_blank">Continue your order</a>
          </div>
          <div class="alert-error" v-if="errorMessage">{{successMessage}}</div>
          <div v-if="parymentTogal" class="billing-details">
            <div class="checkbox" v-if="!authenticated && order">
              <md-checkbox
                class="md-primary"
                v-model="addFromStorage"
              >Is your billing address same to your pickup address ?</md-checkbox>
            </div>
            <div class="checkbox" v-if="authenticated && user.role[0].name === 'shipper'">
              <md-checkbox class="md-primary" v-model="addFromDb">
                Is your billing address same to your account ?
                <md-icon class="md-primary">
                  info
                  <md-tooltip>You wounldn't notified in case of different email!</md-tooltip>
                </md-icon>
              </md-checkbox>
            </div>

            <md-field>
              <label>Email</label>
              <md-input type="email" v-model="form.email" required></md-input>
            </md-field>
            <md-field>
              <label>Address</label>
              <md-input type="text" v-model="form.address" required></md-input>
            </md-field>
            <div class="row">
              <md-field>
                <label>City</label>
                <md-input type="text" v-model="form.city" required></md-input>
              </md-field>
              <md-field>
                <label>State</label>
                <md-input type="text" v-model="form.state" required></md-input>
              </md-field>
              <md-field>
                <label>Postal code</label>
                <md-input type="text" v-model="form.postalcode" required></md-input>
              </md-field>
            </div>
            <md-field>
              <label>Name on card</label>
              <md-input type="text" v-model="form.name" required></md-input>
            </md-field>
            <div ref="card">
              <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" style="color:red">{{error}}</div>
          </div>
        </md-card-content>
        <md-card-actions>
          <md-button
            v-if="!dataLoading && parymentTogal"
            id="submit-button"
            class="md-primary"
            type="submit"
          >Submit</md-button>
          <Spinner v-if="dataLoading" />
        </md-card-actions>
      </form>
    </md-card>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
import Spinner from "../shared/Spinner";
/* var stripe = Stripe("pk_test_0G9HHVR4XmO3EFy80yElsydL0011AX8fxz");
var elements = stripe.elements(); */
var style = {
  base: {
    color: "#32325d",
    fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: "antialiased",
    fontSize: "16px",
    "::placeholder": {
      color: "#aab7c4",
    },
  },
  invalid: {
    color: "#fa755a",
    iconColor: "#fa755a",
  },
};
var card = undefined;
export default {
  name: "Card",
  data: () => ({
    form: {
      email: null,
      address: null,
      city: null,
      state: null,
      postalcode: null,
      name: null,
      saveCard: null,
      stripeToken: null,
      price: null,
    },
    error: null,
    addFromStorage: false,
    addFromDb: false,
    shipperExist: null,
    dataLoading: false,
    successMessage: null,
    errorMessage: null,
    parymentTogal: true,
    order: null,
  }),

  mounted: function () {
    card = elements.create("card", {
      style: style,
      hidePostalCode: true,
    });
    card.mount(this.$refs.card);
  },
  watch: {
    addFromStorage: function (value) {
      if (value) {
        this.form.email = this.order.shipper.pickDetails.email;
        this.form.address = this.order.shipper.pickDetails.address;
        this.form.state = this.order.shipper.pickDetails.stateName;
        this.form.city = this.order.shipper.pickDetails.cityName;
        this.form.postalcode = this.order.shipper.pickDetails.postalCodeName;
      } else {
        this.form.email = this.form.address = this.form.state = this.form.city = this.form.postalcode = null;
      }
    },
    addFromDb: function (value) {
      if (value) {
        if (this.shipperExist === null) {
          axios
            .get("shipper/shipper-address")
            .then((res) => {
              this.form.email = res.data.email;
              this.form.address = res.data.shipper_with_address.address;
              this.form.state =
                res.data.shipper_with_address.full_address.state.name;
              this.form.city =
                res.data.shipper_with_address.full_address.city.name;
              this.form.postalcode =
                res.data.shipper_with_address.full_address.citycode;
              this.shipperExist = res.data;
            })
            .catch((err) => console.log(err));
        } else {
          this.form.email = this.shipperExist.email;
          this.form.address = this.shipperExist.shipper_with_address.address;
          this.form.state = this.shipperExist.shipper_with_address.full_address.state.name;
          this.form.city = this.shipperExist.shipper_with_address.full_address.city.name;
          this.form.postalcode = this.shipperExist.shipper_with_address.full_address.citycode;
        }
      } else {
        this.form.email = this.form.address = this.form.state = this.form.city = this.form.postalcode = null;
      }
    },
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  methods: {
    getStripeToken: function () {
      this.dataLoading = true;
      stripe.createToken(card).then((result) => {
        if (result.error) {
          this.error = result.error.message;
        } else {
          this.handleStripeToken(result.token);
        }
      });
    },
    handleStripeToken: function (token) {
      if (this.order !== null) {
        this.form.price = this.order.carrier.price;
        if (this.order.id !== undefined) {
          this.form.orderId = this.order.id;
        }
      }
      this.form.stripeToken = token.id;
      axios
        .post("charge", this.form)
        .then((res) => {
          this.successMessage = res.data["message"];
          if (this.order !== null) {
            this.order.id = res.data["id"];
            this.order.billing.status = res.data["status"];
            this.order.billing.email = res.data["email"];
            localStorage.setItem("order", JSON.stringify(this.order));
          }

          this.form.email = this.form.address = this.form.city = this.form.postalcode = this.form.state = this.form.name = null;
          this.dataLoading = false;
          this.parymentTogal = false;
        })
        .catch((err) => {
          this.errorMassage = err;
          console.log(err);
        });
    },
    reloadPage(){
      window.location.reload()
    }
  },
  created() {
    this.order = JSON.parse(localStorage.getItem("order"));
  },
  components: {
    Spinner,
  },
};
</script>
<style lang="scss" scoped>
.card {
  max-width: 600px;
  margin: auto;
  text-align: center;
  .md-display-1 {
    font-size: 24px;
  }
  .md-card {
    .checkbox {
      text-align: left;
    }
    .row {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      .md-field {
        flex: 30%;
        label {
          font-size: 14px;
        }
      }
    }
  }
}

.alert-error {
  padding: 20px;
  background-color: #f44336b3;
  color: white;
  border-radius: 5px;
}

.alert-error ul {
  margin: 0;
}

.alert-success {
  padding: 20px;
  background-color: #008000a8;
  color: white;
  border-radius: 5px;
}

.loading {
  text-align: center;
}

/**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;
  font-family: "Roboto";
  height: 40px;

  padding: 10px 12px;

  border-bottom: 1px solid #ddd;
  /* border-radius: 4px; */
  background-color: white;

  /* box-shadow: 0 1px 3px 0 #e6ebf1; */
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

/*  .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        } */

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}

@media only screen and (min-width: 600px) {
  .card {
    .header {
      margin: 10px auto;
      .md-display-1 {
        font-size: 30px;
      }
    }
    .md-card {
      padding: 10px 20px 0 20px;
    }
  }
}
</style>