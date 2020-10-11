<template>
<div class="shipment-details">
    <md-card mode="ios" color="light">
        <md-card-header>
            <h3 class="md-title">Shipment details</h3>
        </md-card-header>
        <md-card-content v-if="dataLoaded">
            <div>
                <p>
                    Dear {{shipment.order_detail.shipper.first_name}},
                    <br />your freight
                    <span>{{shipment.jobstatus.title}}</span>
                </p>
                <p>You will be collecting your freight at bellow address</p>

                <p> {{shipment.order_detail.full_address[1].country.name}},
                    {{shipment.order_detail.full_address[1].state.name}},<br>
                    {{shipment.order_detail.full_address[1].city.name}},
                    {{shipment.order_detail.full_address[1].zip.postal_code}},
                    {{shipment.order_detail.full_address[1].address.name}}
                </p>

                <div>
                    <div class="carrier-contacts">
                        <label>Carrier contacts</label>
                        <md-switch v-model="carrierTogal"></md-switch>
                    </div>
                    <div v-show="carrierTogal">
                        <div v-if="carrier != null">
                            <p>{{carrier.last_name}} <br>
                                {{carrier.contact.phone}} <br>
                                {{carrier.contact.email}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </md-card-content>
    </md-card>
</div>
</template>

<script>
import axios from "axios";
export default {
    name: "ShipmentDetails",
    data: () => ({
        dataLoaded: false,
        shipment: null,
        carrier: null,
        carrierExist: false,
        carrierTogal: false,
    }),
    watch: {
        carrierTogal(data) {
            if (data) {
                this.getCarrier()
            }
        }
    },
    methods: {
        get() {
            axios
                .get("shipment-details/" + this.$route.params.id)
                .then((res) => {
                    this.shipment = res.data;
                    this.dataLoaded = true;
                    console.log("res: ", this.shipment);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getCarrier() {
            if (this.carrier == null) {
                axios
                    .get("carrier-contacts/" + this.shipment.carrier_id)
                    .then((res) => {
                        this.carrierExist = true;
                        this.carrier = res.data;
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

    md-card {
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
