const htmlClassSelectedItemInNavigationBar = "classSelectedItemInNavigationBar";
const htmlIdMainNavigationBar = "idMainNavigationBar";
const htmlIdLocalNavigationBar = "idLocalNavigationBar";
const htmlMainTag = "main";

function showMainNavigationBar() {
    document.getElementById(htmlIdMainNavigationBar).classList.remove("invisible");
}
function hideNavigationBar() {
    document.getElementById(htmlIdMainNavigationBar).classList.add("invisible");
}
function setNavigationItemAsSelectedInNavigationBar(htmlIdNavigationBar, htmlElement) {
    document.getElementById(htmlIdNavigationBar)
    .getElementsByClassName(htmlClassSelectedItemInNavigationBar)[0].
    classList.remove(htmlClassSelectedItemInNavigationBar);
    htmlElement.classList.add(htmlClassSelectedItemInNavigationBar);
}
function loadHtmlFileInHtmlMainTag(htmlFilePath) {
    $(htmlMainTag).load(htmlFilePath);
}