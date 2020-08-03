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
              <label>Code</label>
              <md-input v-model="code" name="code"></md-input>
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
  props: ["countryData"],
  data: () => {
    return {
      id: null,
      name: null,
      code: null
    };
  },
  methods: {
    postData() {
      Axios.post("admin/country/update", {
        id: this.id,
        name: this.name,
        code: this.code
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
    this.id = this.countryData.id;
    this.name = this.countryData.name;
    this.code = this.countryData.code;
  }
});
</script>

<style scoped>
.md-card {
  box-shadow: none;
}
</style>