<template>
  <div class="login">
    <md-card mode="ios">
      <md-card-header>
        <div class="md-title">Login</div>
      </md-card-header>
      <md-card-content>
        <Spinner v-if="dataLoading"/>
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
      </md-card-content>
      <div class="login-througth">
<!--         <ion-chip color="default">
          <ion-label>Login using</ion-label>
          <ion-avatar>
            <img src="http://localhost:8000/images/gmail.svg" />
          </ion-avatar>
        </ion-chip> -->
        <ion-chip color="default" v-if="orderExist" @click="asGuest()">
          <ion-label>Continue as guest</ion-label>
        </ion-chip>
      </div>
    </md-card>
    <md-snackbar
      class="required-feild-error"
      :md-position="snackbar.position"
      :md-duration="snackbar.isInfinity ? Infinity : snackbar.duration"
      :md-active.sync="snackbar.show"
      md-persistent
    >
      <span>{{snackbar.message}}</span>
      <span style="color:red">Status: {{snackbar.statusCode}}</span>
    </md-snackbar>
  </div>
</template>

<script>
import axio from "axios";
import { mapActions, mapGetters } from "vuex";
import Spinner from '../shared/Spinner'
export default {
  name: "Login",
  data: () => ({
    snackbar: {
      show: false,
      position: "center",
      duration: 5000,
      isInfinity: false,
      message: null,
      statusCode: null,
    },
    form: {
      email: null,
      password: null,
    },
    dataLoading: false,
    orderExist: false,
  }),
  methods: {
    ...mapActions({
      signIn: "auth/signIn",
    }),
    submit() {
      if (!this.authenticated) {
        this.dataLoading = true;
        this.signIn(this.form)
          .then((res) => {
            if (this.user.role[0].name === "carrier") {
              this.$router.push("/carrier");
            } else if (this.user.role[0].name === "shipper") {
              this.$router.push(this.$route.query.redirect || "/shipper");
            } else if (this.user.role[0].name === "admin") {
              this.$router.push("/admin");
            }
          })
          .catch((error) => {
            this.snackbar.message = error.response.data;
            this.snackbar.statusCode = error.response.status;
            this.snackbar.show = true;
          });
      } else {
        this.snackbar.show = true;
        this.snackbar.statusCode = "";
        this.snackbar.message = "You are already logedin.";
      }
    },
    watchLocalstorage() {
      let order = JSON.parse(localStorage.getItem("order"));
      if (order) {
        this.orderExist = true;
      }
    },
    asGuest() {
      this.$router.push("/shipment");
    },
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  created() {
    this.watchLocalstorage();
  },
  components:{
    Spinner
  }
};
</script>

<style lang="scss" scoped>
.login {
  width: 100%;
  height: calc(100vh - 200px);
  .md-card {
    margin: auto;
    text-align: center;
    background: #fff;
    .md-card-content {
      padding: 20px;
    }
    .login-througth {
      width: 100%;
      display: flex;
      justify-content: space-between;
      .md-button {
        font-size: 8px;
      }
      ion-label {
        font-size: 12px;
      }
    }
    .md-display-1 {
      font-size: 24px;
    }
  }
}
@media only screen and (min-width: 600px) {
  .login {
    .md-card {
      max-width: 500px;
      margin: 3em auto;
      .login-througth {
        .md-button {
          font-size: 11px;
        }
      }
      .md-display-1 {
        font-size: 30px;
      }
    }
  }
}
</style>