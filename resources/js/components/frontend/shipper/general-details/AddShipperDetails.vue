<template>
<div>
    <form @submit.prevent="submit" enctype="multipart/form-data">
        <md-card class="main-card" v-touch:tap="tapHandler">
            <div class="inputs-container">
                <div class="row">
                    <md-field>
                        <label for="">First name</label>
                        <md-input type="text" v-model="form.first_name" required ref="focusable"></md-input>
                    </md-field>
                    <md-field>
                        <label for="">Last name</label>
                        <md-input type="text" v-model="form.last_name" required></md-input>
                    </md-field>
                    <md-field>
                        <label for="">Phone</label>
                        <md-input type="tel" v-model="form.phone" required></md-input>
                    </md-field>
                </div>
                <div class="row">
                    <md-field>
                        <label for="">Select country</label>
                        <md-select v-model="form.country" name="country" id="country">
                            <md-option v-for="country in countries" :value="country.id" :key="country.id">{{ country.name }}</md-option>
                        </md-select>
                        <input class="hidden-input" v-model="form.country" required />
                    </md-field>

                    <md-menu md-direction="bottom-start" class="" md-align-trigger md-dense>
                        <md-field>
                            <label for="">Search state</label>
                            <md-input v-model="sk" required v-touch:tap="tapHandler" md-menu-trigger></md-input>
                        </md-field>
                        <md-menu-content>
                            <div v-if="states">
                                <md-menu-item v-if="states.length === 0">Not found</md-menu-item>
                            </div>
                            <div v-else>
                                <md-menu-item>Type</md-menu-item>
                            </div>
                            <md-menu-item v-for="list in states" :key="list.id" @click="selectState(list)">{{ list.name }}</md-menu-item>
                        </md-menu-content>
                    </md-menu>
                    <md-menu md-direction="bottom-start" class="" md-align-trigger md-dense>
                        <md-field>
                            <label for="">Search city</label>
                            <md-input v-model="ck" required md-menu-trigger></md-input>
                        </md-field>
                        <md-menu-content>
                            <div v-if="cities">
                                <md-menu-item v-if="cities.length === 0">Not found</md-menu-item>
                            </div>
                            <div v-else>
                                <md-menu-item>Type</md-menu-item>
                            </div>
                            <md-menu-item v-for="list in cities" :key="list.id" @click="selectCity(list)">{{ list.name }}</md-menu-item>
                        </md-menu-content>
                    </md-menu>
                </div>
                <div class="row">
                    <md-menu md-direction="bottom-start" class="zip-address" md-align-trigger md-dense>
                        <md-field>
                            <label for="">Search address</label>
                            <md-input v-model="ak" required md-menu-trigger></md-input>
                        </md-field>
                        <md-menu-content>
                            <div v-if="addresses">
                                <md-menu-item v-if="addresses.length === 0">Not found</md-menu-item>
                            </div>
                            <div v-else>
                                <md-menu-item>Type</md-menu-item>
                            </div>
                            <md-menu-item v-for="list in addresses" :key="list.id" @click="selectAddress(list)">{{ list.name }}</md-menu-item>
                        </md-menu-content>
                    </md-menu>
                    <md-menu md-direction="bottom-start" class="zip-address" md-align-trigger md-dense>
                        <md-field>
                            <label for="">Search postal code</label>
                            <md-input v-model="zk" required md-menu-trigger></md-input>
                        </md-field>
                        <md-menu-content>
                            <div v-if="zips">
                                <md-menu-item v-if="zips.length === 0">Not found</md-menu-item>
                            </div>
                            <div v-else>
                                <md-menu-item>Type</md-menu-item>
                            </div>
                            <md-menu-item v-for="list in zips" :key="list.id" @click="selectZip(list)">{{ list.postal_code }}</md-menu-item>
                        </md-menu-content>
                    </md-menu>
                </div>
            </div>
            <md-button type="submit" class="md-primary md-small-fab">Save</md-button>
        </md-card>
    </form>
    <Snackbar :data="snackbar" />
</div>
</template>

<script>
import axios from "axios";
import Snackbar from "../../shared/Snackbar";
export default {
    name: "AddGeneralInfo",
    data: () => ({
        form: {
            first_name: null,
            last_name: null,
            address: null,
            country: null,
            state: null,
            city: null,
            postal_code: null,
            address: null,
            phone: null,
            website: null,
            company: null,
            detail: null,
        },
        countries: null,
        states: null,
        cities: null,
        zips: null,
        addresses: null,
        hasCompany: false,
        sk: null,
        ck: null,
        zk: null,
        ak: null,
        snackbar: {
            show: false,
            message: null,
            statusCode: null,
        },
    }),
    watch: {
        sk(after, before) {
            this.getState()
        },
        ck(after, before) {
            this.getCity()
        },
        zk(after, before) {
            this.getZip()
        },
        ak(after, before) {
            this.getAddress()
        },
    },
    methods: {
        getState() {
            axios
                .get("search-state/" + this.form.country, {
                    params: {
                        keywords: this.sk,
                    },
                })
                .then((res) => {
                    console.log("states: ", res.data.data);
                    this.states = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getCity() {
            axios
                .get("search-city/" + this.form.state, {
                    params: {
                        keywords: this.ck,
                    },
                })
                .then((res) => {
                    console.log("cities: ", res.data.data);
                    this.cities = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        getAddress() {
            axios
                .get("search-address/" + this.form.city, {
                    params: {
                        keywords: this.ak,
                    },
                })
                .then((res) => {
                    console.log("address: ", res.data.data);
                    this.addresses = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getZip() {
            axios
                .get("search-zip/" + this.form.address, {
                    params: {
                        keywords: this.zk,
                    },
                })
                .then((res) => {
                    console.log("zips: ", res.data.data);
                    this.zips = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        selectState(selected) {
            this.sk = selected.name
            this.form.state = selected.id;
        },

        selectCity(selected) {
            this.ck = selected.name
            this.form.city = selected.id;
        },

        selectAddress(selected) {
            this.ak = selected.name
            this.form.address = selected.id;
        },
        selectZip(selected) {
            this.zk = selected.postal_code
            this.form.postal_code = selected.id;
        },
        submit() {
            axios
                .post("shipper/details", this.form)
                .then((res) => {
                    console.log(">> ", res.data);
                    this.$router.push("/shipper");
                })
                .catch((error) => {
                    console.log("eerrr: ", error.response);
                    this.snackbar.message = error.response.data.errors;
                    this.snackbar.statusCode = error.response.status;
                    this.snackbar.show = true;
                });
        },

        getCountries() {
            axios
                .get("countries")
                .then((res) => {
                    this.countries = res.data;
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },
        tapHandler(direction) {
            console.log("tap: ", direction)
        },
    },
    mounted() {
        this.$refs.focusable.$el.focus();
    },
    created() {
        this.getCountries();
    },
    components: {
        Snackbar,
    },
};
</script>

<style lang="scss" scoped>
.main-card {
    padding: 30px;
    text-align: center;
    box-shadow: none;
    border: solid 1px #ddd;

    .shipper-logo {
        text-align: center;
        margin-top: -40px;

        .md-large {
            background: #ddd;
        }
    }

    .inputs-container {
        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;

            .md-field {
                flex: 32%;
            }

            .zip-address {
                flex: 50%;
            }
        }
    }
}
</style>
