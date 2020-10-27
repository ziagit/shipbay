<template>
<div class="services">
    <div class="section1" v-bind:style="{'background-image': 'url(/images/uploads/help.svg)'}">
        <div class="md-display-1"> How It Works? </div>
        <p class="md-body-1">Our simple shipping tool is the fastest route to getting your freight on the road. Just enter a few shipment details, review quotes and choose a carrier.</p>
        <md-button class="md-primary md-raised" to="/order">Start a new quote</md-button>
    </div>
    <md-card>
        <div class="section2">
            <img :src="'/images/uploads/guid.gif'" alt="">
        </div>
    </md-card>

    <Footer />
</div>
</template>

<script>
import Footer from "../shared/Footer"
import axio from "axios";
export default {
    name: "services",
    data: () => ({

    }),
    methods: {

    },
    components: {
        Footer,
    },
};
</script>

<style lang="scss" scoped>
.services {
    min-height: 100vh !important;

    .section1 {
        padding: 50px 200px 100px 200px;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        color: #fff;

        .md-display-1 {
            color: #fff;
            line-height: 66px;
            font-size: 36px;
        }

    }

    .md-card {
        width: 95%;
        margin: auto;
        margin-top: -50px;
        margin-bottom: 30px;
        overflow: hidden;
        padding: 50px;

        .section2 {
            padding: 100px;

            img {
                width: 100%;
                border-radius: 10px;

            }

        }
    }
}

.md-body-1 {
    width: 100% !important;
}

@media only screen and (max-width: 600px) {
    .services {
        .section1 {
            text-align: center;
            padding: 50px 10px;
            min-height: calc(100vh - 50px);
            padding: 50px 10px !important;

            .md-button {
                margin: 30px 0 0 0;
            }

            .md-display-1 {
                line-height: 36px;
                font-size: 30px;
            }

        }

        .md-card {
            padding: 10px !important;
            margin-top: -150px;

            .section2 {
                padding: 0;

                .row {
                    padding: 20px;

                    .md-body-1,
                    .md-headline,
                    div {
                        margin: 0 !important;
                    }

                    .md-button {
                        margin: 20px 0 0 0;
                    }

                }
            }

            .md-display-1 {
                font-size: 30px;
            }

            .md-card-header {
                padding-left: 100px;
                padding-right: 100px;
                padding-bottom: 50px;
            }
        }
    }

}

@media (max-width: 575.98px) {
    .services {}
}

// Small devices (landscape phones, less than 768px)
@media (max-width: 767.98px) {
    .services {
        .section2 {
            padding: 0 !important;
        }
    }
}

// Medium devices (tablets, less than 992px)
@media (max-width: 991.98px) {
    .section1 {
        padding: 50px 100px 100px 100px !important;

        .section2 {
            padding: 26px !important;
        }

        .md-display-1 {
            line-height: 36px !important;
        }
    }

    .services {

        .section2 {
            padding: 30px;

            .row {
                padding: 60px !important;
            }
        }
    }
}

// Large devices (desktops, less than 1200px)
@media (max-width: 1199.98px) {
    .services {
        .section2 {
            padding: 60px;
        }
    }
}
</style>
