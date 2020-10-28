<template>
<div class="footer" v-bind:style="{'background-image': 'url(/images/uploads/f.png)'}">
    <div class="cols">
        <div class="links">
            <ul>
                <li>
                    <router-link to="/">About Us</router-link>
                </li>
                <li>
                    <router-link to="/">How it Works</router-link>
                </li>
                <li>
                    <router-link to="/">Freight</router-link>
                </li>
                <li>
                    <router-link to="/">Moving</router-link>
                </li>
                <li>
                    <router-link to="/">Insurance Policy</router-link>
                </li>
            </ul>
            <ul>
                <li>
                    <router-link to="/">Shippers</router-link>
                </li>
                <li>
                    <router-link to="/">Carriers</router-link>
                </li>
                <li>
                    <router-link to="/">Help Center</router-link>
                </li>
                <li>
                    <router-link to="/">Contact</router-link>
                </li>
            </ul>
        </div>
        <div class="apps">
            <a href="https://play.google.com"><img :src="'/images/uploads/google-play.svg'" alt="" width="120"></a>
            <a href="https://apple.com"><img :src="'/images/uploads/apple-store.svg'" alt="" width="120"></a>
        </div>
    </div>
    <div class="bottom">
        <span>© 2020 EG Logistics Inc.</span>
        <span><a class="terms" href="/#/terms-and-conditions">Terms & Conditions</a> | <a class="policy" href="/#/privacy-policies">Privacy Policies</a></span>
        <span>1 (800) 123-4567</span>
        <div class="social-media">
            <a href="https://facebook.com"><img :src="'/images/uploads/facebook.svg'" alt="" width="30"></a>
            <a href="https://instagram.com"><img :src="'/images/uploads/instagram.svg'" alt="" width="30"></a>
            <a href="https://twitter.com"><img :src="'/images/uploads/twitter.svg'" alt="" width="30"></a>
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
.footer {
    /*   background: #333; */

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
    color: #fff;
    min-height: 150px;

    .cols {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        padding: 38px;

        .md-headline {
            font-size: 18px;
        }

        .links {
            flex: 60%;
            display: flex;

            ul {
                margin: 0 136px 0 30px;
                list-style: none;

                li {
                    list-style-type: none;
                    margin-bottom: 6px;
                }

                a {
                    font-size: 13px;
                    color: #fff;

                }
            }

        }

        .apps {
            display: flex;
            justify-content: space-around;
            flex-direction: column !important;
        }

    }

    .bottom {
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 10px;
        border-top: solid 0.5px #79787885;
        color: rgb(121, 120, 120);

        span {
            a {
                color: rgb(121, 120, 120);
            }
        }

        .social-media {
            display: flex;
            justify-content: space-between;

            img {
                margin: 5px;
            }
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
            flex-direction: column;

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

@media only screen and (max-width: 768px) {
    .footer {

        /*        .bottom {
            font-size: 8px;
            text-align: center;
            padding: 0;

        } */
    }
}
</style>
