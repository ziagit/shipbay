<template>
  <div class="pickup-date">
    <div class="icon">
      <img src="http://localhost:8000/images/date.svg" width="100" />
    </div>
    <span class="md-display-1">When to pick-up? *</span>
    <form>
      <div>
        <md-field>
          <md-input type="date" v-model="selectedDate" required></md-input>
        </md-field>
      </div>
      <div class="options">
        <md-checkbox
          v-for="accessory in accessories"
          :key="accessory.id"
          v-model="appointment"
          :value="accessory.code"
          class="md-primary"
        >{{accessory.name}}?</md-checkbox>

        <md-field v-if="appointment">
          <label>Appointment time</label>
          <md-input type="time" v-model="appointmentTime"></md-input>
        </md-field>
      </div>

      <div class="action">
        <md-button @click="prevStep(-14)" class="md-icon-button md-raised">
          <md-icon>keyboard_arrow_left</md-icon>
        </md-button>
        <md-button @click="nextStep(14)" class="md-icon-button md-raised md-primary" type="submit">
          <md-icon>keyboard_arrow_right</md-icon>
        </md-button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  name: "PickupDate",
  data: () => ({
    selectedDate: null,
    accessories: null,
    appointment: null,
    appointmentTime: null
  }),
  methods: {
    nextStep(prgValue) {
      if (this.selectedDate != null) {
        let storage = JSON.parse(localStorage.getItem("order"));
        storage.pickDate = this.selectedDate;
        if (this.appointment != null) {
          if (!storage.src.accessories.includes("ap")) {
            storage.src.accessories.push(this.appointment);
            storage.src.appointmentTime = this.appointmentTime;
          }
        } else {
          if (storage.src.accessories.includes("ap")) {
            for (let i = 0; i < storage.src.accessories.length; i++) {
              if (storage.src.accessories[i] === "ap") {
                storage.src.accessories.splice(i, 1);
              }
            }
          }
          storage.src.appointmentTime = null;
        }
        localStorage.setItem("order", JSON.stringify(storage));
        this.$router.push("destination");
        this.$emit("progress", prgValue);
      }
    },
    prevStep(prgValue) {
      this.$router.back("pickup-services");
      this.$emit("progress", prgValue);
    },
    watchLocalstorage() {
      if (localStorage.getItem("order")) {
        let storage = JSON.parse(localStorage.getItem("order"));
        this.selectedDate = storage.pickDate;
        if (storage.src.accessories.includes("ap")) {
          this.appointment = "ap";
          this.appointmentTime = storage.src.appointmentTime;
        }
      }
    },
    getAccessories() {
      axios
        .get("pick-date")
        .then(res => {
          this.accessories = res.data;
        })
        .catch(err => {
          console.log("Error: ", err);
        });
    }
  },
  created() {
    console.log("in pick date: ", JSON.parse(localStorage.getItem("order")));
    this.watchLocalstorage();
    this.getAccessories();
  }
};
</script>

<style lang="scss" scoped>
.pickup-date {
  text-align: center;
  .md-input {
    color: #737373;
  }
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