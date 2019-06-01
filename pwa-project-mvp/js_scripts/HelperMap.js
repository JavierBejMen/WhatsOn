const LOCAL_NAME = "Lemon Rock";
const LOCAL_LATITUDE = 37.1770273;
const LOCAL_LONGITUDE = -3.6045047;

class HelperMap {
    static loadLocalDataInGoogleMapsApi() {
        let localLocation = new google.maps.LatLng(LOCAL_LATITUDE, LOCAL_LONGITUDE);
        let mapOfLocal =
            new google.maps.Map(document.getElementById(HTML_ID_EVENT_INFO_MAP_CONTAINER), {
                center: localLocation,
                zoom: 17
            });
        let markerOfLocal = new google.maps.Marker({
            position: localLocation,
            map: mapOfLocal,
            title: LOCAL_NAME
        });
    }

    static loadLocalDataInLeafletApi(htmlElementId, localName, localLatitude, localLongitude, zoomLevel) {
        let mapOfLocal = L.map(htmlElementId, { dragging: !L.Browser.mobile })
            .setView([localLatitude, localLongitude], zoomLevel);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            {
                attribution: "&copy; <a href='https://www.openstreetmap.org/copyright'>OpenStreetMap</a> contributors"
            }).addTo(mapOfLocal);
        L.marker([localLatitude, localLongitude]).addTo(mapOfLocal).bindPopup(localName).openPopup();
    }
}