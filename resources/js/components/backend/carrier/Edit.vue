<template>
<div>
    <form @submit.prevent="post">
        <md-card>
            <md-card-content>
                <md-content class="md-layout">
                    <md-avatar v-if="hasCompany" class="md-large">
                        <img :src="'/images/uploads/'+oldLogo" alt="Logo" />
                        <md-field class="select-logo">
                            <md-tooltip>Select new logo</md-tooltip>
                            <md-file v-model="form.logo" name="logo" accept="image/*" ref="logo" @change="onChange" />
                        </md-field>
                    </md-avatar>
                    <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                        <label>First name</label>
                        <md-input v-model="form.first_name"></md-input>
                    </md-field>
                    <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                        <label>Last name</label>
                        <md-input v-model="form.last_name"></md-input>
                    </md-field>
                    <md-switch v-model="hasCompany" class="md-primary">Do you have a company?</md-switch>
                    <md-field v-if="hasCompany" class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                        <label>Website</label>
                        <md-input v-model="form.website"></md-input>
                    </md-field>
                    <md-field v-if="hasCompany" class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                        <label>Company</label>
                        <md-input v-model="form.company" :required="hasCompany"></md-input>
                    </md-field>
                    <md-field v-if="hasCompany" class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                        <label>Details</label>
                        <md-textarea v-model="form.detail" :required="hasCompany"></md-textarea>
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
    props: ["carrier"],
    data: () => {
        return {
            form: {
                first_name: null,
                last_name: null,
                website: null,
                company: null,
                detail: null,
            },
            logo: null,
            oldLogo: null,
            hasCompany: false,
        };
    },
    methods: {
        post() {
            let fd = new FormData();
            fd.append("logo", this.logo);
            fd.append("first_name", this.form.first_name);
            fd.append("last_name", this.form.last_name);
            fd.append("website", this.form.website);
            fd.append("company", this.form.company);
            fd.append("detail", this.form.detail);
            fd.append("_method", "put");
            axios.post("admin/carriers/" + this.carrier.id, fd)
                .then(res => {
                    console.log("updated successfully! ", res.data);
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
            if (this.carrier.company !== "null") {
                this.hasCompany = true;
                this.form.website = this.carrier.website;
                this.form.company = this.carrier.company;
                this.form.detail = this.carrier.detail;
                this.oldLogo = this.carrier.logo;
            }
            this.form.first_name = this.carrier.first_name;
            this.form.last_name = this.carrier.last_name;
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
