<template>
  <div>
    <!--     <form @submit.prevent="submit">
      <input type="text" v-model="test" placeholder="Test" required />
      <input type="submit" title="Submit" />
    </form>
    <br />
    <ul>
      <li v-for="test in tests" :key="test.id">
        {{test.id}} : {{test.test}}
        <span @click="remove(test.id)">Delete</span>
      </li>
    </ul> -->

    <form action="/">
      <md-field>
        <label>Country</label>
        <md-input
          type="text"
          name="country"
          v-model="country"
          required
        ></md-input>
      </md-field>
      <md-field>
        <label>State</label>
        <md-input type="text" name="state" v-model="state" required></md-input>
      </md-field>
      <md-field>
        <label>City</label>
        <md-input type="text" name="city" v-model="city" required></md-input>
      </md-field>
      <md-field>
        <label>Postal code</label>
        <md-input type="text" name="postalcode" v-model="postalcode" required></md-input>
      </md-field>
      <md-field>
        <label>Address</label>
        <md-input type="text" name="address" v-model="address" required></md-input>
      </md-field>
      <button type="submit">Submit</button>
    </form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data: () => ({
    country:null,
    state:null,
    city:null,
    postalcode:null,
    address:null,


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
          console.log("removed:", res.data);
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
form{
  max-width: 600px;
}
div {
  margin: 30px;
}
span {
  color: rgb(255, 0, 179);
}
span:hover {
  cursor: pointer;
}
</style>