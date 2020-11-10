<template>
<div class="home-content">
    <div class="section1" v-bind:style="{'background-image': 'url(/images/uploads/home-background.svg)'}">
        <div class="header">
            <div class="left">
                <md-button class="md-icon-button" @click="menuTogal()">
                    <md-icon>menu</md-icon>
                </md-button>
                <h3 @click="$router.push('/')"><span>Shipping </span> TAP</h3>
            </div>
            <div class="right">
                <md-button class="md-icon-button" @click="track()">
                    <md-icon>location_on</md-icon>
                </md-button>
                <span @click="$router.push('/')">Track</span>
            </div>
        </div>
        <div class="content">
            <div class="heading">
                <h1 class="md-display-1">Let’s book your shipment in a few taps.</h1>
                <p class="md-subheading">The way you book your travel tickets.</p>
            </div>
            <div class="order">
                <div class="col1">
                    <h2>Where are you shipping from?</h2>
                    <form action="">
                        <div class="inputs">
                            <md-icon>location_on</md-icon>
                            <input v-model="zip" placeholder="Postal code" />
                            <button type="submit">
                                <md-icon>east</md-icon>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col2">
                    <img :src="'/images/uploads/step1.svg'" width="13" alt="">
                </div>

            </div>
        </div>
    </div>

    <div class="section2">

        <div class="row">
            <img :src="'/images/uploads/transparent.svg'" width="60" alt="">
            <div>
                <div class="md-title">Transparent </div>
                <div class="md-body-1">Upfront pricing and free quotes from
                    hundreds of Carriers. know your
                    shipment cost before you ship.</div>
            </div>
        </div>
        <div class="row">
            <img :src="'/images/uploads/nosignup.svg'" width="60" alt="">
            <div>
                <div class="md-title">No Sign up </div>
                <div class="md-body-1">Get free quotes and book your
                    shipment in a few taps. No sign up
                    or membership required.</div>

            </div>
        </div>
        <div class="row">
            <img :src="'/images/uploads/inssured.svg'" width="60" alt="">
            <div>
                <div class="md-title">Insured </div>
                <div class="md-body-1">All the shipments happening here
                    are insured through our vetted
                    Carriers insurance policy.
                </div>

            </div>
        </div>
    </div>
    <div class="steps">
        <div class="section3">
            <div class="row">
                <div class="text">
                    <div class="row1">
                        <div class="md-title">Tap the specifications</div>
                    </div>
                    <div class="row2">
                        <div class="line"></div>
                        <div class="circle"></div>
                    </div>
                    <div class="row3">
                        <img :src="'/images/uploads/01.svg'" width="10" alt="">
                        <div class="details">
                            <div class="md-body-1">Specify your shipment and
                                schedule the date. Tap on
                                different services you may need
                                in the pick-up and drop-off 1locations.
                            </div>
                        </div>
                    </div>
                </div>
                <img :src="'/images/uploads/dw.png'" width="50" alt="">
            </div>
        </div>
        <div class="section4">
            <div class="row">
                <img :src="'/images/uploads/select-carrier.jpg'" width="50" alt="">
                <div class="text">
                    <div class="col1">
                        <img :src="'/images/uploads/02.svg'" width="50" alt="">
                    </div>
                    <div class="col2">
                        <div class="line"></div>
                        <div class="circle"></div>
                    </div>
                    <div class="col3">
                        <div class="md-title">Select the Carrier </div>
                        <div class="details">
                            <div class="md-body-1">Tap on carrier of your
                                choice based on their
                                competitive price, review and customer ratings.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section5">
            <div class="row">
                <div class="text">
                    <div class="col1">
                        <img :src="'/images/uploads/03.svg'" width="50" alt="">
                    </div>
                    <div class="col2">
                        <div class="circle"></div>
                        <div class="line"></div>
                    </div>
                    <div class="col3">
                        <div class="md-title">Track The Shipment</div>
                        <div class="details">
                            <div class="md-body-1">Tap on carrier of your
                                Relax! we will notify you on every step taken on the shipment. Also, you can track your shipment 3live.
                            </div>
                        </div>
                    </div>
                </div>
                <img :src="'/images/uploads/tracking.jpg'" width="250" alt="">
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
import Footer from "../shared/Footer"

export default {
    name: "HomeContent",
    data: () => ({
        zip: null
    }),
    methods: {
        menuTogal() {
            this.$emit('menu-togal');
        }
    },
    components: {
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

.home-content {
    background-size: 100% 100%;

    .section1 {
        text-align: left;
        color: #fff;
        height: calc(100vh - 200px);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        margin-bottom: 83px;

        .header {
            display: flex;
            justify-content: space-between;
            color: #fff;
            align-items: center;
            padding: 0 10px;

            .md-icon {
                color: #fff;
            }

            .left {
                display: flex;
                align-items: center;

                h3 {
                    span {
                        font-family: "Segoe Script", Helvetica, Arial;
                        font-size: 20px;

                    }
                }
            }

            .right {
                display: flex;
                align-items: center;
                padding-right: 20px;

                .md-button {
                    margin: 0;
                }
            }

        }

        .content {
            .heading {
                margin: 200px 0 12px 56px;
                max-width: 500px;
                font-family: Verdana, Geneva, Tahoma, sans-serif;

                .md-display-1 {
                    line-height: 50px;
                    font-size: 36px;
                    font-weight: 600;
                    color: #fff;
                    margin-bottom: 0;
                }

                .md-subheading {
                    line-height: 0px;
                }
            }

            .order {
                background: #ffa500;
                max-width: 556px;
                height: 200px;
                display: flex;
                padding: 26px;

                .col1 {
                    flex: 80%;

                    .inputs {
                        background: #fff;
                        border: 1px solid #000;

                        .md-icon {
                            color: #c0c0c0;
                        }

                        input {
                            min-height: 30px;
                            min-width: 78%;
                            border: none;
                        }

                        input:focus {
                            outline: none;
                        }

                        button {
                            background: #000;
                            min-width: 57px !important;

                            .md-icon {
                                color: #fff;
                            }
                        }
                    }
                }

                .col2 {
                    flex: 20%;
                    text-align: right;
                    align-items: center;
                }
            }

        }

    }

    .section2 {
        padding: 30px 100px;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;

        .row {
            flex: 30%;
            padding: 30px;

            .md-title {
                line-height: 52px;
                font-weight: 600;
                line-height: 44px;
            }
        }
    }

    .steps {
        padding: 30px 100px;

        .section3 {
            padding: 0 20px;

            .row {
                display: flex;
                justify-content: space-between;

                .text {
                    flex: 40%;

                    .row1 {
                        width: 92%;
                        text-align: right;

                        .md-title {
                            text-align: left;
                            font-weight: 800;
                            line-height: 31px;
                            font-size: 24px;
                            margin-left: 55px;
                            max-width: 186px;
                        }
                    }

                    .row2 {
                        display: flex;
                        padding-left: 54px;
                        margin-right: -9px;
                        position: relative;

                        .line {
                            border-bottom: solid 2px #BFBFBF;
                            width: 100%;
                            margin-bottom: 9px;
                        }

                        .circle {
                            height: 20px;
                            width: 20px;
                            border: solid 2px #BFBFBF;
                            border-radius: 50%;
                        }
                    }

                    .row3 {
                        display: flex;
                        justify-content: space-between;

                        img {
                            flex: 10%;
                        }

                        .details {
                            flex: 100%;
                            padding-left: 13px;

                            .md-body-1 {
                                max-width: 212px;
                            }
                        }

                    }

                }

                img {
                    flex: 35%;
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
                        position: relative;
                        flex: 10%;
                        padding: 29px 10px 0 10px;
                        margin-bottom: -10px;

                        .line {
                            border-left: solid 2px #BFBFBF;
                            height: 100%;
                            margin-left: 9px;
                            min-height: 146px;
                        }

                        .circle {
                            height: 20px;
                            width: 20px;
                            border: solid 2px #BFBFBF;
                            border-radius: 50%;
                        }

                    }

                    .col3 {
                        flex: 90%;
                        display: flex;
                        justify-content: space-between;
                        flex-direction: column;
                        padding-top: 20px;

                        .md-title {
                            font-weight: 800;
                            line-height: 31px;
                            font-size: 24px;
                            max-width: 186px;
                            margin: none;
                        }

                        .details {
                            .md-body-1 {
                                max-width: 170px;
                            }
                        }

                    }
                }

                img {
                    flex: 35%;
                }

            }
        }

        .section5 {
            padding: 0 20px;

            .row {
                display: flex;
                justify-content: space-between;

                .text {
                    flex: 40%;
                    display: flex;
                    justify-content: space-between;

                    .col1 {
                        flex: 15%;
                        align-self: flex-end;

                        img {
                            width: 100%;
                        }
                    }

                    .col2 {
                        position: relative;
                        flex: 10%;
                        padding: 0 10px;
                        margin-top: -10px;
                        padding-bottom: 19px;

                        .line {
                            border-left: solid 2px #BFBFBF;
                            height: 100%;
                            margin-left: 9px;
                            min-height: 146px;
                        }

                        .circle {
                            height: 20px;
                            width: 20px;
                            border: solid 2px #BFBFBF;
                            border-radius: 50%;
                        }

                    }

                    .col3 {
                        flex: 90%;
                        display: flex;
                        justify-content: space-between;
                        flex-direction: column;
                        padding-top: 25px;

                        .md-title {
                            font-weight: 800;
                            line-height: 31px;
                            font-size: 24px;
                            max-width: 186px;
                            margin: none;
                        }

                        .details {
                            .md-body-1 {
                                max-width: 170px;
                            }
                        }

                    }
                }

                img {
                    flex: 35%;
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

} */
</style>
