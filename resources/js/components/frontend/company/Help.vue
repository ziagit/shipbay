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
        <div class="md-display-1">We're happy to help</div>
        <div class="md-subheading">Select from bellow options to begin</div>
      </div>
    </div>

    <div class="section1">
      <md-tabs>
        <md-tab id="tab-carrier" md-label="Carrier" md-icon="directions_boat">
          <CarrierHelp />
        </md-tab>
        <md-tab id="tab-shipper" md-label="Shipper" md-icon="local_mall">
          <ShipperHelp />
        </md-tab>
        <md-tab id="tab-how-works" md-label="How it Works" md-icon="help">
          <HowItWorks />
        </md-tab>
        <md-tab id="faq" md-label="FAQ" md-icon="notes">
          <FAQ />
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
  }),
  methods: {},
  components: {
    Footer,
    Header,
    CarrierHelp,
    ShipperHelp,
    HowItWorks,
    FAQ
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
      min-height: 278px;
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
