<template>
<div class="confirmation">
    <div class="header">
        <span class="md-display-1">Confirmation</span>
        <div class="md-display-body"> Please take a look at the details to confirm the shipment.</div>
    </div>

    <md-card>
        <md-card-content>
            <div class="md-title">Shipment details</div>
            <div>
                <div class="item-head">Source</div>
                <div class="item">
                    <div class="md-body-1">
                        Country: {{ shipment.src.countryName }}
                    </div>
                    <div class="md-body-1">
                        State: {{ shipment.src.address.state }}
                    </div>
                    <div class="md-body-1">
                        City: {{ shipment.src.address.city }},
                        {{ shipment.src.address.zip }}
                    </div>
                    <div class="md-body-1">
                        Address: {{ shipment.src.address.address }}
                    </div>
                    <div class="md-body-1">
                        Contact name: {{ shipment.shipper.pickupName }}
                    </div>
                    <div class="md-body-1">
                        Phone: {{ shipment.shipper.pickupPhone }}
                    </div>
                    <div class="md-body-1">
                        Email: {{ shipment.shipper.pickupEmail }}
                    </div>
                </div>
            </div>
            <md-divider class="md-inset"></md-divider>
            <div>
                <div class="item-head">Destination</div>
                <div class="item">
                    <div class="md-body-1">
                        Country: {{ shipment.des.countryName }}
                    </div>
                    <div class="md-body-1">
                        State: {{ shipment.des.address.state }}
                    </div>
                    <div class="md-body-1">
                        City: {{ shipment.des.address.city }},
                        {{ shipment.des.address.zip }}
                    </div>
                    <div class="md-body-1">
                        Address: {{ shipment.des.address.address }}
                    </div>
                    <div class="md-body-1">
                        Contact name: {{ shipment.shipper.deliveryName }}
                    </div>
                    <div class="md-body-1">
                        Phone: {{ shipment.shipper.deliveryPhone }}
                    </div>
                    <div class="md-body-1">
                        Email: {{ shipment.shipper.deliveryEmail }}
                    </div>
                </div>
            </div>
            <md-divider class="md-inset"></md-divider>
            <div>
                <div class="item-head">Item(s)</div>
                <div class="item">
                    <div class="md-body-1" v-for="item in shipment.myItem.items" :key="item.id">
                        <div class="md-body-1">
                            Name: {{ item.description }}, {{ item.weight }} Pounds
                        </div>
                    </div>
                    <div class="md-body-1">
                        Totoal weight: {{ totalWeight() }} Pounds
                    </div>
                </div>
            </div>
            <md-divider class="md-inset"></md-divider>
            <div>
                <div class="item-head">Carrier</div>
                <div class="item">
                    <div class="md-body-1">Name: <span v-if="shipment.carrier.company !== 'null'">{{ shipment.carrier.company }}</span><span v-else>{{ shipment.carrier.last_name }}</span></div>
                    <div class="md-body-1">Phone: {{ shipment.carrier.phone }}</div>
                    <div class="md-body-1">
                        Cost:
                        <span class="green">${{ Math.round(shipment.carrier.price) }}</span>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-title">Billing details</div>
                <div class="item-head">
                    The following email is attached to your card
                </div>
                <div class="item">
                    <div class="md-body-1">{{ shipment.billing.email }}</div>
                    <div class="md-body-1" v-if="shipment.billing.status">
                        Status:
                        <span class="green">{{ shipment.billing.status }}</span>
                    </div>
                </div>
            </div>

            <div>
                <p>Important notice</p>
                <ul>
                    <li>
                        All rates quoted are provided according to the Description of
                        Goods declared by the Shipper and may be subject to additional
                        charges in the case of misdeclaration.
                    </li>
                    <li>
                        If your load needs Special Handling, please select it for an
                        accurate quote. Carriers charge for Special Handling if needed,
                        and this will affect your final invoice.
                    </li>
                    <li>
                        The pickup date and transit time vary by the carrier and are not
                        guaranteed unless otherwise stated.
                    </li>
                    <li>
                        <md-menu md-direction="top-start" :md-active.sync="toggle">
                            Here is our
                            <span class="term-link" md-menu-trigger>Terms & Conditions</span>
                            for further details
                            <md-menu-content>
                                <TermsAndConditions />
                            </md-menu-content>
                        </md-menu>
                    </li>
                </ul>
                <div class="confirm">
                    <p>By clicking on Confirm you accept our Terms & Conditions</p>
                    <div v-if="paymentStatus">
                        <Spinner v-if="dataLoading" />
                        <md-button v-if="!dataLoading" @click="confirm()" class="md-primary">Confirm</md-button>
                    </div>
                </div>
            </div>
        </md-card-content>
    </md-card>
    <Snackbar :data="snackbar" />
</div>
</template>

<script>
import axios from "axios";
import functions from "../services/functions";
import Card from "../services/card";
import Spinner from "../../shared/Spinner";
import Snackbar from "../../shared/Snackbar";
import TermsAndConditions from "../../shared/TermsAndConditions";
export default {
    name: "Confirmation",
    data: () => ({
        shipment: null,
        dataLoading: false,
        paymentStatus: false,
        toggle: false,
        snackbar: {
            show: false,
            message: null,
            statusCode: null,
        },
    }),
    methods: {
        confirm() {
            this.dataLoading = true;
            axios
                .post("confirm", JSON.parse(localStorage.getItem("order")))
                .then((res) => {
                    if (localStorage.getItem("order")) {
                        localStorage.removeItem("order");
                    }
                    if (localStorage.getItem("prg-value")) {
                        localStorage.removeItem("prg-value");
                    }
                    if (localStorage.getItem('dflug')) {
                        localStorage.removeItem('dflug');
                    }
                    if (localStorage.getItem('adflug')) {
                        localStorage.removeItem('adflug');
                    }
                    if (localStorage.getItem('aflug')) {
                        localStorage.removeItem('aflug');
                    }
                    if (localStorage.getItem('sflug')) {
                        localStorage.removeItem('sflug');
                    }
                    if (localStorage.getItem('cRoute')) {
                        localStorage.removeItem('cRoute');
                    }
                    this.$router.push("completion");
                    console.log("data: ", res.data)
                    this.dataLoading = false;
                })
                .catch((err) => {
                    this.dataLoading = false;
                    this.snackbar.show = true;
                    this.snackbar.message = err.message;
                    this.snackbar.statusCode = err.status;
                    console.log(err);
                });
        },
        checkPayment() {
            Card.checkPayment()
                .then((res) => {
                    if (res.status) {
                        this.paymentStatus = true;
                    } else {
                        this.dataLoading = false;
                        this.snackbar.show = true;
                        this.snackbar.message =
                            "Add your card informations to process your order";
                        this.snackbar.statusCode = 0;
                        this.$router.push('/shipment/payment-details')
                    }
                })
                .catch((error) => {
                    this.dataLoading = false;
                    this.snackbar.show = true;
                    this.snackbar.message =
                        "Somthing is wrong! refresh your page.";
                    this.snackbar.statusCode = 0;
                    console.log("error: ", error.response);
                });
        },
        totalWeight() {
            return functions.totalWeight(this.shipment.myItem.items);
        },
    },
    created() {
        this.checkPayment();
        this.shipment = JSON.parse(localStorage.getItem("order"));
        console.log("in confirmation ", this.shipment);
    },
    components: {
        Spinner,
        Snackbar,
        TermsAndConditions,
    },
};
</script>

<style lang="scss" scoped>
.confirmation {
    max-width: 600px;
    margin: auto;

    .header {
        margin: 24px auto;
    }

    .md-card {
        margin: 20px auto;
        text-align: left;

        .md-card-content {
            padding: 20px;

            .loading {
                text-align: right;
            }
        }

        .item {
            margin: 0 0 10px 10px;

            .green {
                color: green;
            }
        }
    }

    .md-body-1 {
        width: 100% !important;
    }

    .md-display-1 {
        font-size: 24px;
    }

    .confirm {
        div {
            text-align: right;
        }
    }

    .term-link {
        color: #448aff;
    }

    .term-link:hover {
        cursor: pointer;
    }
}

@media only screen and (min-width: 600px) {
    .confirmation {
        .md-display-1 {
            font-size: 30px;
        }

        .confirm {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    }
}
</style>
