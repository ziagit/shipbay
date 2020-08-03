<template>
  <div class="select-carrier">
    <div v-show="dataLoading" class="loading">
      <span class="md-display-1">Calculating...</span>
      <div class="md-title">We trying to find topest carriers to fit your requirments. please wait</div>
      <ion-spinner mode="ios" name="lines" color="primary" class="primary"></ion-spinner>
    </div>
    <div v-show="!dataLoading">
      <div class="icon">
        <img src="http://localhost:8000/images/carrier.svg" width="100" />
      </div>
      <span class="md-display-1">Select the carrier of your choice</span>
      <md-card class="items">
        <md-button class="md-primary md-icon-button edit-item" @click="editItem(-32)">
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
          {{item.description}}, {{item.dw}}
        </div>
        <md-divider></md-divider>
        <span>Total: {{Math.round(calculateTotalDW())}} Pounds</span>
      </md-card>
      <md-list class="md-triple-line carriers" v-if="carriersExist">
        <md-list-item v-for="carrier in carriers" :key="carrier.id">
          <md-avatar>
            <img src="https://placeimg.com/40/40/people/1" alt="People" />
          </md-avatar>
          <div class="md-list-item-text">
            <span>{{carrier.company}}</span>
            <span>{{carrier.last_name}}</span>
            <p>{{carrier.detail}}</p>
          </div>
          <div class="list-action">
            <div>
              <span>${{Math.round(carrier.price)}}</span>
              <md-icon class="md-primary">info</md-icon>
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
import Axios from "axios";
export default {
  name: "CarrierList",
  data: () => ({
    carriers: null,
    order: null,
    dataLoading: true,
    carriersExist: true
  }),
  methods: {
    getCarriers() {
      Axios.post("calculate-rate", JSON.parse(localStorage.getItem("order")))
        .then(res => {
          console.log(">> ", res.data);

          this.carriers = res.data;
          if (this.carriers.length == 0) {
            this.carriersExist = false;
          }
        })
        .catch(err => {
          console.log(err);
        });
    },
    select(carrier) {
      if (localStorage.getItem("order")) {
        let order = JSON.parse(localStorage.getItem("order"));
        order.carrier = carrier;
        order.orderId = parseInt(this.$route.params.id);
        localStorage.setItem("order", JSON.stringify(order));
      }
      this.$router.push("/login");
    },
    editItem(prgValue) {
      this.$router.push("items");
      this.$emit("progress", prgValue);
    },
    calculateTotalDW() {
      let total = 0;
      this.order.myItem.items.forEach(element => {
        total = total + element.dw;
      });
      return total;
    }
  },

  created() {
    this.getCarriers();
    this.order = JSON.parse(localStorage.getItem("order"));
    console.log("order in carrier: ", this.order);
    setTimeout(() => {
      this.dataLoading = false;
    }, 5000);
  }
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
    }
  }
  ul {
    background: none;
    li {
      box-shadow: 0px 2px 5px -3px;
      background-color: #fff;
      margin-bottom: 5px;
      border-radius: 7px;
      .button {
        border-radius: 7px;
      }
    }
  }
  .md-display-1 {
    font-size: 30px;
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
    .edit-item {
      position: absolute;
      top: 0;
      right: 0;
    }
  }
}
</style>