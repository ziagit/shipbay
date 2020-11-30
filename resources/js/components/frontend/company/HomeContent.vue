<template>
  <div class="container">
    <div
      class="section0"
      v-bind:style="{ 'background-image': 'url(/images/uploads/home-bg.svg)' }"
    >
      <Header
        v-on:togal-menu="$emit('togal-menu')"
        :scrollValue="scrollValue"
      />
      <div class="content">
        <div class="md-display-1">Let’s book your shipment in a few taps.</div>
        <div class="md-subheading">The way you book your travel tickets.</div>
        <div class="md-title">What are you shipping today?</div>
        <div class="actions">
          <md-button class="custom-button" to="/order">Freight</md-button>
          <md-button class="md-button custom-button-outline">Moving</md-button>
        </div>
      </div>
    </div>
    <div class="wrapper">
      <div class="section1">
        <div class="row">
          <div class="md-display-1">8.8</div>
          <div class="md-subheading">Carrier Review</div>
          <div>
            <router-link to="#"
              >See All Reviews <md-icon>keyboard_arrow_right</md-icon>
            </router-link>
          </div>
        </div>
        <div class="row row2">
          <div class="md-display-1">9.2</div>
          <div class="md-subheading">Shipper Review</div>
          <div>
            <router-link to="#"
              >See All Reviews <md-icon>keyboard_arrow_right</md-icon>
            </router-link>
          </div>
        </div>
        <div class="row row3">
          <div class="md-display-1">
            Trusted by over 250+ business partner around the world
          </div>
        </div>
        <div class="row"></div>
      </div>
      <div class="section2">
        <div class="heading">
          <div class="md-display-1">Safe and hassle-free shipping</div>
          <div class="md-body-1">
            Get your freight safely shipped by a few taps.
          </div>
        </div>
        <div class="rows">
          <div class="row">
            <img :src="'/images/uploads/transparent.svg'" width="35" alt="" />
            <div>
              <div class="md-title">Transparent</div>
              <div class="md-body-1">
                Upfront pricing and free quotes from hundreds of Carriers. know
                your shipment cost before you ship.
              </div>
            </div>
          </div>
          <div class="row with-shadow">
            <img :src="'/images/uploads/nosignup.svg'" width="35" alt="" />
            <div>
              <div class="md-title">No Sign up</div>
              <div class="md-body-1">
                Get free quotes and book your shipment in a few taps. No sign up
                or membership required.
              </div>
            </div>
          </div>
          <div class="row">
            <img :src="'/images/uploads/inssured.svg'" width="35" alt="" />
            <div>
              <div class="md-title">Insured</div>
              <div class="md-body-1">
                All the shipments happening here are insured through our vetted
                Carriers insurance policy.
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="section3"
        v-bind:style="{
          'background-image': 'url(/images/uploads/section3.svg)',
        }"
      >
        <div class="text">
          <div class="md-display-1">Customer competitive advantage</div>
          <div class="break"></div>
          <div class="md-body-1">You are granted free access to the qualified services provided pricing with customer rating and reviews </div>
        </div>
        <div class="steps">
          <div class="head"></div>
          <ul>
            <li>
              <div class="avatar">
                <img :src="'/images/uploads/item-list.svg'" alt="People" />
              </div>
              <div class="text">
                <div class="md-title">List your items</div>
                <div class="details">
                  Specify the shipment and schedule a date.
                </div>
              </div>
            </li>

            <md-divider></md-divider>

            <li>
              <div class="avatar">
                <img :src="'/images/uploads/select-carrier.svg'" alt="People" />
              </div>
              <div class="text">
                <div class="md-title">Select a Carrier</div>
                <div class="details">
                  Chose a service provider with the lowest price and best
                  customer ratings.
                </div>
              </div>
            </li>
            <md-divider></md-divider>
            <li>
              <div class="avatar">
                <img :src="'/images/uploads/track-order.svg'" alt="People" />
              </div>
              <div class="text">
                <div class="md-title">Track your order</div>
                <div class="details">
                  Relax! we will notify you on every step taken. Also, you can
                  track the shipment live.
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="section4">
        <div class="row">
          <img :src="'/images/uploads/about.svg'" alt="" />
        </div>
        <div class="row">
          <div class="md-display-1">Business Freight</div>
          <div class="md-body-1">
            Whether you have a one time freight to be shipped or everyday
            shipment, we got you covered with the competitive advantages...
          </div>
          <md-button class="md-button md-raised" to="/order"
            >Get Freight Quote</md-button
          >
        </div>
      </div>
      <div class="section5">
        <div class="row">
          <div class="md-display-1">Household Moving</div>
          <div class="md-body-1">
            We are the only platform where you can get upfront quote for your
            big day moving in a matter of seconds.
          </div>
          <button class="md-button md-raised">Get Moving Quote</button>
        </div>
        <div class="row">
          <img :src="'/images/uploads/about.svg'" alt="" />
        </div>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script>
import Footer from "../../shared/Footer";
import Header from "../../shared/Header";

export default {
  name: "HomeContent",
  props: ["scrollValue"],
  data: () => ({}),

  methods: {
    menuTogal() {
      this.$emit("menu-togal");
    },
    getQoute() {
      this.$router.push("/order");
    },
  },

  components: {
    Header,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
.container {
  background: #fff;
  .section0 {
    text-align: left;
    height: calc(100vh - 48px);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    box-shadow: none !important;

    .content {
      text-align: left;
      padding: 122px 0 12px 106px;
      max-width: 665px;

      .md-display-1 {
        line-height: 60px;
        font-size: 53px;
        font-weight: 600;
        color: #000;
        margin-bottom: 0 !important;
      }
      .md-subheading {
        margin-top: 0;
        color: #848484;
        margin-bottom: 42px;
        font-size: 18px;
      }
      .md-title {
        margin-bottom: 16px;
      }

      .actions {
        .md-button {
          margin-right: 16px;
        }
      }
    }
  }

  .wrapper {
    background: #fff;
    max-width: 1200px;
    margin: auto;
    padding-bottom: 126px;

    .section1 {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      padding: 46px 100px;

      .row {
        flex: 25%;

        .md-display-1 {
          color: #ffa500;
          font-weight: 500;
        }

        .md-subheading {
          color: #000;
        }
      }

      .row2 {
        .md-display-1 {
          color: #f58720;
        }
      }

      .row3 {
        .md-display-1 {
          color: #000;
          font-size: 22px;
          line-height: 28px;
        }
      }
    }

    .section2 {
      padding: 46px 100px;

      .heading {
        padding: 20px 20px 20px 0;

        .md-display-1 {
          color: #000;
          line-height: 38px;
          font-weight: 500;
        }

        .md-body-1 {
          font-size: 16px;
          line-height: 24px;
        }
      }

      .rows {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;

        .row {
          flex: 30%;
          padding: 30px;
          border: solid 1px #ddd;
          border-radius: 3px;
          margin: 10px;

          .md-title {
            line-height: 52px;
            font-weight: 600;
            line-height: 44px;
          }
        }

        .with-shadow {
          background: #fff;
          box-shadow: rgba(0, 0, 0, 0.12) 0px 4px 16px;
          border: none;
        }
      }
    }

    .section3 {
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
      padding: 76px;
      margin: 30px 30px 60px 30px;
      min-height: 500px;
      max-width: 80%;
      position: relative;

      .text {
        .md-display-1 {
          line-height: 38px;
          max-width: 309px;
          color: #000;
          font-weight: 500;
        }

        .md-body-1 {
          max-width: 353px;
          font-size: 14px;
          line-height: 24px;
        }
      }

      .steps {
        max-width: 460px;
        background: #fff;
        position: absolute;
        right: -100px;
        bottom: -50px;
        box-shadow: rgba(0, 0, 0, 0.12) 0px 4px 16px;
        .head {
          min-height: 9px;
          width: 100%;
          background: #ffa500;
        }
        ul {
          padding: 36px;
          margin: 0;

          li {
            padding: 20px;
            display: flex;
            justify-content: space-between;

            .avatar {
              display: flex;
              flex: 13%;
              padding: 10px;
            }
            .text {
              flex: 75%;
              padding: 10px;

              .md-title {
                font-weight: 600;
                line-height: 34px;
                font-size: 16px;
              }
              .details {
                font-size: 12px;
                color: #6c6b6b;
              }
            }
          }
          .md-divider {
            height: 0.1px !important;
          }
        }
      }
    }
    .section4,
    .section5 {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      padding: 46px 100px;

      .row {
        flex: 50%;

        .md-display-1 {
          max-width: 52%;
          font-weight: 500;
          font-size: 30px;
          line-height: 49px;
          color: #000;
        }

        .md-body-1 {
          max-width: 70%;
          margin: 3px 0 86px 0;
          font-size: 16px;
          line-height: 24px;
        }

        .md-button {
          width: 179px;
        }

        ul {
          padding: 20px 20px 20px 40px;
          border: solid 1px #ddd;

          li {
            padding: 10px;
          }
        }
      }
    }
  }
}

@media only screen and (max-width: 769px) {
  .section3 {
    .steps {
      max-width: 360px !important;

      ul {
        li {
          padding: 12px !important;
        }
      }
    }
  }

  .section4,
  .section5 {
    .row {
      .md-display-1,
      .md-body-1 {
        max-width: 80% !important;
      }
    }
  }
}

@media only screen and (max-width: 600px) {
  .section0 {
    background-position: right !important;

    .content {
      .heading {
        padding: 372px 20px !important;
        text-align: center !important;

        .md-display-1 {
          line-height: 39px !important;
          margin: 0 !important;
          font-size: 28px !important;
        }

        .md-body-1 {
          margin: 0 !important;
        }

        .actions {
          margin-top: 18px !important;
        }
      }
    }
  }

  .section1 {
    display: none !important;
  }

  .section2 {
    padding: 112px 20px 20px 20px !important;

    .heading {
      .md-display-1 {
        line-height: 24px !important;
        font-size: 23px;
        font-weight: 500;
        margin-bottom: 12px;
      }
    }

    .row {
      flex: 100% !important;
    }
  }

  .section3 {
    margin: 0 !important;
    max-width: 100% !important;
    padding: 20px !important;

    .text {
      .md-display-1 {
        margin: 10px 0 !important;
      }
    }

    .steps {
      position: relative !important;
      right: 0 !important;
      bottom: 0 !important;
      margin-top: 44px !important;
    }
  }

  .section4,
  .section5 {
    padding: 46px 22px !important;

    .row {
      .md-display-1 {
        line-height: 24px !important;
        font-size: 23px !important;
        font-weight: 500 !important;
        margin-bottom: 12px;
      }

      .md-body-1 {
        margin: 3px 0 52px 0 !important;
      }
    }
  }
}
</style>
