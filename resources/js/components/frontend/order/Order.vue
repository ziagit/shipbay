<template>
<div class="order">
    <div class="progress-container">
        <md-progress-bar class="md-primary" md-mode="determinate" :md-value="amount"></md-progress-bar>
    </div>
    <div class="input-container">
        <router-view v-on:progress="progress"></router-view>
    </div>
</div>
</template>

<script>
import axios from "axios";
export default {
    name: "StepperLinear",
    data: () => ({
        amount: 0,
    }),

    methods: {
        progress(prgValue) {
            this.amount = prgValue;
        },
    },
};
</script>

<style lang="scss" scoped>
.order {
    width: 100%;
    margin: auto;
    padding: 50px 20px 0 20px !important;
    text-align: center;

    .progress-container {
        max-width: 800px;
        margin: auto;

        .md-progress-bar {
            border-radius: 20px;
            background-color: #fff;

            .md-progress-bar-fill {
                background: #FFA500 !important;
            }

            .md-progress-bar-buffer {
                background: #e7eaed;
            }
        }
    }

    .input-container {
        padding: 10px;
        max-width: 600px;
        margin: auto;
    }
}

@media only screen and (min-width: 600px) {
    .order {
        padding: 30px;

        .progress-container {
            max-width: 800px;
        }

        .input-container {
            padding: 10px;
            max-width: 600px;
            margin: auto;
        }
    }
}
</style>
