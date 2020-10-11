<template>
<div class="addresses" v-if="addresses">
    <!-- delete dialog-->
    <md-dialog-confirm :md-active.sync="deleteTogal" md-title="I assure what you doing" md-content md-confirm-text="OK" md-cancel-text="Cancel" @md-confirm="confirm()" @md-cancel="cancel" />
    <!-- edit dialog -->
    <md-dialog :md-active.sync="editTogal">
        <md-dialog-title>Update address data</md-dialog-title>
        <md-dialog-content>
            <EditAddress v-on:close-dialog="refresh" :address="address" />
        </md-dialog-content>
    </md-dialog>

    <div>
        <md-list>
            <md-list-item>Country: </md-list-item>
            <md-list-item>State: </md-list-item>
            <md-list-item>City: </md-list-item>
            <md-list-item>Postal code: </md-list-item>
            <md-list-item>Address: </md-list-item>
        </md-list>
    </div>

</div>
</template>

<script>
import AddAddress from "./AddAddress";
import EditAddress from "./EditAddress";
import axios from "axios";

export default {
    name: "address",
    data: () => ({
        address: null,
        address: null,
        editTogal: false,
        deleteTogal: false,
    }),

    methods: {

        get() {
            axios
                .get("admin/carrier/address/" + id)
                .then((res) => {
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
            this.selectedId = id;
        },

        confirm() {
            axios
                .delete("admin/addresses/" + this.selectedId)
                .then((res) => {
                    console.log("deleted", res.data);
                    this.get();
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },
        cancel() {},
    },
    created() {
        this.get();
    },

    components: {
        AddAddress,
        EditAddress,
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
