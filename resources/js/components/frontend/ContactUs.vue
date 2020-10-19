<template>
<div class="container">
    <md-card>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31958839.600046597!2d-128.4053053!3d60.7318475!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x537a66c7aa6b6aaf%3A0x881b41e937e7f1f9!2sBritish%20Columbia%2C%20Canada!5e0!3m2!1sen!2s!4v1603098152028!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <md-card-content>
            <div class="md-display-1">Drop us an email.</div>
            <form action="">
                <md-field>
                    <label>Email</label>
                    <md-input v-model="email" type="number"></md-input>
                </md-field>

                <md-field>
                    <label>Message</label>
                    <md-input v-model="message"></md-input>
                </md-field>

                <md-button type="submit" class="md-raised md-primary">Send</md-button>
            </form>
        </md-card-content>
    </md-card>
</div>
</template>

<script>
import axio from "axios";
export default {
    name: "ContactUs",
    data: () => ({}),
    methods: {},
};
</script>

<style lang="scss" scoped>
.container {
    padding-top: 20px;
    overflow: hidden;
    padding-bottom: 56.25%;
    position: relative;

    .md-card {
        height: calc(100vh - 100px);

        iframe {
            left: 0;
            top: 0;
            height: 60%;
            width: 100%;
            border-top-right-radius: 10px !important;
            border-top-left-radius: 10px !important;
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

@media only screen and (min-width: 600px) {
    .md-card {
        .md-display-1 {
            font-size: 30px;
        }
    }
}
</style>
