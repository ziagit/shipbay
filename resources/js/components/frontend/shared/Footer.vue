<template>
<div class="footer" v-bind:style="{'background-image': 'url(/images/uploads/footer-background.svg)'}">
    <div class="cols">
        <div class="col">
            <div class="md-headline">Services</div>
            <ul>
                <li>
                    <router-link to="/">LTL freight shipping</router-link>
                </li>
                <li>
                    <router-link to="/">Truckload freight shipping</router-link>
                </li>
                <li>
                    <router-link to="/">Intermodal Rail shipping</router-link>
                </li>
                <li>
                    <router-link to="/">Partial truckload freight shipping</router-link>
                </li>
            </ul>
        </div>
        <div class="col">
            <div class="md-headline">Our Partners</div>
            <ul>
                <li>
                    <router-link to="/">Shippers</router-link>
                </li>
                <li>
                    <router-link to="/">Carriers</router-link>
                </li>
            </ul>
        </div>
        <div class="col app-stores">
            <img :src="'/images/uploads/google-play.svg'" alt="" width="100">
            <img :src="'/images/uploads/apple-store.svg'" alt="" width="100">
        </div>
    </div>
    <div class="bottom">
        <span>© 2020 EG Logistics Inc.</span>
        <span>Terms & Conditions | Privacy Policies</span>
        <span>1 (800) 123-4567</span>

        <div class="social-media">
            <img :src="'/images/uploads/facebook.svg'" alt="" width="30">
            <img :src="'/images/uploads/instagram.svg'" alt="" width="30">
            <img :src="'/images/uploads/twitter.svg'" alt="" width="30">
        </div>
    </div>

</div>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style lang="scss" scoped>
@media only screen and (min-width: 600px) {
    .footer {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;

        .cols {
            display: flex;
            justify-content: space-around;
            background-clip: text
        }

        .bottom {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px;
            border-top: solid 1px rgb(121, 120, 120);

            .social-media {
                display: flex;
                justify-content: space-between;

                img {
                    margin: 5px;
                }
            }

        }
    }
}

.footer {
    /*   background: #333; */
    color: #9b9b9b;
    min-height: 150px;

    /*    background-color: black;
    background-image:
        radial-gradient(white, rgba(255, 255, 255, .2) 2px, transparent 40px),
        radial-gradient(white, rgba(255, 255, 255, .15) 1px, transparent 30px),
        radial-gradient(white, rgba(255, 255, 255, .1) 2px, transparent 40px),
        radial-gradient(rgba(255, 255, 255, .4), rgba(255, 255, 255, .1) 2px, transparent 30px);
    background-size: 550px 550px, 350px 350px, 250px 250px, 150px 150px;
    background-position: 0 0, 40px 60px, 130px 270px, 70px 100px; */
    /*     background:
        radial-gradient(black 15%, transparent 16%) 0 0,
        radial-gradient(black 15%, transparent 16%) 8px 8px,
        radial-gradient(rgba(255, 255, 255, .1) 15%, transparent 20%) 0 1px,
        radial-gradient(rgba(255, 255, 255, .1) 15%, transparent 20%) 8px 9px;
    background-color: #282828;
    background-size: 16px 16px; */
    /*     background:
        linear-gradient(27deg, #151515 5px, transparent 5px) 0 5px,
        linear-gradient(207deg, #151515 5px, transparent 5px) 10px 0px,
        linear-gradient(27deg, #222 5px, transparent 5px) 0px 10px,
        linear-gradient(207deg, #222 5px, transparent 5px) 10px 5px,
        linear-gradient(90deg, #1b1b1b 10px, transparent 10px),
        linear-gradient(#1d1d1d 25%, #1a1a1a 25%, #1a1a1a 50%, transparent 50%, transparent 75%, #242424 75%, #242424);
    background-color: #131313;
    background-size: 20px 20px; */

    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;

    .cols {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 30px;

        .md-headline {
            font-size: 18px;
        }

        .col {
            padding: 30px 30px 0 30px;

            ul {
                margin: 0;
                padding-left: 15px;
                list-style: none;

                li::before {
                    content: "\2022";
                    font-weight: bold;
                    display: inline-block;
                    width: 1em;
                    margin-left: -1em;
                }

                a {
                    font-size: 13px;
                    color: #9b9b9b;

                }
            }
        }

    }

    .copyright {
        display: flex;
        justify-content: space-around;

        span {
            -webkit-background-clip: text;
            background-clip: text;

        }
    }
}

@media only screen and (max-width: 600px) {
    .footer {
        .app-stores {
            width: 100%;
            text-align: center;
        }

        .bottom {
            font-size: 8px;
            text-align: center;
            padding: 0;

            span {
                order: 2;
            }

            .social-media {
                order: 1;

                img {
                    width: 20px;
                }
            }
        }
    }
}
</style>
