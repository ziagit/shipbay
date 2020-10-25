<template>
<div>
    <md-card class="no-shadow-bordered">
        <md-card-header>
            <div>
                <div class="md-title">Order details</div>
                <div v-if="dataLoaded" class="job-id">
                    <span>{{order.uniqid}}</span> |
                    <span>{{formatedDate}}</span>
                </div>
            </div>

            <md-button @click="$router.back()" class="md-icon-button close-btn">
                <md-icon>close</md-icon>
                <md-tooltip>Cancel</md-tooltip>
            </md-button>
        </md-card-header>
        <md-card-content v-if="dataLoaded">
            <div class="status">
                <span>Status:</span>
                <md-menu md-size="auto" :mdCloseOnSelect="true" v-if="dataLoaded">
                    <md-button md-menu-trigger v-bind:class="{delivered: order.job_with_status.jobstatus.id == 6}">{{order.job_with_status.jobstatus.title}}</md-button>

                    <md-menu-content>
                        <md-menu-item v-for="state in status" :key="state.id" @click="markAsReceived(state.id)">{{state.title}}</md-menu-item>
                    </md-menu-content>
                </md-menu>
                <div v-show="dataLoading" class="loading">
                    <Spinner />
                </div>
            </div>
            <div class="src-des">
                <md-card class="src">
                    <md-card-content>
                        <h3 class="md-subheading">Pickup Details</h3>
                        <div class="body-1">Country: {{order.full_address[0].country.name}}</div>
                        <div class="body-1">Address: {{order.full_address[0].address}}</div>
                        <div class="body-1">City: {{order.full_address[0].city}}</div>
                        <div class="body-1">Zip code: {{order.full_address[0].zip}}</div>
                        <div class="body-1">Contact name: {{order.contacts[0].name}}</div>
                        <div class="body-1">Phone: {{order.contacts[0].phone}}</div>
                        <div class="body-1">Email: {{order.contacts[0].email}}</div>
                        <div class="body-1">Appointment: {{order.src_appointment_time}}</div>
                    </md-card-content>
                </md-card>
                <md-card class="des">
                    <md-card-content>
                        <h3 class="md-subheading">Delivery Details</h3>
                        <div class="body-1">Country: {{order.full_address[1].country.name}}</div>
                        <div class="body-1">Address: {{order.full_address[1].address}}</div>
                        <div class="body-1">City: {{order.full_address[1].city}}</div>
                        <div class="body-1">Zip code: {{order.full_address[1].zip}}</div>
                        <div class="body-1">Contact name: {{order.contacts[1].name}}</div>
                        <div class="body-1">Phone: {{order.contacts[1].phone}}</div>
                        <div class="body-1">Email: {{order.contacts[1].email}}</div>
                        <div class="body-1">Appointment: {{order.des_appointment_time}}</div>
                    </md-card-content>
                </md-card>
            </div>

            <md-card class="items">
                <md-card-content>
                    <h3 class="md-subheading">Item Details</h3>
                    <div v-for="item in order.items" :key="item.id">
                        <div class="body-1">{{item.description}}, {{item.dimentional_weight}} Pounds</div>
                    </div>
                    <div>
                        <div class="body-1">Min temperature(FH) {{order.min_temperature}}</div>
                        <div class="body-1">Max temperature(FH) {{order.max_temperature}}</div>
                        <div class="body-1">Is dangerouse good? {{order.max_temperature}}</div>
                    </div>
                </md-card-content>
            </md-card>
            <md-card class="shipment">
                <md-card-content>
                    <h3 class="md-subheading">Shippment general info</h3>
                    <div class="body-1">Pickup date: {{order.pickup_date}}</div>
                    <div class="body-1">Estimated item value: ${{order.estimated_value}}</div>
                    <div class="body-1">Cost: ${{Math.round(order.cost)}}</div>
                </md-card-content>
            </md-card>
        </md-card-content>
        <md-card-actions></md-card-actions>
    </md-card>
</div>
</template>

<script>
import axios from "axios";
import Spinner from "../../shared/Spinner";
import functions from "../../services/functions";
export default {
    name: "orderDetails",
    data: () => ({
        order: null,
        active: false,
        hasHistory: false,
        notification: null,
        notificationId: null,
        formatedDate: null,
        dataLoaded: false,
        status: [],
        selectedStatus: null,
        dataLoading: false,
        emails: {
            src: null,
            des: null,
        },
    }),
    methods: {
        orderDetails() {
            axios
                .get("shipper/orders/" + this.$route.params.id)
                .then((res) => {
                    console.log("order details ", res.data);
                    this.order = res.data;
                    this.formatedDate = functions.myDateFormat(this.order.created_at);
                    if (this.order != null) {
                        this.dataLoaded = true;
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        markAsRead() {
            axios
                .get("auth/read-notification/" + this.notificationId)
                .then((res) => {
                    console.log(res.data);
                    this.$router.replace("../orders");
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        markAsReceived() {
            this.dataLoading = true;
            axios
                .post("shipper/orders/" + this.$route.params.id, {
                    jobId: this.order.job_with_status.id,
                })
                .then((res) => {
                    this.order = res.data;
                    this.dataLoading = false;
                    console.log("updated order: ", res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        orderStatus() {
            axios
                .get("shipper/order-status")
                .then((res) => {
                    this.status.push(res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    created() {
        this.orderDetails();
        this.orderStatus();
        this.notificationId = this.$store.state.shared.notificationId;
    },
    watch: {
        $route() {
            this.notificationId = this.$store.state.shared.notificationId;
            this.orderDetails();
        },
    },
    components: {
        Spinner,
    },
};
</script>

<style lang="scss" scoped>
.md-card {
    text-align: center;

    .status {
        display: flex;
        justify-content: flex-end;
        align-items: center;

        .delivered {
            color: green !important;
        }
    }

    .src,
    .des,
    .items,
    .shipment {
        box-shadow: none;
        border: 1px solid rgb(241, 241, 241);
        text-align: left;
    }

    .shipment {
        margin-top: 11px;
    }

    .src-des {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;

        .src {
            flex: 1;
        }

        .des {
            flex: 1;
        }
    }

    .close-btn {
        position: absolute;
        top: 0;
        right: 0;
    }

    .job-id {
        span {
            font-size: 11px;
            margin: 0;
            padding: 0;
        }
    }
}

.md-subheading {
    font-weight: 500;
}
</style>
