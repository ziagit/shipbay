<template>
  <div class="select-carrier">
    <div v-show="dataLoading" class="loading">
      <Spinner />
      <span class="md-display-1">Calculating...</span>
      <div class="md-display-body">
        We trying to find topest carriers to fit your requirments. please wait
      </div>
    </div>
    <div v-show="!dataLoading">
      <span class="md-display-1">Select the carrier of your choice</span>
      <div class="break"></div>
      <div class="break"></div>
      <md-card class="items">
        <md-card-content>
          <md-button class="md-icon-button edit-item" @click="editItem()">
            <md-icon class="md-primary">edit</md-icon>
            <md-tooltip>Edit item</md-tooltip>
          </md-button>
          <div>
            <span>{{ order.src.city }}</span>
            <md-icon>east</md-icon>
            <span>{{ order.des.city }}</span>
          </div>
          <div v-for="item in order.myItem.items" :key="item.id">
            <md-icon>dot</md-icon>
            {{ item.description }}, {{ item.weight }} Pounds
          </div>
          <md-divider></md-divider>
          <span>Total: {{ totalWeight() }} Pounds</span>
        </md-card-content>
      </md-card>
      <md-list class="md-triple-line carriers" v-if="carriersExist">
        <md-list-item v-for="carrier in carriers" :key="carrier.id">
          <md-avatar>
            <md-icon v-if="carrier.logo === 'undefined'">sentiment_satisfied_alt</md-icon>
            <img v-else :src="'/images/uploads/' + carrier.logo" alt="People" />
          </md-avatar>
          <div class="md-list-item-text">
            <span v-if="carrier.company !== 'null'">{{ carrier.company }}</span>
            <span v-else>{{ carrier.last_name }}</span>
            <span>{{ carrier.first_name }}</span>
            <p>
              <md-menu md-direction="top-start" :md-active.sync="carrier.togal">
                Read
                <span class="carrier-info" md-menu-trigger>more</span> about this carrier
                <md-menu-content>
                  <CarrierInfo
                    :lastName="carrier.last_name"
                    :company="carrier.company"
                    :detail="carrier.detail"
                  />
                </md-menu-content>
              </md-menu>
            </p>
          </div>
          <div class="list-action">
            <div>
              <span>${{ Math.round(carrier.price) }}</span>
              <md-menu md-direction="top-start" :md-active.sync="carrier.togal">
                <md-icon md-menu-trigger class="md-seconday info">info</md-icon>
                <md-menu-content>
                  <CarrierRateInfo />
                </md-menu-content>
              </md-menu>
            </div>
            <md-button @click="select(carrier)" class="md-primary">Select</md-button>
          </div>
        </md-list-item>
      </md-list>
      <div v-else style="color: red">
        there is no carrier available with this source & distination
      </div>
      <div class="break"></div>
      <div class="break"></div>
      <div class="action">
        <md-button to="/order" class="custom-button"> Edit </md-button>
      </div>
    </div>
    <Snackbar :data="snackbar" />
  </div>
</template>

<script>
import CarrierRateInfo from "./menu/CarrierRateInfo";
import CarrierInfo from "./menu/CarrierInfo";
import { mapActions, mapGetters } from "vuex";
import Axios from "axios";
import Spinner from "../../shared/Spinner";
import Snackbar from "../../shared/Snackbar";
import functions from "../services/functions";
export default {
  name: "CarrierList",
  data: () => ({
    carriers: null,
    order: null,
    dataLoading: true,
    carriersExist: true,
    carrierTogal: false,
    toggleCarrierInfo: false,
    priceToggle: false,
    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
  }),
  watch: {
    carriers(data) {
      for (let i = 0; i < data.length; i++) {
        data[i]["togal"] = false;
      }
    },
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  methods: {
    getCarriers() {
      Axios.post("carriers-rate", JSON.parse(localStorage.getItem("order")))
        .then((res) => {
          console.log("carriers: ", res.data);
          if (res.data.length === 0) {
            this.carriersExist = false;
            this.dataLoading = false;
            return;
          }
          this.carriers = res.data;
          this.dataLoading = false;
        })
        .catch((err) => {
          console.log(err);
          this.dataLoading = false;
          this.snackbar.show = true;
          this.snackbar.message = err.response.data.message;
          this.snackbar.statusCode = err.response.status;
        });
    },
    select(carrier) {
      if (localStorage.getItem("order")) {
        let order = JSON.parse(localStorage.getItem("order"));
        order.carrier = carrier;
        localStorage.setItem("order", JSON.stringify(order));
      }
      if (this.authenticated && this.user.role[0].name === "shipper") {
        this.$router.push("/shipment/additional-details");
      } else {
        this.$router.push({
          name: "signin",
          query: {
            redirect: "/shipment/additional-details",
          },
        });
      }
    },
    editItem() {
      this.$router.push("items");
    },
    totalWeight() {
      return functions.totalWeight(this.order.myItem.items);
    },
  },

  created() {
    this.$emit("progress", 7);
    this.getCarriers();
    this.order = JSON.parse(localStorage.getItem("order"));
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
  components: {
    CarrierRateInfo,
    CarrierInfo,
    Spinner,
    Snackbar,
  },
};
</script>

<style lang="scss" scoped>
.select-carrier {
  text-align: center;

  .list-action {
    text-align: center;

    .md-button {
      border: 1px solid #ffa500;
      padding: 5px;
      border-radius: 5px;
    }
  }

  ul {
    background: none;

    li {
      .carrier-info {
        color: #448aff;
      }

      .carrier-info:hover {
        cursor: pointer;
      }

      box-shadow: 0 1px 2px #11111142;
      margin-bottom: 5px;
      border-radius: 8px;
      background: #fffbf3;

      .button {
        border-radius: 7px;
      }
    }
  }
  .items {
    padding: 15px;
    text-align: left;
    .edit-item {
      position: absolute;
      top: 0;
      right: 0;
    }
  }
}

@media only screen and (min-width: 600px) {
}
</style>
