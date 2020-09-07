import axios from "axios";
var order = JSON.parse(localStorage.getItem('order'))
export default {
    async checkPayment() {
        if (
            order &&
            order.id !== undefined &&
            order.billing !== undefined &&
            order.billing.status === "paid"
        ) {
            const response = await axios.get("check-payment/" + order.id)
            return response.data;
        } else {
            return false
        }
    },

};