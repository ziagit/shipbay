<template>
  <div class="confirmation">
    <span class="md-display-1">Confirmation</span>
    <div class="md-display-body">Please take a look at the details to confirm the shipment.</div>

    <ion-card color="light" mode="ios">
      <ion-card-content>
        <div class="md-title">Shipment details</div>
        <div>
          <div class="item-head">Source</div>
          <div class="item">
            <div class="md-body-1">City: {{shipment.src.cityName}}</div>
            <div class="md-body-1">Address: {{shipment.shipper.pickDetails.address}}</div>
            <div class="md-body-1">Contact name: {{shipment.shipper.pickDetails.name}}</div>
            <div class="md-body-1">Phone: {{shipment.shipper.pickDetails.phone}}</div>
            <div class="md-body-1">Email: {{shipment.shipper.pickDetails.email}}</div>
          </div>
        </div>
        <md-divider class="md-inset"></md-divider>
        <div>
          <div class="item-head">Destination</div>
          <div class="item">
            <div class="md-body-1">City: {{shipment.des.cityName}}</div>
            <div class="md-body-1">Address: {{shipment.shipper.deliveryDetails.address}}</div>
            <div class="md-body-1">Contact name: {{shipment.shipper.deliveryDetails.name}}</div>
            <div class="md-body-1">Phone: {{shipment.shipper.deliveryDetails.phone}}</div>
            <div class="md-body-1">Email: {{shipment.shipper.deliveryDetails.email}}</div>
          </div>
        </div>
        <md-divider class="md-inset"></md-divider>
        <div>
          <div class="item-head">Item(s)</div>
          <div class="item">
            <div class="md-body-1" v-for="item in shipment.myItem.items" :key="item.id">
              <div class="md-body-1">Name: {{item.description}}, {{Math.round(item.dw)}} Pounds</div>
            </div>
            <div
              class="md-body-1"
            >Totoal dimentional weight: {{Math.round(calculateTotalDW())}} Pounds</div>
          </div>
        </div>
        <md-divider class="md-inset"></md-divider>
        <div>
          <div class="item-head">Carrier</div>
          <div class="item">
            <div class="md-body-1">Name: {{shipment.carrier.company}}</div>
            <div class="md-body-1">Phone: {{shipment.carrier.phone}}</div>
            <div class="md-body-1">
              Cost:
              <span style="color:green">${{Math.round(shipment.carrier.price)}}</span>
            </div>
          </div>
        </div>
        <div class="md-title">Billing details</div>

        <div>
          <p>Important notice</p>
          <ul>
            <li>
              All rates quoted are provided according to the Description of Goods declared by the
              Shipper and may be subject to additional charges in the case of misdeclaration.
            </li>
            <li>
              If your load needs Special Handling, please select it for an accurate quote. Carriers
              charge for Special Handling if needed, and this will affect your final invoice.
            </li>
            <li>
              The pickup date and transit time vary by the carrier and are not guaranteed unless
              otherwise stated.
            </li>
            <li>
              Here is our
              <a href="#">Terms & Conditions</a> for further details
            </li>
          </ul>
          <div class="confirm">
            <p>By clicking on Confirm you accept our Terms & Conditions</p>
            <md-button @click="confirm()" class="md-primary">Confirm</md-button>
          </div>
        </div>
      </ion-card-content>
    </ion-card>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "Confirmation",
  data: () => ({
    shipment: null
  }),
  methods: {
    confirm() {
      axios
        .post("add-shipment", JSON.parse(localStorage.getItem("order")))
        .then(res => {
          console.log("... ", res.data);
/*           if (localStorage.getItem("order")) {
            localStorage.removeItem("order");
          }
          if (localStorage.getItem("prg-value")) {
            localStorage.removeItem("prg-value");
          } */
          this.$router.push("completion");
        })
        .catch(err => {
          console.log(err);
        });
    },
    calculateTotalDW() {
      let total = 0;
      this.shipment.myItem.items.forEach(element => {
        total = total + element.dw;
      });
      return total;
    }
  },
  created() {
    this.shipment = JSON.parse(localStorage.getItem("order"));
  }
};
</script>
<style lang="scss" scoped>
ion-card {
  margin: 20px auto;
  text-align: left;
  background: #fff;
  ion-card-content {
    background: #fff;
    padding: 20px;
  }
  .item {
    margin: 0 0 10px 10px;
  }
  .confirm {
    display: flex;
    justify-content: space-between;
  }
}
</style>