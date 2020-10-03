<template>
<div>
    <form @submit.prevent="submit" enctype="multipart/form-data">
        <md-card>
            <md-card-header>
                <div class="md-title">New rate</div>
                <md-button @click="$router.back()" class="md-icon-button add-btn">
                    <md-icon>close</md-icon>
                    <md-tooltip>Cancel</md-tooltip>
                </md-button>
            </md-card-header>
            <md-card-content>
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="2">ORIGIN</th>
                            <th colspan="2">DESTINITION</th>
                            <th rowspan="2">Min charge</th>
                            <th colspan="7">RATES PER 100LB WITHIN WEIGHT BRACKETS</th>
                            <th rowspan="2">FSC%</th>
                            <th rowspan="2">Transit day</th>
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
                        <tr>
                            <td>
                                <Search :data="srcStates" v-on:set-data="getSrcStates" v-on:get-data="selectSrcState" />
                            </td>
                            <td>
                                <Search :data="srcCities" v-on:set-data="getSrcCities" v-on:get-data="selectSrcCity" />
                            </td>

                            <td>
                                <Search :data="desStates" v-on:set-data="getDesStates" v-on:get-data="selectDesState" />
                            </td>
                            <td>
                                <Search :data="desCities" v-on:set-data="getDesCities" v-on:get-data="selectDesCity" />
                            </td>

                            <td>
                                <input type="number" min="1" v-model="form.min_rate" required placeholder="($)" />
                            </td>
                            <td>
                                <input type="number" min="1" v-model="form.k0_k1" required placeholder="($)" />
                            </td>
                            <td>
                                <input type="number" min="1" v-model="form.k1_k2" required placeholder="($)" />
                            </td>
                            <td>
                                <input type="number" min="1" v-model="form.k2_k3" required placeholder="($)" />
                            </td>
                            <td>
                                <input type="number" min="1" v-model="form.k3_k4" required placeholder="($)" />
                            </td>
                            <td>
                                <input type="number" min="1" v-model="form.k4_k5" required placeholder="($)" />
                            </td>
                            <td>
                                <input type="number" min="1" v-model="form.k5_k10" required placeholder="($)" />
                            </td>
                            <td>
                                <input type="number" min="1" v-model="form.above_10k" required placeholder="($)" />
                            </td>
                            <td>
                                <input type="number" min="1" v-model="form.fsc" required placeholder="(%)" />
                            </td>
                            <td>
                                <input type="number" min="1" v-model="form.transit_day" required placeholder="(day)" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </md-card-content>
            <md-card-actions>
                <md-button type="submit" class="md-primary md-small-fab">Save</md-button>
            </md-card-actions>
        </md-card>
    </form>
</div>
</template>

<script>
import axios from "axios";
import Search from "../../shared/Search";
import {
    mapGetters
} from "vuex";
export default {
    name: "AddRate",
    data: () => ({
        form: {
            src_state: null,
            des_state: null,
            src_city: null,
            des_city: null,
            min_rate: null,
            k0_k1: null,
            k1_k2: null,
            k2_k3: null,
            k3_k4: null,
            k4_k5: null,
            k5_k10: null,
            above_10k: null,
            fsc: null,
            transit_day: null,
            carrierId: null,
        },
        countries: [],
        srcStates: [],
        desStates: [],
        srcCities: [],
        desCities: [],
        carrierId: null,
        countryId: null,
    }),
    computed: {
        ...mapGetters({
            temp: "shared/temp",
        }),
    },
    methods: {
        getSrcStates(keywords) {
            axios
                .get("search-state/" + this.countries[1].id, {
                    params: {
                        keywords: keywords,
                    },
                })
                .then((res) => {
                    console.log("state search res: ", res.data.data);
                    this.srcStates = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        selectSrcState(selected) {
            this.form.src_state = selected.id;
        },
        getDesStates(keywords) {
            axios
                .get("search-state/" + this.countries[1].id, {
                    params: {
                        keywords: keywords,
                    },
                })
                .then((res) => {
                    this.desStates = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        selectDesState(selected) {
            this.form.des_state = selected.id;
        },
        getSrcCities(keywords) {
            axios
                .get("search-city/" + this.form.src_state, {
                    params: {
                        keywords: keywords,
                    },
                })
                .then((res) => {
                    this.srcCities = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        selectSrcCity(selected) {
            this.form.src_city = selected.id;
        },
        getDesCities(keywords) {
            axios
                .get("search-city/" + this.form.des_state, {
                    params: {
                        keywords: keywords,
                    },
                })
                .then((res) => {
                    this.desCities = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        selectDesCity(selected) {
            this.form.des_city = selected.id;
        },

        submit() {
            axios
                .post("carrier/rates", this.form)
                .then((res) => {
                    this.$emit("show-snackbar");
                    this.$router.back();
                    console.log("res ", res.data);
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },
        getCountries() {
            axios
                .get("countries")
                .then((res) => {
                    this.countries = res.data;
                    console.log("counteris: ", res.data);
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },
    },

    created() {
        this.form.carrierId = this.temp.me;
        this.countryId = this.temp.country;
        this.getCountries();
    },
    components: {
        Search,
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

        th {
            font-size: 11px;
            color: #666;
        }

        th,
        td {
            border: 1px solid #ddd;
        }

        td {
            input {
                max-width: 50px;
                border: none;
                font-family: "Times New Roman", Times, serif;
            }

            input:focus {
                outline: none;
            }
        }
    }

    .add-btn {
        position: absolute;
        top: 0;
        right: 0;
    }
}
</style>
