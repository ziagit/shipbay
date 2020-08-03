<template>
  <div class="delivery-services">
    <div class="icon">
      <img src="http://localhost:8000/images/service.svg" width="100" />
    </div>
    <span class="md-display-1">Do you need additional services at the delivery?</span>

    <div class="options">
      <md-checkbox
        v-for="service in accessories"
        :key="service.id"
        v-model="services"
        :value="service.code"
        class="md-primary"
        @change="checkboxToggle(service)"
      >{{service.name}}</md-checkbox>
      <md-field v-show="apointment">
        <label>Appointment time</label>
        <md-input type="time" v-model="appointmentTime"></md-input>
      </md-field>
    </div>

    <div class="action">
      <md-button @click="prevStep(-14)" class="md-icon-button md-raised">
        <md-icon>keyboard_arrow_left</md-icon>
      </md-button>
      <md-button @click="nextStep(14)" class="md-icon-button md-raised md-primary">
        <md-icon>keyboard_arrow_right</md-icon>
      </md-button>
    </div>
  </div>
</template>
<script>
export default {
  name: "CarrierList",
  data: () => ({
    accessories: null,
    appointmentTime: null,
    services: [],
    apointment: false
  }),
  methods: {
    nextStep(prgValue) {
      let storage = JSON.parse(localStorage.getItem("order"));
      let oldElement = storage.des.accessories[0];
      if (!this.services.includes(oldElement)) {
        this.services.push(oldElement);
      }
      storage.des.accessories = this.services;
      storage.des.appointmentTime = this.appointmentTime
      localStorage.setItem("order", JSON.stringify(storage));
      this.$router.push("items");
      this.$emit("progress", prgValue);
    },
    prevStep(prgValue) {
      this.$router.back("destination");
      this.$emit("progress", prgValue);
    },
    watchLocalstorage() {
      let storage = JSON.parse(localStorage.getItem("order"));
      if (storage.des) {
        this.services = storage.des.accessories;
      }
    },
    getAccessories() {
      axios
        .get("delivery-services")
        .then(res => {
          this.accessories = res.data;
          this.ap = res.data[2].code;
        })
        .catch(err => {
          console.log("Error: ", err);
        });
    },
    checkboxToggle(service) {
      if (service.code == "ap") {
        this.apointment = !this.apointment;
      }
    }
  },

  created() {
    console.log("in delivery serv ", JSON.parse(localStorage.getItem("order")));
    this.watchLocalstorage();
    this.getAccessories();
  }
};
</script>

<style lang="scss" scoped>
.delivery-services {
  text-align: center;
  .icon,
  .options,
  .action {
    margin: 20px auto;
  }
  .md-display-1 {
    font-size: 30px;
  }
}
</style>