<template>
  <div class="container">
    <div class="section0">
      <Header v-on:togal-menu="$emit('togal-menu')" />

      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31958839.600046597!2d-128.4053053!3d60.7318475!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x537a66c7aa6b6aaf%3A0x881b41e937e7f1f9!2sBritish%20Columbia%2C%20Canada!5e0!3m2!1sen!2s!4v1603098152028!5m2!1sen!2s"
        width="600"
        height="450"
        frameborder="0"
        style="border: 0"
        allowfullscreen=""
        aria-hidden="false"
        tabindex="0"
      ></iframe>
    </div>
    <div class="section1">
      <div class="wrapper">
        <div class="left">
          <div class="md-display-1">Drop us a line</div>
          <form action="">
            <md-field>
              <label>Name</label>
              <md-input v-model="name" type="number"></md-input>
            </md-field>
            <md-field>
              <label>Email</label>
              <md-input v-model="email" type="number"></md-input>
            </md-field>

            <md-field>
              <label>Message</label>
              <md-textarea v-model="message"></md-textarea>
            </md-field>

            <md-button type="submit" slot="right" class="md-raised md-primary"
              >Send</md-button
            >
          </form>
        </div>
        <div class="right">
          <div class="row1">
            <div class="md-title">
              <img :src="'/images/uploads/location.svg'" alt="2" width="20" />
              Find us at the office
            </div>
            <div class="md-caption">Sheer Pur Main Road,</div>
            <div class="md-caption">1001, Kabul</div>
            <div class="md-caption">Afghanistan</div>
          </div>
          <div class="row2">
            <div class="md-title">
              <img :src="'/images/uploads/phone.svg'" alt="2" width="20" /> Give
              us a ring
            </div>
            <div class="md-caption">Michael Jordan</div>
            <div class="md-caption">+93 775 059 616</div>
            <div class="md-caption">Mon - Fri, 8:00-22:00</div>
          </div>
          <div class="row3">
            <div class="md-title">
              <img :src="'/images/uploads/bag.svg'" alt="2" width="20" /> Legal
              information
            </div>
            <div class="md-caption">Shipping TAP</div>
            <div class="md-caption">Fast Delivery Agency</div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import Footer from "../../shared/Footer";
import Header from "../../shared/Header";
import axio from "axios";
export default {
  name: "ContactUs",
  data: () => ({
    form: {
      name: null,
      email: null,
      message: null,
    },
  }),
  methods: {},
  components: {
    Footer,
    Header,
  },
};
</script>

<style lang="scss" scoped>
.container {
  background: #fff;
  iframe {
    left: 0;
    top: 0;
    height: 300px !important;
    width: 100%;
  }

  .section1 {
    max-width: 1200px;
    margin: auto;
    padding: 30px;
    .wrapper {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;

      .left {
        flex: 60%;
        padding: 60px;

        .md-display-1 {
            font-weight: 500;
            line-height: 70px;
            color: #000;
        }

        .md-button {
          float: right;
        }
      }

      .right {
        flex: 30%;
        padding: 82px 60px;

        .row1,
        .row2,
        .row3 {
          margin-bottom: 30px;

          .md-headline {
            font-size: 18px;
          }

          .md-caption {
            margin-left: 25px;
          }
        }
      }
    }
  }
}

@media only screen and (max-width: 600px) {
  .md-card {
    flex-direction: column;
    margin-bottom: 30px;
    margin: auto;
    padding: 0 !important;

    .left {
      text-align: center;
      align-items: center;

      .md-button {
        margin: 0;
      }
    }

    .md-display-1 {
      font-size: 30px;
    }
  }
}
</style>
