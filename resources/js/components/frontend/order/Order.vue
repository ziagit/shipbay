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
        <!--      <md-progress-bar class="md-primary" md-mode="determinate" :md-value="amount"></md-progress-bar>-->
      </div>
      <div class="row inputs">
        <md-steppers :md-active-step.sync="active" md-vertical md-linear>
          <md-step
            id="first"
            md-label="Where are you shipping from?"
            md-description="Required"
            :md-done.sync="first"
            @click="unsetDone('first', 0)"
          >
          <Pickup v-on:progress="setDone"/>
          </md-step>

          <md-step
            v-if="watchStep(1)"
            id="second"
            md-label="Do you need additional services at pickup?"
            :md-error="secondStepError"
            :md-done.sync="second"
            @click="unsetDone('second', 1)"
          >
          <PickupServices v-on:progress="setDone"/>
            <md-button class="md-raised md-primary" @click="setError()"
              >Set error!</md-button
            >
          </md-step>

          <md-step
            v-if="watchStep(2)"
            id="third"
            md-label="When to pickup?"
            :md-done.sync="third"
            @click="unsetDone('third', 2)"
          >
          <PickupDate v-on:progress="setDone"/>
          </md-step>
          <md-step
            v-if="watchStep(3)"
            id="fourth"
            md-label="Where are you shipping to?"
            :md-done.sync="fourth"
            @click="unsetDone('fourth', 3)"
          >
          <Delivery v-on:progress="setDone"/>
          </md-step>
          <md-step
            v-if="watchStep(4)"
            id="fifth"
            md-label="Do you need additional services at delivery?"
            :md-done.sync="fifth"
            @click="unsetDone('fifth', 4)"
          >
          <DeliveryServices v-on:progress="setDone"/>
          </md-step>
          <md-step
            v-if="watchStep(5)"
            id="sixth"
            md-label="What item are you shipping?"
            :md-done.sync="sixth"
            @click="unsetDone('sixth', 5)"
          >
         <Items v-on:progress="setDone"/>
          </md-step>
          <md-step
            v-if="watchStep(6)"
            id="seventh"
            md-label="Select the carrier of your choice"
            :md-done.sync="seventh"
            @click="unsetDone('seventh', 6)"
          >
          select carriers
           <!--<Carriers  v-on:progress="setDone">-->
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
    completedSteps: 0,
    totalSteps: 8,
    steps: [0],
    amount: 0,
    active: "first",
    first: false,
    second: false,
    third: false,
    fourth: false,
    fifth: false,
    sixth: false,
    seventh: false,
    eighth: false,
    secondStepError: null,
  }),

  methods: {
    setDone(id, index, stepId) {
      this.completedSteps = stepId
      if (!this.steps.includes(stepId)) {
        this.steps.push(stepId);
      }
      this[id] = true;
      if (index) {
        this.active = index;
      }
    },
    unsetDone(step, stepId) {
      this.completedSteps = stepId
      this.steps.splice(stepId + 1, 6);
      this.active = step;
      console.log("step back id", stepId);
    },
    setError() {
      this.secondStepError = "There is an error!";
    },
    watchStep(stepId) {
      if (this.steps.includes(stepId)) {
        return true;
      }
      return false;
    },
  },
  created() {},
  components: {
    RadialProgressBar,
    Pickup,
    PickupServices,
    PickupDate,
    Delivery,
    DeliveryServices,
    Items,
    Carriers,
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
    display: flex;
    justify-content: center;
    max-width: 800px;
    min-height: calc(100vh - 15px);
    margin: auto;
    //padding: 51px 20px 0 20px !important;
    //text-align: center;
    //margin-bottom: 46px;
    .progress-bar {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .inputs {
      padding: 10px;
      //max-width: 710px;
      //margin: auto;
      /*   .progress-bar {
        background: #f0f2f5;
        position: absolute;
        box-shadow: rgba(0, 0, 0, 0.12) 0px 4px 16px;
        padding: 6px;
        border-radius: 50%;
        z-index: 90 !important;
        right: 0;
        top: 0;
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
      } */
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
