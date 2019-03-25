const CSS_CHAR_ID_SELECTOR = "#";
const HTML_TAG_BODY = "body";
const HTML_TAG_MAIN = "main";
const HTML_TAG_NAVIGATION_ITEM = "a";
const HTML_TAG_MENU_BAR_TITLE = "h5";
const JS_EMPTY_STRING_VALUE = "";
const FILE_PATH_SERVICE_WORKER = "./service-worker.js";
const FILE_PATH_EVENTS_VIEW = "./views/events.html";
const FILE_PATH_EVENT_INFO_VIEW = "./views/event-info.html";
const FILE_PATH_CATEGORIES_FILTER_COMPONENT = "./components/categories-filter.html";
const FILE_PATH_EVENTS_WEEK_CALENDAR_COMPONENT = "./components/events-week-calendar.html";
const HTML_ATTRIBUTE_ID = "id";
const HTML_ATTRIBUTE_DATA_TOGGLE = "data-toggle";
const HTML_ATTRIBUTE_DATA_TARGET = "data-target";
const HTML_CLASS_INVISIBLE = "invisible";
const HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR = "classSelectedNavigationItem";
const HTML_CLASS_SHOW_HIDE_DESCRIPTION_BUTTON = "classShowHideDescriptionButton";
const HTML_CLASS_LOCAL_EVENTS_LIST = "classLocalEventsList";
const HTML_CLASS_ALL_EVENTS_LIST = "classAllEventsList";
const HTML_CLASS_OFFERS_ITEM = "classOffersItem";
const HTML_CLASS_ROUNDED_BOTTOM_RIGHT_FLOATING_BUTTON = "classRoundedBottomRightFloatingButton";
const HTML_ID_MAIN_MENU_BAR = "idMainMenuBar";
const HTML_ID_MAIN_NAVIGATION_BAR = "idMainNavigationBar";
const HTML_ID_LOCAL_NAVIGATION_BAR = "idLocalNavigationBar";
const HTML_ID_LOCAL_MAIN = "idLocalMain";
const HTML_ID_LOCAL_HEADER_IMAGE = "idLocalHeaderImage";
const HTML_ID_LOCAL_FOOTER_IMAGE = "idLocalFooterImage";
const HTML_ID_CATEGORIES_FILTER_CONTAINER_IN_CATEGORIES_OF_LOCALS =
    "idCategoriesFilterContainerInCategoriesOfLocals";
const HTML_ID_CATEGORIES_FILTER_CONTAINER_IN_MAP_OF_LOCALS =
    "idCategoriesFilterContainerInMapOfLocals";
const HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_LOCAL = "idEventsWeekCalendarContainerInLocal";
const HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_ALL_EVENTS =
    "idEventsWeekCalendarContainerInAllEvents";
const HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR = "idEventsWeekCalendarNavigationBar";
const HTML_IDS_LIST_FOR_EVENTS_LISTS = ["idLocalEventsOnMonday", "idLocalEventsOnTuesday",
    "idLocalEventsOnWednesday", "idLocalEventsOnThursday", "idLocalEventsOnFriday", "idLocalEventsOnSaturday",
    "idLocalEventsOnSunday"];
const HTML_ID_CATEGORIES_FILTER_CONTAINER_IN_EVENTS = "idCategoriesFilterContainerInEvents";
const HTML_ID_OFFERS_MENU_BAR = "idOffersMenuBar";
const HTML_ID_OFFERS_MAIN = "idOffersMain";
const HTML_ID_OFFERS_OFFER_FLYER_MENU_BAR = "idOffersOfferFlyerMenuBar";
const HTML_ID_OFFER_FLYER_ACTION_BUTTON = "idOffersOfferFlyerActionButton";
const HTML_ID_RESERVE_OFFER_MODAL = "idReserveOfferModal";

function setSelectedNavigationItemInNavigationBar(htmlIdNavigationBar, indexOfElement) {
    var htmlNavigationBar = document.getElementById(htmlIdNavigationBar);
    if (htmlNavigationBar.getElementsByClassName(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR).length) {
        htmlNavigationBar.getElementsByClassName(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR)[0].
            classList.remove(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR);
    }
    htmlNavigationBar.getElementsByTagName(HTML_TAG_NAVIGATION_ITEM)[indexOfElement].classList
        .add(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR);
}
function loadEventInfoView() {
    loadHtmlFileInHtmlElementByTag(HTML_TAG_MAIN, FILE_PATH_EVENT_INFO_VIEW);
}
function loadCategoriesFilterComponentInHtmlElementById(htmlElementId) {
    loadHtmlFileInHtmlElementById(htmlElementId, FILE_PATH_CATEGORIES_FILTER_COMPONENT);
}
function loadEventsWeekCalendarComponentInHtmlElementById(htmlElementId, offsetValue) {
    loadHtmlFileInHtmlElementById(htmlElementId, FILE_PATH_EVENTS_WEEK_CALENDAR_COMPONENT);
    setScrollspyInNavigationBarById(HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR, offsetValue);
}
function loadHtmlFileInHtmlElementByTag(htmlElementTag, htmlFilePath) {
    $(htmlElementTag).load(htmlFilePath);
}
function loadHtmlFileInHtmlElementById(htmlElementId, htmlFilePath) {
    $(CSS_CHAR_ID_SELECTOR + htmlElementId).load(htmlFilePath);
}

/****************************************************************************/

function removeHtmlElementContentById(htmlElementId) {
    document.getElementById(htmlElementId).innerText = HTML_EMPTY_ATTRIBUTE_VALUE;
}
function hideMainMenuBar() {
    document.getElementById(HTML_ID_MAIN_MENU_BAR).classList.add(HTML_CLASS_INVISIBLE);
}
function hideMainNavigationBar() {
    document.getElementById(HTML_ID_MAIN_NAVIGATION_BAR).classList.add(HTML_CLASS_INVISIBLE);
}
function showMainMenuBar() {
    document.getElementById(HTML_ID_MAIN_MENU_BAR).classList.remove(HTML_CLASS_INVISIBLE);
}
function showMainNavigationBar() {
    document.getElementById(HTML_ID_MAIN_NAVIGATION_BAR).classList.remove(HTML_CLASS_INVISIBLE);
}
function toggleShowAndHideDescriptionButtons(htmlIdDescriptionContainer) {
    var htmlListOfButtons = document.getElementById(htmlIdDescriptionContainer).
        getElementsByClassName(HTML_CLASS_SHOW_HIDE_DESCRIPTION_BUTTON);
    if (!htmlListOfButtons[0].classList.contains(HTML_CLASS_INVISIBLE)) {
        htmlListOfButtons[0].classList.add(HTML_CLASS_INVISIBLE);
        htmlListOfButtons[1].classList.remove(HTML_CLASS_INVISIBLE);
    }
    else {
        htmlListOfButtons[1].classList.add(HTML_CLASS_INVISIBLE);
        htmlListOfButtons[0].classList.remove(HTML_CLASS_INVISIBLE);
    }
}
function fillNumericDaysOfTheMonthRowInEventsWeekCalendarNavigationBar() {
    var listOfNumericDaysOfTheMonth = document.getElementById(HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR)
        .getElementsByTagName(HTML_TAG_NAVIGATION_ITEM);
    var variableDate = new Date();
    variableDate.setDate(variableDate.getDate() - getTodayAsNumericDayOfTheWeek());
    for (var indexOfNumericDayOfTheWeek = 0; indexOfNumericDayOfTheWeek < 7;
        indexOfNumericDayOfTheWeek++) {
        listOfNumericDaysOfTheMonth[indexOfNumericDayOfTheWeek].innerText = variableDate.getDate();
        variableDate.setDate(variableDate.getDate() + 1);
    }
}
function setIdsInEventsLists(htmlClassEventsList) {
    var todayAsNumericDayOfTheWeek = getTodayAsNumericDayOfTheWeek();
    var eventsLists = document.getElementsByClassName(htmlClassEventsList);
    for (var indexOfEventsLists = 0; indexOfEventsLists < eventsLists.length; indexOfEventsLists++) {
        if ((idForLocalEventsList = todayAsNumericDayOfTheWeek + indexOfEventsLists) < 7) {
            eventsLists[indexOfEventsLists].setAttribute(HTML_ATTRIBUTE_ID,
                HTML_IDS_LIST_FOR_EVENTS_LISTS[idForLocalEventsList]);
        }
    }
}
function getTodayAsNumericDayOfTheWeek() {
    var today = new Date();
    return (today.getDay() > 0) ? (today.getDay() - 1) : 6;
}
function setScrollspyInNavigationBarById(htmlIdNavigationBar, offsetValue) {
    $(HTML_TAG_BODY).scrollspy({ target: CSS_CHAR_ID_SELECTOR + htmlIdNavigationBar, offset: offsetValue });
}
function reserveOffer() {
    var htmlOfferFlyerActionButton = document.getElementById(HTML_ID_OFFER_FLYER_ACTION_BUTTON);
    htmlOfferFlyerActionButton.innerText = TEXT_YET_RESERVED_OFFER_BUTTON;
    htmlOfferFlyerActionButton.setAttribute(HTML_DISABLED_ATTRIBUTE, HTML_EMPTY_ATTRIBUTE_VALUE);
}
function consumeOffer() {
    var htmlOfferFlyerActionButton = document.getElementById(HTML_ID_OFFER_FLYER_ACTION_BUTTON);
    htmlOfferFlyerActionButton.innerText = TEXT_YET_CONSUMED_OFFER_BUTTON;
    htmlOfferFlyerActionButton.setAttribute(HTML_DISABLED_ATTRIBUTE, HTML_EMPTY_ATTRIBUTE_VALUE);
}