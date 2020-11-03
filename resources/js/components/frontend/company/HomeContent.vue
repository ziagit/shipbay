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
        <div class="section2">

            <div class="row">
                <img :src="'/images/uploads/transparent.svg'" width="50" alt="">
                <div>
                    <div class="md-title">Transparent </div>
                    <div class="md-body-1">Upfront pricing and free quotes from
                        hundreds of Carriers. know your
                        shipment cost before you ship.</div>
                </div>
            </div>
            <div class="row with-shadow">
                <img :src="'/images/uploads/nosignup.svg'" width="50" alt="">
                <div>
                    <div class="md-title">No Sign up </div>
                    <div class="md-body-1">Get free quotes and book your
                        shipment in a few taps. No sign up
                        or membership required.</div>

                </div>
            </div>
            <div class="row">
                <img :src="'/images/uploads/inssured.svg'" width="50" alt="">
                <div>
                    <div class="md-title">Insured </div>
                    <div class="md-body-1">All the shipments happening here
                        are insured through our vetted
                        Carriers insurance policy.
                    </div>

                </div>
            </div>
        </div>
        <div class="section3">
            <div class="text">
                <div class="md-display-1">Book your shipment in 3 teps</div>
                <div class="md-body-1">Specify your shipment and schedule the date. Tap on different services you may need in the pick-up and drop-off 1locations</div>
                <button class="md-button md-raised">Start Quoting</button>
            </div>
            <div class="steps">
                <div class="head"></div>
                <md-list class="md-double-line">

                    <md-list-item>
                        <md-avatar>
                            <img :src="'/images/uploads/dw.svg'" alt="People">
                        </md-avatar>

                        <div class="md-list-item-text">
                            <span class="md-headline">Tap The Specifications</span>
                            <span class="details">Specify your shipment and schedule the date. Tap on different services you may need in the pick-up and drop-off 1locations.</span>
                        </div>

                        <md-button class="md-icon-button md-list-action">
                            <img :src="'/images/uploads/01.svg'" alt="1" width="12">
                        </md-button>
                    </md-list-item>
                    <md-divider></md-divider>

                    <md-list-item>
                        <md-avatar>
                            <img :src="'/images/uploads/select-carrier.svg'" alt="People">
                        </md-avatar>
                        <div class="md-list-item-text">
                            <span class="md-headline">Select The Carrier</span>
                            <span class="details">Tap on carrier of your choice based on their competitive price, review and customer ratings.</span>
                        </div>

                        <md-button class="md-icon-button md-list-action">
                            <img :src="'/images/uploads/02.svg'" alt="2" width="15">
                        </md-button>
                    </md-list-item>
                    <md-divider></md-divider>

                    <md-list-item>
                        <md-avatar>
                            <img :src="'/images/uploads/tracking.svg'" alt="People">
                        </md-avatar>
                        <div class="md-list-item-text">
                            <span class="md-headline">Track The Shipment</span>
                            <span class="details">Tap on carrier of your Relax! we will notify you on every step taken on the shipment. Also, you can track your shipment 3live.</span>
                        </div>

                        <md-button class="md-icon-button md-list-action">
                            <img :src="'/images/uploads/03.svg'" alt="3" width="15">
                        </md-button>
                    </md-list-item>

                </md-list>
            </div>
        </div>

    </div>

    <div class="section6">
        <div class="md-title">LET’S GET YOU A FREE QUOTE.</div>
        <div class="md-body-1">What are you shipping today?</div>
        <div>
            <md-button class="md-default">freight</md-button>
            <md-button class="md-default">moving</md-button>
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
.bg {
    background: #000;
}

.container {
    .section1 {
        text-align: left;
        color: #fff;
        height: calc(100vh - 48px);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        margin-bottom: 83px;

        .content {
            .heading {
                text-align: center;
                padding: 226px 0 12px 106px;
                max-width: 586px;

                /* font-family: Verdana, Geneva, Tahoma, sans-serif; */

                .md-display-1 {
                    line-height: 50px;
                    font-size: 46px;
                    font-weight: 600;
                    color: #fff;
                    margin-bottom: 0;
                }

                .md-subheading {
                    line-height: 0px;
                }

                .actions {
                    display: flex;
                    justify-content: center;
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
        max-width: 1200px;
        margin: auto;
        padding-bottom: 126px;

        .section2 {
            padding: 46px 100px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;

            .row {
                flex: 30%;
                padding: 30px;
                border: solid 1px #ddd;
                border-radius: 3px;
                margin: 10px;

                img {
                    padding: 10px;
                    border-radius: 10px;
                    background: #ffa5001f;
                }

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

        .section3 {
            background:
                linear-gradient(to left bottom, rgb(255, 255, 255) 0%
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

            .steps {

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

                .md-list {
                    padding: 42px;
                    width: 100%;
                    height: 100%;

                    .md-list-item {
                        padding: 20px;

                        .md-avatar {
                            width: 72px;
                        }

                        .md-headline {
                            font-size: 18px;
                            line-height: 1.5;
                        }

                        .details {
                            max-width: 284px;
                        }
                    }

                }
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

.md-body-1 {
    width: 100% !important;
}

/* 
@media only screen and (max-width: 600px) {

} */
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
