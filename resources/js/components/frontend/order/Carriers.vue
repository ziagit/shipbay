<template>
  <div class="select-carrier">
    <div v-show="dataLoading" class="loading">
      <span class="md-display-1">Calculating...</span>
      <div class="md-title">We trying to find topest carriers to fit your requirments. please wait</div>
      <Spinner />
    </div>
    <div v-show="!dataLoading">
      <div class="icon">
        <img :src="'/images/carrier.svg'" width="100" />
      </div>
      <span class="md-display-1">Select the carrier of your choice</span>
      <md-card class="items">
        <md-card-content>
          <md-button class="md-icon-button edit-item" @click="editItem()">
            <md-icon>edit</md-icon>
            <md-tooltip>Edit item</md-tooltip>
          </md-button>
          <div>
            <span>{{order.src.cityName}}</span>
            <md-icon>east</md-icon>
            <span>{{order.des.cityName}}</span>
          </div>
          <div v-for="item in order.myItem.items" :key="item.id">
            <md-icon>dot</md-icon>
            {{item.description}}, {{Math.round(item.dw)}} Pounds
          </div>
          <md-divider></md-divider>
          <span>Total: {{Math.round(totalDw())}} Pounds</span>
        </md-card-content>
      </md-card>
      <md-list class="md-triple-line carriers" v-if="carriersExist">
        <md-list-item v-for="carrier in carriers" :key="carrier.id">
          <md-avatar>
            <img :src="'/images/carrier-logo.jpg'" alt="People" />
          </md-avatar>
          <div class="md-list-item-text">
            <span>{{carrier.company}}</span>
            <span>{{carrier.last_name}}</span>
            <p>
              <md-menu md-direction="top-start" :md-active.sync="toggleCarrierInfo">
                Read <span class="carrier-info" md-menu-trigger>more</span> about this carrier
                <md-menu-content>
                  <CarrierInfo :detail="carrier.detail" :name="carrier.company"/>
                </md-menu-content>
              </md-menu>
            </p>
          </div>
          <div class="list-action">
            <div>
              <span>${{Math.round(carrier.price)}}</span>
              <md-menu md-direction="top-start" :md-active.sync="priceToggle">
                <md-icon md-menu-trigger class="md-primary info">info</md-icon>
                <md-menu-content>
                  <CarrierRateInfo />
                </md-menu-content>
              </md-menu>
            </div>
            <md-button @click="select(carrier)" class="md-primary">Select</md-button>
          </div>
        </md-list-item>
      </md-list>
      <div v-else style="color:red">there is no carrier available with this source & distination</div>
      <div class="action">
        <md-button to="/order" class="md-icon-button md-raised md-primary">
          <md-icon>edit</md-icon>
        </md-button>
      </div>
    </div>
  </div>
</template>
<script>
import CarrierRateInfo from "./menu/CarrierRateInfo";
import CarrierInfo from "./menu/CarrierInfo";
import { mapActions, mapGetters } from "vuex";
import Axios from "axios";
import Spinner from "../shared/Spinner";
import functions from '../services/functions'
export default {
  name: "CarrierList",
  data: () => ({
    carriers: null,
    order: null,
    dataLoading: true,
    carriersExist: true,
    carrierTogal: false,
    toggleCarrierInfo: false,
    priceToggle:false,
  }),
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  methods: {
    getCarriers() {
      Axios.post("calculate-rate", JSON.parse(localStorage.getItem("order")))
        .then((res) => {
          console.log("carriers: ", res.data);
          if (res.data.length === 0) {
            this.carriersExist = false;
            return
          }
          this.carriers = res.data;
        })
        .catch((err) => {
          console.log(err);
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
          query: { redirect: "/shipment/additional-details" },
        });
      }
    },
    editItem() {
      this.$router.push("items");
    },
    totalDw() {
      return functions.totalDw(this.order.myItem.items)
    },
  },

  created() {
    this.$emit("progress", 100);
    this.getCarriers();
    this.order = JSON.parse(localStorage.getItem("order"));
    setTimeout(() => {
      this.dataLoading = false;
    }, 5000);
    localStorage.setItem('cRoute',this.$router.currentRoute.path);
  },
  components: {
    CarrierRateInfo,
    CarrierInfo,
    Spinner
  },
};
</script>

<style lang="scss" scoped>
.select-carrier {
  text-align: center;
  .list-action {
    text-align: center;
    .md-button {
      border: 1px solid #448aff;
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
      .carrier-info:hover{
        cursor: pointer;
      }
      box-shadow: 0 1px 2px #11111142;
      margin-bottom: 5px;
      border-radius: 8px;
      background: #fff;
      .button {
        border-radius: 7px;
      }
    }
  }
  .md-display-1 {
    font-size: 24px;
  }
  .loading,
  .icon,
  .carriers,
  .action {
    margin: 20px auto;
  }
  .items {
    padding: 15px;
    text-align: left;
    background: #fff;
    .edit-item {
      position: absolute;
      top: 0;
      right: 0;
    }
  }
}
@media only screen and (min-width: 600px) {
  .select-carrier {
    .md-display-1 {
      font-size: 30px;
    }
  }
}
</style>