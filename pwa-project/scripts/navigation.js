const CSS_CHAR_ID_SELECTOR = "#";
const HTML_TAG_BODY = "body";
const HTML_TAG_MAIN = "main";
const HTML_TAG_NAVIGATION_ITEM = "a";
const FILE_PATH_CATEGORIES_OF_LOCALS_VIEW = "./views/categories-of-locals.html";
const FILE_PATH_MAP_OF_LOCALS_VIEW = "./views/map-of-locals.html";
const FILE_PATH_EVENTS_VIEW = "./views/events.html";
const FILE_PATH_USER_PROFILE_VIEW = "./views/user-profile.html";
const FILE_PATH_USER_PROFILE_OFFERS_SUBVIEW = "./views/user-profile-subviews/offers.html";
const FILE_PATH_USER_PROFILE_SETTINGS_SUBVIEW = "./views/user-profile-subviews/settings.html";
const FILE_PATH_USER_PROFILE_HELP_SUBVIEW = "./views/user-profile-subviews/help.html";
const FILE_PATH_USER_PROFILE_HELP_FAQS_SUBVIEW = "./views/user-profile-subviews/help-faqs.html";
const FILE_PATH_LOCAL_VIEW = "./views/local.html";
const FILE_PATH_LOCAL_INFO_SUBVIEW = "./views/local-subviews/info.html";
const FILE_PATH_LOCAL_EVENTS_SUBVIEW = "./views/local-subviews/events.html";
const FILE_PATH_LOCAL_PHOTOS_SUBVIEW = "./views/local-subviews/photos.html";
const FILE_PATH_CATEGORIES_FILTER_COMPONENT = "./components/categories-filter.html";
const FILE_PATH_EVENTS_WEEK_CALENDAR_COMPONENT = "./components/events-week-calendar.html";
const HTML_ATTRIBUTE_ID = "id";
const HTML_CLASS_INVISIBLE = "invisible";
const HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR = "classSelectedNavigationItem";
const HTML_CLASS_SHOW_HIDE_DESCRIPTION_BUTTON = "classShowHideDescriptionButton";
const HTML_CLASS_LOCAL_EVENTS_LIST = "classLocalEventsList";
const HTML_CLASS_ALL_EVENTS_LIST = "classAllEventsList";
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
var globalVarSelectedLocalSubview = LOCAL_NAVIGATION_BAR_INDEX.INFO;

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
function loadCategoriesOfLocalsView()
{
    setSelectedNavigationItemInNavigationBar(HTML_ID_MAIN_NAVIGATION_BAR,
    MAIN_NAVIGATION_BAR_INDEX.CATEGORIES_OF_LOCALS);
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_CATEGORIES_OF_LOCALS_VIEW);
}
function loadMapOfLocalsView()
{
    setSelectedNavigationItemInNavigationBar(HTML_ID_MAIN_NAVIGATION_BAR,
    MAIN_NAVIGATION_BAR_INDEX.MAP_OF_LOCALS);
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_MAP_OF_LOCALS_VIEW);
}
function loadEventsView()
{
    setSelectedNavigationItemInNavigationBar(HTML_ID_MAIN_NAVIGATION_BAR,
    MAIN_NAVIGATION_BAR_INDEX.EVENTS);
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_EVENTS_VIEW);
}
function loadUserProfileView()
{
    setSelectedNavigationItemInNavigationBar(HTML_ID_MAIN_NAVIGATION_BAR,
    MAIN_NAVIGATION_BAR_INDEX.USER_PROFILE);
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_USER_PROFILE_VIEW);
}
function loadUserProfileOffersSubview()
{
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_USER_PROFILE_OFFERS_SUBVIEW);
}
function loadUserProfileSettingsSubview()
{
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_USER_PROFILE_SETTINGS_SUBVIEW);
}
function loadUserProfileHelpSubview()
{
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_USER_PROFILE_HELP_SUBVIEW);
}
function loadUserProfileHelpFaqs()
{
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_USER_PROFILE_HELP_FAQS_SUBVIEW);
}
function loadLocalView(localSubview = LOCAL_NAVIGATION_BAR_INDEX.INFO) {
    globalVarSelectedLocalSubview = localSubview;
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_LOCAL_VIEW);
}
function loadLocalSubviewFromGlobalVarSelectedLocalSubview()
{
    switch(globalVarSelectedLocalSubview)
    {
        default:
        case LOCAL_NAVIGATION_BAR_INDEX.INFO:
            loadLocalInfoSubview();
            break;
        case LOCAL_NAVIGATION_BAR_INDEX.EVENTS:
            loadLocalEventsSubview();
            break;
        case LOCAL_NAVIGATION_BAR_INDEX.PHOTOS:
            loadLocalPhotosSubview();
            break;
    }
}
function loadLocalInfoSubview() {
    setSelectedNavigationItemInNavigationBar(HTML_ID_LOCAL_NAVIGATION_BAR,LOCAL_NAVIGATION_BAR_INDEX.INFO);
    loadHtmlFileInHtmlNodeById(HTML_ID_LOCAL_MAIN,FILE_PATH_LOCAL_INFO_SUBVIEW);
}
function loadLocalEventsSubview()
{
    setSelectedNavigationItemInNavigationBar(HTML_ID_LOCAL_NAVIGATION_BAR,LOCAL_NAVIGATION_BAR_INDEX.EVENTS);
    loadHtmlFileInHtmlNodeById(HTML_ID_LOCAL_MAIN,FILE_PATH_LOCAL_EVENTS_SUBVIEW);
}
function loadLocalPhotosSubview() {
    setSelectedNavigationItemInNavigationBar(HTML_ID_LOCAL_NAVIGATION_BAR,LOCAL_NAVIGATION_BAR_INDEX.PHOTOS);
    loadHtmlFileInHtmlNodeById(HTML_ID_LOCAL_MAIN,FILE_PATH_LOCAL_PHOTOS_SUBVIEW);
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