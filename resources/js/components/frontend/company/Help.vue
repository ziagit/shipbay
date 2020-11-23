<template>
<div class="container">
    <div class="section0">
        <Header v-on:togal-menu="$emit('togal-menu')" :scrollValue="scrollValue" />
        <div class="content">
            <div class="text">
                <div class="md-display-1">Welcome to our Help Center</div>
                <div class="md-subheading">
                    Select a user type to begin
                </div>
            </div>
            <div class="user-type">
                <div class="shipper" @click="shipper()">
                    <div>
                        <md-icon>home</md-icon>
                        <span>Shipper</span>
                    </div>
                </div>
                <div class="carrier" @click="carrier()">
                    <div>
                        <md-icon>home</md-icon>
                        <span>Carrier</span>
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
import Footer from "../../shared/Footer";
import Header from "../../shared/Header";
export default {
    name: "ContactUs",
    props: ["scrollValue"],
    data: () => ({
        form: {
            name: null,
            email: null,
            message: null,
        },
    }),
    methods: {
        shipper() {
            $router.push('/shipper-help-center')
        },
        carrier() {
            $router.push('/carrier-help-center')
        }
    },
    components: {
        Footer,
        Header,
    },
};
</script>

<style lang="scss" scoped>
.container {
    background: #fff;

    .section0 {
        min-height: 100vh;

        .content {
            text-align: center;
            align-items: center;
            padding-top: 110px;

            .text {
                max-width: 530px;
                margin: auto;

                .md-display-1 {
                    line-height: 60px;
                    font-size: 53px;
                    font-weight: 600;
                    color: #000;
                }

                .md-subheading {
                    color: #000;
                    margin: 30px 0;
                }

            }

            .user-type {
                display: flex;
                justify-content: space-around;
                max-width: 300px;
                margin: auto;

                .shipper,
                .carrier {
                    display: flex;
                    align-items: center;
                    justify-content: space-around;
                    min-width: 100px;
                    min-height: 100px;

                    padding: 10px;
                    box-shadow: rgba(0, 0, 0, 0.12) 0px 4px 16px;

                    div {}
                }

                .shipper:hover,
                .carrier:hover {
                    cursor: pointer;
                    background: #ddd;
                }
            }

        }
    }

}

@media only screen and (max-width: 600px) {
    .section0 {
        padding: 50px 10px 100px 10px !important;
    }
}
</style>
