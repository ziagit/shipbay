<template>
<div>
    <div class="register">
        <md-card mode="ios">
            <md-card-header>
                <div class="md-title">Register</div>
            </md-card-header>
            <md-card-content>
                <Spinner v-if="loading" />
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <md-field>
                        <label>Name</label>
                        <md-input v-model="form.name" required ref="focusable"></md-input>
                    </md-field>
                    <md-field>
                        <label>Email</label>
                        <md-input v-model="form.email" required></md-input>
                    </md-field>
                    <md-field>
                        <label>Password</label>
                        <md-input v-model="form.password" required></md-input>
                    </md-field>
                    <md-field>
                        <label>Confirm password</label>
                        <md-input v-model="form.password_confirmation" required></md-input>
                    </md-field>
                    <div>
                        <md-radio v-model="form.type" value="carrier">Carrier</md-radio>
                        <md-radio v-model="form.type" value="shipper">Shipper</md-radio>
                    </div>
                    <md-button type="submit" class="md-primary">Register</md-button>
                </form>
            </md-card-content>
        </md-card>
    </div>
    <Snackbar :data="snackbar" />
</div>
</template>

<script>
import axios from "axios";
import {
    mapActions
} from "vuex";
import Spinner from "../shared/Spinner";
import Snackbar from "../shared/Snackbar";
export default {
    name: "SignUp",
    data: () => ({
        form: {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            type: "shipper",
        },
        loading: false,
        snackbar: {
            show: false,
            message: null,
            statusCode: null,
        },
    }),
    methods: {
        ...mapActions({
            signUp: "auth/signUp",
        }),
        submit() {
            if (this.form.password !== this.form.password_confirmation) {
                this.snackbar.show = true;
                this.snackbar.statusCode = 400;
                this.snackbar.message = "Passwords not matching!";
            } else {
                this.loading = true;
                this.signUp(this.form)
                    .then((res) => {
                        this.loading = false;
                        this.$router.push("welcome");
                    })
                    .catch((error) => {
                        if (error.response.status === 409) {
                            this.snackbar.statusCode = error.response.status;
                            this.snackbar.message = error.response.data.error;
                        } else {
                            this.snackbar.statusCode = error.response.status;
                            this.snackbar.message = error.response.data.error;
                        }
                        this.snackbar.show = true;
                    });
            }
        },
    },
    mounted() {
        this.$refs.focusable.$el.focus();
    },
    components: {
        Spinner,
        Snackbar
    },
};
</script>

<style lang="scss" scoped>
.register {
    width: 100%;
    height: calc(100vh - 200px);
    padding: 20px;

    .md-card {
        margin: auto;
        text-align: center;
        background: #fff;

        .md-card-content {
            padding: 20px;
        }
    }
}

@media only screen and (min-width: 600px) {
    .register {
        .md-card {
            max-width: 500px;
            margin-top: 3em;

            .other-way {
                .md-button {
                    font-size: 11px;
                }
            }
        }
    }
}
</style>
