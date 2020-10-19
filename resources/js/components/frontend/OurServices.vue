<template>
<div class="services">
    <md-card>
        <div class="img-container">
            <img :src="'/images/uploads/truck2.jpg'" alt="">
        </div>
        <md-card-content class="card-content">
        </md-card-content>
    </md-card>
</div>
</template>

<script>
import axio from "axios";
export default {
    name: "services",
    data: () => ({}),
    methods: {},
};
</script>

<style lang="scss" scoped>
.services {
    padding-top: 20px;

    .md-card {
        min-height: calc(100vh - 100px);

        .img-container {
            width: 100%;
            background: salmon;
            max-height: 300px;
            object-fit: cover;

            img {
                max-width: 100%;
                max-height: 100%;
                margin: auto;
                display: block;
            }
        }

    }
}

@media only screen and (min-width: 600px) {
    .md-card {
        .md-display-1 {
            font-size: 30px;
        }
    }
}
</style>
