<template>
  <div>
    <form>
      <md-card>
        <md-card-content>
          <md-content class="md-layout">
          <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
              <md-input v-model="form.title" placeholder="Title"></md-input>
            </md-field>
            <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
              <md-input v-model="form.description" placeholder="Description"></md-input>
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
        title: null,
        description: null,
      },
    };
  },
  methods: {
    save() {
      axios
        .post("admin/services", this.form)
        .then((res) => {
          console.log("saved successfully! ", res.data);
          this.$emit("close-dialog");
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
  },
};
</script>

<style scoped>
.md-card {
  box-shadow: none;
}
</style>