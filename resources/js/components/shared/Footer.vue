<template>
  <div class="footer">
    <div class="rows">
      <div class="row social-media">
        <div class="md-headline"><span class="logo">Shipping</span> Tap</div>
        <div class="md-body-1">Stay in touch & get update from social media</div>
        <div class="icons">
          <a href="https://facebook.com"
            ><img :src="'/images/uploads/facebook.svg'" alt="" width="30"
          /></a>
          <a href="https://linkedin.com"
            ><img :src="'/images/uploads/linkedin.svg'" alt="" width="30"
          /></a>
          <a href="https://twitter.com"
            ><img :src="'/images/uploads/twitter.svg'" alt="" width="30"
          /></a>
        </div>
      </div>
      <div class="row">
        <div class="md-headline">Company</div>
        <ul>
          <li>
            <router-link to="/about">About</router-link>
          </li>
          <li>
            <router-link to="/shippers">Shipper</router-link>
          </li>
          <li>
            <router-link to="/carriers">Carrier</router-link>
          </li>
        </ul>
      </div>
      <div class="row">
        <div class="md-headline">Support</div>
        <ul>
          <li>
            <router-link to="/how-it-works">How it works</router-link>
          </li>
          <li>
            <router-link to="/help">Help center</router-link>
          </li>
          <li>
            <span>1 (800) 123-4567</span>
          </li>
        </ul>
      </div>
      <div class="row app">
        <div>
          <a href="https://apple.com"
            ><img :src="'/images/uploads/apple-store.svg'" alt="" width="120"
          /></a>
        </div>
        <div>
          <a href="https://play.google.com"
            ><img :src="'/images/uploads/google-play.svg'" alt="" width="120"
          /></a>
        </div>
      </div>
    </div>
    <div class="line"></div>
    <div class="bottom">
      <span class="col0">© 2020 EG Logistics Inc. All rights reserved.</span>
      <span class="col1"
        ><router-link to="/terms-and-conditions">Terms</router-link> |
        <router-link to="/privacy-policies">Privacy</router-link></span
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style lang="scss" scoped>
.footer {
  background: #edf3ff;
  min-height: 150px;

  .rows {
    max-width: 1200px;
    margin: auto;
    padding: 56px 92px;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;

    .social-media {
      .logo {
        font-family: "Segoe Script", Helvetica, Arial;
        font-size: 20px;
      }

      .md-body-1 {
        width: 60% !important;
      }
    }

    .row {
      flex: 25%;

      .md-headline {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 12px;
      }

      .icons {
        display: flex;
        justify-content: space-between;
        max-width: 110px;
        margin-top: 36px;
      }

      ul {
        padding: 0;
        margin: 0;

        li {
          list-style-type: none;
          margin-bottom: 8px;

          a {
            color: #21201e;
          }
        }
      }
    }

    .app {
      flex-direction: column !important;
      text-align: right;
      div {
        margin-bottom: 10px;
      }
    }
  }
  .line {
    border-top: solid 0.5px #fff;
  }
  .bottom {
    max-width: 1200px;
    margin: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 92px;

    color: rgb(121, 120, 120);

    span {
      a {
        color: rgb(121, 120, 120);
      }
    }
  }
}

@media only screen and (max-width: 600px) {
  .footer {
    .rows {
      padding: 46px 46px;

      .row {
        flex: 100% !important;
        margin-bottom: 26px;
      }
    }

    .bottom {
      span {
        font-size: 8px;
      }
    }
    .app {
      text-align: left !important;
    }
  }
  .bottom {
    padding: 10px !important;
  }
}
</style>
