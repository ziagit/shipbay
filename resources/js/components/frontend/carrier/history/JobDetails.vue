<template>
<div>
    <md-card class="no-shadow-bordered">
        <md-card-header>
            <md-button @click="$router.back()" class="md-icon-button close-btn">
                <md-icon>close</md-icon>
                <md-tooltip>Cancel</md-tooltip>
            </md-button>
            <div>
                <div class="md-title">order_detail details</div>
                <div v-if="dataLoaded" class="job-id">
                    <span>{{job.order_detail.uniqid}}</span> |
                    <span>{{formatedDate}}</span>
                </div>
            </div>
        </md-card-header>
        <md-card-content v-if="dataLoaded">
            <div class="status">
                <span>Status:</span>
                <md-menu md-size="auto" :mdCloseOnSelect="true" v-if="dataLoaded">
                    <md-button md-menu-trigger v-bind:class="{delivered: job.jobstatus.id == 5}">{{job.jobstatus.title}}</md-button>

                    <md-menu-content>
                        <md-menu-item v-for="state in status" :key="state.id" @click="updateJob(state.id)">{{state.title}}</md-menu-item>
                    </md-menu-content>
                </md-menu>
                <div v-show="dataLoading" class="loading">
                    <Spinner />
                </div>
            </div>
            <div class="src-des">
                <md-card class="src">
                    <md-card-content>
                        <h3 class="md-subheading">Pickup details</h3>
                        <div class="body-1">Country: {{job.order_detail.full_address[0].country.name}}</div>
                        <div class="body-1">State: {{job.order_detail.full_address[0].state.name}}</div>
                        <div class="body-1">City: {{job.order_detail.full_address[0].city.name}}</div>
                        <div class="body-1">Address: {{job.order_detail.full_address[0].address.name}}</div>
                        <div class="body-1">Zip code: {{job.order_detail.full_address[0].zip.postal_code}}</div>
                        <div class="body-1">Contact name: {{job.order_detail.contacts[0].name}}</div>
                        <div class="body-1">Phone: {{job.order_detail.contacts[0].phone}}</div>
                        <div class="body-1">Email: {{job.order_detail.contacts[0].email}}</div>
                        <div class="body-1">Appointment: {{job.order_detail.src_appointment_time}}</div>
                    </md-card-content>
                </md-card>
                <md-card class="des">
                    <md-card-content>
                        <h3 class="md-subheading">Delivery details</h3>
                        <div class="body-1">Country: {{job.order_detail.full_address[1].country.name}}</div>
                        <div class="body-1">State: {{job.order_detail.full_address[1].state.name}}</div>
                        <div class="body-1">City: {{job.order_detail.full_address[1].city.name}}</div>
                        <div class="body-1">Address: {{job.order_detail.full_address[1].address.name}}</div>
                        <div class="body-1">Zip code: {{job.order_detail.full_address[1].zip.postal_code}}</div>
                        <div class="body-1">Contact name: {{job.order_detail.contacts[1].name}}</div>
                        <div class="body-1">Phone: {{job.order_detail.contacts[1].phone}}</div>
                        <div class="body-1">Email: {{job.order_detail.contacts[1].email}}</div>
                        <div class="body-1">Appointment: {{job.order_detail.src_appointment_time}}</div>
                    </md-card-content>
                </md-card>
            </div>

            <md-card class="items">
                <md-card-content>
                    <h3 class="md-subheading">Items</h3>
                    <div v-for="item in job.order_detail.items_with_type" :key="item.id">
                        <div class="body-1">Name: {{item.description}}</div>
                        <div class="body-1">Type: {{item.itemtype.title}}</div>
                        <div class="body-1">Dimentional weight: {{item.dimentional_weight}} Pounds</div>
                        <div class="body-1">Min temperature(FH): {{job.order_detail.min_temperature}}</div>
                        <div class="body-1">Max temperature(FH): {{job.order_detail.max_temperature}}</div>
                        <div class="body-1">Is dangerouse good?: {{job.order_detail.max_temperature}}</div>
                    </div>
                </md-card-content>
            </md-card>
            <md-card class="order_detail">
                <md-card-content>
                    <h3 class="md-subheading">Shippment general info</h3>
                    <div class="body-1">Pickup date: {{job.order_detail.pickup_date}}</div>
                    <div class="body-1">Estimated value: ${{job.order_detail.estimated_value}}</div>
                    <div class="body-1">Cost: ${{Math.round(job.order_detail.cost)}}</div>
                </md-card-content>
            </md-card>
        </md-card-content>
        <md-card-actions>
            <md-button class="md-icon-button mark-as-read" @click="markAsRead()">
                <md-icon>done</md-icon>
                <md-tooltip>Mark as read</md-tooltip>
            </md-button>
        </md-card-actions>
    </md-card>
</div>
</template>

<script>
import axios from "axios";
import Spinner from "../../shared/Spinner";
import functions from '../../services/functions'
export default {
    name: "JobDetails",
    data: () => ({
        job: null,
        active: false,
        hasHistory: false,
        notification: null,
        notificationId: null,
        dataLoaded: false,
        status: [],
        selectedStatus: null,
        dataLoading: false,
        formatedDate: null,
        emails: {
            src: null,
            des: null,
        },
    }),
    methods: {
        jobDetails() {
            axios
                .get("carrier/jobs/" + this.$route.params.id)
                .then((res) => {
                    console.log("job details ", res.data);
                    if (res.data) {
                        this.dataLoaded = true;
                        this.job = res.data;
                        this.formatedDate = functions.myDateFormat(this.job.created_at);
                        return;
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
                    this.$router.replace("../jobs");
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        updateJob(statusId) {
            this.dataLoading = true;
            axios
                .put("carrier/jobs/" + this.$route.params.id, {
                    status: statusId,
                    emails: [
                        this.job.order_detail.contacts[0].email,
                        this.job.order_detail.contacts[1].email,
                    ],
                })
                .then((res) => {
                    this.job = res.data;
                    this.dataLoading = false;
                    console.log("updated job: ", res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getJobStatus() {
            axios
                .get("carrier/job-status")
                .then((res) => {
                    console.log("job statues: ", res.data);
                    this.status = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    created() {
        this.jobDetails();
        this.getJobStatus();
        this.notificationId = this.$store.state.shared.notificationId;
    },
    watch: {
        $route() {
            this.notificationId = this.$store.state.shared.notificationId;
            this.jobDetails();
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

    .md-card {
        margin: 5px;
    }

    .src,
    .des,
    .items,
    .order_detail {
        box-shadow: none;
        border: 1px solid rgb(241, 241, 241);
        text-align: left;
    }

    .order_detail {
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

    .md-subheading {
        font-size: 18px;
    }
}
</style>
