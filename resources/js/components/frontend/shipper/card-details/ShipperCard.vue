<template>
<div>
    <md-dialog :md-active.sync="checkoutTogal">
        <md-dialog-title>Add your card information</md-dialog-title>
        <md-dialog-content>
            <Card v-on:card-added="refresh" />
        </md-dialog-content>
    </md-dialog>
    <md-card class="no-shadow-bordered">
        <md-card-header>
            <div class="md-title">Card information</div>
        </md-card-header>
        <md-card-content>
            <div v-show="dataLoading" class="loading">
                <Spinner />
            </div>
            <div v-show="!dataLoading">
                <div v-if="card.name">
                    <p>The following information is associated with our payment system.</p>
                    <div>
                        <div class="md-subheading">Name: {{card.name}}</div>
                        <div class="md-subheading">Email: {{card.email}}</div>
                        <div class="edit-card">
                            <md-button @click="editCart()" class="md-primary md-icon-button">
                                <md-icon>edit</md-icon>
                            </md-button>
                        </div>
                    </div>
                </div>
                <md-empty-state v-else class="md-primary" md-icon="sentiment_satisfied_alt" md-label="Card not added yet" md-description="Click bellow link to add one">
                    <a class="payment-card" @click="checkout()">Add new card</a>
                </md-empty-state>
            </div>
        </md-card-content>
        <md-card-actions>
            <div class="process-order">
                <div class="alert-success" v-if="successMessage">{{successMessage}}</div>
                <div class="alert-error" v-if="errorMessage">{{errorMessage}}</div>
                <div v-if="isCardAdded && pendingOrder">
                    <md-button v-if="paymentStatus" @click="targetRoute()">Process order</md-button>
                    <div v-else>
                        <div class="alert-success">Your cart added.</div>
                        <md-button v-if="!cardSubmiting" @click=" chargeCustomer()">Pay now</md-button>
                        <Spinner v-if="cardSubmiting" />
                    </div>
                </div>
            </div>

        </md-card-actions>
    </md-card>
</div>
</template>

<script>
import axios from "axios";
import Spinner from "../../../shared/Spinner";
import Card from "../../card/Card";
import isPaid from "../../services/card";
export default {
    name: "ShipperPaymentDetails",
    data: () => ({
        card: {
            name: null,
            email: null,
        },
        successMessage: null,
        errorMessage: null,
        dataLoading: true,
        order: null,
        cardSubmiting: false,
        paymentStatus: false,
        isCardAdded: false,
        pendingOrder: false,
        checkoutTogal: false,
    }),
    methods: {
        refresh(data) {
            /*  this.checkoutTogal = false; */
            console.log("xxxxxxxxxxxxxxxxxx ", data)
            this.successMessage = data
        },

        editCart() {
            this.checkoutTogal = true
        },
        getCard() {
            axios
                .get("shipper/card-details")
                .then((res) => {
                    if (res.data) {
                        console.log("xxxx ", res.data)
                        this.card.name = res.data.name;
                        this.card.email = res.data.email;
                        this.isCardAdded = true;
                        this.dataLoading = false;
                    } else {
                        this.dataLoading = false;
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        chargeCustomer() {
            this.cardSubmiting = true;
            let order = JSON.parse(localStorage.getItem("order"));
            axios.post("charge-customer", {
                    price: order.carrier.price,
                    id: order.id,
                    email: this.card.email,
                })
                .then((res) => {
                    console.log("response : ", res.data);
                    this.cardSubmiting = false;
                    this.paymentStatus = true;
                    this.successMessage = res.data["message"];
                    order.id = res.data["id"];
                    order.billing.status = res.data["status"];
                    order.billing.email = res.data["email"];
                    localStorage.setItem("order", JSON.stringify(order));
                })
                .catch((err) => (this.errorMassage = err));
        },

        checkPayment() {
            isPaid.checkPayment()
                .then((res) => {
                    if (res.status) {
                        this.paymentStatus = res.status;
                    }
                })
                .catch((error) => {
                    console.log("error: ", error.response);
                });
        },
        targetRoute() {
            this.$router.push(localStorage.getItem("cRoute"));
        },
    },
    created() {
        this.pendingOrder = localStorage.getItem("order");
        this.getCard();
        this.checkPayment();
    },
    components: {
        Spinner,
        Card,
    },
};
</script>

<style lang="scss" scoped>
.md-card {
    text-align: center;

    .md-card-content {
        text-align: center !important;
    }

    .edit-card {
        margin-top: 30px;
    }

    .process-order {
        margin-top: 30px;
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

    .payment-card:hover {
        cursor: pointer;
    }
}
</style>
