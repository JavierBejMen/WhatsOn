const TYPE_OF_FILTER_BUTTON = {
    OFFERS_EVENTS: 0,
    CATEGORIE: 1
};
const HTML_DISABLED_ATTRIBUTE = "disabled";
const HTML_EMPTY_ATTRIBUTE_VALUE = "";
const HTML_DISABLED_OFFERS_EVENTS_CLASS_VALUE = "btn-outline-warning";
const HTML_ENABLED_OFFERS_EVENTS_CLASS_VALUE = "btn-warning";

function toggleFilterButton(typeOfFilterButtonValue,htmlElement) {
    if(htmlElement.hasAttribute(HTML_DISABLED_ATTRIBUTE))
    {
        if(typeOfFilterButtonValue == TYPE_OF_FILTER_BUTTON.OFFERS_EVENTS)
        {
            htmlElement.classList.remove(HTML_DISABLED_OFFERS_EVENTS_CLASS_VALUE);
            htmlElement.classList.add(HTML_ENABLED_OFFERS_EVENTS_CLASS_VALUE);
        }
        htmlElement.removeAttribute(HTML_DISABLED_ATTRIBUTE);
    }
    else
    {
        if(typeOfFilterButtonValue == TYPE_OF_FILTER_BUTTON.OFFERS_EVENTS)
        {
            htmlElement.classList.remove(HTML_ENABLED_OFFERS_EVENTS_CLASS_VALUE);
            htmlElement.classList.add(HTML_DISABLED_OFFERS_EVENTS_CLASS_VALUE);
        }
        htmlElement.setAttribute(HTML_DISABLED_ATTRIBUTE,HTML_EMPTY_ATTRIBUTE_VALUE);
    }
}