const FILE_PATH_SERVICE_WORKER = "./service-worker.js";
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
const HTML_TAG_SPAN = "span";
const HTML_ATTRIBUTE_ID = "id";
const HTML_ATTRIBUTE_DATA_TOGGLE = "data-toggle";
const HTML_ATTRIBUTE_DATA_TARGET = "data-target";
const HTML_ATTRIBUTE_HIDDEN = "hidden";
const HTML_ATTRIBUTE_DISABLED = "disabled";
const HTML_BOOTSTRAP_CLASS_BUTTON = "btn";
const HTML_BOOTSTRAP_CLASS_BUTTON_ELEGANT = "btn-elegant";
const HTML_CLASS_WHITE_BACKGROUND_COLOR = "#FFFFFF";
const HTML_CLASS_TERTIARY_BACKGROUND_COLOR = "#EEEEEE";
const HTML_CLASS_INVISIBLE = "classInvisible";
const HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR = "classSelectedNavigationItem";
const HTML_CLASS_SHOW_HIDE_DESCRIPTION_BUTTON = "classShowHideDescriptionButton";
const HTML_CLASS_EVENTS_PER_DATE_LIST = "classEventsPerDateList";
const HTML_CLASS_EVENTS_PER_DATE_EVENT_CONTAINER = "classEventsPerDateEventContainer";
const HTML_CLASS_ROUNDED_BOTTOM_RIGHT_FLOATING_BUTTON = "classRoundedBottomRightFloatingButton";
const HTML_CLASS_TAG_SPAN = "classTagSpan";
const HTML_CLASS_TAGS_MODAL_TAG_SPAN = "classTagsModalTagSpan";
const HTML_CLASS_FORM_FIELD_WAS_VALIDATED = "was-validated";
const HTML_CLASS_START_DATE_TIME_INPUT = "classStartDateTimeInput";
const HTML_CLASS_END_DATE_TIME_INPUT = "classEndDateTimeInput";
const HTML_ID_MAIN_MENU_BAR = "idMainMenuBar";
const HTML_ID_LOGIN_FORM = "idLoginForm";
const HTML_ID_CREATE_EVENT_FORM = "idCreateEventForm";
const HTML_ID_UPDATE_EVENT_FORM = "idUpdateEventForm";
const HTML_ID_EVENT_IMAGE_CONTAINER = "idEventImageContainer";
const HTML_ID_EVENT_TEMPORARY_IMAGE = "idEventTemporaryImage";
const HTML_ID_EVENT_HEADER_IMAGE_INPUT = "idEventHeaderImageInput";
const HTML_ID_ADD_EVENT_IMAGE_BUTTON = "idAddEventImageButton";
const HTML_ID_CREATE_EVENT_SHOW_MODAL_FOR_ADDING_TAGS_BUTTON = "idCreateEventShowModalForAddingTagsButton";
const HTML_ID_UPDATE_EVENT_SHOW_MODAL_FOR_ADDING_TAGS_BUTTON = "idUpdateEventShowModalForAddingTagsButton";
const HTML_ID_EVENT_TAGS_INPUT = "idEventTagsInput";
const HTML_ID_EVENT_TAGS_LIST = "idEventTagsList";
const HTML_ID_EVENT_START_DATE_TIME_BUTTON = "idEventStartDateTimeButton";
const HTML_ID_EVENT_START_DATE_INPUT = "idEventStartDateInput";
const HTML_ID_EVENT_START_TIME_INPUT = "idEventStartTimeInput";
const HTML_ID_EVENT_END_DATE_TIME_BUTTON = "idEventEndDateTimeButton";
const HTML_ID_EVENT_END_DATE_INPUT = "idEventEndDateInput";
const HTML_ID_EVENT_END_TIME_INPUT = "idEventEndTimeInput";
const HTML_ID_EVENT_TICKET_PRICE_INPUT = "idEventTicketPriceInput";
const HTML_ID_FREE_ENTRANCE_CHECK_INPUT = "idFreeEntranceCheckInput";
const HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_ALL_EVENTS =
    "idEventsWeekCalendarContainerInAllEvents";
const HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR = "idEventsWeekCalendarNavigationBar";
const HTML_ID_EVENTS_WEEK_CALENDAR_BUTTON = "idEventsWeekCalendarButton";
const HTML_IDS_LIST_FOR_EVENTS_LISTS = ["idEventsOnMonday", "idEventsOnTuesday",
    "idEventsOnWednesday", "idEventsOnThursday", "idEventsOnFriday", "idEventsOnSaturday",
    "idEventsOnSunday"];
const HTML_ID_EVENTS_SHOW_MODAL_FOR_FILTERING_TAGS_BUTTON = "idEventsShowModalForFilteringTagsButton";
const HTML_ID_TAGS_MODAL_CLOSE_BUTTON = "idTagsModalCloseButton";
const HTML_ID_TAGS_MODAL_SAVE_BUTTON = "idTagsModalSaveButton";
const HTML_ID_DATE_TIME_PICKER_WRAPPER = "idMddtpPickerWrapper";
const HTML_ID_DATE_PICKER = "mddtp-picker__date";
const HTML_ID_DATE_PICKER_CANCEL_BUTTON = "mddtp-date__cancel";
const HTML_ID_DATE_PICKER_OK_BUTTON = "mddtp-date__ok";
const HTML_ID_TIME_PICKER = "mddtp-picker__time";
const HTML_ID_TIME_PICKER_CANCEL_BUTTON = "mddtp-time__cancel";
const HTML_ID_TIME_PICKER_OK_BUTTON = "mddtp-time__ok";
const HTML_ID_EVENT_INFO_MAP_CONTAINER = "idEventInfoMapContainer";
const SESSION_STORAGE_KEY_ENABLED_TAG_VALUES = "EnabledTagValues";

function loadEventsWeekCalendarComponentInHtmlElementById(htmlElementId, offsetValue) {
    loadHtmlFileInHtmlElementById(htmlElementId, FILE_PATH_EVENTS_WEEK_CALENDAR_COMPONENT);
    setScrollspyInNavigationBarById(HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR, offsetValue);
}
function loadHtmlFileInHtmlElementById(htmlElementId, htmlFilePath) {
    $(CSS_CHAR_ID_SELECTOR + htmlElementId).load(htmlFilePath);
}
function loadUrlEventsFromDateOnwards(jsDatePicker) {
    let destinationUrl = getUrlRoot() + "?view=events&events-from-date="
        + DataRepresentationConversor.DateValueFromJsMomentToDataBaseString(jsDatePicker.time);
    window.location.assign(destinationUrl);
}
function getUrlRoot() {
    return window.location.protocol + "//" + window.location.hostname + window.location.pathname;
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
    let htmlListOfButtons = document.getElementById(htmlIdDescriptionContainer).getElementsByClassName(HTML_CLASS_SHOW_HIDE_DESCRIPTION_BUTTON);
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
    let listOfMonthDatesInCurrentWeek = Array.from(document.getElementById(HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR)
        .getElementsByTagName(HTML_TAG_NAVIGATION_ITEM));
    let variableDate = new Date();
    variableDate.setDate(variableDate.getDate() - getTodayAsNumericDayOfTheWeek());
    listOfMonthDatesInCurrentWeek.map((monthDateInCurrentWeek) => {
        monthDateInCurrentWeek.innerText = variableDate.getDate();
        variableDate.setDate(variableDate.getDate() + 1);
    });
}
function setIdsInEventsLists(htmlClassEventsList) {
    let todayAsNumericDayOfTheWeek = getTodayAsNumericDayOfTheWeek();
    let htmlEventsLists = Array.from(document.getElementsByClassName(htmlClassEventsList));
    htmlEventsLists.map((htmlEventList, indexOfEventsLists) => {
        if ((idForEventsList = todayAsNumericDayOfTheWeek + indexOfEventsLists) < 7) {
            htmlEventList.setAttribute(HTML_ATTRIBUTE_ID, HTML_IDS_LIST_FOR_EVENTS_LISTS[idForEventsList]);
        }
    });
}
function getTodayAsNumericDayOfTheWeek() {
    let today = new Date();
    return (today.getDay() > 0) ? (today.getDay() - 1) : 6;
}
function setScrollspyInNavigationBarById(htmlIdNavigationBar, offsetValue) {
    $(HTML_TAG_BODY).scrollspy({ target: CSS_CHAR_ID_SELECTOR + htmlIdNavigationBar, offset: offsetValue });
}
function setHtmlBodyBackgroundColor(backgroundColor) {
    document.getElementsByTagName(HTML_TAG_BODY)[0].style.backgroundColor = backgroundColor;
}
function showDatePickerForHtmlEventsWeekCalendarButton() {
    let startDatePicker = getDateTimePicker();
    insertHtmlDateTimePickerInHtmlDateTimePickerWrapperIfNotInserted(HTML_ID_DATE_PICKER);
    showHtmlDateTimePickerWrapper();
    startDatePicker.toggle();
    document.getElementById(HTML_ID_DATE_PICKER_CANCEL_BUTTON).addEventListener("click", () => {
        hideHtmlDateTimePickerWrapper();
    });
    document.getElementById(HTML_ID_DATE_PICKER_OK_BUTTON).addEventListener("click", () => {
        hideHtmlDateTimePickerWrapper();
        loadUrlEventsFromDateOnwards(startDatePicker);
    });
}
function showDatePicker(jsDatePicker) {
    insertHtmlDateTimePickerInHtmlDateTimePickerWrapperIfNotInserted(HTML_ID_DATE_PICKER);
    showHtmlDateTimePickerWrapper();
    jsDatePicker.toggle();
    document.getElementById(HTML_ID_DATE_PICKER_CANCEL_BUTTON).addEventListener("click", () => {
        hideHtmlDateTimePickerWrapper();
    });
}
function showTimePicker(jsTimePicker) {
    insertHtmlDateTimePickerInHtmlDateTimePickerWrapperIfNotInserted(HTML_ID_TIME_PICKER);
    jsTimePicker.toggle();
    document.getElementById(HTML_ID_TIME_PICKER_OK_BUTTON).addEventListener("click", () => {
        hideHtmlDateTimePickerWrapper();
    });
    document.getElementById(HTML_ID_TIME_PICKER_CANCEL_BUTTON).addEventListener("click", () => {
        hideHtmlDateTimePickerWrapper();
    });
}
function getDateTimePicker(startTime = moment(), dateTimePickerType = JS_DATE_TIME_PICKER_DATE_TYPE, htmlElemntForEventTrigger = null) {
    moment.locale(JS_DATE_TIME_PICKER_LOCALE);
    let dateTimePicker = new mdDateTimePicker.default({
        type: dateTimePickerType, init: startTime,
        past: moment(startTime), future: moment(startTime).add(21, "years"),
        orientation: JS_DATE_TIME_PICKER_ORIENTATION,
        ok: JS_DATE_TIME_PICKER_OK_BUTTON_TEXT, cancel: JS_DATE_TIME_PICKER_CANCEL_BUTTON_TEXT
    });
    dateTimePicker.trigger = htmlElemntForEventTrigger;
    dateTimePicker.time.locale(JS_DATE_TIME_PICKER_LOCALE);
    return dateTimePicker;
}
function createHtmlDateTimePickerWrapperInHtmlBody() {
    let datePickerWrapper = document.createElement(HTML_TAG_DIV);
    datePickerWrapper.id = HTML_ID_DATE_TIME_PICKER_WRAPPER;
    document.body.appendChild(datePickerWrapper);
}
function showHtmlDateTimePickerWrapper() {
    document.getElementById(HTML_ID_DATE_TIME_PICKER_WRAPPER).style.display = CSS_PROPERTY_DISPLAY_VALUE_INITIAL;
}
function hideHtmlDateTimePickerWrapper() {
    document.getElementById(HTML_ID_DATE_TIME_PICKER_WRAPPER).style.display = CSS_PROPERTY_DISPLAY_VALUE_NONE;
}
function insertHtmlDateTimePickerInHtmlDateTimePickerWrapperIfNotInserted(htmlDateTimePickerId) {
    if (!document.querySelector(CSS_CHAR_ID_SELECTOR + HTML_ID_DATE_TIME_PICKER_WRAPPER + " "
        + CSS_CHAR_ID_SELECTOR + htmlDateTimePickerId)) {
        document.getElementById(HTML_ID_DATE_TIME_PICKER_WRAPPER).appendChild(document.getElementById(htmlDateTimePickerId));
    }
}
function writeValuesFromDateTimePickersToDateInputAndTimeInput(jsDatePicker, htmlDateInput, jsTimePicker, htmlTimeInput) {
    htmlDateInput.value = DataRepresentationConversor.DateValueFromJsMomentToUIString(jsDatePicker.time);
    htmlTimeInput.value = DataRepresentationConversor.TimeValueFromJsMomentToUIString(jsTimePicker.time);
}
function clearHtmlEventEndDateInputAndEventEndTimeInputValues(htmlEventEndDateInput, htmlEventEndTimeInput) {
    htmlEventEndDateInput.value = HTML_EMPTY_STRING_VALUE;
    htmlEventEndTimeInput.value = HTML_EMPTY_STRING_VALUE;
}
function showHtmlEventsPerDateListsAndTheirEventContainers() {
    let htmlEventsPerDateLists = Array.from(document.getElementsByClassName(HTML_CLASS_EVENTS_PER_DATE_LIST));
    htmlEventsPerDateLists.map((eventsPerDateList) => {
        let htmlEventContainers = Array.from(eventsPerDateList.getElementsByClassName(HTML_CLASS_EVENTS_PER_DATE_EVENT_CONTAINER));
        htmlEventContainers.map((eventContainer) => {
            eventContainer.removeAttribute(HTML_ATTRIBUTE_HIDDEN);
        });
        eventsPerDateList.removeAttribute(HTML_ATTRIBUTE_HIDDEN);
    });
}
function hideHtmlEventsPerDateListsAndTheirEventContainers(arrayOfEnabledTags) {
    let htmlEventsPerDateLists = Array.from(document.getElementsByClassName(HTML_CLASS_EVENTS_PER_DATE_LIST));
    htmlEventsPerDateLists.map((htmlEventsPerDateList) => {
        let numberOfHiddenEvents = 0;
        let htmlEventContainers = Array.from(htmlEventsPerDateList.getElementsByClassName(HTML_CLASS_EVENTS_PER_DATE_EVENT_CONTAINER));
        htmlEventContainers.map((htmlEventContainer) => {
            let hideEventContainer = true;
            let htmlEventTags = Array.from(htmlEventContainer.getElementsByClassName(HTML_CLASS_TAG_SPAN));
            htmlEventTags.map((htmlEventTag) => {
                if (arrayOfEnabledTags.includes(htmlEventTag.textContent)) {
                    hideEventContainer = false;
                }
            });
            if (hideEventContainer) {
                htmlEventContainer.setAttribute(HTML_ATTRIBUTE_HIDDEN, HTML_EMPTY_STRING_VALUE);
                numberOfHiddenEvents++;
            } else {
                htmlEventContainer.removeAttribute(HTML_ATTRIBUTE_HIDDEN);
            }
        });
        (htmlEventContainers.length == numberOfHiddenEvents) ?
            htmlEventsPerDateList.setAttribute(HTML_ATTRIBUTE_HIDDEN, HTML_EMPTY_STRING_VALUE) :
            htmlEventsPerDateList.removeAttribute(HTML_ATTRIBUTE_HIDDEN);
    });
}
function fillHtmlEventTagsInputWithEnabledTagValuesFromTagsModal(htmlIdEventTagsInput) {
    let htmlEventTagsInput = document.getElementById(htmlIdEventTagsInput);
    htmlEventTagsInput.value = HTML_EMPTY_STRING_VALUE;
    htmlEventTagsInput.value = HelperTagsModal.getArrayOfEnabledTagValuesFromHtmlTagsModal().join(",");
}

function fillHtmlEventTagsListWithEnabledTagValuesFromTagsModal(htmlIdTagsList) {
    let htmlTagsList = document.getElementById(htmlIdTagsList);
    htmlTagsList.textContent = HTML_EMPTY_STRING_VALUE;
    HelperTagsModal.getArrayOfEnabledTagValuesFromHtmlTagsModal().map(tag => {
        htmlTagsList.appendChild(createHtmlEventTagSpan(tag));
    });
}
function createHtmlEventTagSpan(tagValue) {
    let resultHtmlSpan = document.createElement(HTML_TAG_SPAN);
    resultHtmlSpan.classList.add(HTML_BOOTSTRAP_CLASS_BUTTON, HTML_BOOTSTRAP_CLASS_BUTTON_ELEGANT);
    resultHtmlSpan.textContent = tagValue;
    resultHtmlSpan.disabled = true;
    return resultHtmlSpan;
}
function setHtmlEventHeaderImageInputAsBackgroundImageInHtmlEventImageContainer(htmlIdEventHeaderImageInput, htmlIdEventImageContainer) {
    let htmlEventHeaderImageInput = document.getElementById(htmlIdEventHeaderImageInput);
    if (htmlEventHeaderImageInput.files && htmlEventHeaderImageInput.files[0]) {
        let fileReader = new FileReader();
        fileReader.onload = (event) => {
            document.getElementById(htmlIdEventImageContainer).style.backgroundImage = "url('" + event.target.result + "')";
        };
        fileReader.readAsDataURL(htmlEventHeaderImageInput.files[0]);
    }
}