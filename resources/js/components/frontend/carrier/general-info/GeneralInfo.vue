<template>
  <div>
    <md-card>
      <md-card-content v-if="carrier">
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
            >{{carrier.first_name}} | {{carrier.last_name}} | {{carrier.full_address.address}}</span>
            <br />
            <span
              class="md-subheading"
            >{{carrier.full_address.country.name}} | {{carrier.full_address.state.name}} | {{carrier.full_address.city.name}} | {{carrier.full_address.citycode}}</span>
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
      </md-card-content>
      <md-card-actions v-if="carrier">
        <md-button to="edit-carrier" class="md-primary md-icon-button">
          <md-icon>edit</md-icon>
          <md-tooltip>Edit profile</md-tooltip>
        </md-button>
      </md-card-actions>
      <md-empty-state
        v-else
        class="md-primary"
        md-icon="sentiment_satisfied_alt"
        md-label="Not available"
        md-description="Click + icon to add"
      >
        <md-button to="add-carrier" class="md-icon-button md-raised">
          <md-icon>add</md-icon>
          <md-tooltip>Add new data</md-tooltip>
        </md-button>
      </md-empty-state>
    </md-card>
  </div>
</template>
<script>
import axios from "axios";
import { mapActions } from "vuex";
export default {
  name: "GeneralInfo",
  data: () => ({
    carrier: null,
    temp: {
      me: null,
      country: null,
    },
  }),
  methods: {
    ...mapActions({
      tempData: "shared/tempData",
    }),
    async get() {
      await axios
        .get("carrier/details")
        .then((res) => {
          this.carrier = res.data;
          this.dataLoaded = true;
          this.temp.me = this.carrier.id;
          this.temp.country = this.carrier.full_address.country.id;
          this.tempData(this.temp).then((res) => {});
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
  },

  created() {
    this.get();
  },
};
</script>
<style lang="scss" scoped>
.md-card {
  box-shadow: none;
  border: 1px solid #ddd;
  text-align: center;
  .md-card-actions {
    display: flex;
    justify-content: space-around;
  }
}
.carrier-logo {
  text-align: center;
}
.md-body-1 {
  width: 50%;
  margin: auto;
}
</style>