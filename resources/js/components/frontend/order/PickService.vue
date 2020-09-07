<template>
  <div class="pickup-services">
    <div class="icon">
      <img src="http://localhost:8000/images/service.svg" width="100" />
    </div>
    <span class="md-display-1">Do you need additional services at the pick-up?</span>
    <form @submit.prevent="nextStep()">
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
        <md-button to="/order" class="md-icon-button md-raised">
          <md-icon>keyboard_arrow_left</md-icon>
        </md-button>
        <md-button type="submit" class="md-icon-button md-raised md-primary">
          <md-icon>keyboard_arrow_right</md-icon>
        </md-button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  name: "PickupService",
  data: () => ({
    prgValue: 14,
    accessories: null,
    services: [],
  }),
  methods: {
    getAccessories() {
      axios
        .get("pick-services")
        .then((res) => {
          this.accessories = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    nextStep() {
      let storage = JSON.parse(localStorage.getItem("order"));
      let oldElement = storage.src.accessories[0];
      if (!this.services.includes(oldElement)) {
        this.services.push(oldElement);
      }
      storage.src.accessories = this.services;
      localStorage.setItem("order", JSON.stringify(storage));
      this.$router.push("pickup-date");
    },

    watchLocalstorage() {
      if (localStorage.getItem("order")) {
        let storage = JSON.parse(localStorage.getItem("order"));
        this.services = storage.src.accessories;
      }
    },
  },

  created() {
    this.$emit("progress", this.prgValue);
    console.log("in pik serc: ", JSON.parse(localStorage.getItem("order")));
    this.watchLocalstorage();
    this.getAccessories();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
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
    font-size: 24px;
  }
}
@media only screen and (min-width: 600px) {
  .pickup-services {
    .md-display-1 {
      font-size: 30px;
    }
  }
}
</style>