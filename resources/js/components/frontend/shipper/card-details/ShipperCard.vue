<template>
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
                        <a href="/#/checkout" target="_blank" class="md-primary md-icon-button">
                            <md-icon>edit</md-icon>
                            <md-tooltip>Edit card information</md-tooltip>
                        </a>
                    </div>
                </div>
            </div>
            <md-empty-state v-else class="md-primary" md-icon="sentiment_satisfied_alt" md-label="Card not added yet" md-description="Click bellow link to add one">
                <a href="/#/checkout" target="_blank">Add new card</a>
            </md-empty-state>
        </div>
    </md-card-content>
    <md-card-actions>
        <div class="process-order" v-if="pendingOrder">
            <div class="alert-success" v-if="successMessage">{{successMessage}}</div>
            <div class="alert-error" v-if="errorMessage">{{errorMessage}}</div>

            <md-button v-if="!cardSubmiting && isCustomer" @click="chargeCustomer()">Pay now</md-button>
            <md-button v-if="paymentStatus" @click="targetRoute()">Process order</md-button>
            <Spinner v-if="cardSubmiting" />
        </div>
    </md-card-actions>
</md-card>
</template>

<script>
import axios from "axios";
import Spinner from "../../shared/Spinner";
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
        pendingOrder: false,
        order: null,
        cardSubmiting: false,
        paymentStatus: false,
        isCustomer: false,
    }),
    methods: {
        getCard() {
            axios
                .get("shipper/card-details")
                .then((res) => {
                    if (res.data) {
                        this.card.name = res.data.name;
                        this.card.email = res.data.email;
                        this.dataLoading = false;
                        this.isCustomer = true;
                    } else {
                        this.dataLoading = false;
                    }
                    if (this.watchLocalstorage) {
                        this.pendingOrder = true;
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        chargeCustomer() {
            this.cardSubmiting = true;
            let order = JSON.parse(localStorage.getItem("order"));
            if (order) {
                axios
                    .post("charge-customer", {
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
            } else {
                this.$router.push("/order");
            }
        },

        watchLocalstorage: function () {
            if (localStorage.getItem("order")) {
                return true;
            }
        },
        checkPaymentStatus() {
            let order = JSON.parse(localStorage.getItem("order"));
            if (
                order &&
                order.billing !== undefined &&
                order.billing.status === "paid"
            ) {
                axios
                    .get("check-payment/" + order.id)
                    .then((res) => {
                        if (res.data) {
                            this.paymentStatus = true;
                            console.log("payment statsus: ", res.data);
                        }
                    })
                    .catch((err) => console.log(err));
            }
        },
        targetRoute() {
            this.$router.push(localStorage.getItem("cRoute"));
        },
    },
    created() {
        this.getCard();
        this.checkPaymentStatus();
    },
    components: {
        Spinner,
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
}
</style>
