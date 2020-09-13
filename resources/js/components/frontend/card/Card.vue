<template>
  <div class="card">
    <div>
      <span class="md-display-1">Card information</span>
    </div>
    <md-card>
      <form @submit.prevent="getStripeToken" id="payment-form" enctype="multipart/form-data">
        <md-card-content>
          <div v-if="successMessage && !parymentTogal">
            <div class="alert-success">{{successMessage}}</div><br>
            <a v-if="authenticated" href="/#/shipper/card">Continue to payment</a>
            <a v-else href="/#/shipment/payment-details" target="_blank">Continue your order</a>
          </div>
          <div class="alert-error" v-if="errorMessage">{{successMessage}}</div>
          <div v-if="parymentTogal" class="billing-details">
            <div class="checkbox" v-if="order">
              <md-checkbox
                class="md-primary"
                v-model="pickAddress"
              >Is your billing address same to your pickup address ?</md-checkbox>
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
          <md-button v-if="!dataLoading && parymentTogal" id="submit-button" class="md-primary" type="submit">Submit</md-button>
          <Spinner v-if="dataLoading"/>
        </md-card-actions>
      </form>
    </md-card>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters,mapActions } from "vuex";
import Spinner from '../shared/Spinner'
var stripe = Stripe("pk_test_0G9HHVR4XmO3EFy80yElsydL0011AX8fxz");
var elements = stripe.elements();
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
    pickAddress: false,
    dataLoading: false,
    successMessage: null,
    errorMessage: null,
    parymentTogal:true,
    order:null,
  }),

  mounted: function () {
    card = elements.create("card", {
      style: style,
      hidePostalCode: true,
    });
    card.mount(this.$refs.card);
  },
  watch: {
    pickAddress: function (value) {
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
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
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
      this.form.price = this.order.carrier.price;
      if (this.order.id !== undefined) {
        this.form.orderId = this.order.id;
      }
      this.form.stripeToken = token.id;
      axios
        .post("charge", this.form)
        .then((res) => {
          this.successMessage = res.data["message"];
          this.order.id = res.data["id"];
          this.order.billing.status = res.data["status"];
          this.order.billing.email = res.data["email"];
          localStorage.setItem("order", JSON.stringify(this.order));
          this.form.email = this.form.address = this.form.city = this.form.postalcode = this.form.state = this.form.name = null;
          this.dataLoading = false;
          this.parymentTogal=false
        })
        .catch((err) => {
          this.errorMassage = err;
          console.log(err);
        });
    },
  },
  created(){
    this.order = JSON.parse(localStorage.getItem("order"));
  },
  components:{
    Spinner
  }
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
    background: #fff;
    padding: 10px 20px 0 20px;
    .checkbox {
      text-align: left;
    }
    .row {
      display: flex;
      justify-content: space-between;
      .md-field {
        width: 32%;
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
    .md-display-1 {
      font-size: 30px;
    }
  }
}
</style>