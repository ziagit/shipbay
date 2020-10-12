<template>
<div class="addresses" v-if="address">
    <!-- delete dialog-->
    <md-dialog-confirm :md-active.sync="deleteTogal" md-title="Are you sure what you doing?" md-content md-confirm-text="OK" md-cancel-text="Cancel" @md-confirm="confirm()" @md-cancel="cancel" />
    <!-- edit dialog -->
    <md-dialog :md-active.sync="editTogal">
        <md-dialog-title>Update address data</md-dialog-title>
        <md-dialog-content>
            <EditCarrierAddress v-on:close-dialog="refresh" :address="address" />
        </md-dialog-content>
    </md-dialog>

    <md-card>
        <md-button class="md-icon-button" @click="$router.back()">
            <md-icon>close</md-icon>
        </md-button>
        <md-card-content>
            <div>
                <md-list>
                    <md-list-item>Country: {{address.full_address.country.name}}</md-list-item>
                    <md-list-item>State: {{address.full_address.state.name}}</md-list-item>
                    <md-list-item>City: {{address.full_address.city.name}}</md-list-item>
                    <md-list-item>Postal code: {{address.full_address.zip.postal_code}}</md-list-item>
                    <md-list-item>Address: {{address.full_address.address.name}}</md-list-item>
                </md-list>
            </div>
        </md-card-content>
        <md-card-actions>
            <md-button class="md-icon-button" @click="editTogal=true">
                <md-icon>edit</md-icon>
            </md-button>
            <md-button class="md-icon-button" @click="deleteTogal=true">
                <md-icon>delete</md-icon>
            </md-button>
        </md-card-actions>
    </md-card>

</div>
</template>

<script>
import EditCarrierAddress from "./EditCarrierAddress";
import axios from "axios";

export default {
    name: "CarrierAddress",
    data: () => ({
        address: null,
        editTogal: false,
        deleteTogal: false,
    }),

    methods: {

        get() {
            axios
                .get("admin/carrier/addresses/" + this.$route.params.id)
                .then((res) => {
                    console.log("c add", res.data)
                    this.address = res.data;
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },

        edit(data) {
            this.editTogal = true;
            this.address = data;
        },
        remove(id) {
            this.deleteTogal = true;
        },

        confirm() {
            axios
                .delete("admin/carrier/addresses/" + this.address.id)
                .then((res) => {
                    console.log("deleted", res.data);
                    this.get();
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },
        cancel() {},
        refresh() {
            this.editTogal = false;
            this.get();
        }
    },
    created() {
        this.get();
    },

    components: {
        EditCarrierAddress,
    },
};
</script>

<style lang="scss" scoped>
.addresses {
    width: 100%;

    .add-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }
}
</style>
