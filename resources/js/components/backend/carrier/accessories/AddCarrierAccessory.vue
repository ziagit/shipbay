<template>
<div>
    <form @submit.prevent="submit" enctype="multipart/form-data">
        <md-card>
            <md-card-header>
                <md-button @click="$emit('close-dialog')" class="md-icon-button add-btn">
                    <md-icon>close</md-icon>
                    <md-tooltip>Cancel</md-tooltip>
                </md-button>
            </md-card-header>

            <md-card-content>
                <table class="table">
                    <thead>
                        <tr>
                            <th rowspan="2">NAME</th>
                            <th colspan="2">PRICES</th>
                        </tr>
                        <tr v-show="acType">
                            <th>Origin</th>
                            <th>Destination</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <md-field>
                                    <label for="name">Name</label>
                                    <md-select v-model="form.name" name="name" id="name" md-dense @input="onInput($event)">
                                        <md-option v-for="accessory in accessories" :key="accessory.id" :value="accessory.id">{{accessory.name}}</md-option>
                                    </md-select>
                                    <input class="hidden-input" v-model="form.name" required />
                                </md-field>
                            </td>
                            <td v-show="acType">
                                <md-field>
                                    <label>($)</label>
                                    <md-input v-model="form.srcValue"></md-input>
                                </md-field>
                            </td>
                            <td>
                                <md-field>
                                    <label>($)</label>
                                    <md-input v-model="form.desValue"></md-input>
                                </md-field>
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
    <Snackbar :data="snackbar" />
</div>
</template>

<script>
import axios from "axios";
import {
    mapGetters
} from "vuex";
import Snackbar from "../../../frontend/shared/Snackbar";
export default {
    name: "EditAccessory",
    data: () => ({
        form: {
            name: null,
            srcValue: null,
            desValue: null,
            carrierId: null,
        },
        accessories: null,
        acType: true,
        snackbar: {
            show: false,
            message: null,
            statusCode: null,
        },
    }),
    methods: {
        submit() {
            if (this.form.name == 7 || this.form.name == 8 || this.form.name == 9) {
                if (this.form.srcValue == null) {
                    this.form.srcValue = 0;
                }
            }
            axios
                .post("admin/carrier/accessories", this.form)
                .then((res) => {
                    this.$emit("close-dialog");
                })
                .catch((err) => {
                    this.snackbar.show = true;
                    this.snackbar.message = err.response.data.message;
                    this.snackbar.statusCode = err.response.status
                });
        },
        init() {
            this.form.carrierId = this.$route.params.id
        },
        get() {
            axios
                .get("carrier/accessories-lookup")
                .then((res) => {
                    this.accessories = res.data;
                })
                .catch((err) => {
                    console.log("error: ", err);
                });
        },
        onInput(e) {
            console.log("xxxx", e)
            if (e == 7 || e == 8 || e == 9) {
                this.acType = false;
            } else {
                this.acType = true;
            }
        },
    },
    created() {
        this.get();
        this.init()
    },
    components: {
        Snackbar
    }
};
</script>

<style lang="scss" scoped>
.md-card {
    box-shadow: none;
    text-align: center;

    .carrier-logo {
        text-align: center;
        margin-top: -50px;

        .md-large {
            background: #ddd;
        }
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

        td {
            .md-field {
                margin: 0;
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
