<template>
<div class="origin">
    <div class="icon">
        <img :src="'/images/a-b.svg'" width="100" />
    </div>
    <span class="md-display-1">Where are you shipping from?</span>
    <form @submit.prevent="nextStep()">
        <div class="search-container">
            <md-field v-if="!isSelected">
                <label>City/State</label>
                <md-input v-model="keywords" required ref="focusable" @keydown="clearCity($event)"></md-input>
            </md-field>
            <md-field v-if="isSelected">
                <label>Address</label>
                <md-input v-model="addKeywords" required @keydown="clearAddress($event)"></md-input>
            </md-field>
            <ul>
                <li v-if="notFound !== null" class="not-found">
                    {{ this.notFound }}
                </li>
            </ul>
            <ul v-if="!isSelected">
                <li v-for="city in cities" :key="city.id" @click="selectCity(city)">
                    {{ city.name }},
                    {{ city.state.name }}
                </li>
            </ul>
            <ul v-if="!isAddSelected">
                <li v-for="address in addresses" :key="address.id" @click="selectAddress(address)">
                    {{ address.name }},
                    {{ address.zip.postal_code }}
                </li>
            </ul>
        </div>

        <div class="options">
            <md-radio v-for="service in accessoryList" :key="service.id" v-model="order.src.accessories[0]" :value="service.code" class="md-primary">{{ service.name }}</md-radio>
        </div>
        <md-card v-if="isSelected">
            <md-button @click="edit()" class="md-icon-button md-primary edit">
                <md-icon>edit</md-icon>
            </md-button>
            <md-card-content>
                <span>{{ order.src.cityName }}, {{ order.src.stateName }}</span><br />
                <span v-if="order.src.addressName">{{ order.src.addressName }}, {{order.src.postalCodeName}}</span>
            </md-card-content>
        </md-card>
        <div class="action">
            <md-button class="md-icon-button md-raised md-primary" type="submit">
                <md-icon>keyboard_arrow_right</md-icon>
            </md-button>
        </div>
    </form>
</div>
</template>

<script>
import {
    mapActions,
    mapGetters
} from "vuex";
export default {
    name: "Origin",
    data: () => ({
        keywords: null,
        addKeywords: null,
        cities: [],
        addresses: [],
        notFound: null,
        isSelected: false,
        isAddSelected: false,
        accessoryList: null,
        order: {
            src: {
                country: null,
                countryName: null,
                state: null,
                stateName: null,
                city: null,
                cityName: null,
                postalCode: null,
                postalCodeName: null,
                address: null,
                addressName: null,
                accessories: ["bs"],
                appointmentTime: null,
            },
            billing: {
                email: null,
                status: null,
            },
        },
    }),
    watch: {
        keywords(after, before) {
            this.searchCity();
        },
        addKeywords(after, before) {
            this.searchAddress()
        },
        cities(data) {
            if (data.length === 0) {
                if (this.isSelected === true) {
                    this.notFound = null;
                } else {
                    this.notFound = "Not found";
                }
            } else {
                this.notFound = null;
            }
        },
        addresses(data) {
            if (data.length === 0) {
                if (this.isAddSelected === true) {
                    this.notFound = null;
                } else {
                    this.notFound = "Not found";
                }
            } else {
                this.notFound = null;
            }
        },
    },
    methods: {
        searchCity() {
            axios
                .get("search-city-state/" + 2, {
                    params: {
                        keywords: this.keywords,
                    },
                })
                .then((res) => {
                    this.cities = res.data.data;
                    console.log("found cities: ", this.cities);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        searchAddress() {
            axios
                .get("search-address-zip/" + this.order.src.city, {
                    params: {
                        keywords: this.addKeywords,
                    },
                })
                .then((res) => {
                    console.log("found addresses: ", res.data.data);
                    this.addresses = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        selectCity(selected) {
            this.order.src.city = selected.id;
            this.order.src.cityName = selected.name;
            this.order.src.state = selected.state.id;
            this.order.src.stateName = selected.state.name;
            this.isSelected = true;
            localStorage.setItem("sflug", this.isSelected);
        },
        selectAddress(selected) {
            this.order.src.address = selected.id;
            this.order.src.addressName = selected.name;
            this.order.src.postalCode = selected.zip.id;
            this.order.src.postalCodeName = selected.zip.postal_code
            this.addKeywords = selected.name
            this.isAddSelected = true;
            localStorage.setItem("aflug", this.isAddSelected);
        },
        clearCity(e) {
            if (e.key === "Backspace" || e.key === "Delete") {
                this.isSelected = false;
            }
        },
        clearAddress(e) {
            if (e.key === "Backspace" || e.key === "Delete") {
                this.isAddSelected = false;
            }
        },
        validator() {
            if (
                this.order.src.city === null ||
                this.order.src.stateName === null ||
                this.order.src.cityName === null ||
                this.order.src.postalCode === null ||
                this.order.src.postalCodeName === null ||
                this.order.src.address === null
            ) {
                console.log("these fields are req:", this.order.src);
            } else {
                this.nextStep();
            }
        },
        nextStep() {
            localStorage.setItem("order", JSON.stringify(this.order));
            this.$router.push("pickup-services");
        },
        edit() {
            this.isSelected = false;
            this.$refs.focusable.$el.focus();
        },
        init() {
            if (localStorage.getItem("order")) {
                let storage = JSON.parse(localStorage.getItem("order"));
                this.isSelected = localStorage.getItem("sflug");
                this.isAddSelected = localStorage.getItem("aflug");
                this.order.src.country = storage.src.country;
                this.order.src.countryName = storage.src.countryName;
                this.order.src.state = storage.src.state;
                this.order.src.stateName = storage.src.stateName;
                this.order.src.city = storage.src.city;
                this.order.src.cityName = storage.src.cityName;
                this.order.src.accessories = storage.src.accessories;
                this.order.src.postalCode = storage.src.postalCode;
                this.order.src.postalCodeName = storage.src.postalCodeName;
                this.order.src.address = storage.src.address;
                this.order.src.addressName = storage.src.addressName;
                this.addKeywords = storage.src.addressName;
            }
        },
        getAccessories() {
            axios
                .get("location-type")
                .then((res) => {
                    this.cityList = res.data.cities;
                    this.accessoryList = res.data.services;
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },
        getCountries() {
            axios.get("countries").then((res) => {
                this.order.src.country = res.data[1].id;
                this.order.src.countryName = res.data[1].name;
            });
        },
    },
    created() {
        this.$emit("progress", 0);
        this.init();
        this.getAccessories();
        this.getCountries();
        localStorage.setItem("cRoute", this.$router.currentRoute.path);
    },
};
</script>

<style lang="scss" scoped>
.origin {
    .search-container {
        position: relative;
        text-align: center;

        .md-field {
            margin-bottom: 0;

            .select-country {
                position: absolute;
                top: 0;
                right: 0;
            }
        }

        ul {
            background: #fff;
            margin-top: 0;
            padding: 0;
            position: absolute;
            z-index: 10;
            box-shadow: 1px 2px 3px #ddd;
            width: 100%;

            li {
                text-align: left;
                list-style-type: none;
                padding: 10px;
            }

            li:hover {
                background: #ddd;
            }

            .not-found {
                color: red;
            }
        }
    }

    .icon,
    .options,
    .action {
        margin: 20px auto;
    }

    .options {
        .md-radio {
            margin: 8px 16px 8px 0;
        }
    }

    .md-card {
        .edit {
            position: absolute;
            top: 0;
            right: 0;
        }
    }
}

@media only screen and (min-width: 600px) {
    .origin {
        .options {
            text-align: center;
        }
    }
}
</style>
