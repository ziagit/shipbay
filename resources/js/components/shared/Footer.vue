<template>
<div class="footer">
    <div class="cols">
        <div class="social-media">
            <div class="md-headline"><img :src="'/images/logo.svg'" alt="" width="20"> &nbsp;Shipping Tap</div>
            <div class="md-body-1">Stay in touch & get update from social media</div>
            <div class="icons">
                <a href="https://facebook.com"><img :src="'/images/uploads/facebook.svg'" alt="" width="30"></a>
                <a href="https://instagram.com"><img :src="'/images/uploads/instagram.svg'" alt="" width="30"></a>
                <a href="https://twitter.com"><img :src="'/images/uploads/twitter.svg'" alt="" width="30"></a>
            </div>
        </div>
        <div>
            <div class="md-headline">Partners</div>
            <ul>
                <li>
                    <router-link to="/">Shippers</router-link>
                </li>
                <li>
                    <router-link to="/">Carriers</router-link>
                </li>
                <li>
                    <router-link to="/help">Freight</router-link>
                </li>
                <li>
                    <router-link to="/contact">Moving</router-link>
                </li>
            </ul>
        </div>
        <div>
            <div class="md-headline">Company</div>
            <ul>
                <li>
                    <router-link to="/about">About</router-link>
                </li>
                <li>
                    <router-link to="/contact">Contact</router-link>
                </li>
                <li>
                    <router-link to="/help">Help Center</router-link>
                </li>
                <li>
                    <router-link to="/privacy-policies">Insurance Policy | </router-link>
                    <router-link to="/terms-and-conditions">Terms & Conditions</router-link>
                </li>
            </ul>
        </div>
        <div class="apps">
            <div class="md-headline">Get the app on APP store</div>
            <button class="md-button md-raised" to="https://play.google.com">Download</button>
        </div>
    </div>
    <!-- <div class="apps">
            <a href="https://play.google.com"><img :src="'/images/uploads/google-play.svg'" alt="" width="120"></a>
            <a href="https://apple.com"><img :src="'/images/uploads/apple-store.svg'" alt="" width="120"></a>
        </div>-->
    <!--   <div class="bottom">
        <span>© 2020 EG Logistics Inc.</span>
        <span><a class="terms" href="/#/terms-and-conditions">Terms & Conditions</a> | <a class="policy" href="/#/privacy-policies">Privacy Policies</a></span>
        <span>1 (800) 123-4567</span>
        <div class="social-media">
            <a href="https://facebook.com"><img :src="'/images/uploads/facebook.svg'" alt="" width="30"></a>
            <a href="https://instagram.com"><img :src="'/images/uploads/instagram.svg'" alt="" width="30"></a>
            <a href="https://twitter.com"><img :src="'/images/uploads/twitter.svg'" alt="" width="30"></a>
        </div>
    </div>-->

</div>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style lang="scss" scoped>
.md-headline {
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 26px;
}

.footer {
    .md-body-1 {
        width: 100% !important;
    }

    background: #EDF3FF;
    min-height: 150px;

    .cols {
        max-width: 1200px;
        margin: auto;
        padding: 56px 92px;
        display: flex;
        justify-content: space-around;

        .social-media {
            max-width: 206px;

            .icons {
                display: flex;
                justify-content: space-between;
                max-width: 116px;
                margin-top: 36px;

            }
        }

        ul {
            padding: 0;

            li {
                list-style: none;
                margin-bottom: 8px;
            }

            a {
                font-size: 13px;
                color: #6A6C86;

            }
        }

        .apps {
            max-width: 196px;
        }

        .md-button {
            min-width: 124px;
            color: #fff !important;
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
