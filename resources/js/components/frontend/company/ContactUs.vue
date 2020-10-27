<template>
<div class="container">
    <div class="section1">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31958839.600046597!2d-128.4053053!3d60.7318475!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x537a66c7aa6b6aaf%3A0x881b41e937e7f1f9!2sBritish%20Columbia%2C%20Canada!5e0!3m2!1sen!2s!4v1603098152028!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <md-card>
        <div class="column1">
            <div class="md-headline">Drop us a line</div>
            <form action="">
                <md-field>
                    <label>Name</label>
                    <md-input v-model="name" type="number"></md-input>
                </md-field>
                <md-field>
                    <label>Email</label>
                    <md-input v-model="email" type="number"></md-input>
                </md-field>

                <md-field>
                    <label>Message</label>
                    <md-textarea v-model="message"></md-textarea>
                </md-field>

                <md-button type="submit" slot="right" class="md-raised md-primary">Send</md-button>
            </form>
        </div>
        <div class="column2">
            <div class="col1">
                <div class="md-headline">Find us at the office</div>
                <div class="md-body-1">bola bala boal</div>
            </div>
            <div class="col2">
                <div class="md-headline">Give us a ring</div>
                <div class="md-body-1">bola bala boal</div>
            </div>
            <div class="col3">
                <div class="md-headline">Legal information</div>
                <div class="md-body-1">bola bala boal</div>
            </div>
        </div>

    </md-card>
    <Footer />
</div>
</template>

<script>
import Footer from "../shared/Footer"
import axio from "axios";
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

    iframe {
        left: 0;
        top: 0;
        height: 300px !important;
        width: 100%;
    }

    .md-card {
        width: 95%;
        margin-top: -50px;
        padding: 100px;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;

        .column1 {
            flex: 70%;
            padding: 50px;

            .md-button {
                float: right;
            }
        }

        .column2 {
            flex: 30%;
            padding: 50px;

            .col1,
            .col2,
            .col3 {
                margin-bottom: 36px;
            }
        }

        .md-card-content {
            .md-display-1 {
                font-size: 24px;
            }

            form {
                display: flex;
                justify-content: flex-end;
                flex-wrap: wrap;

                :nth-child(1) {
                    flex: 40%;
                }

                :nth-child(2) {
                    flex: 60%;
                }
            }
        }
    }
}

@media only screen and (max-width: 600px) {
    .md-card {
        flex-direction: column;
        margin-bottom: 30px;
        margin: auto;
        padding: 0 !important;

        .column1 {
            text-align: center;
            align-items: center;

            .md-button {
                margin: 0;
            }
        }

        .md-display-1 {
            font-size: 30px;
        }
    }
}
</style>
