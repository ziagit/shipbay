<template>
  <div class="container">
    <div
      class="section0"
      v-bind:style="{ 'background-image': 'url(/images/uploads/help.jpg)' }"
    >
      <Header v-on:togal-menu="$emit('togal-menu')" :scrollValue="scrollValue"/>
      <div class="content">
        <div class="md-display-1">How it Works?</div>
        <div class="md-subheading">
          Our simple shipping tool is the fastest route to getting your freight
          on the road. Just enter a few shipment details, review quotes and
          choose a carrier
        </div>
        <md-button class="md-raised">Get Quote</md-button>
      </div>
    </div>

    <div class="section1">
      <div class="wrapper">
        <div class="left">
          <div class="md-display-1">We're happy to help</div>
          <div class="md-body-1">
            Ask us anything! When you need assistance, our knowledgeable experts
            are ready. We want your freight shipping to be easy. Here are some
            common situations along with guidance we’re pleased to share with
            you.
          </div>
          <br />
          <md-steppers md-vertical :md-active-step.sync="active">
            <md-step
              id="first"
              md-label="I want to set up an account."
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Call us at 800.323.5441 or
                <router-link to="/register"
                  >set up your account online</router-link
                >.
              </div>
            </md-step>
            <md-step
              id="second"
              md-label="What if I need help after regular business hours?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                When you create a ShippingTAP account, you will have access to
                all your information, whenever you need it. You can quote, book,
                track, pay invoices, access your address book, view prior
                shipments and more within your account page.
              </div>
            </md-step>
            <md-step
              id="third"
              md-label="I’m a carrier wanting to become a ShippingTAP contract carrier."
              md-description="Click to read more"
            >
              <div class="md-body-1">
                You can learn more about our carriers
                <router-link to="/carriers">here</router-link> or call us at
                877.667.0035 to learn more about becoming a ShippingTAP contract
                carrier.
              </div>
            </md-step>
            <md-step
              id="fifth"
              md-label="My shipment was late and I paid for guaranteed service."
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Contact ShippingTAP customer service, 800.323.5441, to file a
                claim with the contract carrier.
              </div>
            </md-step>
            <md-step
              id="sixth"
              md-label="Can customer service reps book freight on the phone?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Customer service reps can quote and track your freight, but can
                only book LTL shipments over the phone. Contact your account
                manager or log in to your account for other tools and services.
              </div>
            </md-step>
            <md-step
              id="seventh"
              md-label="I need to know how to pack my items, do you have any advice?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                We have lots of tips and suggestions about packing, crating and
                pallets to help you with the safety and security of your
                shipment. You may also call us any time with questions at
                800.323.5441.
              </div>
            </md-step>
            <md-step
              id="eighth"
              md-label="I want to change or cancel my pick up date."
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Sign into your ShippingTAP account to cancel or rebook. You can
                also call to change or cancel the pickup date.
              </div>
            </md-step>
            <md-step
              id="nineth"
              md-label="Calling Customer service, we can often solve issues faster if you provide:"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                <ul>
                  <li>Bill of Lading number</li>
                  <li>Account phone number</li>
                  <li>Account email address</li>
                  <li>Zip code pairings on your shipment</li>
                  <li>Pick up date and location</li>
                </ul>
              </div>
            </md-step>
          </md-steppers>
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

    .content {
      padding: 85px 200px 40px 106px;

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
      .md-button {
        margin-top: 30px;
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
