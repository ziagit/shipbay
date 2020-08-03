<template>
  <div class="payment-details">
    <span class="md-healine">Payment details</span>
    <ion-card mode="ios">
      <ion-card-content>
        <img src="http://localhost:8000/images/mastercard.svg" width="25" />
        <p>You don't have payment history.</p>
        <a href="https://stripe.com" target="_blank">Add your card informations</a>
      </ion-card-content>
    </ion-card>
    <div class="action">
      <md-button @click="prevStep()" class="md-icon-button md-raised">
        <md-icon>keyboard_arrow_left</md-icon>
      </md-button>
      <md-button class="md-icon-button md-raised md-primary" @click="nextStep()">
        <md-icon>keyboard_arrow_right</md-icon>
      </md-button>
    </div>
  </div>
</template>
<script>
export default {
  name: "PaymentDetails",
  data: () => ({
    card: {
      name: null,
      number: null,
      expireMonth: null,
      expireYear: null
    }
  }),
  methods: {
    nextStep(prgValue) {
      this.$router.push("confirmation");
    },
    prevStep(prgValue) {
      this.$router.back("delivery-details");
    }
  },
  created() {}
};
</script>

<style lang="scss" scoped>
.payment-details {
  .content,
  .action {
    margin: 20px auto;
  }
  .md-headline {
    font-size: 3em;
  }
  ion-card {
    background: #fff;
    text-align: left;
    img {
      position: absolute;
      top: 0;
      right: 5px;
      width: 3em;
    }
  }
  .expiries {
    display: flex;
    justify-content: space-between;
    .md-field {
      width: 48%;
    }
  }
}
</style>