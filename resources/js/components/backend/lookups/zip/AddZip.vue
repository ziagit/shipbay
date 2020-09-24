<template>
  <div>
    <form>
      <md-card>
        <md-card-content>
          <md-content class="md-layout">
            <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
              <label>Postal code</label>
              <md-input v-model="form.postalcodes"></md-input>
            </md-field>
            <md-field>
              <md-select v-model="form.city" id="state" placeholder="City">
                <md-option v-for="city in cities" :key="city.id" :value="city.id">{{city.name}}</md-option>
              </md-select>
            </md-field>
          </md-content>
        </md-card-content>
        <md-card-actions>
          <md-button v-on:click="save()">Save</md-button>
        </md-card-actions>
      </md-card>
    </form>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import axios from "axios";
export default {
  data: () => {
    return {
      form: {
        postalcodes:null,
        city: null,
      },
      cities: null,
    };
  },
  methods: {
    save() {
      this.form.postalcodes = this.form.postalcodes.split(',');
      axios
        .post("admin/zips", this.form)
        .then((res) => {
          console.log("saved successfully! ", res.data);
          this.$emit("close-dialog");
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    get() {
      axios
        .get("cities")
        .then((res) => {
          this.cities = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
  },
  created(){
    this.get();
  }
};
</script>

<style scoped>
.md-card {
  box-shadow: none;
}
</style>