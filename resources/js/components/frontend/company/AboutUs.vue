<template>
<div class="container">
    <div class="section0" v-bind:style="{'background-image': 'url(/images/uploads/about.jpg)'}">
        <Header v-on:togal-menu="$emit('togal-menu')" />
        <div class="content">
            <div class="md-display-1">About Us</div>
            <div class="md-subheading">From the start, everything we've done has centered on solving customer problems through technology.</div>
        </div>
    </div>

    <div class="section1">
        <div class="rows">
            <div class="left">
                <div>
                    <div class="md-headline">Shipping TAP Mission</div>

                    <img :src="'/images/uploads/mission1.jpg'" alt="">
                    <div class="md-body-1">
                        Shipping TAB was founded to create a better way for people and businesses to ship freight.
                        There were countless carriers to choose from, but there was no way to compare them side by side.
                        That meant you had to either spend hours online or on the phone, comparing rates and carriers, or
                        just book with one carrier and hope you chose the best possible option.
                        <br><br>
                        We were the first to solve this dilemma by developing our own patented technology.
                        It disrupted the freight industry and forever changed how people and businesses ship freight.
                        <br><br>
                        Today, we’ve quoted more than 50 million shipments, delivering to virtually every corner of North America.
                        <br><br>
                        We can serve multitudes of customers and still maintain the highest standards of service because we’ve committed,
                        from the start, to integrating technology and powerful data analytics into everything we do. From the backend that
                        gathers and organizes quotes to the self-service online tools that give you all the information you need to manage
                        freight like a pro, our business is designed to serve yours.
                        <br><br>
                        Watch below to see how our online self-serve shipping experience streamlines processes.
                        This technology is built with small business customers in mind, making shipping even easier.
                        <br><br>
                    </div>
                </div>
                <div>
                    <div class="md-headline">Services That We Provide</div>
                    <img :src="'/images/uploads/mission1.jpg'" alt="">
                    <div class="md-body-1">
                        Technology alone can’t solve every problem. That’s why we also have highly trained shipping experts
                        who are ready to answer any question, at any time – this experienced team is the primary reason we are able
                        to maintain our A+ Better Business Bureau rating year after year.
                        <br><br>
                        So whether you’re an experienced or novice shipper, we have the tools and experts to help you plan and
                        execute complex or simple shipping solutions. The service our technology and people make possible gained the attention
                        of global 3PL powerhouse, C.H. Robinson. Since that relationship began, the combination of C.H. Robinson’s experience and
                        network has been a perfect fit with Freightquote’s nimble, technology-driven culture.
                        <br><br>
                    </div>
                </div>
                <div>
                    <div class="md-headline">Our Team</div>
                    <img :src="'/images/uploads/mission1.jpg'" alt="">
                    <div class="md-body-1">
                        Technology alone can’t solve every problem. That’s why we also have highly trained shipping experts
                        who are ready to answer any question, at any time – this experienced team is the primary reason we are able
                        to maintain our A+ Better Business Bureau rating year after year.
                        <br><br>
                        So whether you’re an experienced or novice shipper, we have the tools and experts to help you plan and
                        execute complex or simple shipping solutions. The service our technology and people make possible gained the attention
                        of global 3PL powerhouse, C.H. Robinson. Since that relationship began, the combination of C.H. Robinson’s experience and
                        network has been a perfect fit with Freightquote’s nimble, technology-driven culture.
                        <br><br>
                    </div>
                </div>

            </div>
            <div class="right">
                <div class="qoute">
                    <div class="md-headline">Get a Free Shipping Qoute</div>
                    <form action="">
                        <md-field>
                            <label>City/Zip code</label>
                            <md-input type="text" v-model="form.city" required></md-input>
                        </md-field>

                        <div class="action">
                            <md-button class="md-primary md-raised" to="/order">Start</md-button>
                        </div>
                    </form>
                </div>
                <div class="faq">
                    <div class="md-headline">FAQ</div>
                    <div class="md-body-1">Access knowledge from experts willing to share.</div>
                    <div>
                        <router-link to="/faq">Answers</router-link>
                        <md-icon>keyboard_arrow_right</md-icon>
                    </div>
                </div>
                <div class="terms">
                    <div class="md-headline">Terms and Conditions</div>
                    <div class="md-body-1">Read our terms and conditions</div>
                    <div>
                        <router-link to="/terms-and-conditions">More</router-link>
                        <md-icon>keyboard_arrow_right</md-icon>
                    </div>
                </div>
                <div class="privacy">
                    <div class="md-headline">Privacy Policies</div>
                    <div class="md-body-1">Do you want to know about our privacies?</div>
                    <div>
                        <router-link to="/privacy-policies">More</router-link>
                        <md-icon>keyboard_arrow_right</md-icon>
                    </div>
                </div>
                <div class="get-qoute">
                    <div class="md-headline">Contact us</div>
                    <div class="md-body-1">If you want to know more about us, drop us an email.</div>
                    <div>
                        <router-link to="/contact">Contact us</router-link>
                        <md-icon>keyboard_arrow_right</md-icon>
                    </div>
                </div>
                <div class="download-app">
                    <div class="md-headline">Download Our Application</div>
                    <div class="md-body-1">By downloading our application the task will be much easier.</div>
                    <div>
                        <md-button class="md-raised" to="https://play.google.com">Download</md-button>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <Footer />
</div>
</template>

<script>
import axio from "axios";
import Footer from "../../shared/Footer"
import Header from "../../shared/Header"
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
        Footer,
        Header,
    }
};
</script>

<style lang="scss" scoped>
.container {
    .section0 {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        align-items: center;

        .content {
            padding: 85px 200px 130px 106px;

            .md-display-1 {
                line-height: 60px;
                font-size: 53px;
                font-weight: 600;
                color: #fff;
            }

            .md-subheading {
                color: #fff;
                max-width: 70%;
            }
        }
    }

    .section1 {
        max-width: 1200px;
        margin: auto;
        padding: 30px;

        .rows {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;

            .left {
                flex: 70%;
                padding: 20px;

                .md-display-1 {
                    line-height: 80px;
                }

                img {
                    margin: 10px 0;
                }
            }

            .right {
                flex: 25%;
                padding: 20px;

                .md-headline {
                    font-size: 18px;
                }

                .md-icon {
                    color: #66A9FB;
                }

                .qoute {
                    background: #fff;
                    padding: 10px;
                    border-radius: 8px;
                    box-shadow: 0 1px 2px #11111142;
                    margin-bottom: 20px;

                    .action {
                        text-align: right;
                    }
                }

                .get-qoute,
                .download-app,
                .privacy,
                .terms {
                    margin-bottom: 20px;
                }

                .app {
                    .md-button {
                        margin-top: 20px;
                    }
                }
            }
        }

    }

}

@media only screen and (max-width: 600px) {
    .section0 {
        padding: 50px 10px 100px 10px !important;
    }

    .md-card {
        padding: 0 !important;

        .md-card-header {
            padding: 50px 0 0 0 !important;
            max-width: 78% !important;
        }

        .section1 {
            padding: 0 !important;

            .rows {
                flex-direction: column;

                .md-button {
                    margin: 30px 0 0 0;
                }
            }
        }
    }
}
</style>
