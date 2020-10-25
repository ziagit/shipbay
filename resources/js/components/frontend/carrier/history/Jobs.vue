<template>
<div>
    <md-card md-theme="orange-card">
        <md-card-header>
            <div class="md-title">Job history</div>
        </md-card-header>
        <md-card-content>
            <table class="table" v-if="jobs.length != 0">
                <thead>
                    <tr>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="job in jobs" :key="job.id">
                        <td>{{job.order_detail.full_address[0].city}}</td>
                        <td>{{job.order_detail.full_address[1].city}}</td>
                        <td>{{job.created_at}}</td>
                        <td v-bind:class="{delivered: job.jobstatus.id == 5}">{{job.jobstatus.title}}</td>

                        <td>
                            <md-button :to="{path: 'details/'+job.id}" class="md-primay md-icon-button">
                                <md-icon>more_horiz</md-icon>
                                <md-tooltip>View more</md-tooltip>
                            </md-button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <md-empty-state class="md-primary" md-icon="done" md-label="Nothing in Done" md-description="Anything you mark done will be safely stored here." v-if="jobs.length == 0"></md-empty-state>
        </md-card-content>
    </md-card>
</div>
</template>

<script>
import axios from "axios";
export default {
    name: "Jobs",
    data: () => ({
        jobs: [],
    }),
    methods: {
        getJobs() {
            axios
                .get("carrier/jobs")
                .then((res) => {
                    this.jobs = res.data;
                    console.log("job list ", this.jobs);
                })
                .catch((err) => {
                    console.log("error", err);
                });
        },
    },
    created() {
        this.getJobs();
    },
};
</script>

<style lang="scss" scoped>
.md-card {
    box-shadow: none;
    border: 1px solid #ddd;
    text-align: center;

    .md-card-content {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;

        th,
        td {
            border: 1px solid #ddd;
        }

        .delivered {
            color: green !important;
        }
    }

    .add-btn {
        position: absolute;
        top: 0;
        right: 0;
    }
}
</style>
