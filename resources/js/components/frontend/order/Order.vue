<template>
  <div class="container">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="content">
      <div class="progress-container">
        <radial-progress-bar
          :diameter="100"
          :completed-steps="completedSteps"
          :total-steps="totalSteps"
          innerStrokeColor="#fff"
          startColor="#f97d4a"
          stopColor="#ffa500"
        >
        </radial-progress-bar>
        <!--      <md-progress-bar class="md-primary" md-mode="determinate" :md-value="amount"></md-progress-bar>-->
      </div>
      <div class="input-container">
        <md-steppers
          md-vertical
          md-dynamic-height
          :md-active-step.sync="active"
        >
          <md-step
            id="first"
            exact
            md-label="Where are you shipping from?"
            md-description="Required"
          >
            <Pickup v-on:progress="progress" />
          </md-step>

          <md-step
            id="second"
            md-label="Do you need additional services at the pick-up?"
            md-description="Required"
            exact
          >
            <PickupServices v-on:progress="progress" />
          </md-step>

          <md-step
            id="third"
            md-label="When to pick-up?"
            md-description="Required"
            exact
          >
            <PickupDate v-on:progress="progress" />
          </md-step>

          <md-step
            id="fourth"
            md-label="Where are you shipping to?"
            md-description="Required"
            exact
          >
            <Delivery v-on:progress="progress" />
          </md-step>
          <md-step
            id="fifth"
            md-label="Do you need additional services at the delivery?"
            md-description="Required"
            exact
          >
            <DeliveryServices v-on:progress="progress" />
          </md-step>
          <md-step
            id="sixth"
            md-label="What items are you shipping?"
            md-description="Required"
            exact
          >
            <Items v-on:progress="progress" />
          </md-step>
          <md-step
            id="seventh"
            md-label="Select the carrier of your choice"
            md-description="Required"
            exact
          >
            <Carriers v-on:progress="progress" />
          </md-step>
        </md-steppers>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import RadialProgressBar from "vue-radial-progress";
import Pickup from "./Pickup";
import PickupServices from "./PickupServices";
import PickupDate from "./PickupDate";
import Delivery from "./Delivery";
import DeliveryServices from "./DeliveryServices";
import Items from "./Items";
import Carriers from "./Carriers";

import Header from "../../shared/Header";
import Footer from "../../shared/Footer";
import axios from "axios";
export default {
  name: "StepperLinear",
  data: () => ({
    amount: 0,
    completedSteps: 0,
    totalSteps: 8,

    active: "third",
    first: false,
    second: false,
    third: false,
    fourth: false,
    fifth: false,
    sixth: false,
    seventh: false,
  }),

  methods: {
    progress(id, index, nextRoute, value) {
      this.completedSteps = value;
      this[id] = true;
      if (index) {
        this.active = index;
        localStorage.setItem("completedSteps", this.completedSteps);
        localStorage.setItem("active", this.active);
        this.$router.push(nextRoute);
        console.log("working", nextRoute);
      }
    },
    init() {
      console.log("active: ", localStorage.getItem("active"));
      this.active = localStorage.getItem("active");
      this.completedSteps = localStorage.getItem("completedSteps");
    },
  },
  created() {
    this.init();
  },
  components: {
    RadialProgressBar,
    Pickup,
    PickupServices,
    PickupDate,
    Delivery,
    DeliveryServices,
    Items,

    Header,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
.container {
  .header {
    border-bottom: solid 1px #fff;
  }

  .content {
    width: 100%;
    min-height: calc(100vh - 15px);
    margin: auto;
    padding: 51px 20px 0 20px !important;
    text-align: center;
    margin-bottom: 46px;

    .progress-container {
      max-width: 800px;
      margin: auto;
      .radial-progress-container {
        margin: auto;
      }
      .md-progress-bar {
        border-radius: 20px;
        background-color: #fff;

        .md-progress-bar-fill {
          background: #ffa500 !important;
        }

        .md-progress-bar-buffer {
          background: #e7eaed;
        }
      }
    }

    .input-container {
      padding: 10px;
      max-width: 710px;
      margin: 22px auto;
    }
  }
}

@media only screen and (min-width: 600px) {
  .order {
    .content {
      padding: 30px;

      .progress-container {
        max-width: 800px;
      }

      .input-container {
        padding: 10px;
        max-width: 600px;
        margin: auto;
      }
    }
  }
}
</style>
