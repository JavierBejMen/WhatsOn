function onHtmlFilterTagsShowModalButtonClickSaveDisabledFilterTagButtons(htmlIdFilterTagsShowModalButton) {
    document.getElementById(htmlIdFilterTagsShowModalButton).addEventListener("click", function () {
        arrayOfDisabledFilterTags = new Array();
        var htmlFilterTagButtons = document.querySelectorAll("." + HTML_CLASS_FILTER_TAG_BUTTON + "[" + HTML_ATTRIBUTE_DISABLED + "]");
        if (htmlFilterTagButtons.length > 0) {
            for (var htmlFilterTagButton of htmlFilterTagButtons) {
                arrayOfDisabledFilterTags.push(htmlFilterTagButton.textContent);
            };
        }
    });
}
function onHtmlFilterTagsCloseModalButtonClickLoadPreviousDisabledFilterTagButtons(htmlIdFilterTagsClodeModelButton) {
    document.getElementById(HTML_ID_FILTER_TAGS_HIDE_MODAL_BUTTON).addEventListener("click", function () {
        var htmlFilterTagButtons = document.getElementsByClassName(HTML_CLASS_FILTER_TAG_BUTTON);
        if (htmlFilterTagButtons.length > 0) {
            for (var htmlFilterTagButton of htmlFilterTagButtons) {
                (arrayOfDisabledFilterTags.includes(htmlFilterTagButton.textContent)) ?
                    htmlFilterTagButton.setAttribute(HTML_ATTRIBUTE_DISABLED, HTML_EMPTY_STRING_VALUE) :
                    htmlFilterTagButton.removeAttribute(HTML_ATTRIBUTE_DISABLED);
            };
        }
    });
}
function toggleFilterButton(htmlElement) {
    if (htmlElement.hasAttribute(HTML_ATTRIBUTE_DISABLED)) {
        htmlElement.removeAttribute(HTML_ATTRIBUTE_DISABLED);
    }
    else {
        htmlElement.setAttribute(HTML_ATTRIBUTE_DISABLED, HTML_EMPTY_STRING_VALUE);
    }
}