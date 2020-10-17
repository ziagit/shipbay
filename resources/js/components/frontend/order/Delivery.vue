<template>
<div class="destination">
    <div class="icon">
        <img :src="'/images/b-a.svg'" width="100" />
    </div>
    <span class="md-display-1">Where are you shipping to?</span>
    <form @submit.prevent="nextStep()">
        <div class="search-container">
            <md-field v-if="!isSelected">
                <label>City/State</label>
                <md-input v-model="keywords" required ref="focusable" @keydown="clearCity($event)"></md-input>
            </md-field>
            <md-field v-if="isSelected">
                <label>Address</label>
                <md-input v-model="addKeywords" required ref="focusable" @keydown="clearAddress($event)"></md-input>
            </md-field>
            <ul>
                <li v-if="notFound !== null" class="not-found">
                    {{ this.notFound }}
                </li>
            </ul>
            <ul v-if="!isSelected">
                <li class="city-list" v-for="city in cities" :key="city.id" @click="selectCity(city)">
                    {{ city.name }},
                    {{ city.state.name }}
                </li>
            </ul>
            <ul v-if="!isAddSelected">
                <li class="address-list" v-for="address in addresses" :key="address.id" @click="selectAddress(address)">
                    {{ address.name }},
                    {{ address.zip.postal_code }}
                </li>
            </ul>
        </div>

        <div class="options">
            <md-radio v-for="service in accessoryList" :key="service.id" v-model="des.accessories[0]" :value="service.code" class="md-primary">{{ service.name }}</md-radio>
        </div>
        <md-card v-if="isSelected">
            <md-button @click="edit()" class="md-icon-button md-primary edit">
                <md-icon>edit</md-icon>
            </md-button>
            <md-card-content>
                <span>{{ des.cityName }}, {{ des.stateName }}</span><br />
                <span v-if="des.addressName">{{ des.addressName }}, {{des.postalCodeName}}</span>
            </md-card-content>
        </md-card>
        <div class="action">
            <md-button to="pickup-date" class="md-icon-button md-raised">
                <md-icon>keyboard_arrow_left</md-icon>
            </md-button>
            <md-button class="md-icon-button md-raised md-primary" type="submit">
                <md-icon>keyboard_arrow_right</md-icon>
            </md-button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    name: "Destination",
    data: () => ({
        keywords: null,
        addKeywords: null,
        cities: [],
        addresses: [],
        isSelected: false,
        isAddSelected: false,
        notFound: null,
        accessoryList: null,
        des: {
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
                .get("search-address-zip/" + this.des.city, {
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
            this.$refs.focusable.$el.focus()
            this.des.state = selected.state.id;
            this.des.stateName = selected.state.name;
            this.des.city = selected.id;
            this.des.cityName = selected.name;
            this.isSelected = true;
            localStorage.setItem("dflug", this.isSelected);
        },
        selectAddress(selected) {
            this.des.address = selected.id;
            this.des.addressName = selected.name;
            this.des.postalCode = selected.zip.id;
            this.des.postalCodeName = selected.zip.postal_code
            this.addKeywords = selected.name
            this.isAddSelected = true;
            localStorage.setItem("adflug", this.isAddSelected);
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
        edit() {
            this.isSelected = false;
            this.$refs.focusable.$el.focus();
        },
        nextStep() {
            let storage = JSON.parse(localStorage.getItem("order"));
            if (storage.des) {
                for (let i = 0; i < storage.des.accessories.length; i++) {
                    if (
                        storage.des.accessories[i] === "bs" ||
                        storage.des.accessories[i] === "rs" ||
                        storage.des.accessories[i] === "sp"
                    ) {
                        storage.des.accessories.splice(i, 1);
                    }
                }
            }
            storage.des = this.des;
            localStorage.setItem("order", JSON.stringify(storage));
            this.$router.push("delivery-services");
        },

        init() {
            let storage = JSON.parse(localStorage.getItem("order"));
            if (storage.des) {
                this.isSelected = localStorage.getItem("dflug");
                this.isAddSelected = localStorage.getItem("adflug");
                this.des.country = storage.des.country;
                this.des.countryName = storage.des.countryName;
                this.des.state = storage.des.state;
                this.des.stateName = storage.des.stateName;
                this.des.city = storage.des.city;
                this.des.cityName = storage.des.cityName;
                this.des.postalCode = storage.des.postalCode;
                this.des.postalCodeName = storage.des.postalCodeName;
                this.des.address = storage.des.address;
                this.des.addressName = storage.des.addressName;
                this.addKeywords = storage.des.addressName;
                this.des.accessories = storage.des.accessories;
                this.des.appointmentTime = storage.des.appointmentTime;
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
                this.des.country = res.data[1].id;
                this.des.countryName = res.data[1].name;
            });
        },
    },
    mounted() {
        this.$refs.focusable.$el.focus();
    },
    created() {
        this.$emit("progress", 42);
        console.log("in destination: ", JSON.parse(localStorage.getItem("order")));
        this.init();
        this.getAccessories();
        this.getCountries();
        localStorage.setItem("cRoute", this.$router.currentRoute.path);
    },
};
</script>

<style lang="scss" scoped>
.destination {
    text-align: center;

    .search-container {
        position: relative;

        .md-field {
            margin-bottom: 0;
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

            .city-list:hover,
            .address-list:hover {
                background: #F0F2F5;
                cursor: pointer;
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

    .md-card {
        .edit {
            position: absolute;
            top: 0;
            right: 0;
        }
    }
}
</style>
