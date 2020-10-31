<template>
<div class="order">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="content">
        <div class="progress-container">
            <md-progress-bar class="md-primary" md-mode="determinate" :md-value="amount"></md-progress-bar>
        </div>
        <div class="input-container">
            <router-view v-on:progress="progress"></router-view>
        </div>
    </div>
</div>
</template>

<script>
import Header from "../../shared/Header"
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
    components: {
        Header,
    }
};
</script>

<style lang="scss" scoped>
.order {
    .header {
        background: #333 !important;
    }

    .content {
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
}

@media only screen and (min-width: 600px) {
    .order {
        .content {
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
}
</style>
