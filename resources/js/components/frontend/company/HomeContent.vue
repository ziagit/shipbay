<template>
<div class="container">
    <div class="section1" v-bind:style="{'background-image': 'url(/images/uploads/bg.svg)'}">
        <Header v-on:togal-menu="$emit('togal-menu')" :class="{bg: isScrolled}" />
        <div class="content">
            <div class="heading">
                <img :src="'/images/uploads/logo-white1.svg'" alt="" width="86">
                <h1 class="md-display-1">Let’s book your shipment in a few taps.</h1>
                <p class="md-subheading">The way you book your travel tickets.</p>
                <div class="actions">
                    <button class="md-button md-raised" @click="getQoute()">Start new qoute</button>
                    <span>
                        <router-link to="/help">How it works</router-link>
                    </span>
                </div>
            </div>

        </div>
    </div>
    <div class="wrapper">
        <div class="section0">
            <div class="col1">
                <div class="md-display-1">4.8</div>
                <div class="md-subheading">Customer Review</div>
                <div>
                    <router-link to="#">See All Reviews...</router-link>
                </div>
            </div>
            <div class="col2">
                <div class="md-display-1">76</div>
                <div class="md-subheading">Business Product</div>
                <div>
                    <router-link to="#">See All Product...</router-link>
                </div>
            </div>
            <div class="col3">
                <div class="md-display-1">Trusted by over 250+ business partner around the world</div>
            </div>
        </div>
        <div class="section2">
            <div class="heading">
                <div class="md-display-1">Get ready for your business</div>
                <div class="md-subheading">Get ready for your business</div>
            </div>
            <div class="rows">
                <div class="row">
                    <img :src="'/images/uploads/transparent.svg'" width="35" alt="">
                    <div>
                        <div class="md-title">Transparent </div>
                        <div class="md-body-1">Upfront pricing and free quotes from
                            hundreds of Carriers. know your
                            shipment cost before you ship.</div>
                    </div>
                </div>
                <div class="row with-shadow">
                    <img :src="'/images/uploads/nosignup.svg'" width="35" alt="">
                    <div>
                        <div class="md-title">No Sign up </div>
                        <div class="md-body-1">Get free quotes and book your
                            shipment in a few taps. No sign up
                            or membership required.</div>

                    </div>
                </div>
                <div class="row">
                    <img :src="'/images/uploads/inssured.svg'" width="35" alt="">
                    <div>
                        <div class="md-title">Insured </div>
                        <div class="md-body-1">All the shipments happening here
                            are insured through our vetted
                            Carriers insurance policy.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section3">
            <div class="text">
                <div class="md-display-1">Tap The Specifications</div>
                <div class="md-body-1">Specify your shipment and schedule the date. Tap on different services you may need in the pick-up and drop-off 1locations</div>
                <button class="md-button md-raised">Start Quoting</button>
            </div>
            <div class="image">
                <div class="head"></div>
                <img :src="'/images/uploads/dw.svg'" width="35" alt="">
            </div>
        </div>
        <div class="section4">
            <div class="image">
                <div class="head"></div>
                <img :src="'/images/uploads/select-carrier.svg'" width="35" alt="">
            </div>
            <div class="text">
                <div class="md-display-1">Select The Carrier</div>
                <div class="md-body-1">Specify your shipment and schedule the date. Tap on different services you may need in the pick-up and drop-off 1locations</div>
                <button class="md-button md-raised">Start Quoting</button>
            </div>

        </div>
        <div class="section5">
            <div class="text">
                <div class="md-display-1">Track The Shipment</div>
                <div class="md-body-1">Specify your shipment and schedule the date. Tap on different services you may need in the pick-up and drop-off 1locations</div>
                <button class="md-button md-raised">Start Quoting</button>
            </div>
            <div class="image">
                <div class="head"></div>
                <img :src="'/images/uploads/tracking.svg'" width="35" alt="">
            </div>
        </div>

    </div>

    <Footer />
</div>
</template>

<script>
import Footer from "../../shared/Footer"
import Header from "../../shared/Header"

export default {
    name: "HomeContent",
    data: () => ({
        zip: null,
        isScrolled: false,
        scrollPosition: 100,
    }),
    methods: {
        getQoute() {
            this.$router.push('/order')
        },
        onScroll(e) {
            var currentScrollPosition = e.srcElement.scrollTop;
            if (currentScrollPosition > 100) {
                this.isScrolled = true;
                console.log("val1: ", currentScrollPosition, ' val2: ', this.scrollPosition)
            } else {
                this.isScrolled = false;
            }
            this.scrollPosition = currentScrollPosition;
        }

    },

    components: {
        Header,
        Footer,
    },
};
</script>

<style lang="scss" scoped>
/* @font-face {
    font-family: "Segoe Script";
    src: local("Segoe Script"),
        url('/fonts/Segoe Script.ttf') format("truetype");
} */

.container {
    .section1 {
        text-align: left;
        height: calc(100vh - 48px);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;

        .content {
            .heading {
                text-align: left;
                padding: 122px 0 12px 106px;
                max-width: 665px;

                /* font-family: Verdana, Geneva, Tahoma, sans-serif; */

                .md-display-1 {
                    line-height: 60px;
                    font-size: 53px;
                    font-weight: 600;
                    color: #000;
                }

                .md-subheading {
                    line-height: 0px;
                    color: #6D6E73;
                }

                .actions {
                    display: flex;
                    justify-content: left;
                    align-items: center;
                    margin-top: 59px;

                    .md-button {
                        width: 180px;
                    }

                    span {
                        font-size: 11px;
                        color: #448AFF;
                    }
                }
            }

        }

    }

    .wrapper {
        background: #fff;
        max-width: 1200px;
        margin: auto;
        padding-bottom: 126px;

        .section0 {
            background: #fff;
            min-height: 150px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 46px 100px;

            .col1 {
                flex: 25%;

                .md-display-1 {
                    color: #F5C82F;
                }

                .md-subheading {
                    color: #000;
                }
            }

            .col2 {
                flex: 25%;

                .md-display-1 {
                    color: #F97D4B;
                }

                .md-subheading {
                    color: #000;
                }
            }

            .col3 {
                flex: 50%;

                .md-display-1 {
                    color: #000;
                    font-weight: 400;
                }
            }
        }

        .section2 {
            padding: 46px 100px;
            background: #fff;

            .heading {
                padding: 20px 20px 20px 0;

                .md-display-1 {
                    color: #000;
                    font-weight: 500;
                }
            }

            .rows {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;

                .row {
                    flex: 30%;
                    padding: 30px;
                    border: solid 1px #ddd;
                    border-radius: 3px;
                    margin: 10px;

                    img {}

                    .md-title {
                        line-height: 52px;
                        font-weight: 600;
                        line-height: 44px;
                    }
                }

                .with-shadow {
                    box-shadow: rgba(0, 0, 0, 0.12) 0px 4px 16px;
                    border: none;
                }
            }

        }

        .section3 {
            background:
                linear-gradient(to left bottom, rgb(250, 250, 250) 0%
                    /*bottom-right color*/
                    , rgba(255, 255, 255, 0.5) 50%
                    /*middle color*/
                    , rgba(255, 187, 0, 0.13) 100%
                    /*top-left color*/
                )
                /*"faked" black background make sure to add last or it will appear before the transparent/colored layer*/
            ;

            padding: 46px 100px;
            margin: 30px;
            min-height: 500px;
            max-width: 80%;
            position: relative;

            .text {

                .md-display-1 {
                    margin: 30px 0;
                    max-width: 309px;
                    font-weight: 600;
                    color: #000;
                }

                .md-body-1 {
                    max-width: 353px;
                }

                .md-button {
                    margin-top: 98px;
                    width: 164px !important;
                    color: #fff;
                }
            }

            .image {
                min-width: 386px;
                min-height: 350px;
                background: #fff;
                position: absolute;
                right: -100px;
                bottom: -50px;
                box-shadow: rgba(0, 0, 0, 0.12) 0px 4px 16px;

                .head {
                    min-height: 9px;
                    width: 100%;
                    background: #ffa500;
                }

                img {
                    width: 100%;
                    padding: 20px;
                }

            }
        }

        .section4 {
            display: flex;
            justify-content: space-between;
            padding: 46px 100px;
            margin: 30px;
            min-height: 500px;

            .image {
                min-width: 386px;
                padding: 30px;
                box-shadow: rgba(0, 0, 0, 0.12) 0px 4px 16px;

                img {
                    width: 100%;
                }
            }

            .text {
                padding: 62px;

                .md-display-1 {
                    margin: 30px 0;
                    max-width: 309px;
                    font-weight: 600;
                    color: #000;
                }

            }
        }

        .section5 {
            display: flex;
            justify-content: space-between;
            padding: 46px 100px;
            margin: 30px;
            position: relative;

            .text {
                .md-display-1 {
                    margin: 30px 0;
                    max-width: 309px;
                    font-weight: 600;
                    color: #000;
                }

                .md-body-1 {
                    max-width: 353px;
                }

                .md-button {
                    margin-top: 98px;
                    width: 164px !important;
                    color: #fff;
                }
            }

            .image {
                min-width: 386px;
                background: #fff;
                box-shadow: rgba(0, 0, 0, 0.12) 0px 4px 16px;

                .head {
                    min-height: 9px;
                    width: 100%;
                    background: #ffa500;
                }

                img {
                    width: 100%;
                    padding: 20px;
                }

            }
        }
    }

}

@media only screen and (max-width: 600px) {
    .section1 {
        background-position: right !important;

        .content {
            .heading {
                padding: 94px 20px !important;

                .md-display-1 {
                    font-size: 36px !important;
                }
            }
        }
    }

    .section2 {
        padding: 0px 20px 20px 20px !important;

        .row {
            flex: 100% !important;
        }
    }

    .section3 {
        margin: 0 !important;
        max-width: 100% !important;
        padding: 20px !important;
        text-align: center;

        .steps {
            position: relative !important;
            right: 0 !important;
            bottom: 0 !important;
            margin-top: 44px !important;

            .md-list {
                padding: 0 !important;

                .md-list-item-content {
                    padding: 0 !important;

                    .md-headline {
                        font-size: 14px !important;
                    }

                    .details {
                        font-size: 10px !important;
                    }
                }
            }
        }
    }
}

/* @media only screen and (min-width: 1179px) {
    .section3 {
        .row {
            .text {
                .row1 {
                    .md-title {
                        margin-left: 74px !important;
                    }
                }

                .row2 {
                    padding-left: 73px !important;
                }
            }
        }
    }

    .section4 {
        padding: 0 20px;

        .row {
            display: flex;
            justify-content: space-between;

            .text {
                flex: 40%;
                display: flex;
                justify-content: space-between;
                padding: 20px 0 20px 72px;

                .col1 {
                    flex: 18%;
                    align-self: flex-end;

                    img {
                        width: 100%;
                    }
                }

                .col2 {

                    padding: 84px 10px 0 10px !important;
                    margin-bottom: -10px;
                }

                .col3 {

                    padding-top: 76px !important;

                }
            }

        }
    }

    .section5 {

        .row {

            .text {

                .col3 {

                    padding-top: 56px !important;

                }
            }

        }
    }
} */
</style>
