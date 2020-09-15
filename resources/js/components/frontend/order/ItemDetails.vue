<template>
  <div class="result">
    <div v-show="dataLoding" class="loading">
      <Spinner />
      <br />
      <span class="md-title">Please wait</span>
    </div>

    <div v-show="!dataLoding">
      <div class="icon">
        <img :src="'/images/result.svg'" width="100" />
      </div>
      <span class="md-display-1">Item dimensional weight</span>
      <div>We calculated your item(s) based on the weight and dimensions you provided.</div>

      <md-card mode="ios" class="items">
        <md-card-content>
          <md-button class="md-icon-button edit-item" @click="prevStep(-16)">
            <md-icon>edit</md-icon>
            <md-tooltip>Edit item</md-tooltip>
          </md-button>
          <ul>
            <li
              v-for="item in order.myItem.items"
              :key="item.id"
            >{{item.description}}, {{Math.round(item.dw)}} Pounds</li>
            <md-divider></md-divider>
            <span>Total: {{Math.round(totalDw())}} Pounds</span>
          </ul>
        </md-card-content>
      </md-card>

      <div class="action">
        <md-button @click="prevStep()" class="md-icon-button md-raised">
          <md-icon>keyboard_arrow_left</md-icon>
        </md-button>
        <md-button @click="nextStep()" class="md-icon-button md-raised md-primary">
          <md-icon>keyboard_arrow_right</md-icon>
        </md-button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import Spinner from "../shared/Spinner";
import functions from "../services/functions";
export default {
  name: "Result",
  data: () => ({
    dataLoding: true,
    dataAvailable: false,
    order: null,
  }),
  methods: {
    nextStep() {
      this.$router.push("carriers");
    },
    prevStep() {
      this.$router.push("items");
    },
    totalDw() {
      return functions.totalDw(this.order.myItem.items);
    },
  },
  created() {
    this.$emit("progress", 84);
    this.order = JSON.parse(localStorage.getItem("order"));
    console.log("in result: ", this.order);
    setTimeout(() => {
      this.dataLoding = false;
    }, 2000);
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
  components:{
    Spinner
  }
};
</script>

<style lang="scss" scoped>
.result {
  text-align: center;
  .loading,
  .action,
  .icon,
  .items {
    margin: 20px auto;
  }
  ul {
    padding: 0;
    li {
      list-style-type: none;
      span {
        border-top: 1px solid #ddd;
      }
    }
  }
  .md-display-1 {
    font-size: 24px;
  }
  .md-card {
    background: #fff;
    text-align: left;
    .edit-item {
      position: absolute;
      top: 0;
      right: 0;
    }
  }
}
@media only screen and (min-width: 600px) {
  .result {
    .md-display-1 {
      font-size: 30px;
    }
  }
}
</style>