<template>
  <div class="container">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="content">
      <div class="row progress-bar">
        <radial-progress-bar
          :diameter="150"
          :completed-steps="completedSteps"
          :total-steps="totalSteps"
          innerStrokeColor="#fff"
          startColor="#f97d4a"
          stopColor="#ffa500"
        >
        </radial-progress-bar>
      </div>
      <div class="row inputs">
        <md-steppers :md-active-step.sync="active" md-vertical>
          <md-step
            :class="{ activeStep: active === 'first' }"
            id="first"
            md-label="Where are you shipping from?"
            md-description="Required"
            :md-done.sync="first"
            @click="unsetDone('first', 0)"
          >
            <Pickup v-on:progress="setDone" />
          </md-step>
          <md-step
            :class="{ activeStep: active === 'second' }"
            v-if="watchStep(1)"
            id="second"
            md-label="Do you need additional services at pickup?"
            :md-done.sync="second"
            @click="unsetDone('second', 1)"
          >
            <PickupServices v-on:progress="setDone" />
          </md-step>
          <md-step
            :class="{ activeStep: active === 'third' }"
            v-if="watchStep(2)"
            id="third"
            md-label="When to pickup?"
            :md-done.sync="third"
            @click="unsetDone('third', 2)"
          >
            <PickupDate v-on:progress="setDone" />
          </md-step>
          <md-step
            :class="{ activeStep: active === 'fourth' }"
            v-if="watchStep(3)"
            id="fourth"
            md-label="Where are you shipping to?"
            :md-done.sync="fourth"
            @click="unsetDone('fourth', 3)"
          >
            <Delivery v-on:progress="setDone" />
          </md-step>
          <md-step
            :class="{ activeStep: active === 'fifth' }"
            v-if="watchStep(4)"
            id="fifth"
            md-label="Do you need additional services at delivery?"
            :md-done.sync="fifth"
            @click="unsetDone('fifth', 4)"
          >
            <DeliveryServices v-on:progress="setDone" />
          </md-step>
          <md-step
            :class="{ activeStep: active === 'sixth' }"
            v-if="watchStep(5)"
            id="sixth"
            md-label="What item are you shipping?"
            :md-done.sync="sixth"
            @click="unsetDone('sixth', 5)"
          >
            <Items v-on:progress="setDone" />
          </md-step>
          <md-step
            :class="{ activeStep: active === 'seventh' }"
            v-if="watchStep(6)"
            id="seventh"
            md-label="Additional information"
            :md-done.sync="seventh"
            @click="unsetDone('seventh', 6)"
          >
            <AdditionalDetails v-on:progress="setDone" />
          </md-step>
          <md-step
            :class="{ activeStep: active === 'eighth' }"
            v-if="watchStep(7)"
            id="eighth"
            md-label="Select the carrier of your choice"
            :md-done.sync="eighth"
            @click="unsetDone('eighth', 7)"
          >
            <Carriers v-on:progress="setDone" />
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
import AdditionalDetails from "./AdditionalDetails";

import Header from "../../shared/Header";
import Footer from "../../shared/Footer";
import axios from "axios";
export default {
  name: "StepperLinear",
  data: () => ({
    completedSteps: 0,
    totalSteps: 8,
    steps: [0],

    active: "first",
    first: false,
    second: false,
    third: false,
    fourth: false,
    fifth: false,
    sixth: false,
    seventh: false,
    eighth: false,
  }),

  methods: {
    setDone(prev, next, index) {
      this.completedSteps = index;
      if (!this.steps.includes(index)) {
        this.steps.push(index);
        console.log("sssssteps: ", this.steps);
        localStorage.setItem("steps", JSON.stringify(this.steps));
      }
      this[prev] = true;
      if (next) {
        this.active = next;
        localStorage.setItem("aStep", JSON.stringify(this.active));
      }
      localStorage.setItem(
        "completedSteps",
        JSON.stringify(this.completedSteps)
      );
    },
    unsetDone(step, index) {
      this.active = step;
      localStorage.setItem("aStep", JSON.stringify(this.active));

      this.completedSteps = index;
      localStorage.setItem(
        "completedSteps",
        JSON.stringify(this.completedSteps)
      );
      
      this.steps.splice(index + 1, 8);
      localStorage.setItem("steps", JSON.stringify(this.steps));
    },

    watchStep(index) {
      if (this.steps.includes(index)) {
        return true;
      }
      return false;
    },
    init() {
      if (localStorage.getItem("steps")) {
        this.steps = JSON.parse(localStorage.getItem("steps"));
        console.log("steps: ", this.steps);
      }
      if (localStorage.getItem("aStep")) {
        this.active = JSON.parse(localStorage.getItem("aStep"));
        console.log("active step: ", this.active);
      }
      if(localStorage.getItem("completedSteps")){
        this.completedSteps = JSON.parse(localStorage.getItem("completedSteps"));
      }
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
    Carriers,
    AdditionalDetails,
    Header,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
.container {
  .content {
    display: flex;
    justify-content: center;
    max-width: 800px;
    min-height: calc(100vh - 15px);
    margin: auto;
    padding-top: 30px;
    .progress-bar {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .inputs {
      flex: 70%;
      padding: 10px;
    }
  }
}

@media only screen and (max-width: 600px) {
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
