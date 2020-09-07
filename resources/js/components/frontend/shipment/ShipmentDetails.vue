<template>
  <div class="shipment-details">
    <ion-card mode="ios" color="light">
      <ion-card-header>
        <ion-title>Shipment details</ion-title>
      </ion-card-header>
      <ion-card-content v-if="dataLoaded">
        <ion-text>
          <p>
            Dear {{shipment.shipment.full_address[1].name}},
            <br />your freight
            <span color="danger">{{shipment.jobstatus.title}}</span>
          </p>
          <p>You will be collecting your freight at bellow address</p>
          <p>{{shipment.shipment.full_address[1].city.name}}, {{shipment.shipment.full_address[1].citycode.postal_code}}, {{shipment.shipment.full_address[1].address}}</p>

          <div>
            <div class="carrier-contacts">
              <ion-label>Carrier contacts</ion-label>
              <ion-toggle @ionChange="getCarrier()"></ion-toggle>
            </div>
            <div v-show="carrierTogal">
              <ion-text v-if="carrierContacts != null">
                <p>{{carrierContacts.last_name}}</p>
                <p>{{carrierContacts.phone}}</p>
              </ion-text>
            </div>
          </div>
        </ion-text>
      </ion-card-content>
    </ion-card>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "ShipmentDetails",
  data: () => ({
    dataLoaded: false,
    shipment: null,
    carrierContacts: null,
    carrierExist: false,
    carrierTogal: false,
  }),
  methods: {
    get() {
      axios
        .get("shipment-details/" + this.$route.params.id)
        .then((res) => {
          this.shipment = res.data;
          this.dataLoaded = true;
          console.log("res: ", res.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getCarrier() {
      this.carrierTogal = !this.carrierTogal;
      if (this.carrierContacts == null) {
        axios
          .get("carrier-contacts/" + this.shipment.carrier_id)
          .then((res) => {
            this.carrierExist = true;
            this.carrierContacts = res.data;
            console.log(res.data);
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
  },
  created() {
    this.get();
  },
};
</script>
<style lang="scss" scoped>
.shipment-details {
  max-width: 600px;
  margin: auto;
  ion-card {
    text-align: left;
    background: #fff !important;
    span {
      color: green;
    }
    .carrier-contacts {
      display: flex;
      align-items: center;
    }
  }
}
</style>