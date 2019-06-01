class HelperLogin {
    static validateHtmlLoginForm(htmlLoginForm) {
        if (htmlLoginForm.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            htmlLoginForm.classList.add(HTML_CLASS_FORM_FIELD_WAS_VALIDATED);
        }
        else {
            htmlLoginForm.classList.remove(HTML_CLASS_FORM_FIELD_WAS_VALIDATED);
        }
    }
}