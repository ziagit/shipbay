<template>
  <div class="container">
    <div
      class="section0"
      v-bind:style="{ 'background-image': 'url(/images/uploads/help.svg)' }"
    >
      <Header v-on:togal-menu="$emit('togal-menu')" />
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
              (subheader = 'Beginnerٌs guide to shipping from home on Shipbay')
            )
          "
        >
          <!--  <FAQ /> -->
          <Test />
        </md-tab>
        <md-tab
          id="tab-carrier"
          md-label="Carrier"
          md-icon="directions_boat"
          @click="
            passData(
              (header = 'Carrier'),
              (subheader = 'Most common questoins about our carriers')
            )
          "
        >
          <CarrierFaq />
        </md-tab>
        <md-tab
          id="tab-shipper"
          md-label="Shipper"
          md-icon="local_mall"
          @click="
            passData(
              (header = 'Shipper'),
              (subheader = 'Top common questions about our shippers')
            )
          "
        >
          <ShipperFaq />
        </md-tab>
      </md-tabs>
    </div>

    <Footer />
  </div>
</template>

<script>
import Footer from "../../shared/Footer";
import Header from "../../shared/Header";
import CarrierFaq from "./CarrierFaq";
import ShipperFaq from "./ShipperFaq";
import FAQ from "./FAQ";
import Test from "./Test";
export default {
  name: "ContactUs",
  data: () => ({
    form: {
      name: null,
      email: null,
      message: null,
    },
    header: "How it Works?",
    subheader: "Beginnerٌs guide to shipping from home on Shipbay",
    carrierToggal: false,
    shipperToggal: false,
  }),
  methods: {
    passData(header, subheader) {
      this.header = header;
      this.subheader = subheader;
      this.carrierToggal = header == "Carrier" ? true : false;
      this.shipperToggal = header == "Shipper" ? true : false;
    },
  },
  components: {
    Footer,
    Header,
    CarrierFaq,
    ShipperFaq,
    FAQ,
    Test,
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
      height: 268px;
      padding: 85px 200px 85px 106px;
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
    .content {
      padding: 20px !important;
      height: 188px !important;
      .md-display-1 {
        font-size: 32px !important;
        line-height: 48px !important;
      }
      .md-subheading {
        font-size: 14px !important;
      }
    }
  }

  .section1 {
    padding: 30 !important;

    .wrapper {
      flex-direction: column;
      .left,
      .right {
        padding: 0 !important;
      }
      .left {
        margin-bottom: 74px !important;
      }
      .md-button {
        margin: 30px 0 0 0;
      }
    }
  }
}
</style>
