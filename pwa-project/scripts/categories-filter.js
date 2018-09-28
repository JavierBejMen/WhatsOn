const typeOfFilterButton = {
    Offers: 1,
    Events: 2,
    Categorie: 3
};
const htmlDisabledAttribute = "disabled";
const htmlEmptyAttributeValue = "";
const htmlDisabledOffersClassValue = "btn-outline-success";
const htmlEnabledOffersClassValue = "btn-success";
const htmlDisabledEventsClassValue = "btn-outline-warning";
const htmlEnabledEventsClassValue = "btn-warning";

function toggleFilterButton(typeOfFilterButtonValue,htmlElement) {
    if(htmlElement.hasAttribute(htmlDisabledAttribute))
    {
        if(typeOfFilterButtonValue == typeOfFilterButton.Offers)
        {
            htmlElement.classList.remove(htmlDisabledOffersClassValue);
            htmlElement.classList.add(htmlEnabledOffersClassValue);
        }
        else if(typeOfFilterButtonValue == typeOfFilterButton.Events)
        {
            htmlElement.classList.remove(htmlDisabledEventsClassValue);
            htmlElement.classList.add(htmlEnabledEventsClassValue);
        }
        htmlElement.removeAttribute(htmlDisabledAttribute);
    }
    else
    {
        if(typeOfFilterButtonValue == typeOfFilterButton.Offers)
        {
            htmlElement.classList.remove(htmlEnabledOffersClassValue);
            htmlElement.classList.add(htmlDisabledOffersClassValue);
        }
        else if(typeOfFilterButtonValue == typeOfFilterButton.Events)
        {
            htmlElement.classList.remove(htmlEnabledEventsClassValue);
            htmlElement.classList.add(htmlDisabledEventsClassValue);
        }
        htmlElement.setAttribute(htmlDisabledAttribute,htmlEmptyAttributeValue);
    }
}