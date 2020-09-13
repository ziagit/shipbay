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
    totalDw(items) {
        let total = 0;
        items.forEach((element) => {
            total = total + element.dw;
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

};