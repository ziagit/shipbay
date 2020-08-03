<template>
  <div>
    <div class="register">
      <ion-card mode="ios">
        <ion-card-header>
          <span class="md-display-1">Register</span>
        </ion-card-header>
        <ion-card-content>
          <md-progress-spinner v-if="dataLoaded" md-mode="indeterminate"></md-progress-spinner>
          <form @submit.prevent="submit" enctype="multipart/form-data">
            <md-field>
              <label>Name</label>
              <md-input v-model="form.name" required></md-input>
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
              <md-radio v-model="form.type" value="carrier" class="md-primary">Carrier</md-radio>
              <md-radio v-model="form.type" value="shipper" class="md-primary">Shipper</md-radio>
            </div>
            <md-button type="submit" class="md-primary">Register</md-button>
          </form>
        </ion-card-content>
      </ion-card>
    </div>
    <md-snackbar
      class="required-feild-error"
      :md-position="snackbar.position"
      :md-duration="snackbar.isInfinity ? Infinity : snackbar.duration"
      :md-active.sync="snackbar.showSnackbar"
      md-persistent
    >
      <span>Passwords not match</span>
      <span style="color:red">Error in your inputs</span>
    </md-snackbar>
  </div>
</template>

<script>
import axios from "axios";
import { mapActions } from "vuex";
export default {
  name: "SignUp",
  data: () => ({
    form: {
      name: null,
      email: null,
      password: null,
      password_confirmation: null,
      type: "shipper"
    },
    dataLoaded: false,
    snackbar: {
      showSnackbar: false,
      position: "center",
      duration: 5000,
      isInfinity: false
    }
  }),
  methods: {
    ...mapActions({
      signUp: "auth/signUp"
    }),
    submit() {
      if (this.form.password != this.form.password_confirmation) {
        this.snackbar.showSnackbar = true;
        console.log("Passwords not matching");
      } else {
        this.signUp(this.form).then(() => {
          this.$router.push("welcome");
        }).catch(err=>{
          console.log("error ", err)
        })
      }
    }
  },
  components: {}
};
</script>

<style lang="scss" scoped>
.register {
  width: 100%;
  height: calc(100vh - 200px);
  padding-top: 91px;
  .social-media {
    margin-top: 20px;
  }
  ion-card {
    max-width: 500px;
    margin: auto;
    text-align: center;
    background: #fff;
    padding: 20px;
  }
}
</style>