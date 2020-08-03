<template>
  <div class="pickup-services">
    <div class="icon">
      <img src="http://localhost:8000/images/service.svg" width="100" />
    </div>
    <span class="md-display-1">Do you need additional services at the pick-up?</span>

    <div class="options">
      <md-checkbox
        v-for="service in accessories"
        :key="service.id"
        v-model="services"
        :value="service.code"
        class="md-primary"
      >{{service.name}}</md-checkbox>
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
  name: "PickupService",
  data: () => ({
    accessories: null,
    services: []
  }),
  methods: {
    getAccessories() {
      axios
        .get("pick-services")
        .then(res => {
          this.accessories = res.data;
        })
        .catch(err => {
          console.log("Error: ", err);
        });
    },
    nextStep(prgValue) {
      let storage = JSON.parse(localStorage.getItem("order"));
      let oldElement = storage.src.accessories[0];
      if (!this.services.includes(oldElement)) {
        this.services.push(oldElement);
      }
      storage.src.accessories = this.services;
      localStorage.setItem("order", JSON.stringify(storage));
      this.$emit("progress", prgValue);

      this.$router.push("pickup-date");
    },
    prevStep(prgValue) {
      this.$router.back("order");
      this.$emit("progress", prgValue);
    },
    watchLocalstorage() {
      if (localStorage.getItem("order")) {
        let storage = JSON.parse(localStorage.getItem("order"));
        this.services = storage.src.accessories;
      }
    }
  },

  created() {
    console.log("in pik serc: ", JSON.parse(localStorage.getItem("order")));
    this.watchLocalstorage();
    this.getAccessories();
  }
};
</script>

<style lang="scss" scoped>
.pickup-services {
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