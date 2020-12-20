<template>
  <div class="container">
    <div class="content">
      <md-dialog :md-active.sync="cartTogal">
        <md-dialog-title>
          <span>Add your card information </span>
          <img :src="'/images/mastercard.svg'" width="20" />
        </md-dialog-title>
        <md-dialog-content>
          <Card v-on:payment-succeed="refresh" />
        </md-dialog-content>
      </md-dialog>
      <span class="md-display-1">Payment details</span>
      <div class="break"></div>
      <div class="break"></div>
      <md-card>
        <md-card-content>
          <div v-if="dataLoading" class="spinner">
            <Spinner />
          </div>

          <div v-else>
            <div v-if="paymentStatus">
              <p style="color: green">
                Thanks! your payment was successful. process your order
              </p>
            </div>
            <div v-else>
              <p>You don't have payment history.</p>
              <!-- <router-link v-if="authenticated" to="/shipper/card">Add your card informations</router-link> -->
              <a class="payment-card" @click="card()">Add your card informations</a>
            </div>
            <p>
              Credit cards can be securely saved for future orders. Payment information
              that is deleted or not saved to your account will be stored for 90 days in
              the case of any order refunds or adjustments. For more details, please read
              the
              <a href="#">Terms and conditions</a>
            </p>
          </div>
        </md-card-content>
        <md-card-actions>
          <div class="payment-status">
            <div class="paid" v-if="billing.status === 'paid' || paymentStatus">
              Payment status
              <md-icon>done</md-icon>
              <md-tooltip>Paid!</md-tooltip>
            </div>
            <div class="unpaid" v-else>
              Payment status
              <md-icon>pending</md-icon>
              <md-tooltip>Unpaid!</md-tooltip>
            </div>
          </div>
        </md-card-actions>
      </md-card>
      <div class="break"></div>
      <div class="break"></div>
      <div class="action">
        <md-button v-if="paymentStatus" class="custom-button" @click="nextStep()">
          Continue
        </md-button>
        <Spinner v-if="checkingPayment" />
      </div>
    </div>
    <Snackbar :data="snackbar" />
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios";
import isPaid from "../services/card";
import Spinner from "../../shared/Spinner";
import Snackbar from "../../shared/Snackbar";

import Card from "../card/Card";
export default {
  name: "PaymentDetails",
  data: () => ({
    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
    billing: {
      status: null,
      email: null,
    },
    paymentStatus: false,
    dataLoading: true,
    checkingPayment: false,
    test: null,
    cartTogal: false,
  }),
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  methods: {
    nextStep() {
      this.checkingPayment = false;
      this.$router.push("/confirmation");
    },
    prevStep() {
      this.$router.back("delivery-details");
    },
    checkPayment() {
      isPaid
        .checkPayment()
        .then((res) => {
          if (res.status) {
            this.dataLoading = false;
            this.paymentStatus = res.status;
            this.$emit("progress", 8);
          } else {
            this.dataLoading = false;
            this.snackbar.show = true;
            this.snackbar.message = "Add your card informations to process your order";
            this.snackbar.statusCode = 0;
          }
        })
        .catch((error) => {
          this.dataLoading = false;
          this.snackbar.show = true;
          this.snackbar.message = "Somthing is wrong! refresh your page.";
          this.snackbar.statusCode = 0;
        });
    },
    card() {
      this.cartTogal = true;
    },
    refresh() {
      this.cartTogal = false;
      if (this.authenticated) {
        if (this.user.role[0].name === "shipper") {
          this.$router.push("/shipper/card");
        } else {
          window.location.reload(true);
        }
      } else {
        window.location.reload(true);
      }
    },
  },
  created() {
    this.$emit("progress", 7);
    this.checkPayment();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
  components: {
    Spinner,
    Snackbar,
    Card,
  },
};
</script>

<style lang="scss" scoped>
.container {
  text-align: center;
  .content {
    .action {
      display: flex;
      justify-content: center;
    }

    .md-card {
      text-align: left;
      margin: 0;

      .payment-card:hover {
        cursor: pointer;
      }

      .spinner {
        text-align: center;
      }

      .payment-status {
        .paid {
          background: green;
          padding: 2px 14px;
          border-radius: 17px;
          color: #fff;
          font-size: 9px;

          .md-icon {
            color: #fff;
          }
        }

        .unpaid {
          background: #ebebeb;
          padding: 2px 7px;
          border-radius: 17px;
          color: #fff;
          font-size: 9px;

          .md-icon {
            color: #fff;
          }
        }
      }
    }

    .required-feild-error {
      background: crimson;
    }
  }

  img {
    position: absolute;
    top: 0;
    right: 9px;
    width: 2.2em;
  }
}
</style>
