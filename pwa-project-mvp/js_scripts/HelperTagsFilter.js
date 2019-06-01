class HelperTagsFilter {
    static saveEnabledFilterTagButtons(sessionStorageKeyName) {
        let arrayOfEnabledFilterTags = this.getArrayOfEnabledFilterTagsValuesFromHtmlFilterTagsModal();
        if (arrayOfEnabledFilterTags.length > 0) {
            sessionStorage.setItem(sessionStorageKeyName, JSON.stringify(arrayOfEnabledFilterTags));
        }
    }
    static loadPreviousEnabledFilterTagButtons(sessionStorageKeyName) {
        let htmlFilterTagButtons = Array.from(document.getElementsByClassName(HTML_CLASS_FILTER_TAG_BUTTON));
        if (htmlFilterTagButtons.length > 0) {
            let arrayOfEnabledFilterTags = JSON.parse(sessionStorage.getItem(sessionStorageKeyName));
            htmlFilterTagButtons.map(button => {
                (arrayOfEnabledFilterTags.includes(button.textContent)) ?
                    button.removeAttribute(HTML_ATTRIBUTE_DISABLED) :
                    button.setAttribute(HTML_ATTRIBUTE_DISABLED, HTML_EMPTY_STRING_VALUE);
            });
        }
    }
    static getArrayOfEnabledFilterTagsValuesFromHtmlFilterTagsModal() {
        let arrayOfEnabledFilterTags = new Array();
        let htmlFilterTagButtons = Array.from(document.querySelectorAll("." + HTML_CLASS_FILTER_TAG_BUTTON + ":not([" + HTML_ATTRIBUTE_DISABLED + "])"));
        if (htmlFilterTagButtons.length > 0) {
            htmlFilterTagButtons.map(button => {
                arrayOfEnabledFilterTags.push(button.textContent);
            });
        }
        return arrayOfEnabledFilterTags;
    }
    static toggleFilterTagButton(htmlFilterTagButton) {
        if (htmlFilterTagButton.hasAttribute(HTML_ATTRIBUTE_DISABLED)) {
            htmlFilterTagButton.removeAttribute(HTML_ATTRIBUTE_DISABLED);
        }
        else {
            htmlFilterTagButton.setAttribute(HTML_ATTRIBUTE_DISABLED, HTML_EMPTY_STRING_VALUE);
        }
    }
}