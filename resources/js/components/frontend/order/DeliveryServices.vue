<template>
  <div class="delivery-services">
    <form @submit.prevent="nextStep()">
      <div class="options">
        <md-checkbox
          v-for="service in accessories"
          :key="service.id"
          v-model="services"
          :value="service.code"
          @change="checkboxToggle(service)"
          >{{ service.name }}</md-checkbox
        >
        <md-field v-if="appointment">
          <label>Appointment time</label>
          <md-input
            type="time"
            v-model="appointmentTime"
            :required="appointment"
          ></md-input>
        </md-field>
      </div>

      <div class="action">
        <md-button class="custom-button" type="submit"> Continue </md-button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "CarrierList",
  data: () => ({
    accessories: null,
    appointmentTime: null,
    services: [],
    appointment: false,
  }),
  methods: {
    nextStep() {
      let storage = JSON.parse(localStorage.getItem("order"));
      let oldElement = storage.des.accessories[0];
      if (!this.services.includes(oldElement)) {
        this.services.push(oldElement);
      }
      storage.des.accessories = this.services;
      storage.des.appointmentTime = this.appointmentTime;
      localStorage.setItem("order", JSON.stringify(storage));

      this.$emit("progress", "fifth", "sixth",'items', 5);

    },

    init() {
      let storage = JSON.parse(localStorage.getItem("order"));
      if (storage.des) {
        this.services = storage.des.accessories;
        if (storage.des.accessories.includes("ap")) {
          this.appointmentTime = storage.des.appointmentTime;
          this.appointment = true;
        }
      }
    },
    getAccessories() {
      axios
        .get("delivery-services")
        .then((res) => {
          this.accessories = res.data;
          this.ap = res.data[2].code;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    checkboxToggle(service) {
      if (service.code == "ap") {
        this.appointment = !this.appointment;
      }
    },
  },

  created() {
    this.init();
    this.getAccessories();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
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
}
</style>
