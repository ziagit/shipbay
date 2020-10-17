<template>
<div class="services">
    <md-card>
        <md-card-header>
            <span class="md-display-1">Services</span>
        </md-card-header>
        <md-card-content></md-card-content>
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
        height: calc(100vh - 100px);

        .md-display-1 {
            font-size: 24px;
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
