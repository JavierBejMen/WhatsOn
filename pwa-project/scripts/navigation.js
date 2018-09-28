
const cssCharIdSelector = "#";
const filePathCategoriesView = "./views/categories.html";
const filePathLocalView = "./views/local.html";
const filePathLocalInfoSubView = "./views/local-subviews/info.html";
const htmlClassSelectedItemInNavigationBar = "classSelectedNavigationItem";
const htmlIdMainNavigationBar = "idMainNavigationBar";
const htmlTagMain = "main";
const htmlIdLocalNavigationBar = "idLocalNavigationBar";
const htmlIdLocalMain = "idLocalMain";

function showMainNavigationBar() {
    document.getElementById(htmlIdMainNavigationBar).classList.remove("invisible");
}
function hideMainNavigationBar() {
    document.getElementById(htmlIdMainNavigationBar).classList.add("invisible");
}
function setNavigationItemAsSelectedInNavigationBar(htmlIdNavigationBar, htmlElement) {
    document.getElementById(htmlIdNavigationBar)
    .getElementsByClassName(htmlClassSelectedItemInNavigationBar)[0].
    classList.remove(htmlClassSelectedItemInNavigationBar);
    htmlElement.classList.add(htmlClassSelectedItemInNavigationBar);
}
function loadCategoriesView() {
    showMainNavigationBar();
    loadHtmlFileInHtmlNodeByTag(htmlTagMain,filePathCategoriesView);
}
function loadLocalView() {
    hideMainNavigationBar();
    loadHtmlFileInHtmlNodeByTag(htmlTagMain,filePathLocalView);
}
function loadLocalSubView(filePathSubView) {
    loadHtmlFileInHtmlNodeById(htmlIdLocalMain,filePathSubView);
}
function loadHtmlFileInHtmlNodeByTag(htmlNodeTag,htmlFilePath) {
    $(htmlNodeTag).load(htmlFilePath);
}
function loadHtmlFileInHtmlNodeById(htmlNodeId,htmlFilePath) {
    $(cssCharIdSelector + htmlNodeId).load(htmlFilePath);
}