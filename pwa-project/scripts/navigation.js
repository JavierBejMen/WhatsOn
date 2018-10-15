const CSS_CHAR_ID_SELECTOR = "#";
const HTML_TAG_MAIN = "main";
const HTML_TAG_NAVIGATION_ITEM = "a";
const FILE_PATH_SEARCH_LOCAL_VIEW = "./views/search-local.html";
const FILE_PATH_SEARCH_LOCAL_MAP_SUBVIEW = "./views/search-local-subviews/map.html";
const FILE_PATH_SEARCH_LOCAL_CATEGORIES_SUBVIEW = "./views/search-local-subviews/categories.html";
const FILE_PATH_LOCAL_VIEW = "./views/local.html";
const FILE_PATH_LOCAL_INFO_SUBVIEW = "./views/local-subviews/info.html";
const FILE_PATH_LOCAL_EVENTS_SUBVIEW = "./views/local-subviews/events.html";
const FILE_PATH_LOCAL_PHOTOS_SUBVIEW = "./views/local-subviews/photos.html";
const HTML_CLASS_INVISIBLE = "invisible";
const HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR = "classSelectedNavigationItem";
const HTML_CLASS_SHOW_HIDE_DESCRIPTION_BUTTON = "classShowHideDescriptionButton";
const HTML_ID_MAIN_MENU_BAR = "idMainMenuBar";
const HTML_ID_MAIN_NAVIGATION_BAR = "idMainNavigationBar";
const HTML_ID_SEARCH_LOCAL_NAVIGATION_BAR = "idSearchLocalNavigationBar";
const HTML_ID_SEARCH_LOCAL_MAIN = "idSearchLocalMain";
const HTML_ID_LOCAL_NAVIGATION_BAR = "idLocalNavigationBar";
const HTML_ID_LOCAL_MAIN = "idLocalMain";
const HTML_ID_LOCAL_EVENTS_NUMERIC_DAYS_OF_MOTH_ROW = "idNumericDaysOfTheMonthRow";

function setSelectedNavigationItemInNavigationBar(htmlIdNavigationBar,indexOfElement){
    document.getElementById(htmlIdNavigationBar)
    .getElementsByTagName(HTML_TAG_NAVIGATION_ITEM)[indexOfElement].classList
    .add(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR);
}
function setNavigationItemAsSelectedInNavigationBar(htmlIdNavigationBar,htmlElement) {
    document.getElementById(htmlIdNavigationBar)
    .getElementsByClassName(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR)[0].
    classList.remove(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR);
    htmlElement.classList.add(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR);
}
function loadSearchLocalView() {
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_SEARCH_LOCAL_VIEW);
}
function loadSearchLocalMapSubview()
{
    loadHtmlFileInHtmlNodeById(HTML_ID_SEARCH_LOCAL_MAIN,FILE_PATH_SEARCH_LOCAL_MAP_SUBVIEW);
}
function loadSearchLocalCategoriesSubview()
{
    loadHtmlFileInHtmlNodeById(HTML_ID_SEARCH_LOCAL_MAIN,FILE_PATH_SEARCH_LOCAL_CATEGORIES_SUBVIEW);
}
function loadLocalView() {
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_LOCAL_VIEW);
}
function loadLocalInfoSubview() {
    loadHtmlFileInHtmlNodeById(HTML_ID_LOCAL_MAIN,FILE_PATH_LOCAL_INFO_SUBVIEW);
}
function loadLocalEventsSubview()
{
    loadHtmlFileInHtmlNodeById(HTML_ID_LOCAL_MAIN,FILE_PATH_LOCAL_EVENTS_SUBVIEW);
}
function loadLocalPhotosSubview() {
    loadHtmlFileInHtmlNodeById(HTML_ID_LOCAL_MAIN,FILE_PATH_LOCAL_PHOTOS_SUBVIEW);
}
function loadHtmlFileInHtmlNodeById(htmlNodeId,htmlFilePath) {
    $(CSS_CHAR_ID_SELECTOR + htmlNodeId).load(htmlFilePath);
}
function loadHtmlFileInHtmlNodeByTag(htmlNodeTag,htmlFilePath) {
    $(htmlNodeTag).load(htmlFilePath);
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
function fillNumericDaysOfTheMonthRowInLocalEventsNavigationBar()
{
    var listOfNumericDaysOfTheMonth = document.getElementById(HTML_ID_LOCAL_EVENTS_NUMERIC_DAYS_OF_MOTH_ROW)
    .getElementsByTagName("p");
    var today = new Date();
    var todayAsNumericDayOfTheWeek = today.getDay() - 1;
    var firstNumericDayOfTheWeek = today.getDate() - todayAsNumericDayOfTheWeek;
    for (var indexOfNumericDayOfTheWeek = 0; indexOfNumericDayOfTheWeek < 7; indexOfNumericDayOfTheWeek++)
    { 
        listOfNumericDaysOfTheMonth[indexOfNumericDayOfTheWeek].innerText = 
        firstNumericDayOfTheWeek + indexOfNumericDayOfTheWeek;
    }
}
function setCurrentNumericDayAsSelectedInLocalEventsNavigationBar()
{
    var today = new Date();
    document.getElementById(HTML_ID_LOCAL_EVENTS_NUMERIC_DAYS_OF_MOTH_ROW).
    getElementsByTagName("p")[today.getDay() - 1].classList
    .add(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR);
}