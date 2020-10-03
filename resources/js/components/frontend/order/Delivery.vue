<template>
<div class="destination">
    <div class="icon">
        <img :src="'/images/b-a.svg'" width="100" />
    </div>
    <span class="md-display-1">Where are you shipping to?</span>
    <form @submit.prevent="nextStep()">
        <div class="search-container">
            <md-field v-if="!isSelected">
                <label>City/Zip code</label>
                <md-input v-model="keywords" required ref="focusable" @keydown="removingChar($event)"></md-input>
            </md-field>
            <md-field v-if="isSelected">
                <label>Address</label>
                <md-input v-model="tempAddress" required></md-input>
            </md-field>
            <ul>
                <li v-if="notFound !== null" class="not-found">
                    {{ this.notFound }}
                </li>
            </ul>
            <ul v-if="!isSelected">
                <li v-for="result in results" :key="result.id" @click="select(result)">
                    {{ result.citycode_city[0].name }},
                    {{ result.citycode_city[0].state.name }} - {{ result.postal_code }}
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
                {{ des.cityName }}, {{ des.stateName }} - {{ des.postalCodeName
          }}<br />{{ des.address }}
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
        tempAddress: null,
        results: [],
        isSelected: false,
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
            accessories: ["bs"],
        },
    }),
    watch: {
        keywords(after, before) {
            this.search();
        },
        tempAddress(data) {
            this.des.address = data;
        },
        results(data) {
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
    },
    methods: {
        search() {
            axios
                .get("search-city", {
                    params: {
                        keywords: this.keywords
                    }
                })
                .then((res) => {
                    this.results = res.data.data;
                    console.log("resluts: ", this.results);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        removingChar(e) {
            if (e.key === "Backspace" || e.key === "Delete") {
                this.isSelected = false;
            }
        },
        edit() {
            this.isSelected = false;
            this.$refs.focusable.$el.focus();
        },
        select(selected) {
            this.des.state = selected.citycode_city[0].state.id;
            this.des.stateName = selected.citycode_city[0].state.name;
            this.des.city = selected.citycode_city[0].id;
            this.des.cityName = selected.citycode_city[0].name;
            this.des.postalCode = selected.id;
            this.des.postalCodeName = selected.postal_code;
            this.isSelected = true;
            localStorage.setItem("dflug", this.isSelected);
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
                this.isSelected = localStorage.getItem("sflug");
                this.des.country = storage.des.country;
                this.des.countryName = storage.des.countryName;
                this.des.state = storage.des.state;
                this.des.stateName = storage.des.stateName;
                this.des.city = storage.des.city;
                this.des.cityName = storage.des.cityName;
                this.des.postalCode = storage.des.postalCode;
                this.des.postalCodeName = storage.des.postalCodeName;
                this.des.accessories = storage.des.accessories;
                this.des.address = storage.des.address;
                this.tempAddress = storage.des.address;
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
                this.des.country = res.data[0].id;
                this.des.countryName = res.data[0].name;
            });
        },
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

    .md-card {
        .edit {
            position: absolute;
            top: 0;
            right: 0;
        }
    }
}
</style>
