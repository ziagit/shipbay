<template>
  <div class="container">
    <div
      class="section0"
      v-bind:style="{ 'background-image': 'url(/images/uploads/help.svg)' }"
    >
      <Header
        v-on:togal-menu="$emit('togal-menu')"
        :scrollValue="scrollValue"
      />
      <div class="content">
        <div class="md-display-1">{{ header }}</div>
        <div class="md-subheading">
          {{ subheader }}
          <div class="break"></div>
          <md-button class="custom-button" to="/register" v-if="carrierToggal"
            >Signup now</md-button
          >
          <md-button class="custom-button" to="/order" v-if="shipperToggal"
            >Start new quote</md-button
          >
        </div>
      </div>
    </div>

    <div class="section1">
      <md-tabs>
        <md-tab
          id="tab-how-works"
          md-label="How it Works"
          md-icon="help"
          @click="
            passData(
              (header = 'How it Works?'),
              (subheader = 'We are happy to help')
            )
          "
        >
          <HowItWorks />
        </md-tab>
        <md-tab
          id="faq"
          md-label="FAQ"
          md-icon="notes"
          @click="
            passData(
              (header = 'FAQ'),
              (subheader = 'Frequently asked questions')
            )
          "
        >
          <FAQ />
        </md-tab>
        <md-tab
          id="tab-carrier"
          md-label="Carrier"
          md-icon="directions_boat"
          @click="
            passData(
              (header = 'Carrier'),
              (subheader = 'Join our carrier networks')
            )
          "
        >
          <CarrierHelp />
        </md-tab>
        <md-tab
          id="tab-shipper"
          md-label="Shipper"
          md-icon="local_mall"
          @click="
            passData(
              (header = 'Shipper'),
              (subheader = 'Sign up for free and start shipping today')
            )
          "
        >
          <ShipperHelp />
        </md-tab>
      </md-tabs>
    </div>

    <Footer />
  </div>
</template>

<script>
import axio from "axios";
import Footer from "../../shared/Footer";
import Header from "../../shared/Header";
import CarrierHelp from "./CarrierHelp";
import ShipperHelp from "./ShipperHelp";
import HowItWorks from "./HowItWorks";
import FAQ from "./FAQ";
export default {
  name: "ContactUs",
  data: () => ({
    form: {
      name: null,
      email: null,
      message: null,
    },
    header: "How it Works?",
    subheader: "We are happy to help",
    carrierToggal: false,
    shipperToggal: false,
  }),
  methods: {
    passData(header, subheader) {
      this.header = header;
      this.subheader = subheader;
      this.carrierToggal = (header == "Carrier") ? true : false;
      this.shipperToggal = (header == "Shipper") ? true : false;
    },
  },
  components: {
    Footer,
    Header,
    CarrierHelp,
    ShipperHelp,
    HowItWorks,
    FAQ,
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
    border-bottom: #ddd 1px solid;
    .content {
      min-height: 285px;
      padding: 85px 200px 40px 106px;
      .md-display-1 {
        line-height: 60px;
        font-size: 53px;
        font-weight: 600;
        color: #000;
        max-width: 355px;
      }

      .md-subheading {
        color: #000;
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

    .md-tabs {
      width: 100% !important;
      margin: auto;
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
