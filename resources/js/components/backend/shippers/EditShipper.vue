<template>
<div>
    <form @submit.prevent="post">
        <md-card>
            <md-card-content>
                <md-content class="md-layout">
                    <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                        <label>First name</label>
                        <md-input v-model="form.first_name"></md-input>
                    </md-field>
                    <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                        <label>Last name</label>
                        <md-input v-model="form.last_name"></md-input>
                    </md-field>
                </md-content>
            </md-card-content>
            <md-card-actions>
                <md-button type="submit">Done</md-button>
            </md-card-actions>
        </md-card>
    </form>
</div>
</template>

<script lang="ts">
import Vue from "vue";
import axios from "axios";
export default Vue.extend({
    props: ["shipper"],
    data: () => {
        return {
            form: {
                first_name: null,
                last_name: null,
            },
        };
    },
    methods: {
        post() {

            axios.put("admin/shippers/" + this.shipper.id, this.form)
                .then(res => {
                    console.log("response:", res.data);
                    this.$emit("close-dialog");
                })
                .catch(err => {
                    console.log("Error: ", err);
                });
        },
        onChange(e) {
            this.logo = e.target.files[0];
        },
        init() {

            this.form.first_name = this.shipper.first_name;
            this.form.last_name = this.shipper.last_name;
        }
    },
    created() {
        this.init()
    }
});
</script>

<style scoped>
.md-card {
    box-shadow: none;
}
</style>
