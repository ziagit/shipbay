<template>
  <div>
    <form>
      <md-card>
        <md-card-content>
          <md-content class="md-layout">
            <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
              <label>Name</label>
              <md-input v-model="form.name" name="name"></md-input>
            </md-field>
            <md-field>
              <md-select v-model="form.state" id="state" placeholder="State">
                <md-option v-for="state in states" :key="state.id" :value="state.id">{{state.name}}</md-option>
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
        name: null,
        state: null,
      },
      states: null,
    };
  },
  methods: {
    save() {
      axios
        .post("admin/cities", this.form)
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
        .get("states")
        .then((res) => {
          this.states = res.data;
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