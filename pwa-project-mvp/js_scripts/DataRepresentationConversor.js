class DataRepresentationConversor {
    static DateValueFromUIStringToJsMoment(UIDate) {
        if (UIDate != HTML_EMPTY_STRING_VALUE) {
            let partsOfDate = UIDate.split(" ");
            let day = partsOfDate[1];
            day = (day.length == 1) ? ("0" + day) : day;
            let month = this.MONTHS_OF_YEAR.indexOf(partsOfDate[3]) + 1;
            month = (month < 10) ? ("0" + month) : month;
            return moment(partsOfDate[5] + "-" + month + "-" + day);
        }
        return moment();
    }
    static DateValueFromJsMomentToUIString(jsMoment) {
        if (jsMoment) {
            let resultString = jsMoment.format(JS_DATE_TIME_PICKER_DATE_STRING_FORMAT_TO_DISPLAY).toString();
            return resultString.substring(0, resultString.lastIndexOf(" "));
        }
        return HTML_EMPTY_STRING_VALUE;
    }
    static DateValueFromJsMomentToDataBaseString(jsMoment) {
        let arrayOfDateValues = jsMoment.format("L").toString().split("/");
        return arrayOfDateValues[2] + "-" + arrayOfDateValues[1] + "-" + arrayOfDateValues[0];
    }
    static TimeValueFromJsMomentToUIString(jsMoment) {
        if (jsMoment) {
            let partsOfTime = jsMoment.format(JS_DATE_TIME_PICKER_TIME_STRING_FORMAT_TO_DISPLAY).toString().split(":");
            partsOfTime[0] = (partsOfTime[0].length == 1) ? "0" + partsOfTime[0] : partsOfTime[0];
            return partsOfTime.join(":");
        }
        return HTML_EMPTY_STRING_VALUE;
    }
}
DataRepresentationConversor.MONTHS_OF_YEAR = [
    "enero", "febrero", "marzo", "abril", "mayo", "junio",
    "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
];