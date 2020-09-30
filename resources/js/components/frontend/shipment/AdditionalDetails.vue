<template>
<div class="additional-details">
    <div class="header">
        <span class="md-display-1">Additional information</span>
    </div>
    <form>
        <md-field>
            <label>Estimated shipment value ($)</label>
            <md-input type="number" v-model="shipper.estimatedValue" min="1" required ref="focusable"></md-input>
        </md-field>
        <md-field>
            <label>Special instructions (optional)</label>
            <md-textarea v-model="shipper.instructions"></md-textarea>
        </md-field>
        <md-steppers md-vertical :md-active-step.sync="active">
            <md-step id="first" md-label="Sender Contacts" md-description="Required" :md-error="stepError">
                <md-field>
                    <label>Name</label>
                    <md-input type="tel" v-model="shipper.senderName" required></md-input>
                </md-field>
                <div class="row">
                    <md-field>
                        <label>Phone</label>
                        <md-input type="tel" v-model="shipper.senderPhone" @input="acceptNumber" required></md-input>
                    </md-field>
                    <md-field>
                        <label>Email</label>
                        <md-input type="email" v-model="shipper.senderEmail" required></md-input>
                        <md-icon class="md-primary">
                            info
                            <md-tooltip>Use your account email!</md-tooltip>
                        </md-icon>
                    </md-field>
                </div>
            </md-step>

            <md-step id="second" md-label="Receiver Contacts" md-description="Required" :md-error="stepError">
                <md-field>
                    <label>Name</label>
                    <md-input type="tel" v-model="shipper.receiverName" required></md-input>
                </md-field>
                <div class="row">
                    <md-field>
                        <label>Phone</label>
                        <md-input type="tel" v-model="shipper.receiverPhone" @input="acceptNumber" required></md-input>
                    </md-field>
                    <md-field>
                        <label>Email</label>
                        <md-input type="email" v-model="shipper.receiverEmail" required></md-input>
                        <md-icon class="md-primary">
                            info
                            <md-tooltip>Use your account email!</md-tooltip>
                        </md-icon>
                    </md-field>
                </div>
            </md-step>
        </md-steppers>
        <div class="action">
            <md-button to="/order/carriers" class="md-icon-button md-raised">
                <md-icon>keyboard_arrow_left</md-icon>
            </md-button>
            <md-button class="md-icon-button md-raised md-primary" @click="nextStep()" type="submit">
                <md-icon>keyboard_arrow_right</md-icon>
            </md-button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    name: "additional-details",
    data: () => ({
        shipper: {
            estimatedValue: null,
            instructions: null,
            senderName: null,
            senderPhone: null,
            senderEmail: null,
            receiverName: null,
            receiverPhone: null,
            receiverEmail: null,
        },
        active: 'first',
        first: false,
        second: false,
        stepError: null
    }),

    methods: {
        nextStep() {
            if (
                this.shipper.estimatedValue !== null &&
                this.shipper.senderName !== null &&
                this.shipper.senderPhone !== null &&
                this.shipper.senderEmail !== null &&
                this.shipper.receiverName !== null &&
                this.shipper.receiverPhone !== null &&
                this.shipper.receiverEmail !== null

            ) {
                let order = JSON.parse(localStorage.getItem("order"));
                order.shipper = this.shipper;
                localStorage.setItem("order", JSON.stringify(order));
                this.$router.push("payment-details");
            } else {
                this.stepError = "Required step!"
            }
        },

        watchLocalstorage() {
            let storage = JSON.parse(localStorage.getItem("order"));
            if (storage.shipper) {
                this.shipper.estimatedValue = storage.shipper.estimatedValue;
                this.shipper.senderName = storage.shipper.senderName
                this.shipper.senderPhone = storage.shipper.senderPhone
                this.shipper.senderEmail = storage.shipper.senderEmail
                this.shipper.receiverName = storage.shipper.receiverName
                this.shipper.receiverPhone = storage.shipper.receiverPhone
                this.shipper.receiverEmail = storage.shipper.receiverEmail
            }
        },
        acceptNumber() {
            var x = this.value
                .replace(/\D/g, "")
                .match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            this.pickDetails.phone = !x[2] ?
                x[1] :
                "(" + x[1] + ") " + x[2] + (x[3] ? "-" + x[3] : "");
        },
    },
    mounted() {
        this.$refs.focusable.$el.focus();
    },
    created() {
        this.watchLocalstorage();
        this.shipper.pickupDate = JSON.parse(
            localStorage.getItem("order")
        ).pickDate;
        localStorage.setItem("cRoute", this.$router.currentRoute.path);
    },
};
</script>

<style lang="scss" scoped>
.additional-details {
    max-width: 600px;
    margin: auto;

    .header {
        .md-display-1 {
            font-size: 24px;
        }
    }

    .pick-time {
        display: flex;
        justify-content: space-between;

        .md-field {
            width: 48%;
        }
    }

    .row {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;

        .md-field {
            flex: 50%;
        }
    }

    .md-vertical {
        background: none;
    }
}

@media only screen and (min-width: 600px) {
    .additional-details {
        .header {
            margin-top: 10px;

            .md-display-1 {
                font-size: 30px;
            }
        }
    }
}
</style>
