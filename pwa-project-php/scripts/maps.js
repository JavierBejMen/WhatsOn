const HTML_ID_MAP_CONTAINER_LOCAL_INFO_SUBVIEW = "idLocalMapContainer";
const LOCAL_NAME = "Lemon Rock";
const LOCAL_LATITUDE = 37.1770273;
const LOCAL_LONGITUDE = -3.6045047;

function loadLocalDataInGoogleMapsApi() {
    var localLocation = new google.maps.LatLng(LOCAL_LATITUDE,LOCAL_LONGITUDE);
    var mapOfLocal = 
    new google.maps.Map(document.getElementById(HTML_ID_MAP_CONTAINER_LOCAL_INFO_SUBVIEW),{
        center: localLocation,
        zoom: 17
    });
    var markerOfLocal = new google.maps.Marker({
        position: localLocation,
        map: mapOfLocal,
        title: LOCAL_NAME
    });
}

function loadLocalDataInLeafletApi(localName,localLatitude,localLongitude,zoomLevel) {
    var mapOfLocal = L.map("idLocalMapContainer", {dragging: !L.Browser.mobile})
    .setView([localLatitude,localLongitude],zoomLevel);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", 
    {
        attribution: "&copy; <a href='https://www.openstreetmap.org/copyright'>OpenStreetMap</a> contributors"
    }).addTo(mapOfLocal);
    L.marker([localLatitude,localLongitude]).addTo(mapOfLocal).bindPopup(localName).openPopup();
}

function loadMapInHtmlNodeWithLeafletApi(htmlNodeId) {
    var mapOfLocal = L.map(htmlNodeId).setView([LOCAL_LATITUDE,LOCAL_LONGITUDE],17);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", 
    {
        attribution: "&copy; <a href='https://www.openstreetmap.org/copyright'>OpenStreetMap</a> contributors"
    }).addTo(mapOfLocal);
    L.marker([LOCAL_LATITUDE,LOCAL_LONGITUDE]).addTo(mapOfLocal).bindPopup(LOCAL_NAME)
    .openPopup().on('click',function(){
        loadLocalView();
    });
}