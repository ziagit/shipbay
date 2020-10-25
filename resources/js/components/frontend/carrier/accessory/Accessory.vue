<template>
<div>
    <md-dialog-confirm :md-active.sync="active" md-title="Are you sure?" md-content="Make sure it's not an Accident" md-confirm-text="Agree" md-cancel-text="Disagree" @md-cancel="cancel" @md-confirm="confirm" />

    <md-card md-theme="orange-card">
        <md-card-header>
            <div class="md-title">Accessories</div>
            <md-button to="add" class="md-icon-button add-btn" v-show="accessories.length != 0">
                <md-icon>add</md-icon>
                <md-tooltip>Add new accessory</md-tooltip>
            </md-button>
        </md-card-header>

        <md-card-content>
            <table class="table" v-if="accessories.length != 0">
                <thead>
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">NAME</th>
                        <th colspan="2">PRICES</th>
                        <th colspan="2" rowspan="2">ACTIONS</th>
                    </tr>
                    <tr>
                        <th scope="col">Origin</th>
                        <th scope="col">Destination</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(accessory,index) in accessories" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{accessory.name}}</td>
                        <td>
                            <span v-show="accessory.pivot.src_value != 0">${{accessory.pivot.src_value}}</span>
                        </td>
                        <td>${{accessory.pivot.des_value}}</td>
                        <td>
                            <md-button :to="{path: 'edit/'+ accessory.id}" class="md-primay md-icon-button">
                                <md-icon>edit</md-icon>
                                <md-tooltip>Edit Accessory</md-tooltip>
                            </md-button>
                        </td>
                        <td>
                            <md-button class="md-icon-button md-accent" @click="remove(accessory.id)">
                                <md-icon>delete</md-icon>
                                <md-tooltip>Delete accessory</md-tooltip>
                            </md-button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <md-empty-state v-else class="md-primary" md-icon="sentiment_satisfied_alt" md-label="Not available" md-description="Click + icon to add">
                <md-button to="add" class="md-icon-button md-raised">
                    <md-icon>add</md-icon>
                    <md-tooltip>Add new accessory</md-tooltip>
                </md-button>
            </md-empty-state>
        </md-card-content>
    </md-card>
</div>
</template>

<script>
import axios from "axios";
export default {
    name: "Accessory",
    data: () => ({
        active: false,
        acsIdToDelete: null,
        accessories: [],
        dataLoaded: false,
    }),
    methods: {
        get() {
            axios
                .get("carrier/accessories")
                .then((res) => {
                    this.accessories = res.data.accessories;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        remove(id) {
            this.active = true;
            this.acsIdToDelete = id;
        },
        confirm() {
            axios
                .delete("carrier/accessories/" + this.acsIdToDelete)
                .then((res) => {
                    this.$emit("show-snackbar");
                    this.get();
                })
                .catch((err) => {
                    console.log("Error: ", err);
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
    }

    .add-btn {
        position: absolute;
        top: 0;
        right: 0;
    }
}
</style>
