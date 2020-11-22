<template>
  <div class="container">
    <div
      class="section0"
      v-bind:style="{ 'background-image': 'url(/images/uploads/about.jpg)' }"
    >
      <Header v-on:togal-menu="$emit('togal-menu')" :scrollValue="scrollValue"/>
      <div class="content">
        <div class="md-display-1">Our Shippers</div>
        <div class="md-subheading">
          From the start, everything we've done has centered on solving customer
          problems through technology.
        </div>
      </div>
    </div>

    <div class="section1">
      <div class="wrapper">
        <div class="left">
          <div>
            <div class="md-display-1">Important info about your quote</div>
            <div class="md-body-1">
              1. All freight rates quoted on ShippingTAP platform are provided
              according to the description of goods and declared by the shipper
              and may be subject to additional charges in the case of
              misdeclaration.
              <div class="break"></div>
              2. If your load needs special handling, please select it for an
              accurate quote. Carriers charge for special handling if needed,
              and this will affect your final rate and invoice.
              <div class="break"></div>
              3. The pickup date and transit time vary by the carrier and are
              not guaranteed unless otherwise stated. Transit time starts with
              the first business day after pickup and doesn’t include the day of
              pickup, weekends or holidays.
              <div class="break"></div>
              4. Be mindful of the truck waiting time. Rates quoted include up
              to 30 minutes loading and offloading and 1 hour loading and 1 hour
              offloading unless otherwise specified. There will be additional
              charges for delays in loading, waiting at facilities for loading
              or offloading and other unforeseen delays.
              <div class="break"></div>
              5. By using this site, you agree to be bound by Terms of Use.
              <router-link to="terms-and-conditions"
                >Please review the terms here</router-link
              >.
            </div>
          </div>
          <br />
          <div>
            <div class="md-display-1">How Does ShippingTAP Works?</div>
            <div class="md-body-1">
              ShippingTAP is like the Expedia of shipping freight. Just type in
              your origin and destination, dates and quantity you’re shipping.
              Instantly see all available trucks and rates. You book the deal
              you want! <br />
              <ul>
                <li>
                  <router-link to="/order"
                    >Get a Free Instant Quote</router-link
                  >
                </li>
                <li>
                  <router-link to="/terms-and-conditions"
                    >Read our Terms and Conditions</router-link
                  >
                </li>
                <li>
                  <router-link to="/privacy-policy"
                    >Read Privacy Policy</router-link
                  >
                </li>
                <li>
                  <router-link to="/help">Visit our Help Center</router-link>
                </li>
                <li><router-link to="/register">Signup now</router-link></li>
              </ul>
            </div>
            <router-link to="faq">See Shipper FAQ</router-link>
          </div>
          <br />
          <div>
            <div class="md-title">Start a New Quote</div>
            <div class="break"></div>
            <md-button class="custom-button">Get Quote</md-button>
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
                <md-button class="custom-button" to="/order"
                  >Start</md-button
                >
              </div>
            </form>
          </div>

          <div class="contact">
            <div class="bunner">
              <div class="md-body-1">
                Whether you're an experienced or novice shipper, we have the
                tools and experts to help you plan and execute complex or simple
                shipping solutions.
              </div>
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
  props: ['scrollValue'],
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

    .header {
      color: #fff;

      h3 {
        color: #fff !important;
      }

      .md-icon {
        color: #fff !important;
      }
    }

    .content {
      padding: 85px 200px 130px 106px;

      .md-display-1 {
        line-height: 60px;
        font-size: 53px;
        font-weight: 600;
        color: #fff;
      }

      .md-subheading {
        color: #fff;
        max-width: 70%;
      }
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

        img {
          width: 100%;
          //box-shadow: rgba(0, 0, 0, 0.12) 0px 4px 16px;
        }

        .md-body-1 {
          font-size: 16px;
          line-height: 24px;
        }
      }

      .right {
        flex: 30%;
        padding: 82px 60px;

        .md-headline {
          font-size: 22px;
        }

        .md-icon {
          color: #66A9FB;
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
        .download-app,
        .contact,
        .bunner {
          margin-bottom: 30px;
        }
        .bunner {
          background: #ffa50066;
          padding: 20px;
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

      .rows {
        flex-direction: column;

        .md-button {
          margin: 30px 0 0 0;
        }
      }
    }
  }
}
</style>
