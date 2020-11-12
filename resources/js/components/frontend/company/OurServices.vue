<template>
<div class="services">
    <div class="section1" v-bind:style="{'background-image': 'url(/images/uploads/services.svg)'}">
        <div class="md-display-1"> Our Services </div>
        <p class="md-body-1">Not sure what freight class your shipment falls into? No problem! We’ll guide you through the process and calculate it for you.</p>
        <md-button class="md-raised" to="/order">Get A Quotes</md-button>
    </div>
    <md-card>
        <div class="section2">
            <div class="row" v-bind:style="{'background-image': 'url(/images/home-background.png)'}">
                <div>
                    <div class="md-headline">LTL freight</div>
                    <div class="md-body-1">Choose from hundreds of contract carriers with our self-service online tools or work directly with a freight expert.</div>
                    <div>
                        <md-button class="md-primary" to="/service-details">
                            <md-icon class="md-primary">subject</md-icon> Read More
                        </md-button>
                    </div>
                </div>
            </div>
            <div class="row" v-bind:style="{'background-image': 'url(/images/home-background.png)'}">
                <div>
                    <div class="md-headline">Truckload freight</div>
                    <div class="md-body-1">Easily ship your refrigerated, flatbed and dry van freight with our large network of contract carriers and the guidance of our freight professionals.</div>
                    <div>
                        <md-button class="md-primary">
                            <md-icon class="md-primary">subject</md-icon> Read More
                        </md-button>
                    </div>
                </div>
            </div>
            <div class="row" v-bind:style="{'background-image': 'url(/images/home-background.png)'}">
                <div>
                    <div class="md-headline">Intermodal Rail shipping</div>
                    <div class="md-body-1">We offer real-time intermodal rates and an in-house team of experts to make your rail shipments easy.</div>
                    <div>
                        <md-button class="md-primary">
                            <md-icon class="md-primary">subject</md-icon> Read More
                        </md-button>
                    </div>
                </div>
            </div>
            <div class="row" v-bind:style="{'background-image': 'url(/images/home-background.png)'}">
                <div>
                    <div class="md-headline">Partial Truckload freight</div>
                    <div class="md-body-1">Find a partial truckload option that fits based on your budget, transit or handling requirements.</div>
                    <div>
                        <md-button class="md-primary">
                            <md-icon class="md-primary">subject</md-icon> Read More
                        </md-button>
                    </div>
                </div>
            </div>
        </div>

    </md-card>

    <Footer />
</div>
</template>

<script>
import Footer from "../../shared/Footer"
import axio from "axios";
export default {
    name: "services",
    data: () => ({}),
    methods: {},
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

        .md-raised {
            color: #333 !important;
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
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 100px;

            .row {
                flex: 40%;
                padding: 100px;
                margin: 10px;
                color: #fff;
                background-repeat: no-repeat;
                background-size: cover;
                border-radius: 10px;
                text-align: center;

                .md-headline {
                    line-height: 40px;
                }

                .md-button {
                    margin: 0;
                    margin-top: 36px;
                }

            }
        }
    }
}

.md-body-1 {
    width: 100% !important;
}

@media only screen and (max-width: 1199.98px) {
    .section2 {
        padding: 60px !important;
    }
}

@media only screen and (max-width: 991.98px) {
    .section2 {
        padding: 20px !important;

    }

    .md-display-1 {
        line-height: 38px !important;
    }
}

@media only screen and (max-width: 600px) {
    .services {
        .section1 {
            text-align: center;
            padding: 50px 10px !important;
            min-height: calc(100vh - 50px);

            .md-display-1 {
                line-height: 36px;
                font-size: 30px;
            }

        }

        .md-card {
            padding: 10px !important;
            margin-top: -150px;

            .section2 {
                flex-direction: column;
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

// Medium devices (tablets, less than 992px)
/* @media only screen and (max-width: 991.98px) {
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
} */

// Large devices (desktops, less than 1200px)
</style>
