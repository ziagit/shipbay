import axios from "axios";
export default {
    async checkPayment() {
        let order = JSON.parse(localStorage.getItem('order'))
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