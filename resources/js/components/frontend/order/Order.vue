<template>
  <div class="order">
    <div class="progress-container">
      <md-progress-bar md-mode="determinate" :md-value="amount"></md-progress-bar>
    </div>
    <div class="input-container">
      <router-view v-on:progress="progress"></router-view>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "StepperLinear",
  data: () => ({
    amount: 0
  }),

  methods: {
    progress(prgValue) {
      if(localStorage.getItem('prg-value')){
        let storage = JSON.parse(localStorage.getItem('prg-value'))
        this.amount = storage + prgValue;
        localStorage.setItem('prg-value', JSON.stringify(this.amount))
        console.log("prg in order: ", this.amount)
      }else{
        this.amount = this.amount + prgValue;
      localStorage.setItem('prg-value', JSON.stringify(this.amount))
      console.log("prg in order: ", JSON.parse(localStorage.getItem('prg-value')))
      }
    },
  },
  created(){
    if(localStorage.getItem('prg-value')){
        this.amount = JSON.parse(localStorage.getItem('prg-value'))
        localStorage.setItem('prg-value', JSON.stringify(this.amount))
      }
  }
};
</script>

<style lang="scss" scoped>
.order {
  width: 100%;
  margin: auto;
  padding: 30px;
  text-align: center;
  .progress-container {
    max-width: 800px;
    margin: auto;
    .md-progress-bar {
      border-radius: 20px;
      background-color: #fff;
      .md-progress-bar-fill {
        background: chocolate;
      }
      .md-progress-bar-buffer {
        background: #e7eaed;
      }
    }
  }
  .input-container {
    padding: 10px;
    max-width: 600px;
    margin: auto;
  }
}

/* @media only screen and (max-width: 600px) {
  .section1 {
    height: 100vh;
    padding-top: 10px;
    .main-card {
      width: 95%;
      label,
      .md-primary {
        font-size: 11px;
      }
      .row-inputs {
        padding: 0;
        display: block;
      }
      .service-label {
        margin-left: 0;
      }
      ul {
        padding: 0;
        li {
          display: block;
          list-style-type: none;

          .remove-item {
            position: relative;
            bottom: 0;
            right: 0;
          }
        }
      }
    }
  }
} */
</style>