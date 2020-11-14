<template>
<div class="footer">
    <div class="rows">
        <div class="row social-media">
            <div class="md-headline"><span class="logo">Shipping</span> Tap</div>
            <div class="md-body-1">Stay in touch & get update from social media</div>
            <div class="icons">
                <a href="https://facebook.com"><img :src="'/images/uploads/facebook.svg'" alt="" width="30"></a>
                <a href="https://linkedin.com"><img :src="'/images/uploads/linkedin.svg'" alt="" width="30"></a>
                <a href="https://twitter.com"><img :src="'/images/uploads/twitter.svg'" alt="" width="30"></a>
            </div>
        </div>
        <div class="row">
            <div class="md-headline">Company</div>
            <ul>
                <li>
                    <router-link to="/about">About</router-link>
                </li>
                <li>
                    <router-link to="/">Shipper</router-link>
                </li>
                <li>
                    <router-link to="/">Carrier</router-link>
                </li>

            </ul>
        </div>
        <div class="row">
            <div class="md-headline">Support</div>
            <ul>
                <li>
                    <router-link to="/help">How it works</router-link>
                </li>
                <li>
                    <router-link to="/help">Help center</router-link>
                </li>
                <li>
                    <span>1 (800) 123-4567</span>
                </li>

            </ul>
        </div>
        <div class="row app">
            <div> <a href="https://apple.com"><img :src="'/images/uploads/apple-store.svg'" alt="" width="120"></a></div>
            <div> <a href="https://play.google.com"><img :src="'/images/uploads/google-play.svg'" alt="" width="120"></a></div>
        </div>
    </div>

    <div class="bottom">
        <span>© 2020 EG Logistics Inc. All rights reserved.</span>
        <span><a class="terms" href="/#/terms-and-conditions">Terms</a> | <a class="policy" href="/#/privacy-policies">Privacy</a></span>
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
    background: #ffa50014;
    min-height: 150px;

    .rows {
        max-width: 1200px;
        margin: auto;
        padding: 56px 92px;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;

        .social-media {

            .logo {
                font-family: "Segoe Script", Helvetica, Arial;
                font-size: 20px;
            }

            .md-body-1 {
                width: 60% !important;
            }
        }

        .row {
            flex: 25%;

            .md-headline {
                font-size: 18px;
                font-weight: 500;
                margin-bottom: 12px;
            }

            .icons {
                display: flex;
                justify-content: space-between;
                max-width: 110px;
                margin-top: 36px;

            }

            ul {
                padding: 0;
                margin: 0;

                li {
                    list-style-type: none;
                    margin-bottom: 8px;

                    a {
                        color: #21201E;
                    }
                }
            }
        }

        .app {
            flex-direction: column !important;

            div {
                margin-bottom: 10px;
            }
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

    }
}

@media only screen and (max-width: 600px) {
    .footer {
        .rows {
            padding: 46px 46px;

            .row {
                flex: 100% !important;
                margin-bottom: 26px;
            }
        }

        .bottom {
            span {
                font-size: 8px;

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
