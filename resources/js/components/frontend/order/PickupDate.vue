<template>
<div class="pickup-date">
    <form @submit.prevent="nextStep()">
        <div>
            <md-field>
                <input type="date" v-model="selectedDate" required :min="validDate" />
            </md-field>
        </div>
        <div class="options">
            <md-checkbox v-for="accessory in accessories" :key="accessory.id" v-model="appointment" :value="accessory.code">{{accessory.name}}?</md-checkbox>

            <md-field v-if="appointment">
                <md-input type="time" v-model="appointmentTime" :required="appointment"></md-input>
            </md-field>
        </div>
        <div class="action">
         
            <md-button class="custom-button" type="submit">
                Continue
            </md-button>
        </div>
    </form>
</div>
</template>

<script>
import functions from "../services/functions";
export default {
    name: "PickupDate",
    data: () => ({
        accessories: null,
        appointment: null,
        appointmentTime: null,
        boxChecked: false,
        validDate: functions.validDate(),
    }),

    methods: {
        nextStep() {
            if (this.selectedDate != null) {
                let storage = JSON.parse(localStorage.getItem("order"));
                storage.pickDate = this.selectedDate;
                if (this.appointment != null) {
                    if (!storage.src.accessories.includes("ap")) {
                        storage.src.accessories.push(this.appointment);
                    }
                    storage.src.appointmentTime = this.appointmentTime;
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
                this.$emit("progress", 'thirth', 'fourth','delivery', 3);
                localStorage.setItem("order", JSON.stringify(storage));
            }
        },

        init() {
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
                .then((res) => {
                    this.accessories = res.data;
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },
    },
    created() {
        this.$emit("progress", 28);
        console.log("in pick date: ", JSON.parse(localStorage.getItem("order")));
        this.init();
        this.getAccessories();
        localStorage.setItem("cRoute", this.$router.currentRoute.path);
    },
};
</script>

<style lang="scss" scoped>
.pickup-date {
    text-align: center;

    input {
        width: 100%;
        background: #f0f2f5;
        border: none;
        font-family: "Roboto";
        font-size: 16px;
    }

    input:focus {
        outline: none;
    }

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
    .pickup-date {
        .md-display-1 {
            font-size: 30px;
        }
    }
}
</style>
