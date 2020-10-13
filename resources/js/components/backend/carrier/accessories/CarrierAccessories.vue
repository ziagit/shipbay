<template>
<div>
    <md-dialog-confirm :md-active.sync="active" md-title="Do you whant to delete?" md-content="Make sure it's not an Accident" md-confirm-text="Agree" md-cancel-text="Disagree" @md-cancel="cancel" @md-confirm="confirm" />
    <!-- edit dialog -->
    <md-dialog :md-active.sync="editTogal">
        <md-dialog-title>Update Accessory</md-dialog-title>
        <md-dialog-content>
            <EditCarrierAccessory v-on:close-dialog="refresh" :accessory="accessory" />
        </md-dialog-content>
    </md-dialog>
    <!-- add dialog -->
    <md-dialog :md-active.sync="addTogal">
        <md-dialog-title>Add New Accessory</md-dialog-title>
        <md-dialog-content>
            <AddCarrierAccessory v-on:close-dialog="refresh" />
        </md-dialog-content>
    </md-dialog>

    <md-card>
        <md-card-header>
            <md-toolbar>
                <div class="md-toolbar-section-start">
                    <h1 class="md-title">Accessories</h1>
                </div>

                <md-field md-clearable class="md-toolbar-section-end">
                    <md-input placeholder="Search by carrier..." v-model="keywords" />
                </md-field>
            </md-toolbar>
        </md-card-header>

        <md-card-content>
            <table class="table" v-if="accessories">
                <thead>
                    <tr>
                        <th rowspan="2">ID</th>
                        <th rowspan="2">NAME</th>
                        <th colspan="2">PRICES</th>
                        <th rowspan="2">CARRIERS</th>
                        <th colspan="2" rowspan="2">ACTIONS</th>
                    </tr>
                    <tr>
                        <th scope="col">Origin</th>
                        <th scope="col">Destination</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(accessory, index) in accessories" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{accessory.name}}</td>
                        <td>
                            <span v-show="accessory.pivot.src_value != 0">${{accessory.pivot.src_value}}</span>
                        </td>
                        <td>${{accessory.pivot.des_value}}</td>
                        <td>{{accessory.carrier}}</td>
                        <td>
                            <md-button class="md-icon-button md-primary" @click="edit(accessory)">
                                <md-icon>edit</md-icon>
                                <md-tooltip>Edit accessory</md-tooltip>
                            </md-button>
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
    <pagination :limit="4" :data="accessories" @pagination-change-page="get"></pagination>
    <md-button class="md-fab md-primary add-btn" @click="add()">
        <md-icon>add</md-icon>
        <md-tooltip>Add new accessory</md-tooltip>
    </md-button>
</div>
</template>

<script>
import EditCarrierAccessory from './EditCarrierAccessory'
import AddCarrierAccessory from './AddCarrierAccessory'
import axios from "axios";
export default {
    name: "Accessory",
    data: () => ({
        keywords: null,
        active: false,
        acsIdToDelete: null,
        accessories: null,
        accessory: null,
        dataLoaded: false,
        addTogal: false,
        editTogal: false,
    }),
    watch: {
        keywords(after, before) {
            this.search();
        },
    },
    methods: {
        search() {
            axios
                .get("admin/carrier/search-accessory", {
                    params: {
                        keywords: this.keywords
                    }
                })
                .then((res) => {
                    console.log("search res ", res.data.data)
                    this.accessories = res.data;

                })
                .catch((err) => {
                    console.log(err);
                });
        },
        get(page = 1) {
            axios
                .get("admin/carrier/accessories?page=" + page)
                .then((res) => {
                    console.log('accessories:', res.data)
                    this.accessories = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        add() {
            this.addTogal = true;
        },
        refresh() {
            this.addTogal = false;
            this.editTogal = false;
            this.get();
        },
        edit(data) {
            this.editTogal = true;
            this.accessory = data;
        },
        remove(id) {
            this.active = true;
            this.acsIdToDelete = id;
        },
        confirm() {
            axios
                .delete("admin/carrier/accessories/" + this.$route.params.id + "/" + this.acsIdToDelete)
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
    components: {
        EditCarrierAccessory,
        AddCarrierAccessory
    }
};
</script>

<style lang="scss" scoped>
.md-card {
    text-align: center;

    .md-toolbar {
        background: none;
        box-shadow: none;
    }

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
}

.add-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
}
</style>
