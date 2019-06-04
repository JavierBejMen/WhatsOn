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
    static toggleHtmlEventTicketPriceInputReadOnlyAndValue(htmlIdFreeEntranceCheckInput, htmlIdEventPriceInput) {
        let htmlEventPriceInput = document.getElementById(htmlIdEventPriceInput);
        if (document.getElementById(htmlIdFreeEntranceCheckInput).checked) {
            htmlEventPriceInput.readOnly = true;
            htmlEventPriceInput.value = 0;
        }
        else {
            htmlEventPriceInput.readOnly = false;
            htmlEventPriceInput.value = HTML_EMPTY_STRING_VALUE;
        }
    }
}