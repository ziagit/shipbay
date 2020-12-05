<template>
<div class="pickup-services">
    <form @submit.prevent="nextStep()">
        <div class="options">
            <md-checkbox v-for="service in accessories" :key="service.id" v-model="services" :value="service.code">{{service.name}}</md-checkbox>
        </div>

        <div class="action">
            <md-button type="submit" class="custom-button">
                Contintue
            </md-button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    name: "PickupService",
    data: () => ({
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

            this.$emit("progress", 'second', 'third', 2);
        },

        init() {
            if (localStorage.getItem("order")) {
                let storage = JSON.parse(localStorage.getItem("order"));
                this.services = storage.src.accessories;
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
.pickup-services {
    .icon,
    .options,
    .action {
        margin: 20px auto;
    }
}
</style>
