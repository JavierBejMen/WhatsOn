const FILE_PATH_SERVICE_WORKER = "./service-worker.js";
// const FILE_PATH_EVENTS_VIEW = "./views/events.html";
// const FILE_PATH_EVENT_INFO_VIEW = "./views/event-info.html";
const FILE_PATH_LOGIN_VIEW = "./views/login.html";
const FILE_PATH_ADMIN_PANEL_VIEW = "./views/admin-panel.html";
const FILE_PATH_CREATE_EVENT_VIEW = "./views/admin-panel-subviews/create-event.html";
const FILE_PATH_TAGS_FILTER_COMPONENT = "./components/tags-filter.html";
const FILE_PATH_EVENTS_WEEK_CALENDAR_COMPONENT = "./components/events-week-calendar.html";
const CSS_CHAR_ID_SELECTOR = "#";
const CSS_PROPERTY_DISPLAY_VALUE_INITIAL = "initial";
const CSS_PROPERTY_DISPLAY_VALUE_NONE = "none";
const JS_DATE_TIME_PICKER_LOCALE = "es";
const JS_DATE_TIME_PICKER_DATE_STRING_FORMAT_TO_DISPLAY = "LLLL";
const JS_DATE_TIME_PICKER_TIME_STRING_FORMAT_TO_DISPLAY = "LT";
const JS_DATE_TIME_PICKER_DATE_TYPE = "date";
const JS_DATE_TIME_PICKER_TIME_TYPE = "time";
const JS_DATE_TIME_PICKER_ORIENTATION = "PORTRAIT";
const JS_DATE_TIME_PICKER_OK_BUTTON_TEXT = "guardar";
const JS_DATE_TIME_PICKER_CANCEL_BUTTON_TEXT = "cancelar";
const JS_DATE_TIME_PICKER_ON_OK_EVENT = "onOk";
const HTML_EMPTY_STRING_VALUE = "";
const HTML_TAG_BODY = "body";
const HTML_TAG_MAIN = "main";
const HTML_TAG_DIV = "div";
const HTML_TAG_NAVIGATION_ITEM = "a";
const HTML_TAG_MENU_BAR_TITLE = "h5";
const HTML_ATTRIBUTE_ID = "id";
const HTML_ATTRIBUTE_DATA_TOGGLE = "data-toggle";
const HTML_ATTRIBUTE_DATA_TARGET = "data-target";
const HTML_ATTRIBUTE_HIDDEN = "hidden";
const HTML_ATTRIBUTE_DISABLED = "disabled";
const HTML_CLASS_WHITE_BACKGROUND_COLOR = "#FFFFFF";
const HTML_CLASS_TERTIARY_BACKGROUND_COLOR = "#EEEEEE";
const HTML_CLASS_INVISIBLE = "invisible";
const HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR = "classSelectedNavigationItem";
const HTML_CLASS_SHOW_HIDE_DESCRIPTION_BUTTON = "classShowHideDescriptionButton";
const HTML_CLASS_EVENTS_PER_DATE_LIST = "classEventsPerDateList";
const HTML_CLASS_EVENTS_PER_DATE_EVENT_CONTAINER = "classEventsPerDateEventContainer";
const HTML_CLASS_ROUNDED_BOTTOM_RIGHT_FLOATING_BUTTON = "classRoundedBottomRightFloatingButton";
const HTML_CLASS_TAG_SPAN = "classTagSpan";
const HTML_CLASS_FILTER_TAG_BUTTON = "classFilterTagButton";
const HTML_ID_MAIN_MENU_BAR = "idMainMenuBar";
const HTML_ID_EVENT_START_DATE_TIME_BUTTON = "idEventStartDateTimeButton";
const HTML_ID_EVENT_START_DATE_TEXT_INPUT = "idEventStartDateTextInput";
const HTML_ID_EVENT_START_TIME_TEXT_INPUT = "idEventStartTimeTextInput";
const HTML_ID_EVENT_END_DATE_TIME_BUTTON = "idEventEndDateTimeButton";
const HTML_ID_EVENT_END_DATE_TEXT_INPUT = "idEventEndDateTextInput";
const HTML_ID_EVENT_END_TIME_TEXT_INPUT = "idEventEndTimeTextInput";
const HTML_ID_CREATE_EVENT_BUTTON = "idCreateEventButton";
const HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_ALL_EVENTS =
    "idEventsWeekCalendarContainerInAllEvents";
const HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR = "idEventsWeekCalendarNavigationBar";
const HTML_ID_EVENTS_WEEK_CALENDAR_BUTTON = "idEventsWeekCalendarButton";
const HTML_IDS_LIST_FOR_EVENTS_LISTS = ["idEventsOnMonday", "idEventsOnTuesday",
    "idEventsOnWednesday", "idEventsOnThursday", "idEventsOnFriday", "idEventsOnSaturday",
    "idEventsOnSunday"];
// const HTML_ID_TAGS_FILTER_CONTAINER_IN_EVENTS = "idTagsFilterContainerInEvents";
const HTML_ID_FILTER_TAGS_SHOW_MODAL_BUTTON = "idFilterTagsShowModalButton";
const HTML_ID_FILTER_TAGS_HIDE_MODAL_BUTTON = "idFilterTagsHideModalButton";
const HTML_ID_FILTER_TAGS_SAVE_BUTTON = "idFilterTagsSaveButton";
const HTML_ID_DATE_TIME_PICKER_WRAPPER = "idMddtpPickerWrapper";
const HTML_ID_DATE_PICKER = "mddtp-picker__date";
const HTML_ID_DATE_PICKER_CANCEL_BUTTON = "mddtp-date__cancel";
const HTML_ID_DATE_PICKER_OK_BUTTON = "mddtp-date__ok";
const HTML_ID_TIME_PICKER = "mddtp-picker__time";
const HTML_ID_TIME_PICKER_CANCEL_BUTTON = "mddtp-time__cancel";
const HTML_ID_TIME_PICKER_OK_BUTTON = "mddtp-time__ok";
const HTML_ID_EVENT_INFO_MAP_CONTAINER = "idEventInfoMapContainer";

// function loadEvents() {
//     loadHtmlFileInHtmlElementByTag(HTML_TAG_MAIN, FILE_PATH_EVENTS_VIEW);
// }
// function loadEventInfoView() {
//     loadHtmlFileInHtmlElementByTag(HTML_TAG_MAIN, FILE_PATH_EVENT_INFO_VIEW);
// }
function loadLoginView() {
    loadHtmlFileInHtmlElementByTag(HTML_TAG_MAIN, FILE_PATH_LOGIN_VIEW);
}
function loadAdminPanelView() {
    loadHtmlFileInHtmlElementByTag(HTML_TAG_MAIN, FILE_PATH_ADMIN_PANEL_VIEW);
}
function loadCreateEventView() {
    loadHtmlFileInHtmlElementByTag(HTML_TAG_MAIN, FILE_PATH_CREATE_EVENT_VIEW);
}
// function loadTagsFilterComponentInHtmlElementById(htmlElementId) {
//     loadHtmlFileInHtmlElementById(htmlElementId, FILE_PATH_TAGS_FILTER_COMPONENT);
// }
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
    document.getElementById(htmlElementId).innerText = HTML_EMPTY_STRING_VALUE;
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
function setHtmlBodyBackgroundColor(backgroundColor) {
    document.getElementsByTagName(HTML_TAG_BODY)[0].style.backgroundColor = backgroundColor;
}
function onHtmlEventsWeekCalendarButtonClickShowDatePicker(htmlIdEventsWeekCalendarButton) {
    document.getElementById(htmlIdEventsWeekCalendarButton).addEventListener("click", function () {
        createHtmlDateTimePickerWrapperInHtmlBodyIfNotExists();
        startDatePicker = getDateTimePicker();
        insertHtmlDateTimePickerInHtmlDateTimePickerWrapper(HTML_ID_DATE_PICKER);
        showHtmlDateTimePickerWrapper();
        startDatePicker.toggle();
        onHtmlDateTimePickerButtonClickHideHtmlDateTimePickerWrapper(HTML_ID_DATE_PICKER_CANCEL_BUTTON);
        onHtmlDateTimePickerButtonClickHideHtmlDateTimePickerWrapper(HTML_ID_DATE_PICKER_OK_BUTTON);
        onHtmlDateTimePickerButtonClickLoadUrlEventsFromDateOnwards(startDatePicker, HTML_ID_DATE_PICKER_OK_BUTTON);
    });
}
function onHtmlEventStartDateTimeButtonClickShowDatePicker(htmlIdEventStartDateTimeButton, htmlIdEventStartDateTextInput) {
    document.getElementById(htmlIdEventStartDateTimeButton).addEventListener("click", function () {
        createHtmlDateTimePickerWrapperInHtmlBodyIfNotExists();
        startDatePicker = getDateTimePicker(moment(), JS_DATE_TIME_PICKER_DATE_TYPE, document.getElementById(htmlIdEventStartDateTextInput));
        insertHtmlDateTimePickerInHtmlDateTimePickerWrapper(HTML_ID_DATE_PICKER);
        showHtmlDateTimePickerWrapper();
        startDatePicker.toggle();
        onHtmlDateTimePickerButtonClickHideHtmlDateTimePickerWrapper(HTML_ID_DATE_PICKER_CANCEL_BUTTON);
    });
}
function onHtmlEventStartDateTextInputOkShowTimePicker(htmlIdEventStartDateTextInput, htmlIdEventStartTimeTextInput) {
    document.getElementById(htmlIdEventStartDateTextInput).addEventListener(JS_DATE_TIME_PICKER_ON_OK_EVENT, function () {
        startTimePicker = getDateTimePicker(moment(), JS_DATE_TIME_PICKER_TIME_TYPE, document.getElementById(htmlIdEventStartTimeTextInput));
        insertHtmlDateTimePickerInHtmlDateTimePickerWrapper(HTML_ID_TIME_PICKER);
        startTimePicker.toggle();
        onHtmlDateTimePickerButtonClickHideHtmlDateTimePickerWrapper(HTML_ID_TIME_PICKER_CANCEL_BUTTON);
        onHtmlDateTimePickerButtonClickHideHtmlDateTimePickerWrapper(HTML_ID_TIME_PICKER_OK_BUTTON);
    });
}
function onHtmlEventStartTimeTextInputOkWriteStartDateTimeValuesAndClearEndDateTimeValues(htmlIdEventStartDateTextInput,
    htmlIdEventStartTimeTextInput, htmlIdEventEndDateTextInput,
    htmlIdEventEndTimeTextInput) {
    document.getElementById(htmlIdEventStartTimeTextInput).addEventListener(JS_DATE_TIME_PICKER_ON_OK_EVENT, function () {
        writeValuesFromDateTimePickersToDateTextInputAndTimeTextInput(startDatePicker, htmlIdEventStartDateTextInput, startTimePicker,
            this.id);
        clearHtmlEventEndDateTextInputAndEventEndTimeTextInputValues(htmlIdEventEndDateTextInput, htmlIdEventEndTimeTextInput);
    });
}
function onHtmlEventEndDateTimeButtonClickShowDatePicker(htmlIdEventStartDateTextInput, htmlIdEventStartTimeTextInput,
    htmlIdEventEndDateTimeButton, htmlIdEventEndDateTextInput) {
    document.getElementById(htmlIdEventEndDateTimeButton).addEventListener("click", function () {
        if (document.getElementById(htmlIdEventStartDateTextInput).value &&
            document.getElementById(htmlIdEventStartTimeTextInput).value) {
            datePicker = getDateTimePicker(startDatePicker.time, JS_DATE_TIME_PICKER_DATE_TYPE,
                document.getElementById(htmlIdEventEndDateTextInput));
            showHtmlDateTimePickerWrapper();
            datePicker.toggle();
            onHtmlDateTimePickerButtonClickHideHtmlDateTimePickerWrapper(HTML_ID_DATE_PICKER_CANCEL_BUTTON);
        }
    });
}
function onHtmlEventEndDateTextInputOkShowTimePicker(htmlIdEventEndDateTextInput, htmlIdEventEndTimeTextInput) {
    document.getElementById(htmlIdEventEndDateTextInput).addEventListener(JS_DATE_TIME_PICKER_ON_OK_EVENT, function () {
        timePicker = getDateTimePicker(moment(), JS_DATE_TIME_PICKER_TIME_TYPE, document.getElementById(htmlIdEventEndTimeTextInput));
        timePicker.toggle();
        onHtmlDateTimePickerButtonClickHideHtmlDateTimePickerWrapper(HTML_ID_TIME_PICKER_CANCEL_BUTTON);
        onHtmlDateTimePickerButtonClickHideHtmlDateTimePickerWrapper(HTML_ID_TIME_PICKER_OK_BUTTON);
    });
}
function onHtmlEventEndTimeTextInputOkWriteEndDateTimeValues(htmlIdEventEndDateTextInput, htmlIdEventEndTimeTextInput) {
    document.getElementById(htmlIdEventEndTimeTextInput).addEventListener(JS_DATE_TIME_PICKER_ON_OK_EVENT, function () {
        writeValuesFromDateTimePickersToDateTextInputAndTimeTextInput(datePicker, htmlIdEventEndDateTextInput, timePicker, this.id);
    });
}
function getDateTimePicker(startTime = moment(), dateTimePickerType = JS_DATE_TIME_PICKER_DATE_TYPE, htmlElemntForEventTrigger = null) {
    moment.locale(JS_DATE_TIME_PICKER_LOCALE);
    var dateTimePicker = new mdDateTimePicker.default({
        type: dateTimePickerType, init: startTime,
        past: moment(startTime), future: moment(startTime).add(21, "years"),
        orientation: JS_DATE_TIME_PICKER_ORIENTATION,
        ok: JS_DATE_TIME_PICKER_OK_BUTTON_TEXT, cancel: JS_DATE_TIME_PICKER_CANCEL_BUTTON_TEXT
    });
    dateTimePicker.trigger = htmlElemntForEventTrigger;
    dateTimePicker.time.locale(JS_DATE_TIME_PICKER_LOCALE);
    return dateTimePicker;
}
function createHtmlDateTimePickerWrapperInHtmlBodyIfNotExists() {
    if (!document.getElementById(HTML_ID_DATE_TIME_PICKER_WRAPPER)) {
        var datePickerWrapper = document.createElement(HTML_TAG_DIV);
        datePickerWrapper.id = HTML_ID_DATE_TIME_PICKER_WRAPPER;
        document.body.appendChild(datePickerWrapper);
    }
}
function showHtmlDateTimePickerWrapper() {
    document.getElementById(HTML_ID_DATE_TIME_PICKER_WRAPPER).style.display = CSS_PROPERTY_DISPLAY_VALUE_INITIAL;
}
function insertHtmlDateTimePickerInHtmlDateTimePickerWrapper(htmlDateTimePickerId) {
    if (!document.querySelector(CSS_CHAR_ID_SELECTOR + HTML_ID_DATE_TIME_PICKER_WRAPPER + " "
        + CSS_CHAR_ID_SELECTOR + htmlDateTimePickerId)) {
        document.getElementById(HTML_ID_DATE_TIME_PICKER_WRAPPER).appendChild(document.getElementById(htmlDateTimePickerId));
    }
}
function onHtmlDateTimePickerButtonClickHideHtmlDateTimePickerWrapper(htmlDateTimePickerButtonId) {
    document.getElementById(htmlDateTimePickerButtonId).addEventListener("click", function () {
        document.getElementById(HTML_ID_DATE_TIME_PICKER_WRAPPER).style.display = CSS_PROPERTY_DISPLAY_VALUE_NONE;
    });
}
function onHtmlDateTimePickerButtonClickLoadUrlEventsFromDateOnwards(dateTimePicker, htmlDateTimePickerButtonId) {
    document.getElementById(htmlDateTimePickerButtonId).addEventListener("click", function () {
        var arrayOfDateValues = dateTimePicker.time.format("L").toString().split("/");
        var stringDateFrom = arrayOfDateValues[2] + "-" + arrayOfDateValues[1] + "-" + arrayOfDateValues[0];
        var destinationUrl = window.location.protocol + "//" + window.location.hostname + window.location.pathname
            + "?view=events&events-from-date=" + stringDateFrom;
        window.location.assign(destinationUrl);
    });
}
function writeValuesFromDateTimePickersToDateTextInputAndTimeTextInput(jsDatePicker, htmlIdDateTextInput, jsTimePicker, htmlIdTimeTextInput) {
    document.getElementById(htmlIdDateTextInput).value = getDateAsStringFromDatePicker(jsDatePicker);
    document.getElementById(htmlIdTimeTextInput).value = getTimeAsStringFromTimePicker(jsTimePicker);
}
function getDateAsStringFromDatePicker(jsDatePicker) {
    var resultString = jsDatePicker.time.format(JS_DATE_TIME_PICKER_DATE_STRING_FORMAT_TO_DISPLAY).toString();
    return resultString.substring(0, resultString.lastIndexOf(" "));
}
function getTimeAsStringFromTimePicker(jsTimePicker) {
    return jsTimePicker.time.format(JS_DATE_TIME_PICKER_TIME_STRING_FORMAT_TO_DISPLAY).toString();
}
function clearHtmlEventEndDateTextInputAndEventEndTimeTextInputValues(htmlIdEventEndDateTextInput, htmlIdEventEndTimeTextInput) {
    document.getElementById(htmlIdEventEndDateTextInput).value = HTML_EMPTY_STRING_VALUE;
    document.getElementById(htmlIdEventEndTimeTextInput).value = HTML_EMPTY_STRING_VALUE;
}
function showHtmlEventsPerDateListsAndTheirEventContainers() {
    var htmlEventsPerDateLists = document.getElementsByClassName(HTML_CLASS_EVENTS_PER_DATE_LIST);
    for (var htmlEventsPerDateList of htmlEventsPerDateLists) {
        var htmlEventContainers = htmlEventsPerDateList.getElementsByClassName(HTML_CLASS_EVENTS_PER_DATE_EVENT_CONTAINER);
        for (var htmlEventContainer of htmlEventContainers) {
            htmlEventContainer.removeAttribute(HTML_ATTRIBUTE_HIDDEN);
        };
        htmlEventsPerDateList.removeAttribute(HTML_ATTRIBUTE_HIDDEN);
    }
}