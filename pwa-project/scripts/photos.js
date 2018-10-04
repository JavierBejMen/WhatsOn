const HTML_ID_LOCAL_PHOTO_MODAL = "idLocalPhotoModal";
const HTML_TAG_MODAL_TITLE = "h5";
const HTML_TAG_IMAGE = "img";
const HTML_ATTRIBUTE_SRC_IMAGE = "src";
const HTML_ATTRIBUTE_ALT_IMAGE = "alt";
const HTML_ATTRIBUTE_ARIA_LABEL_IMAGE = "aria-label";

function showPhotoInLocalPhotographModal(htmlElement){
    var htmlModal = document.getElementById(HTML_ID_LOCAL_PHOTO_MODAL);
    var htmlModalImage = htmlModal.getElementsByTagName(HTML_TAG_IMAGE)[0];
    htmlModal.getElementsByTagName(HTML_TAG_MODAL_TITLE)[0].innerText = 
    htmlElement.getAttribute(HTML_ATTRIBUTE_ALT_IMAGE);
    htmlModalImage.setAttribute(HTML_ATTRIBUTE_SRC_IMAGE,htmlElement
    .getAttribute(HTML_ATTRIBUTE_SRC_IMAGE));
    htmlModalImage.setAttribute(HTML_ATTRIBUTE_ALT_IMAGE,htmlElement
    .getAttribute(HTML_ATTRIBUTE_ALT_IMAGE));
    htmlModalImage.setAttribute(HTML_ATTRIBUTE_ARIA_LABEL_IMAGE,htmlElement
    .getAttribute(HTML_ATTRIBUTE_ARIA_LABEL_IMAGE));
    $(CSS_CHAR_ID_SELECTOR + HTML_ID_LOCAL_PHOTO_MODAL).modal("show");
}