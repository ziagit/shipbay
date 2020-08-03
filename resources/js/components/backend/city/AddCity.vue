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
              <md-select v-model="state" name="state" id="state" placeholder="State">
                <md-option
                  v-for="state in stateData"
                  :key="state.id"
                  :value="state.id"
                >{{state.name}}</md-option>
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
  props: ["stateData"],
  data: () => {
    return {
      name: null,
      postal_code: null,
      state: null,
    };
  },
  methods: {
    logoOnChange(e) {
      this.logo = e.target.files[0];
    },
    slideOnChange(e) {
      this.slide = e.target.files[0];
    },
    postData() {
      Axios.post("admin/city/store", {
        name: this.name,
        postal_code: this.postal_code,
        state_id: this.state
      })
        .then(res => {
          console.log("saved successfully! ", res.data);
          this.$emit("close-dialog");
        })
        .catch(err => {
          console.log("Error: ", err);
        });
    }
  }
});
</script>

<style scoped>
.md-card {
  box-shadow: none;
}
</style>