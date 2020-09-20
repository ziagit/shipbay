<template>
  <div class="home-content">
    <div class="section1">
      <div class="text">
        <div class="heading">
          <span class="md-headline">Smart Shipping!</span>
        </div>
        <div class="sub-heading">
          <span
            class="md-subheading"
          >We get you shipped in 3 easy steps. Thousands happening everyday!</span>
        </div>
        <div class="help">
          <router-link to="/help" color="primary">How it works ?</router-link>
        </div>
      </div>
      <div class="action">
        <md-button @click="getQuote()" class="md-primary md-raised">Get a free qu<div class="circle"></div>te </md-button>
      </div>
    </div>
    <div class="image"></div>
  </div>
</template>
<script>
export default {
  name: "HomeContainer",
  data: () => ({}),
  methods: {
    getQuote() {
      this.$router.push("order");
    },
  },
  components: {},
};
</script>
<style lang="scss" scoped>
.circle {
  animation: pulse 2s infinite;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: solid 2px rgba(255, 82, 82, 1);
  display: inline-block;
}
@keyframes pulse {
  0% {
    transform: scale(0.9);
    box-shadow: 0 0 0 0 rgba(255, 82, 82, 0.7);
  }
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 30px rgba(255, 82, 82, 0);
  }
  100% {
    transform: scale(0.9);
  }
}
.home-content {
  text-align: center;
  padding-top: 60px;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: space-around;
  .text {
    margin-left: 7px;
    .heading {
      .md-headline {
        font-size: 2.5em;
      }
    }
    .sub-heading {
      .md-subheading {
        font-size: 1em;
        line-height: 1em;
      }
    }
    .help {
      margin-bottom: 3em;
      margin-top: 0.7em;
      a {
        font-size: 1em;
      }
    }
  }
  .action {
    .md-button {
      border-radius: 5px;
      padding: 0 10px;
    }
  }
}
@media only screen and (min-width: 600px) {
  .home-content {
    padding: 100px 50px;
    text-align: left;
    .action {
      ion-button {
        font-size: 14px;
      }
    }
  }
}
</style>