const CSS_CHAR_ID_SELECTOR = "#";
const HTML_TAG_BODY = "body";
const HTML_TAG_MAIN = "main";
const HTML_TAG_NAVIGATION_ITEM = "a";
const HTML_TAG_MENU_BAR_TITLE = "h5";
const JS_EMPTY_STRING_VALUE = "";
const FILE_PATH_CATEGORIES_OF_LOCALS_VIEW = "./views/categories-of-locals.html";
const FILE_PATH_MAP_OF_LOCALS_VIEW = "./views/map-of-locals.html";
const FILE_PATH_EVENTS_VIEW = "./views/events.html";
const FILE_PATH_USER_PROFILE_VIEW = "./views/user-profile.html";
const FILE_PATH_USER_PROFILE_SETTINGS_SUBVIEW = "./views/user-profile-subviews/settings.html";
const FILE_PATH_USER_PROFILE_HELP_SUBVIEW = "./views/user-profile-subviews/help.html";
const FILE_PATH_USER_PROFILE_HELP_FAQS_SUBVIEW = "./views/user-profile-subviews/help-faqs.html";
const FILE_PATH_USER_PROFILE_HELP_FAQS_ANSWER_SUBVIEW = 
"./views/user-profile-subviews/help-faq-answer.html";
const FILE_PATH_LOCAL_VIEW = "./views/local.html";
const FILE_PATH_LOCAL_INFO_SUBVIEW = "./views/local-subviews/info.html";
const FILE_PATH_LOCAL_EVENTS_SUBVIEW = "./views/local-subviews/events.html";
const FILE_PATH_LOCAL_PHOTOS_SUBVIEW = "./views/local-subviews/photos.html";
const FILE_PATH_OFFERS_VIEW = "./views/offers.html";
const FILE_PATH_OFFERS_OFFER_FLYER_SUBVIEW = "./views/offers-subviews/offer-flyer.html";
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
const HTML_ID_CATEGORIES_FILTER_CONTAINER_IN_CATEGORIES_OF_LOCALS = 
"idCategoriesFilterContainerInCategoriesOfLocals";
const HTML_ID_CATEGORIES_FILTER_CONTAINER_IN_MAP_OF_LOCALS = 
"idCategoriesFilterContainerInMapOfLocals";
const HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_LOCAL = "idEventsWeekCalendarContainerInLocal";
const HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_ALL_EVENTS = 
"idEventsWeekCalendarContainerInAllEvents";
const HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR = "idEventsWeekCalendarNavigationBar";
const HTML_IDS_LIST_FOR_EVENTS_LISTS = ["idLocalEventsOnMonday","idLocalEventsOnTuesday",
"idLocalEventsOnWednesday","idLocalEventsOnThursday","idLocalEventsOnFriday","idLocalEventsOnSaturday",
"idLocalEventsOnSunday"];
const HTML_ID_CATEGORIES_FILTER_CONTAINER_IN_EVENTS = "idCategoriesFilterContainerInEvents";
const HTML_ID_OFFERS_MENU_BAR = "idOffersMenuBar";
const HTML_ID_OFFERS_MAIN = "idOffersMain";
const HTML_ID_OFFERS_OFFER_FLYER_MENU_BAR = "idOffersOfferFlyerMenuBar";
const HTML_ID_OFFER_FLYER_ACTION_BUTTON = "idOffersOfferFlyerActionButton";
const HTML_ID_RESERVE_OFFER_MODAL = "idReserveOfferModal";
const TEXT_LOCAL_OFFERS_MENU_BAR = "Ofertas del local";
const TEXT_MY_OFFER_FLYERS_MENU_BAR = "Mis flyers de ofertas";
const TEXT_OFFER_INFO_MENU_BAR = "Información de oferta";
const TEXT_OFFER_FLYER_MENU_BAR = "Flyer de oferta";
const TEXT_RESERVE_OFFER_BUTTON = "RESERVAR OFERTA";
const TEXT_YET_RESERVED_OFFER_BUTTON = "OFERTA RESERVADA";
const TEXT_YET_CONSUMED_OFFER_BUTTON = "OFERTA CONSUMIDA";
const TEXT_CONSUME_OFFER_BUTTON = "CONSUMIR OFERTA";
const MAIN_NAVIGATION_BAR_INDEX = {
    CATEGORIES_OF_LOCALS: 0,
    MAP_OF_LOCALS: 1,
    EVENTS: 2,
    USER_PROFILE: 3
}
const LOCAL_NAVIGATION_BAR_INDEX = {
    INFO: 0,
    EVENTS: 1,
    PHOTOS: 2
};
const OFFERS_VIEW_VARIATION = {
    LOCAL_OFFERS: 0,
    MY_OFFER_FLYERS: 1
};
const OFFER_FLYER_SUBVIEW_VARIATION = {
    RESERVE_OFFER: 0,
    CONSUME_OFFER: 1
};
var globalVarSelectedFilePathLocalSubview = LOCAL_NAVIGATION_BAR_INDEX.INFO;
var globalVarSelectedOffersViewVariation, globalVarPreviousFilePathLocalSubview, 
globalVarSelectedOfferFlyerSubviewVariation;

function setSelectedNavigationItemInNavigationBar(htmlIdNavigationBar,indexOfElement){
    var htmlNavigationBar = document.getElementById(htmlIdNavigationBar);
    if(htmlNavigationBar.getElementsByClassName(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR).length)
    {
        htmlNavigationBar.getElementsByClassName(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR)[0].
        classList.remove(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR);
    }
    htmlNavigationBar.getElementsByTagName(HTML_TAG_NAVIGATION_ITEM)[indexOfElement].classList
    .add(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR);
}
function loadMainNavigationView(filePathMainNavigationView)
{
    var selectedNavigationItemInNavigationBar;
    switch(filePathMainNavigationView)
    {
        case FILE_PATH_CATEGORIES_OF_LOCALS_VIEW:
            selectedNavigationItemInNavigationBar = MAIN_NAVIGATION_BAR_INDEX.CATEGORIES_OF_LOCALS;
            break;
        case FILE_PATH_MAP_OF_LOCALS_VIEW:
            selectedNavigationItemInNavigationBar = MAIN_NAVIGATION_BAR_INDEX.MAP_OF_LOCALS;
            break;
        case FILE_PATH_EVENTS_VIEW:
            selectedNavigationItemInNavigationBar = MAIN_NAVIGATION_BAR_INDEX.EVENTS;
            break;
        case FILE_PATH_USER_PROFILE_VIEW:
            selectedNavigationItemInNavigationBar = MAIN_NAVIGATION_BAR_INDEX.USER_PROFILE;
            break;
    }
    setSelectedNavigationItemInNavigationBar(HTML_ID_MAIN_NAVIGATION_BAR,
    selectedNavigationItemInNavigationBar);
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,filePathMainNavigationView);
}
function loadUserProfileSubview(fileUserProfileSubview)
{
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,fileUserProfileSubview);
}
function loadLocalView(filePathLocalSubview = FILE_PATH_LOCAL_INFO_SUBVIEW) {
    globalVarSelectedFilePathLocalSubview = filePathLocalSubview;
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_LOCAL_VIEW);
}
function loadLocalSubviewFromGlobalVarSelectedFilePathLocalSubview()
{
    loadLocalSubview(globalVarSelectedFilePathLocalSubview);
}
function loadLocalSubview(filePathLocalSubview)
{
    var selectedNavigationItemInNavigationBar;
    switch(filePathLocalSubview)
    {
        case FILE_PATH_LOCAL_INFO_SUBVIEW:
            selectedNavigationItemInNavigationBar = LOCAL_NAVIGATION_BAR_INDEX.INFO;
            break;
        case FILE_PATH_LOCAL_EVENTS_SUBVIEW:
            selectedNavigationItemInNavigationBar = LOCAL_NAVIGATION_BAR_INDEX.EVENTS;
            break;
        case FILE_PATH_LOCAL_PHOTOS_SUBVIEW:
            selectedNavigationItemInNavigationBar = LOCAL_NAVIGATION_BAR_INDEX.PHOTOS;
            break;
    }
    setSelectedNavigationItemInNavigationBar(HTML_ID_LOCAL_NAVIGATION_BAR,
    selectedNavigationItemInNavigationBar);
    loadHtmlFileInHtmlNodeById(HTML_ID_LOCAL_MAIN,filePathLocalSubview);
}
function loadOffersView(offersViewVariation, previousFilePathLocalSubview = JS_EMPTY_STRING_VALUE)
{
    globalVarSelectedOffersViewVariation = offersViewVariation;
    globalVarPreviousFilePathLocalSubview = previousFilePathLocalSubview;
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_OFFERS_VIEW);
}
function loadOffersViewVariationFromGlobalVarSelectedOffersViewVariation()
{
    var navigateToPreviousViewFunction, menuBarTitle, offerFlyerSubviewVariation;
    switch(globalVarSelectedOffersViewVariation)
    {
        case OFFERS_VIEW_VARIATION.LOCAL_OFFERS:
            navigateToPreviousViewFunction = function()
            {loadLocalView(globalVarPreviousFilePathLocalSubview)};
            menuBarTitle = TEXT_LOCAL_OFFERS_MENU_BAR;
            offerFlyerSubviewVariation = OFFER_FLYER_SUBVIEW_VARIATION.RESERVE_OFFER;
            break;
        case OFFERS_VIEW_VARIATION.MY_OFFER_FLYERS:
            navigateToPreviousViewFunction = function()
            {loadMainNavigationView(FILE_PATH_USER_PROFILE_VIEW)};
            menuBarTitle = TEXT_MY_OFFER_FLYERS_MENU_BAR;
            offerFlyerSubviewVariation = OFFER_FLYER_SUBVIEW_VARIATION.CONSUME_OFFER;
            break;
    }
    var htmlMenuBar = document.getElementById(HTML_ID_OFFERS_MENU_BAR);
    htmlMenuBar.getElementsByTagName(HTML_TAG_NAVIGATION_ITEM)[0].onclick = navigateToPreviousViewFunction;
    htmlMenuBar.getElementsByTagName(HTML_TAG_MENU_BAR_TITLE)[0].innerText = menuBarTitle;
    var htmlOffersItems = document.getElementById(HTML_ID_OFFERS_MAIN)
    .getElementsByClassName(HTML_CLASS_OFFERS_ITEM);
    for(offersItemsIndex = 0; offersItemsIndex < htmlOffersItems.length; offersItemsIndex++)
    {
        htmlOffersItems[offersItemsIndex].onclick = function()
        {loadOffersOfferFlyerSubview(offerFlyerSubviewVariation)};
    }
}
function loadOffersOfferFlyerSubview(offerFlyerSubviewVariation)
{
    globalVarSelectedOfferFlyerSubviewVariation = offerFlyerSubviewVariation;
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_OFFERS_OFFER_FLYER_SUBVIEW);
}
function loadOffersOfferFlyerSubviewVariationFromGlobalVarSelectedOffersViewVariation()
{
    var menuBarTitle;
    var htmlActionButton = document.getElementById(HTML_ID_OFFER_FLYER_ACTION_BUTTON);
    switch(globalVarSelectedOfferFlyerSubviewVariation)
    {
        case OFFER_FLYER_SUBVIEW_VARIATION.RESERVE_OFFER:
            menuBarTitle = TEXT_OFFER_INFO_MENU_BAR;
            actionButtonText = TEXT_RESERVE_OFFER_BUTTON;
            htmlActionButton.setAttribute(HTML_ATTRIBUTE_DATA_TOGGLE,"modal");
            htmlActionButton.setAttribute(HTML_ATTRIBUTE_DATA_TARGET,
            CSS_CHAR_ID_SELECTOR + HTML_ID_RESERVE_OFFER_MODAL);
            $(CSS_CHAR_ID_SELECTOR + HTML_ID_RESERVE_OFFER_MODAL).on('hidden.bs.modal',ReserveOffer);
            document.getElementsByClassName(HTML_CLASS_ROUNDED_BOTTOM_RIGHT_FLOATING_BUTTON)[0].classList
            .add(HTML_CLASS_INVISIBLE);
            break;
        case OFFER_FLYER_SUBVIEW_VARIATION.CONSUME_OFFER:
            menuBarTitle = TEXT_OFFER_FLYER_MENU_BAR;
            actionButtonText = TEXT_CONSUME_OFFER_BUTTON;
            htmlActionButton.onclick = ConsumeOffer;
            break;
    }
    document.getElementById(HTML_ID_OFFERS_OFFER_FLYER_MENU_BAR)
    .getElementsByTagName(HTML_TAG_MENU_BAR_TITLE)[0].innerText = menuBarTitle;
    htmlActionButton.innerText = actionButtonText;
}
function loadCategoriesFilterComponentInHtmlNodeById(htmlNodeId)
{
    loadHtmlFileInHtmlNodeById(htmlNodeId,FILE_PATH_CATEGORIES_FILTER_COMPONENT);
}
function loadEventsWeekCalendarComponentInHtmlNodeById(htmlNodeId,offsetValue) 
{
    loadHtmlFileInHtmlNodeById(htmlNodeId,FILE_PATH_EVENTS_WEEK_CALENDAR_COMPONENT);
    setScrollspyInNavigationBarById(HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR,offsetValue);
}
function loadHtmlFileInHtmlNodeByTag(htmlNodeTag,htmlFilePath) {
    $(htmlNodeTag).load(htmlFilePath);
}
function loadHtmlFileInHtmlNodeById(htmlNodeId,htmlFilePath) {
    $(CSS_CHAR_ID_SELECTOR + htmlNodeId).load(htmlFilePath);
}
function removeHtmlNodeContentById(htmlNodeId)
{
    document.getElementById(htmlNodeId).innerText = HTML_EMPTY_ATTRIBUTE_VALUE;
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
function toggleShowAndHideDescriptionButtons(htmlIdDescriptionContainer)
{
    var htmlListOfButtons = document.getElementById(htmlIdDescriptionContainer).
    getElementsByClassName(HTML_CLASS_SHOW_HIDE_DESCRIPTION_BUTTON);
    if(!htmlListOfButtons[0].classList.contains(HTML_CLASS_INVISIBLE))
    {
        htmlListOfButtons[0].classList.add(HTML_CLASS_INVISIBLE);
        htmlListOfButtons[1].classList.remove(HTML_CLASS_INVISIBLE);
    }
    else
    {
        htmlListOfButtons[1].classList.add(HTML_CLASS_INVISIBLE);
        htmlListOfButtons[0].classList.remove(HTML_CLASS_INVISIBLE);
    }
}
function fillNumericDaysOfTheMonthRowInEventsWeekCalendarNavigationBar()
{
    var listOfNumericDaysOfTheMonth = document.getElementById(HTML_ID_EVENTS_WEEK_CALENDAR_NAVIGATION_BAR)
    .getElementsByTagName(HTML_TAG_NAVIGATION_ITEM);
    var variableDate = new Date();
    variableDate.setDate(variableDate.getDate() - getTodayAsNumericDayOfTheWeek());
    for(var indexOfNumericDayOfTheWeek = 0; indexOfNumericDayOfTheWeek < 7; 
    indexOfNumericDayOfTheWeek++)
    {
        listOfNumericDaysOfTheMonth[indexOfNumericDayOfTheWeek].innerText = variableDate.getDate();
        variableDate.setDate(variableDate.getDate() + 1);
    }
}
function setIdsInEventsLists(htmlClassEventsList)
{
    var todayAsNumericDayOfTheWeek = getTodayAsNumericDayOfTheWeek();
    var eventsLists = document.getElementsByClassName(htmlClassEventsList);
    for(var indexOfEventsLists = 0; indexOfEventsLists < eventsLists.length; indexOfEventsLists++)
    {
        if((idForLocalEventsList = todayAsNumericDayOfTheWeek + indexOfEventsLists) < 7)
        {
            eventsLists[indexOfEventsLists].setAttribute(HTML_ATTRIBUTE_ID,
            HTML_IDS_LIST_FOR_EVENTS_LISTS[idForLocalEventsList]);
        }
    }
}
function getTodayAsNumericDayOfTheWeek()
{
    var today = new Date();
    return (today.getDay() > 0)?(today.getDay()-1):6;
}
function setScrollspyInNavigationBarById(htmlIdNavigationBar,offsetValue)
{
    $(HTML_TAG_BODY).scrollspy({target: CSS_CHAR_ID_SELECTOR + htmlIdNavigationBar,offset: offsetValue});
}
function ReserveOffer()
{
    var htmlOfferFlyerActionButton = document.getElementById(HTML_ID_OFFER_FLYER_ACTION_BUTTON);
    htmlOfferFlyerActionButton.innerText = TEXT_YET_RESERVED_OFFER_BUTTON;
    htmlOfferFlyerActionButton.setAttribute(HTML_DISABLED_ATTRIBUTE,HTML_EMPTY_ATTRIBUTE_VALUE);
}
function ConsumeOffer()
{
    var htmlOfferFlyerActionButton = document.getElementById(HTML_ID_OFFER_FLYER_ACTION_BUTTON);
    htmlOfferFlyerActionButton.innerText = TEXT_YET_CONSUMED_OFFER_BUTTON;
    htmlOfferFlyerActionButton.setAttribute(HTML_DISABLED_ATTRIBUTE,HTML_EMPTY_ATTRIBUTE_VALUE);
}