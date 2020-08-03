<template>
  <div class="result">
    <div v-show="dataLoding" class="loading">
      <span class="md-display-1">Calculating item dimentional weight...</span>
      <br />
      <span class="md-title">Please wait</span>
      <br />
      <!-- <md-progress-spinner md-mode="indeterminate"></md-progress-spinner> -->
      <ion-spinner mode="ios" name="lines" color="primary" class="primary"></ion-spinner>
    </div>

    <div v-show="!dataLoding">
      <div class="icon">
        <img src="http://localhost:8000/images/result.svg" width="100" />
      </div>
      <span class="md-display-1">We calculated your dimensional weight</span>
      <div>We calculated your item(s) based on the weight and dimensions you provided.</div>

      <ion-card mode="ios" class="items">
        <ion-card-content>
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
            <span>Total: {{Math.round(calculateTotalDW())}} Pounds</span>
          </ul>
        </ion-card-content>
      </ion-card>

      <div class="action">
        <md-button @click="prevStep(-16)" class="md-icon-button md-raised">
          <md-icon>keyboard_arrow_left</md-icon>
        </md-button>
        <md-button @click="nextStep(16)" class="md-icon-button md-raised md-primary">
          <md-icon>keyboard_arrow_right</md-icon>
        </md-button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "Result",
  data: () => ({
    dataLoding: true,
    dataAvailable: false,
    order: null
  }),
  methods: {
    nextStep(prgValue) {
      this.$router.push("select-carrier");
      this.$emit("progress", prgValue);
    },
    prevStep(prgValue) {
      this.$router.back("items");
      this.$emit("progress", prgValue);
    },
    calculateTotalDW() {
      let total = 0;
      this.order.myItem.items.forEach(element => {
        total = total + element.dw;
      });
      return total;
    }
  },
  created() {
    this.order = JSON.parse(localStorage.getItem("order"));
    console.log("in result: ", this.order);
    setTimeout(() => {
      this.dataLoding = false;
    }, 2000);
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
    font-size: 30px;
  }
  ion-card {
    background: #fff;
    text-align: left;
    .edit-item {
      position: absolute;
      top: 0;
      right: 0;
    }
  }
}
</style>