const CSS_CHAR_ID_SELECTOR = "#";
const HTML_TAG_BODY = "body";
const HTML_TAG_MAIN = "main";
const HTML_TAG_NAVIGATION_ITEM = "a";
const HTML_TAG_MENU_BAR_TITLE = "h5";
const JS_EMPTY_STRING_VALUE = "";
const FILE_PATH_SERVICE_WORKER = "./service-worker.js";
const FILE_PATH_EVENTS_VIEW = "./views/events.html";
const FILE_PATH_EVENT_INFO_VIEW = "./views/event-info.html";
const FILE_PATH_LOGIN_VIEW = "./views/login.html";
const FILE_PATH_ADMIN_PANEL = "./views/admin-panel.html";
const FILE_PATH_CATEGORIES_FILTER_COMPONENT = "./components/categories-filter.html";
const FILE_PATH_EVENTS_WEEK_CALENDAR_COMPONENT = "./components/events-week-calendar.html";
const HTML_ATTRIBUTE_ID = "id";
const HTML_ATTRIBUTE_DATA_TOGGLE = "data-toggle";
const HTML_ATTRIBUTE_DATA_TARGET = "data-target";
const HTML_CLASS_TERTIARY_BACKGROUND_COLOR = "#EEEEEE";
const HTML_CLASS_INVISIBLE = "invisible";
const HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR = "classSelectedNavigationItem";
const HTML_CLASS_SHOW_HIDE_DESCRIPTION_BUTTON = "classShowHideDescriptionButton";
const HTML_CLASS_ALL_EVENTS_LIST = "classAllEventsList";
const HTML_CLASS_ROUNDED_BOTTOM_RIGHT_FLOATING_BUTTON = "classRoundedBottomRightFloatingButton";
const HTML_ID_MAIN_MENU_BAR = "idMainMenuBar";
const HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_ALL_EVENTS =
    "idEventsWeekCalendarContainerInAllEvents";
const HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR = "idEventsWeekCalendarNavigationBar";
const HTML_IDS_LIST_FOR_EVENTS_LISTS = ["idEventsOnMonday", "idEventsOnTuesday",
    "idEventsOnWednesday", "idEventsOnThursday", "idEventsOnFriday", "idEventsOnSaturday",
    "idEventsOnSunday"];
const HTML_ID_CATEGORIES_FILTER_CONTAINER_IN_EVENTS = "idCategoriesFilterContainerInEvents";

function loadEvents() {
    loadHtmlFileInHtmlElementByTag(HTML_TAG_MAIN, FILE_PATH_EVENTS_VIEW);
}
function loadEventInfoView() {
    loadHtmlFileInHtmlElementByTag(HTML_TAG_MAIN, FILE_PATH_EVENT_INFO_VIEW);
}
function loadLoginView() {
    loadHtmlFileInHtmlElementByTag(HTML_TAG_MAIN, FILE_PATH_LOGIN_VIEW);
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
function showMainMenuBar() {
    document.getElementById(HTML_ID_MAIN_MENU_BAR).classList.remove(HTML_CLASS_INVISIBLE);
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
        if ((idForEventsList = todayAsNumericDayOfTheWeek + indexOfEventsLists) < 7) {
            eventsLists[indexOfEventsLists].setAttribute(HTML_ATTRIBUTE_ID,
                HTML_IDS_LIST_FOR_EVENTS_LISTS[idForEventsList]);
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

function setBodyHtmlElementBackgroundColor(backgroundColor) {
    document.getElementsByTagName(HTML_TAG_BODY)[0].style.backgroundColor = backgroundColor;
}