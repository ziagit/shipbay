<template>
  <div>
    <form @submit.prevent="submit">
      <input type="text" v-model="test" placeholder="Test" />
      <input type="submit" title="Submit" />
    </form>
    <br />
    <ul>
      <li v-for="test in tests" :key="test.id">
        {{test.id}} : {{test.test}}
        <span @click="remove(test.id)">Delete</span>
      </li>
    </ul>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data: () => ({
    tests: null,
    test: null,
  }),
  methods: {
    submit() {
      axios
        .post("tests", { test: this.test })
        .then((res) => {
          this.get();
          console.log("Response", res.data);
        })
        .catch((error) => {
          console.log("Error: ", error);
        });
    },
    get() {
      axios
        .get("tests")
        .then((res) => {
          this.tests = res.data;
        })
        .catch((error) => {
          console.log("Error: ", error);
        });
    },
    remove(id) {
      axios
        .delete("tests/" + id)
        .then((res) => {
          this.get();
          console.log("removed:", res);
        })
        .catch((error) => {
          console.log("Error: ", error);
        });
    },
  },
  created() {
    this.get();
  },
};
</script>
<style scoped>
div {
  margin: 30px;
}
</style>