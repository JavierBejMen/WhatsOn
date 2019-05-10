const HTML_DISABLED_ATTRIBUTE = "disabled";
const HTML_EMPTY_ATTRIBUTE_VALUE = "";

function toggleFilterButton(htmlElement) {
    if (htmlElement.hasAttribute(HTML_DISABLED_ATTRIBUTE)) {
        htmlElement.removeAttribute(HTML_DISABLED_ATTRIBUTE);
    }
    else {
        htmlElement.setAttribute(HTML_DISABLED_ATTRIBUTE, HTML_EMPTY_ATTRIBUTE_VALUE);
    }
}