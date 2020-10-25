<template>
<div class="home-content">
    <div class="section1" v-bind:style="{'background-image': 'url(/images/uploads/home-background.svg)'}">
        <div class="text">
            <div class="heading">
                <span class="md-display-1">Smart Shipping!</span>
            </div>
            <div class="sub-heading">
                <span class="md-subheading">We get you shipped in 3 easy steps. Thousands happening everyday!</span>
            </div>
            <div class="help">
                <router-link to="/help" class="md-primary">How it works ?</router-link>
            </div>
        </div>
        <div class="action">
            <md-button to="/order" class="md-raised">Get a free quote </md-button>
        </div>
    </div>
    <md-card>
        <md-card-header>
            <div class="row">
                <div class="md-headline">Shipping TAP</div>
                <div class="md-body-1">Shipping TAB is the nation's largest online freight service provider and
                    a licensed transportation property broker. We work with a network of carriers to
                    negotiate rates for shippers. ... Shipping TAB ships throughout United State and Canada.</div>
            </div>
        </md-card-header>
        <div class="section2">

            <div class="row">
                <img :src="'/images/uploads/transparent.svg'" width="60" alt="">
                <div>
                    <div class="md-headline">Transparent </div>
                    <div class="md-body-1">Upfront pricing and free quotes from
                        hundreds of Carriers. know your
                        shipment cost before you ship.</div>

                </div>
            </div>
            <div class="row">
                <img :src="'/images/uploads/nosignup.svg'" width="60" alt="">
                <div>
                    <div class="md-headline">No Sign up </div>
                    <div class="md-body-1">Get free quotes and book your
                        shipment in a few taps. No sign up
                        or membership required.</div>

                </div>
            </div>
            <div class="row">
                <img :src="'/images/uploads/inssured.svg'" width="60" alt="">
                <div>
                    <div class="md-headline">Insured </div>
                    <div class="md-body-1">All the shipments happening here
                        are insured through our vetted
                        Carriers insurance policy.
                    </div>

                </div>
            </div>
        </div>
        <div class="steps">
            <div class="md-headline order-header">III Steps Order</div>
            <div class="section3">
                <div class="row">
                    <img :src="'/images/uploads/item-dw.svg'" width="250" alt="">
                    <div class="text">
                        <img :src="'/images/uploads/01.svg'" width="50" alt="">
                        <div class="md-headline">Tap the specifications</div>
                        <div class="md-body-1">Specify your shipment and
                            schedule the date. Tap on
                            different services you may need
                            in the pick-up and drop-off 1locations.
                        </div>
                    </div>
                </div>
            </div>
            <div class="section4">
                <div class="row">
                    <div class="text">
                        <img :src="'/images/uploads/02.svg'" width="50" alt="">
                        <div class="md-headline">Select the Carrier </div>
                        <div class="md-body-1">Tap on carrier of your
                            choice based on their
                            competitive price, review 2 and customer ratings.</div>
                    </div>
                    <img :src="'/images/uploads/select-carrier.svg'" width="250" alt="">

                </div>
            </div>
            <div class="section5">
                <div class="row">
                    <img :src="'/images/uploads/tracking.svg'" width="250" alt="">
                    <div class="text">
                        <img :src="'/images/uploads/03.svg'" width="50" alt="">
                        <div class="md-headline">Track the shipment </div>
                        <div class="md-body-1">Relax! we will notify you
                            on every step taken on
                            the shipment. Also, you
                            can track your shipment 3live.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section6">
            <div class="md-headline">LET’S GET YOU A FREE QUOTE.</div>
            <div class="md-body-1">What are you shipping today?</div>
            <div>
                <md-button class="md-default">freight</md-button>
                <md-button class="md-default">moving</md-button>
            </div>
        </div>
    </md-card>
    <Footer />
</div>
</template>

<script>
import Footer from "./shared/Footer"

export default {
    name: "HomeContainer",
    data: () => ({}),
    methods: {},
    components: {
        Footer,
    },
};
</script>

<style lang="scss" scoped>
.home-content {
    background-size: 100% 100%;

    .section1 {
        padding: 200px 0 0 200px;
        text-align: left;
        color: #fff;
        height: calc(100vh - 50px);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;

        .md-display-1 {
            color: #fff;
            line-height: 66px;
            font-size: 35px;
        }

        .help {
            margin: 20px 0 !important;

        }

        .action {
            .md-button {
                font-size: 14px;
                margin-left: 0;
            }
        }
    }

    .md-card {
        width: 95%;
        margin: auto;
        margin-top: -50px;
        margin-bottom: 30px;
        overflow: hidden;

        .md-card-header {
            max-width: 60%;
            margin: auto;
            text-align: center;
            padding: 50px;

            .md-headline {
                font-weight: 600;
                font-size: 30px;
                line-height: 60px;
            }
        }

        .section2 {
            padding: 30px 100px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            background: #fff;

            .row {
                flex: 30%;
                text-align: center;
                padding: 30px;

                .md-headline {
                    line-height: 52px;
                }
            }
        }

        .steps {
            padding: 30px 100px;
            background: #fbfbfb;

            .order-header {
                text-align: center;
                font-weight: 600;
                font-size: 30px;
                line-height: 80px;
            }

            .section3,
            .section4,
            .section5 {
                padding: 20px;

                .row {
                    display: flex;
                    justify-content: space-around;

                    .text {
                        width: 70%;
                        padding: 20px;
                    }

                    img {}

                }
            }
        }

        .section6 {
            padding: 2.25em 1.6875em;
            background-image: -webkit-repeating-radial-gradient(center center, rgba(255, 165, 0, 0.2), rgba(255, 165, 0, .2) 1px, transparent 1px, transparent 100%);
            background-image: -moz-repeating-radial-gradient(center center, rgba(255, 165, 0, .2), rgba(255, 165, 0, .2) 1px, transparent 1px, transparent 100%);
            background-image: -ms-repeating-radial-gradient(center center, rgba(255, 165, 0, .2), rgba(255, 165, 0, .2) 1px, transparent 1px, transparent 100%);
            background-image: repeating-radial-gradient(center center, rgba(255, 165, 0, .2), rgba(255, 165, 0, .2) 1px, transparent 1px, transparent 100%);
            -webkit-background-size: 3px 3px;
            -moz-background-size: 3px 3px;
            background-size: 3px 3px;
            text-align: center;

            :nth-child(3) {
                margin-top: 20px;

                .md-button {
                    border: solid 1px #333;
                }
            }
        }
    }

}

.md-body-1 {
    width: 100% !important;
}

@media only screen and (max-width: 600px) {
    .home-content {
        width: 100%;
        min-height: 100%;

        .section1 {
            text-align: center;
            padding: 150px 0 0 0;

            .text {
                margin-left: 7px;

                .heading {
                    .md-headline {
                        font-size: 2.5em;
                    }
                }

                .sub-heading {
                    .md-subheading {
                        font-size: 1em;
                        line-height: 1em;
                    }
                }

                .help {
                    margin-bottom: 3em;
                    margin-top: 0.7em;

                    a {
                        font-size: 1em;
                    }
                }
            }
        }

        .md-card {

            .md-card-header {
                max-width: 100%;
                padding: 30px;
            }

            .section2 {
                flex-direction: column;
                align-items: center;
                padding: 30px;

                .row {
                    flex: 100%;
                    text-align: center;
                    padding: 0 !important;
                    margin-bottom: 36px;

                    .md-headline {
                        line-height: 24px;
                    }

                    img {
                        margin: 20px;
                    }

                    .md-headline {
                        margin-bottom: 10px;
                    }
                }

            }

            .steps {
                padding: 30px;

                .section3 {
                    margin-bottom: 50px;
                    padding: 0;

                    .row {
                        flex-direction: column;
                        text-align: center;
                        align-items: center;

                        img {
                            order: 1;
                            background: none;
                            box-shadow: none;
                            width: 150px;
                        }

                        .text {
                            order: 2;
                            padding: 20px 0 0 0 !important;
                            width: 100% !important;
                        }
                    }
                }

                .section4 {
                    margin-bottom: 50px;
                    padding: 0;

                    .row {
                        flex-direction: column;
                        text-align: center;
                        align-items: center;

                        .text {
                            padding: 20px 0 0 0 !important;
                            width: 100% !important;
                        }

                        img {
                            background: none;
                            box-shadow: none;
                            width: 150px;
                        }
                    }
                }

                .section5 {
                    margin-bottom: 50px;
                    padding: 0;

                    .row {
                        flex-direction: column;
                        text-align: center;
                        align-items: center;

                        img {
                            order: 1;
                            background: none;
                            box-shadow: none;
                            width: 150px;
                        }

                        .text {
                            order: 2;
                            padding: 20px 0 0 0 !important;
                            width: 100% !important;
                        }
                    }
                }
            }

        }
    }

}
</style>
