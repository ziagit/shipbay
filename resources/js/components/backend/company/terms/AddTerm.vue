<template>
  <div>
    <md-field class="">
      <label>Description</label>
      <md-input v-model="form.title"></md-input>
    </md-field>
    <tinymce id="d1" v-model="form.body"></tinymce>
  </div>
</template>
<script>
import Vue from "vue";
import tinymce from "vue-tinymce-editor";
Vue.component("tinymce", tinymce);
export default {
  data() {
    return {
      form: {
        title: "",
        body: "",
      },
    };
  },
};
</script>
