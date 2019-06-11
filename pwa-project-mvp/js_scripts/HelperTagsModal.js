class HelperTagsModal {
    static saveEnabledTagValuesFromHtmlModalFormToSessionStorage(sessionStorageKeyName) {
        sessionStorage.setItem(sessionStorageKeyName, JSON.stringify(this.getArrayOfEnabledTagValuesFromHtmlTagsModal()));
    }
    static saveTagValuesFromHtmlEventTagsInputToSessionStorage(htmlidEventTagsInput, sessionStorageKeyName) {
        sessionStorage.setItem(sessionStorageKeyName, JSON.stringify(document.getElementById(htmlidEventTagsInput).value));
    }
    static loadPreviousEnabledTagValuesFromSessionStorageToHtmlFormModal(sessionStorageKeyName) {
        let htmlTagSpans = Array.from(document.getElementsByClassName(HTML_CLASS_TAGS_MODAL_TAG_SPAN));
        let arrayOfEnabledTags = JSON.parse(sessionStorage.getItem(sessionStorageKeyName));
        if (arrayOfEnabledTags) {
            htmlTagSpans.map(htmlTagSpan => {
                (arrayOfEnabledTags.includes(htmlTagSpan.textContent)) ?
                    htmlTagSpan.removeAttribute(HTML_ATTRIBUTE_DISABLED) :
                    htmlTagSpan.setAttribute(HTML_ATTRIBUTE_DISABLED, HTML_EMPTY_STRING_VALUE);
            });
        }
        else {
            htmlTagSpans.map(htmlTagSpan => {
                htmlTagSpan.setAttribute(HTML_ATTRIBUTE_DISABLED, HTML_EMPTY_STRING_VALUE);
            });
        }
    }
    static clearEnabledTagValuesFromSessionStorage(sessionStorageKeyName) {
        sessionStorage.removeItem(sessionStorageKeyName);
    }
    static getArrayOfEnabledTagValuesFromHtmlTagsModal() {
        let arrayOfEnabledTags = new Array();
        let htmlTagSpans = Array.from(document.querySelectorAll("." + HTML_CLASS_TAGS_MODAL_TAG_SPAN + ":not([" + HTML_ATTRIBUTE_DISABLED + "])"));
        if (htmlTagSpans.length > 0) {
            htmlTagSpans.map(htmlTagSpan => {
                arrayOfEnabledTags.push(htmlTagSpan.textContent);
            });
        }
        return arrayOfEnabledTags;
    }
    static toggleTagSpanInTagsModal(htmlTagSpan) {
        if (htmlTagSpan.hasAttribute(HTML_ATTRIBUTE_DISABLED)) {
            htmlTagSpan.removeAttribute(HTML_ATTRIBUTE_DISABLED);
        }
        else {
            htmlTagSpan.setAttribute(HTML_ATTRIBUTE_DISABLED, HTML_EMPTY_STRING_VALUE);
        }
    }
}