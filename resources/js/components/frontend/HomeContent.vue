<template>
<div class="home-content">
    <div class="section1" v-bind:style="{'background-image': 'url(/images/home-background.png)'}">
        <div class="text">
            <div class="heading">
                <span class="md-headline">Smart Shipping!</span>
            </div>
            <div class="sub-heading">
                <span class="md-subheading">We get you shipped in 3 easy steps. Thousands happening everyday!</span>
            </div>
            <div class="help">
                <router-link to="/help" color="help">How it works ?</router-link>
            </div>
        </div>
        <div class="action">
            <md-button @click="getQuote()" class="md-default md-raised">Get a free quote </md-button>
        </div>
    </div>
    <div class="section2">
        <md-card>
            <md-card-header>
                <h3 class="md-display-1"><img :src="'/images/logo.svg'" width="50" /> ShipBay</h3>
                <div class="md-headline"> Real-time online quotes for freight shipping. </div>
                <p class="md-body-1">You will receive up-to-date freight shipping rates and be able to choose from a variety of contract carriers and transportation modes. Simply pick your price and carrier, and we’ll take care of the rest. Make freight shipping easy when you compare competitive rates from contract carriers, create BOLs and book and track shipments, all in one place.</p>
                <md-button class="md-primary md-raised" @click="getQuote()">Get Free Quotes</md-button>
            </md-card-header>
            <md-card-content>
                <div class="row">
                    <img :src="'/images/ltl.svg'" width="50" alt="">
                    <div>
                        <div class="md-headline">LTL freight</div>
                        <div class="md-body-1">Choose from hundreds of contract carriers with our self-service online tools or work directly with a freight expert.</div>
                        <div>
                            <router-link to="/">Read more...</router-link>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <img :src="'/images/tld.svg'" width="50" alt="">
                    <div>
                        <div class="md-headline">Truckload freight</div>
                        <div class="md-body-1">Easily ship your refrigerated, flatbed and dry van freight with our large network of contract carriers and the guidance of our freight professionals.</div>
                        <div>
                            <router-link to="/">Read more...</router-link>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <img :src="'/images/int.svg'" width="50" alt="">
                    <div>
                        <div class="md-headline">Intermodal Rail shipping</div>
                        <div class="md-body-1">We offer real-time intermodal rates and an in-house team of experts to make your rail shipments easy.</div>
                        <div>
                            <router-link to="/">Read more...</router-link>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <img :src="'/images/par.svg'" width="50" alt="">
                    <div>
                        <div class="md-headline">Partial Truckload freight</div>
                        <div class="md-body-1">Find a partial truckload option that fits based on your budget, transit or handling requirements.</div>
                        <div>
                            <router-link to="/">Read more...</router-link>
                        </div>
                    </div>
                </div>
            </md-card-content>
        </md-card>
    </div>

</div>
</template>

<script>
export default {
    name: "HomeContainer",
    data: () => ({}),
    methods: {
        getQuote() {
            this.$router.push("order");
        },
    },
    components: {},
};
</script>

<style lang="scss" scoped>
.home-content {
    text-align: center;
    width: 100%;
    min-height: 100%;

    .section1 {
        background-repeat: no-repeat;
        background-size: cover;
        height: calc(100vh - 100px);
        padding-top: 80px;

        .text {
            margin-left: 7px;

            .heading {
                .md-headline {
                    font-size: 2.5em;
                    color: #fff;
                }
            }

            .sub-heading {
                .md-subheading {
                    font-size: 1em;
                    line-height: 1em;
                    color: #fff;
                }
            }

            .help {
                margin-bottom: 3em;
                margin-top: 0.7em;

                a {
                    font-size: 1em;
                    color: #F9A003;
                }
            }
        }
    }

    .section2 {
        margin-top: -50px;
        padding-bottom: 30px;
        text-align: left;

        .md-card {
            .md-card-content {
                padding: 0 !important;
                background: #f0f2f58a;
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;

                .row {
                    flex: 50%;
                    padding: 20px;
                    border: solid rgba(221, 221, 221, 0.336);
                    border-width: 0.01em;
                    display: flex;
                    align-items: flex-start;

                    div {
                        margin-left: 10px;
                    }
                }
            }
        }
    }

    .md-button {
        border-radius: 5px;
        padding: 0 10px;
    }

}

@media only screen and (min-width: 600px) {
    .home-content {
        background-size: 100% 100%;
        text-align: left;

        .section1 {
            padding: 100px 200px;

            .action {
                ion-button {
                    font-size: 14px;
                }
            }
        }

        .section2 {
            .md-card-header {
                padding-left: 100px;
                padding-right: 100px;
                padding-bottom: 50px;

                .md-body-1 {
                    width: 100% !important;
                }
            }
        }

    }
}
</style>
