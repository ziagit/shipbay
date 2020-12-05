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
            v-if="watchStep(1)"
            id="first"
            md-label="Where are you shipping from?"
            md-description="Required"
            :md-done.sync="first"
          >
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias
              doloribus eveniet quaerat modi cumque quos sed, temporibus nemo
              eius amet aliquid, illo minus blanditiis tempore, dolores voluptas
              dolore placeat nulla.
            </p>
            <md-button
              class="md-raised md-primary"
              @click="setDone('first', 'second', 1)"
              >Continue</md-button
            >
          </md-step>

          <md-step
            v-if="watchStep(2)"
            id="second"
            md-label="Do you need additional services at the pickup?"
            :md-error="secondStepError"
            :md-done.sync="second"
          >
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias
              doloribus eveniet quaerat modi cumque quos sed, temporibus nemo
              eius amet aliquid, illo minus blanditiis tempore, dolores voluptas
              dolore placeat nulla.
            </p>

            <md-button
              class="md-raised md-primary"
              @click="setDone('second', 'third', 2)"
              >Continue</md-button
            >
            <md-button class="md-raised md-primary" @click="setError()"
              >Set error!</md-button
            >
          </md-step>

          <md-step
            v-if="watchStep(3)"
            id="third"
            md-label="Third Step"
            :md-done.sync="third"
          >
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias
              doloribus eveniet quaerat modi cumque quos sed, temporibus nemo
              eius amet aliquid, illo minus blanditiis tempore, dolores voluptas
              dolore placeat nulla.
            </p>

            <md-button class="md-raised md-primary" @click="setDone('third', 3)"
              >Done</md-button
            >
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
    completedSteps: 1,
    totalSteps: 8,
    steps: [1],
    amount: 0,
    active: "first",
    first: false,
    second: false,
    third: false,
    secondStepError: null,
  }),

  methods: {
    setDone(id, index, stepId) {
      this[id] = true;
      if (!this.steps.includes(stepId)) {
        this.steps.push(stepId);
        this.watchStep(stepId);
        console.log("step id ", this.steps);
      }

      if (index) {
        this.active = index;
      }
    },
    setError() {
      this.secondStepError = "There is an error!";
    },
    watchStep(index) {
      if (this.steps.includes(index)) {
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
    width: 100%;
    min-height: calc(100vh - 15px);
    //margin: auto;
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
