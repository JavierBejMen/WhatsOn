const CSS_CHAR_ID_SELECTOR = "#";
const HTML_TAG_MAIN = "main";
const HTML_TAG_NAVIGATION_ITEM = "a";
const FILE_PATH_SEARCH_LOCAL_VIEW = "./views/search-local.html";
const FILE_PATH_SEARCH_LOCAL_MAP_SUBVIEW = "./views/search-local-subviews/map.html";
const FILE_PATH_SEARCH_LOCAL_CATEGORIES_SUBVIEW = "./views/search-local-subviews/categories.html";
const FILE_PATH_LOCAL_VIEW = "./views/local.html";
const FILE_PATH_LOCAL_INFO_SUBVIEW = "./views/local-subviews/info.html";
const FILE_PATH_LOCAL_PHOTOS_SUBVIEW = "./views/local-subviews/photos.html";
const HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR = "classSelectedNavigationItem";
const HTML_ID_MAIN_MENU_BAR = "idMainMenuBar";
const HTML_ID_MAIN_NAVIGATION_BAR = "idMainNavigationBar";
const HTML_ID_SEARCH_LOCAL_NAVIGATION_BAR = "idSearchLocalNavigationBar";
const HTML_ID_SEARCH_LOCAL_MAIN = "idSearchLocalMain";
const HTML_ID_LOCAL_NAVIGATION_BAR = "idLocalNavigationBar";
const HTML_ID_LOCAL_MAIN = "idLocalMain";

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
    document.getElementById(HTML_ID_MAIN_MENU_BAR).classList.add("invisible");
}
function hideMainNavigationBar() {
    document.getElementById(HTML_ID_MAIN_NAVIGATION_BAR).classList.add("invisible");
}
function showMainMenuBar() {
    document.getElementById(HTML_ID_MAIN_MENU_BAR).classList.remove("invisible");
}
function showMainNavigationBar() {
    document.getElementById(HTML_ID_MAIN_NAVIGATION_BAR).classList.remove("invisible");
}