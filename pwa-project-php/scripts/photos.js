const HTML_ID_LOCAL_PHOTO_MODAL = "idLocalPhotoModal";
const HTML_TAG_MODAL_TITLE = "h5";
const HTML_TAG_IMAGE = "img";
const HTML_ATTRIBUTE_SRC_IMAGE = "src";
const HTML_ATTRIBUTE_ALT_IMAGE = "alt";
const HTML_ATTRIBUTE_ARIA_LABEL_IMAGE = "aria-label";
const HTML_CLASS_MODAL_CONTENT = "modal-content";
const HTML_CLASS_MODAL_TITLE = "modal-title";
const HTML_CLASS_MODAL_CLOSE_BUTTON = "close";

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

function addLightboxEventOnClickImages()
{
    document.querySelectorAll(HTML_TAG_NAVIGATION_ITEM + '[' + HTML_ATTRIBUTE_DATA_TOGGLE 
    + '="lightbox"]').forEach(function(htmlElement)
    {
        htmlElement.addEventListener("click", function()
        {
            event.preventDefault();
            $(this).ekkoLightbox(
            {
                wrapping: false,
                alwaysShowClose: true
            });
            modifyLightboxModal()
        });
    });
}

function modifyLightboxModal()
{
    var modalDiv = document.querySelector("div[" + HTML_ATTRIBUTE_ID + "*=ekkoLightbox]");
    modalDiv.getElementsByClassName(HTML_CLASS_MODAL_CONTENT)[0]
    .classList.add("bg-dark","text-light");
    modalDiv.getElementsByClassName(HTML_CLASS_MODAL_CLOSE_BUTTON)[0]
    .classList.add("text-light");
    modalDiv.getElementsByClassName("modal-dialog")[0].classList.add("modal-fluid");
    var modalOldTitle = modalDiv.getElementsByClassName(HTML_CLASS_MODAL_TITLE)[0];
    var modalNewtitle = document.createElement(HTML_TAG_MENU_BAR_TITLE);
    modalNewtitle.classList.add(HTML_CLASS_MODAL_TITLE);
    modalNewtitle.text = modalOldTitle.text;
    var modalTitleParent = modalOldTitle.parentNode;
    modalTitleParent.insertBefore(modalNewtitle,modalTitleParent.firstChild);
    modalOldTitle.remove();
}