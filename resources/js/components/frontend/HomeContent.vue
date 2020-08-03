<template>
  <div class="home-content">
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
        <router-link to="/help">How it works?</router-link>
      </div>
      <div class="action">
        <ion-button color="primary" @click="getQuote()">get a free quote</ion-button>
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
    }
  },
  components: {}
};
</script>
<style lang="scss" scoped>
.home-content {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: space-around;
  padding: 100px 50px;
  .heading{
    .md-headline{
      font-size: 3em;
    }
  }
  .sub-heading{
    .md-subheading{
      font-size: 1.2em;
      line-height: 2em;
    }
  }
  .help{
    margin-bottom: 3em;
    a{
      font-size: 1em;
    }
  }
}

/* @media only screen and (max-width: 600px) {
  .section1 {
    text-align: center;
    height: 100%;
    padding: 40px 20px 120px 20px;
    display: block;
    .md-display-3 {
      color: #ffffff;
      font-size: 36px;
    }
    .md-title {
      color: #ffffff;
      font-size: 14px;
    }
    img {
      width: 60%;
    }
  }
  .section2 {
    text-align: center;
  }
} */
</style>