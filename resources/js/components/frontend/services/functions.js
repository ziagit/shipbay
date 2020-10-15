export default {
    validDate() {
        let today = new Date();
        let year = today.getFullYear();
        let month = today.getMonth();
        month = month < 9 ? "0" + (month + 1) : month + 1;
        let day = today.getDate();
        day = day < 10 ? "0" + day : day;
        return year + "-" + month + "-" + day;
    },
    calcDw(item) {
        let x =
            ((item.length * item.width * item.height) / 166) *
            item.number;
        let y = item.weight * item.number;
        let dw = x >= y ? x : y;
        return dw;
    },
    totalWeight(items) {
        let total = 0;
        items.forEach((element) => {
            total = total + parseFloat(element.weight);
        });
        return total;
    },
    myDateFormat(date) {
        let myDate = new Date(date);
        let year = myDate.getFullYear()
        let month = myDate.getMonth()
        month = month < 9 ? "0" + (month + 1) : month + 1;
        let day = myDate.getDate()
        day = day < 10 ? "0" + day : day;
        let hours = myDate.getHours()
        hours = hours < 10 ? "0" + hours : hours;
        let minuts = myDate.getMinutes()
        minuts = minuts < 10 ? "0" + minuts : minuts;
        let ampm = hours >= 12 ? 'pm' : 'am';
        return year + "-" + month + "-" + day + " " + hours + ":" + minuts + " " + ampm;
    },

    phoneValidator(phone) {
        let pattern = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
        if (phone.match(pattern)) {
            return true;
        } else {
            return false;
        }
    },
    emailValidator(email) {
        let pattern = /(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        if (email.match(pattern)) {
            return true;
        } else {
            return false;
        }
    },

};