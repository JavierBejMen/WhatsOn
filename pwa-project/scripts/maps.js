const HTML_ID_MAP_CONTAINER_LOCAL_INFO_SUBVIEW = "idLocalMapContainer";
const LOCAL_NAME = "Lemon Rock";
const LOCAL_LATITUDE = 37.1770421;
const LOCAL_LONGITUDE = -3.6043392;

function loadLocalInDatainGoogleMapsApi() {
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