<template>
<div class="footer">
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
            <div class="md-headline">Contacts</div>
            <ul>
                <li>
                    <router-link to="/">info@shipbay.com</router-link>
                </li>
                <li>
                    <router-link to="/">+1 (123) 234 5433</router-link>
                </li>
            </ul>
        </div>
        <div class="col">
            <div class="md-headline">Partners</div>
            <ul>
                <li>
                    <router-link to="/">Amu Cloud Technology Services</router-link>
                </li>
                <li>
                    <router-link to="/">EG</router-link>
                </li>
                <li>
                    <router-link to="/">Eadings</router-link>
                </li>
            </ul>
        </div>
    </div>
    <div class="copyright">
        <span>© 2020 ShipBay</span>
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
    background: #333;
    color: #9b9b9b;
    min-height: 150px;

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

@media only screen and (min-width: 600px) {
    .footer {
        .cols {
            display: flex;
            justify-content: space-around;
            background-clip: text
        }

    }
}
</style>
