<template>
<md-card class="no-shadow-bordered">
    <md-card-content>
        <div v-if="shipper">
            <div>
                <h2>{{shipper.last_name}}</h2>
                <span class="md-subheading">
                    {{shipper.first_name}}
                    <span class="line">|</span>
                    {{shipper.last_name}}
                    <span class="line">|</span>
                    {{shipper.full_address.address}}
                </span>
                <br />
                <span class="md-subheading">
                    {{shipper.full_address.country.name}}
                    <span class="line">|</span>
                    {{shipper.full_address.state}}
                    <span class="line">|</span>
                    {{shipper.full_address.city}}
                    <span class="line">|</span>
                    {{shipper.full_address.zip}}
                </span>
                <br />
                <span class="md-subheading">
                    {{shipper.contact.phone}}
                </span>
                <br />
            </div>
        </div>
        <md-empty-state v-else class="md-primary" md-icon="sentiment_satisfied_alt" md-label="No details available" md-description="Click bellow link to add new details">
            <md-button to="add" class="md-default md-raised md-icon-button">
                <md-icon>add</md-icon>
            </md-button>
        </md-empty-state>
    </md-card-content>
    <md-card-actions>
        <md-button v-if="shipper" to="edit" class="md-primary md-icon-button">
            <md-icon>edit</md-icon>
            <md-tooltip>Edit profile</md-tooltip>
        </md-button>
    </md-card-actions>
</md-card>
</template>

<script>
import axios from "axios";
import {
    mapActions
} from "vuex";
export default {
    name: "GeneralInfo",
    data: () => ({
        shipper: null,
        temp: {
            me: null,
            country: null,
        },
    }),
    methods: {
        ...mapActions({
            tempData: "shared/tempData",
        }),
        async get() {
            await axios
                .get("shipper/details")
                .then((res) => {
                    console.log("shipper ", res.data)
                    this.shipper = res.data;
                    this.temp.me = this.shipper.id;
                    this.temp.country = this.shipper.full_address.country.id;
                    this.tempData(this.temp).then((res) => {});
                })
                .catch((error) => {
                    console.log("Error: ", error);
                });
        },
    },

    created() {
        this.get();
    },
};
</script>

<style lang="scss" scoped>
.md-card {
    box-shadow: none;
    text-align: center;

    .md-display-1 {
        font-size: 30px;
    }

    .md-card-actions {
        display: flex;
        justify-content: space-around;
    }
}
</style>
