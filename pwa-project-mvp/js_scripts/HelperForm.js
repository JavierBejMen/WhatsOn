class HelperForm {
    static validateHtmlForm(htmlForm) {
        if (htmlForm.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            htmlForm.classList.add(HTML_CLASS_FORM_FIELD_WAS_VALIDATED);
        }
        else {
            htmlForm.classList.remove(HTML_CLASS_FORM_FIELD_WAS_VALIDATED);
        }
    }
    static toggleHtmlEventTicketPriceReadOnlyAndValue(htmlIdEventPrice) {
        let htmlEventTicketPrice = document.getElementById(htmlIdEventPrice);
        if (htmlFreeEntranceCheck.checked) {
            htmlEventTicketPrice.readOnly = true;
            htmlEventTicketPrice.value = 0;
        }
        else {
            htmlEventTicketPrice.readOnly = false;
            htmlEventTicketPrice.value = HTML_EMPTY_STRING_VALUE;
        }
    }
}