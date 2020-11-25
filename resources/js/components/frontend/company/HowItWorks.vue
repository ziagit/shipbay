<template>
  <div class="container">
    <div class="section0">
      <Header
        v-on:togal-menu="$emit('togal-menu')"
        :scrollValue="scrollValue"
      />
      <video width="100%" autoplay muted>
        <source :src="'/images/uploads/how-it-works.mp4'" type="video/mp4" />
      </video>
    </div>

    <div class="section1">
      <div class="wrapper">
        <div class="left">
          <div class="md-display-1">How It Works?</div>
          <div class="md-body-1">
            Ask us anything! When you need assistance, our knowledgeable experts
            are ready. We want your freight shipping to be easy. Here are some
            common situations along with guidance we’re pleased to share with
            you.
          </div>
          <br />
          <div class="steps">
            <div class="step step1">
              <div class="circle">1</div>
              <div class="text">Hi bro</div>
            </div>
            <div class="step step2">
              <div class="circle">2</div>
              <div class="text">Hi bro</div>
            </div>
            <div class="step step3">
              <div class="circle">3</div>
              <div class="text"></div>
            </div>
          </div>
        </div>
        <div class="right">
          <div class="qoute">
            <div class="md-title">Get a Free Shipping Qoute</div>
            <form action="">
              <md-field>
                <label>City/Zip code</label>
                <md-input type="text" v-model="form.city" required></md-input>
              </md-field>

              <div class="action">
                <md-button class="custom-button" to="/order">Start</md-button>
              </div>
            </form>
          </div>

          <div class="contact">
            <div class="md-title">Contact us</div>
            <div class="md-body-1">
              If you want to know more about us, drop us an email.
            </div>
            <div>
              <router-link to="/contact">Contact us</router-link>
              <md-icon>keyboard_arrow_right</md-icon>
            </div>
          </div>
          <div class="download-app">
            <div class="md-title">Download our Application</div>
            <div class="md-body-1">
              By downloading our application the task will be much easier.
            </div>
            <div>
              <md-button class="custom-button" to="https://play.google.com"
                >Download</md-button
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script>
import axio from "axios";
import Footer from "../../shared/Footer";
import Header from "../../shared/Header";
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

  .section0 {
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    align-items: center;
    video {
      max-height: 278px;
      border-bottom: #ddd 1px solid;
    }
  }

  .section1 {
    max-width: 1200px;
    margin: auto;
    padding: 30px;

    .wrapper {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;

      .left {
        flex: 60%;
        padding: 60px;

        .md-display-1 {
          font-weight: 500;
          line-height: 70px;
          color: #000;
        }

        .md-body-1 {
          font-size: 16px;
          line-height: 24px;
        }
        .step {
          background: #000;
          min-height: 100px;
          margin: 30px;
          border-radius: 50px;
        }
      }

      .right {
        flex: 30%;
        padding: 80px 60px;

        .md-headline {
          font-size: 22px;
        }

        .md-icon {
          color: #66a9fb;
        }

        .qoute {
          .md-field {
            margin: 4px 0 8px;
          }

          .action {
            text-align: right;

            .md-button {
              margin: 0;
            }
          }
        }

        .qoute,
        .faq,
        .download-app,
        .privacy,
        .terms,
        .contact {
          margin-bottom: 30px;
        }

        .download-app {
          .md-button {
            margin-top: 20px;
          }
        }
      }
    }
  }
}

@media only screen and (max-width: 600px) {
  .section0 {
    padding: 50px 10px 100px 10px !important;
  }

  .md-card {
    padding: 0 !important;

    .md-card-header {
      padding: 50px 0 0 0 !important;
      max-width: 78% !important;
    }

    .section1 {
      padding: 0 !important;

      .wrapper {
        flex-direction: column;

        .md-button {
          margin: 30px 0 0 0;
        }
      }
    }
  }
}
</style>
