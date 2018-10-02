
const CSS_CHAR_ID_SELECTOR = "#";
const FILE_PATH_MAP_VIEW = "./views/map.html";
const FILE_PATH_CATEGORIES_VIEW = "./views/categories.html";
const FILE_PATH_LOCAL_VIEW = "./views/local.html";
const FILE_PATH_LOCAL_INFO_SUBVIEW = "./views/local-subviews/info.html";
const HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR = "classSelectedNavigationItem";
const HTML_ID_MAIN_NAVIGATION_BAR = "idMainNavigationBar";
const HTML_TAG_MAIN = "main";
const HTML_ID_LOCAL_NAVIGATION_BAR = "idLocalNavigationBar";
const HTML_ID_LOCAL_MAIN = "idLocalMain";

function showMainNavigationBar() {
    document.getElementById(HTML_ID_MAIN_NAVIGATION_BAR).classList.remove("invisible");
}
function hideMainNavigationBar() {
    document.getElementById(HTML_ID_MAIN_NAVIGATION_BAR).classList.add("invisible");
}
function setNavigationItemAsSelectedInNavigationBar(htmlIdNavigationBar, htmlElement) {
    document.getElementById(htmlIdNavigationBar)
    .getElementsByClassName(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR)[0].
    classList.remove(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR);
    htmlElement.classList.add(HTML_CLASS_SELECTED_ITEM_IN_NAVIGATION_BAR);
}
function loadMapView() {
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_MAP_VIEW);
}
function loadCategoriesView() {
    showMainNavigationBar();
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_CATEGORIES_VIEW);
}
function loadLocalView() {
    hideMainNavigationBar();
    loadHtmlFileInHtmlNodeByTag(HTML_TAG_MAIN,FILE_PATH_LOCAL_VIEW);
}
function loadLocalSubView(filePathSubView) {
    loadHtmlFileInHtmlNodeById(HTML_ID_LOCAL_MAIN,filePathSubView);
}
function loadHtmlFileInHtmlNodeByTag(htmlNodeTag,htmlFilePath) {
    $(htmlNodeTag).load(htmlFilePath);
}
function loadHtmlFileInHtmlNodeById(htmlNodeId,htmlFilePath) {
    $(CSS_CHAR_ID_SELECTOR + htmlNodeId).load(htmlFilePath);
}