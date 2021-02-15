<template>
  <div class="container">
    <div class="left">
      <div class="md-display-1">Shipper</div>
      <div class="md-body-1 text-16">
        Ask us anything! When you need assistance, our knowledgeable experts are ready. We
        want your freight shipping to be easy. Here are some common situations along with
        guidance we’re pleased to share with you.
      </div>
      <br />
      <md-steppers md-vertical :md-active-step.sync="active" v-if="faqs != null">
        <md-step
          v-for="faq in faqs"
          :key="faq.id"
          :id="'step1'"
          :md-label="faq.title"
          md-description="Click to read more"
        >
          <div v-html="faq.body"></div>
        </md-step>
      </md-steppers>
      <br /><br />
      If you still having question call
      <router-link to="">077 505 9616</router-link>
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
            <md-button class="custom-button" to="/order">Start</md-button>
          </div>
        </form>
      </div>

      <div class="contact">
        <div class="md-title">Contact us</div>
        <div class="md-body-1">If you want to know more about us, drop us an email.</div>
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
</template>
<script lang="ts">
import axios from "axios";
import Vue from "vue";
export default Vue.extend({
  data: () => ({
    active: "first",
    form: {
      city: null,
    },
    faqs: null,
  }),
  methods: {
    get() {
      axios.get("get-shipper-faq").then((res) => {
        console.log("shipper faq", res.data);
        this.faqs = res.data;
      });
    },
  },
  created() {
    this.get();
  },
});
</script>
<style scoped lang="scss">
.container {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  padding: 0;
  .left {
    flex: 60%;
    padding: 60px;

    .md-display-1 {
      font-weight: 500;
      line-height: 70px;
      color: #000;
    }
    .text-16 {
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
</style>
