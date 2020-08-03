<template>
  <div class="additional-details">
    <div>
      <span class="md-display-1">Additional information</span>
    </div>
    <form>
      <div class="search-container">
        <md-field>
          <label>Estimated shipment value ($)</label>
          <md-input type="number" v-model="shipper.estimatedValue" min="1" required></md-input>
        </md-field>
        <md-field>
          <label>Pickup date</label>
          <md-input v-model="shipper.pickupDate" disabled required></md-input>
        </md-field>
        <div class="pick-time">
          <md-field>
            <label>Loading time(optional)</label>
            <md-input type="time" v-model="shipper.startLoadTime"></md-input>
          </md-field>
          <md-field>
            <md-input type="time" v-model="shipper.endLoadTime"></md-input>
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
  name: "additional-details",
  data: () => ({
    shipper: {
      estimatedValue: null,
      pickupDate: null,
      startLoadTime: " ",
      endLoadTime: " "
    }
  }),

  methods: {
    nextStep() {
      if (
        this.shipper.estimatedValue != null &&
        this.shipper.pickupDate != null
      ) {
        let order = JSON.parse(localStorage.getItem("order"));
        order.shipper = this.shipper;
        localStorage.setItem("order", JSON.stringify(order));
        this.$router.push("pickup-details");
      } else {
        console.log("Feilds with * sign are required!");
      }
    },
    prevStep(prgValue) {
      this.$router.back("signin");
    },
    watchLocalstorage() {
      let storage = JSON.parse(localStorage.getItem("order"));
      if (storage.shipper) {
        this.shipper.estimatedValue = storage.shipper.estimatedValue;
        this.shipper.pickupDate = storage.shipper.pickupDate;
        this.shipper.startLoadTime = storage.shipper.startLoadTime;
        this.shipper.endLoadTime = storage.shipper.endLoadTime;
      }
    }
  },
  created() {
    this.watchLocalstorage();
    this.shipper.pickupDate = JSON.parse(
      localStorage.getItem("order")
    ).pickDate;
  }
};
</script>

<style lang="scss" scoped>
.additional-details {
  .options,
  .action {
    margin: 20px auto;
  }
  .md-display-1 {
    font-size: 30px;
  }
  .pick-time {
    display: flex;
    justify-content: space-between;
    .md-field {
      width: 48%;
    }
  }
}
</style>