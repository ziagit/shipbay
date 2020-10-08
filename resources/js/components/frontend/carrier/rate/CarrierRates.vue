<template>
<div>
    <md-dialog-confirm :md-active.sync="active" md-title="Caution!" md-content="Make sure it's not an accident!" md-confirm-text="Agree" md-cancel-text="Disagree" @md-cancel="cancel" @md-confirm="confirm" />

    <md-card class="md-primary" md-theme="orange-card">
        <md-card-header>
            <!--   <md-field md-clearable class="search-feild">
          <label for="search">Search by city/zip... </label>
          <md-input v-model="keywords" id="search"/>
        </md-field> -->
            <div class="md-title">Rates</div>
            <md-button to="add" class="md-icon-button add-rate" v-if="rates.length != 0">
                <md-icon>add</md-icon>
                <md-tooltip>Add new rate</md-tooltip>
            </md-button>
        </md-card-header>
        <md-card-content>
            <table class="table" v-if="rates.length != 0">
                <thead>
                    <tr>
                        <th rowspan="2"> # </th>
                        <th colspan="2">ORIGIN</th>
                        <th colspan="2">DESTINITION</th>
                        <th rowspan="2">Min charge</th>
                        <th colspan="7">RATES PER 100LB WITHIN WEIGHT BRACKETS</th>
                        <th rowspan="2">FSC%</th>
                        <th rowspan="2">Transit day</th>
                        <th rowspan="2" colspan="2">Actions</th>
                    </tr>
                    <tr>
                        <th scope="col">State</th>
                        <th scope="col">City</th>
                        <th scope="col">State</th>
                        <th scope="col">City</th>
                        <th scope="col">0K - 1k</th>
                        <th scope="col">1K - 2K</th>
                        <th scope="col">2K - 3K</th>
                        <th scope="col">3K - 4K</th>
                        <th scope="col">4K - 5K</th>
                        <th scope="col">5K - 10K</th>
                        <th scope="col">Above 10K</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(rate, index) in rates" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{rate.city_with_state[0].state.name}}</td>
                        <td>{{rate.city_with_state[0].name}}</td>
                        <td>{{rate.city_with_state[1].state.name}}</td>
                        <td>{{rate.city_with_state[1].name}}</td>
                        <td>${{rate.min_rate}}</td>
                        <td>${{rate._0k_1k}}</td>
                        <td>${{rate._1k_2k}}</td>
                        <td>${{rate._2k_3k}}</td>
                        <td>${{rate._3k_4k}}</td>
                        <td>${{rate._4k_5k}}</td>
                        <td>${{rate._5k_10k}}</td>
                        <td>${{rate.above_10k}}</td>
                        <td>{{rate.fsc}}</td>
                        <td>{{rate.transit_day}}</td>
                        <td>
                            <md-button :to="{path: 'edit/'+ rate.id}" class="md-icon-button md-primary">
                                <md-icon>edit</md-icon>
                                <md-tooltip>Edit Rate</md-tooltip>
                            </md-button>
                        </td>
                        <td>
                            <md-button class="md-icon-button md-accent" @click="active=true, idToDelete=rate.id">
                                <md-icon>delete</md-icon>
                                <md-tooltip>Delete Rate</md-tooltip>
                            </md-button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <md-empty-state v-else class="md-primary" md-icon="sentiment_satisfied_alt" md-label="Not available" md-description="Click + icon to add">
                <md-button to="add" class="md-icon-button md-raised">
                    <md-icon>add</md-icon>
                    <md-tooltip>Add new rate</md-tooltip>
                </md-button>
            </md-empty-state>
        </md-card-content>
    </md-card>
</div>
</template>

<script>
import axios from "axios";
export default {
    data: () => ({
        rates: [],
        active: false,
        idToDelete: null,
        srcCityDelete: null,
        desCityDelete: null,
        rateExist: true,
        carrierId: null,
        keywords: null,
    }),
    watch: {
        keywords(after, before) {
            this.search();
        },
    },
    methods: {
        search() {
            axios
                .get("carrier/search-rate", {
                    params: {
                        keywords: this.keywords
                    }
                })
                .then((res) => {
                    this.rates = res.data.data;
                    console.log("searched ", res.data.carrier_rates)
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        get() {
            axios
                .get("carrier/rates")
                .then((res) => {
                    this.rates = res.data.rate_with_city;
                    console.log("rates: ", this.rates)

                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },
        deleteRate(rateId) {
            this.active = true;
        },
        confirm() {
            axios
                .delete("carrier/rates/" + this.idToDelete)
                .then((res) => {
                    this.$emit("show-snackbar");
                    this.get();
                })
                .catch((error) => {
                    console.log("Error: ", error);
                });
        },
        cancel() {
            this.value = "Disagreed";
        },
    },
    created() {
        this.get();
    },
};
</script>>

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

        th {
            font-size: 11px;
            color: #666;
        }

        th,
        td {
            border: 1px solid #ddd;
        }
    }

    .add-rate {
        position: absolute;
        top: 0;
        right: 0;
    }

    .search-feild {
        border-bottom: #ddd 1px solid;
        width: 30%;
        margin: 0;
    }
}
</style>
