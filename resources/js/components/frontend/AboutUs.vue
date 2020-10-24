<template>
<div class="container">
    <div class="section1" v-bind:style="{'background-image': 'url(/images/uploads/about.svg)'}">
        <div class="md-display-1">About Us</div>
        <div class="md-body-1">Meet the amazing team behind this project and find out more about how we work.</div>
    </div>
    <md-card>
        <md-card-header>
            <div class="row">
                <div class="md-headline">Shipping TAP</div>
                <div class="md-body-1">Shipping TAB was founded to create a better way for
                    people and businesses to ship freight. There were countless carriers to choose from,
                    but there was no way to compare them side by side.
                    That meant you had to either spend hours o
                    nline or on the phone, comparing rates and carriers, or just book with one carrier and hope you
                    chose the best possible option.</div>
            </div>
        </md-card-header>
        <div class="section2">
            <div class="row">
                <div>
                    <img :src="'/images/uploads/tracking.svg'" width="100" alt="">
                    <div class="md-headline">LTL freight</div>
                    <div class="md-body-1">Choose from hundreds of contract carriers with our self-service online tools or work directly with a freight expert.</div>
                    <div>
                        <md-button class="md-primary md-raised">Read More</md-button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <img :src="'/images/uploads/tracking.svg'" width="100" alt="">
                    <div class="md-headline">Truckload freight</div>
                    <div class="md-body-1">Easily ship your refrigerated, flatbed and dry van freight with our large network of contract carriers and the guidance of our freight professionals.</div>
                    <div>
                        <md-button class="md-primary md-raised">Read More</md-button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <img :src="'/images/uploads/tracking.svg'" width="100" alt="">
                    <div class="md-headline">Intermodal Rail shipping</div>
                    <div class="md-body-1">We offer real-time intermodal rates and an in-house team of experts to make your rail shipments easy.</div>
                    <div>
                        <md-button class="md-primary md-raised">Read More</md-button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <img :src="'/images/uploads/tracking.svg'" width="100" alt="">
                    <div class="md-headline">Partial Truckload freight</div>
                    <div class="md-body-1">Find a partial truckload option that fits based on your budget, transit or handling requirements.</div>
                    <div>
                        <md-button class="md-primary md-raised">Read More</md-button>
                    </div>
                </div>
            </div>
        </div>

    </md-card>
    <Footer />
</div>
</template>

<script>
import axio from "axios";
import Footer from "./shared/Footer"
export default {
    name: "ContactUs",
    data: () => ({
        form: {
            name: null,
            email: null,
            message: null,
        }
    }),
    methods: {},
    components: {
        Footer
    }
};
</script>

<style lang="scss" scoped>
.container {
    height: 100vh;

    .section1 {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        text-align: center;
        align-items: center;
        padding: 85px 200px 130px 200px;

        .md-display-1 {
            color: #fff;
            line-height: 66px;
            font-size: 36px;
        }

        .md-body-1 {
            color: #fff;
        }
    }

    .md-card {
        width: 95%;
        margin: auto;
        margin-top: -50px;
        margin-bottom: 30px;
        overflow: hidden;
        padding: 50px;

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
            display: flex;
            justify-content: space-around;
            margin-top: 30px;

            .row {
                text-align: center;
                flex: 25%;
                padding: 20px;
            }
        }
    }
}

.md-body-1 {
    width: 100% !important;
}

@media only screen and (max-width: 600px) {
    .section1 {
        padding: 50px 10px 100px 10px !important;
    }

    .md-card {
        padding: 0 !important;

        .md-card-header {
            padding: 50px 0 0 0 !important;
        }

        .section2 {
            padding: 0 !important;
            flex-direction: column;

            .row {
                .md-button {
                    margin: 30px 0 0 0;
                }
            }
        }
    }
}
</style>
