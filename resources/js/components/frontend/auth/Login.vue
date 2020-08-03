<template>
  <div class="login">
    <ion-card mode="ios">
      <ion-card-header>
        <span class="md-display-1">Login</span>
      </ion-card-header>
      <ion-card-content>
        <md-progress-spinner v-if="dataLoaded" md-mode="indeterminate"></md-progress-spinner>
        <form @submit.prevent="submit">
          <md-field>
            <label>Username</label>
            <md-input type="email" v-model="form.email" required></md-input>
          </md-field>
          <md-field>
            <label>Password</label>
            <md-input type="password" v-model="form.password" required></md-input>
          </md-field>
          <md-button type="submit" class="md-primary">Login</md-button>
        </form>
        <md-button to="/register" class="md-primary">Register</md-button>
        <div class="other-way">
          <md-button to="#">SignIn using Google</md-button>
          <md-button to="/shipper">Continue as guest</md-button>
        </div>
      </ion-card-content>
    </ion-card>
  </div>
</template>

<script>
import axio from "axios";
import { mapActions, mapGetters } from "vuex";
export default {
  name: "Login",
  data: () => ({
    form: {
      email: null,
      password: null
    },
    dataLoaded: false
  }),
  methods: {
    ...mapActions({
      signIn: "auth/signIn"
    }),
    submit() {
      this.dataLoaded = true;
      this.signIn(this.form).then(res => {
        this.getCarrier();
      });
    },
    getCarrier() {
      let token = localStorage.getItem("token");
      axio
        .get("get-carrier", {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        .then(res => {
          setTimeout(() => {
            if (!res.data[0]) {
              this.$router.push("welcome");
            } else {
              this.$router.push("carrier");
            }
            this.dataLoaded = false;
          }, 2000);
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user"
    })
  }
};
</script>

<style lang="scss" scoped>
.login {
  width: 100%;
  height: calc(100vh - 200px);
  padding-top: 91px;
  ion-card {
    max-width: 500px;
    margin: auto;
    padding: 20px;
    text-align: center;
    background: #fff;
    .other-way {
      width: 100%;
      font-size: 10px;
      display: flex;
      justify-content: space-between;
      .md-button {
        font-size: 11px;
      }
    }
  }
}
</style>