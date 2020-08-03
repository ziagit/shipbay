<template>
  <div>
    <form>
      <md-card>
        <md-card-content>
          <md-content class="md-layout">
            <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
              <label>Name</label>
              <md-input v-model="name" name="name"></md-input>
            </md-field>
            <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
              <label>Postal code</label>
              <md-input v-model="postal_code" name="postal_code"></md-input>
            </md-field>
            <md-field>
              <label for="country">Country</label>
              <md-select v-model="country" name="country" id="country">
                <md-option
                  v-for="cntry in countryData"
                  :key="cntry.id"
                  :value="cntry.id"
                >{{cntry.name}}</md-option>
              </md-select>
            </md-field>
          </md-content>
        </md-card-content>
        <md-card-actions>
          <md-button v-on:click="postData()">Submit</md-button>
        </md-card-actions>
      </md-card>
    </form>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import Axios from "axios";
export default Vue.extend({
  props: ["stateData", "countryData"],
  data: () => {
    return {
      id: null,
      name: null,
      postal_code: null,
      country: null
    };
  },
  methods: {
    postData() {
      Axios.post("admin/state/update", {
        id: this.id,
        name: this.name,
        postal_code: this.postal_code,
        country_id: this.country
      })
        .then(res => {
          console.log("updated successfully! ", res.data);
          this.$emit("close-dialog");
        })
        .catch(err => {
          console.log("Error: ", err);
        });
    }
  },
  mounted() {
    this.id = this.stateData.id;
    this.name = this.stateData.name;
    this.postal_code = this.stateData.postal_code;
    this.country = this.stateData.country.id;
  }
});
</script>

<style scoped>
.md-card {
  box-shadow: none;
}
</style>