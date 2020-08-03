<template>
  <div>
    <md-card v-if="carrier">
      <div class="carrier-logo">
        <md-avatar class="md-large">
          <img src="http://localhost:8000/images/carrier-logo.jpg" alt="Avatar" />
        </md-avatar>
      </div>
      <div class="details">
        <div class="carrier-name">
          <h2 v-if="carrier.company">{{carrier.company}}</h2>
          <h2 v-else>{{carrier.last_name}}</h2>
          <span
            class="md-subheading"
          >{{carrier.first_name}} | {{carrier.last_name}} | {{carrier.address}}</span>
          <br />
          <span
            class="md-subheading"
          >{{carrier.country.name}} | {{carrier.state.name}} | {{carrier.city.name}} | {{carrier.citycode.postal_code}}</span>
          <br />
          <span class="md-subheading">
            {{carrier.phone}} | {{carrier.user.name}} |
            <span
              v-show="carrier.website"
            >{{carrier.website}}</span>
          </span>
          <br />
        </div>
        <div class="md-body-1">
          <br />
          <span class="subheading">About company</span>
          <p v-show="carrier.detail">{{carrier.detail}}</p>
        </div>
      </div>
      <md-button :to="{path: 'edit-carrier/'+ carrier.id}" class="md-primary md-icon-button">
        <md-icon>edit</md-icon>
        <md-tooltip>Edit profile</md-tooltip>
      </md-button>
    </md-card>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "GeneralInfo",
  data: () => ({
    carrier: null,
  }),
  methods: {
    async getData() {
      let token = localStorage.getItem("token");
      await axios
        .get("get-carrier", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
        .then((res) => {
          this.carrier = res.data[0];
          this.dataLoaded = true;
          this.$store.commit("setCarrierData", {
            carrierId: this.carrier.id,
            countryId: this.carrier.country.id,
          });
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
  },

  created() {
    this.getData();
  },
};
</script>
<style lang="scss" scoped>
.md-card {
  box-shadow: none;
  border: 1px solid #ddd;
}
.carrier-logo {
  text-align: center;
}
.md-body-1 {
  width: 50%;
  margin: auto;
}
</style>