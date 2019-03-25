const CACHE_NAME = "WhatsOnPWA-v1.0";
var filesToCache = [
    "./",
    "./manifest.json",
    "./index.html",
    "./assets/icons/icon-128x128.png",
    "./assets/icons/icon-144x144.png",
    "./assets/icons/icon-152x152.png",
    "./assets/icons/icon-192x192.png",
    "./assets/icons/icon-256x256.png",
    "./assets/icons/icon-32x32.png",
    "./assets/images/guillermo-crovetto.jpg",
    "./assets/images/lemon-jazz.jpg",
    "./assets/images/salir-con-arte.png",
    "./components/categories-filter.html",
    "./components/events-week-calendar.html",
    "./scripts/categories-filter.js",
    "./scripts/maps.js",
    "./scripts/navigation.js",
    "./scripts/worker.js",
    "./styles/fontawesome-free-5.3.1-web/css/all.min.css",
    "./styles/fontawesome-free-5.3.1-web/webfonts/fa-brands-400.woff2",
    "./styles/fontawesome-free-5.3.1-web/webfonts/fa-solid-900.woff2",
    "./styles/fontawesome-free-5.3.1-web/webfonts/fa-regular-400.woff2",
    "./styles/material-design-for-bootstrap-free-4.5.10/css/bootstrap.min.css",
    "./styles/material-design-for-bootstrap-free-4.5.10/css/mdb.min.css",
    "./styles/material-design-for-bootstrap-free-4.5.10/font/roboto/Roboto-Bold.woff2",
    "./styles/material-design-for-bootstrap-free-4.5.10/font/roboto/Roboto-Light.woff2",
    "./styles/material-design-for-bootstrap-free-4.5.10/font/roboto/Roboto-Regular.woff2",
    "./styles/material-design-for-bootstrap-free-4.5.10/js/bootstrap.min.js",
    "./styles/material-design-for-bootstrap-free-4.5.10/js/jquery-3.3.1.min.js",
    "./styles/material-design-for-bootstrap-free-4.5.10/js/mdb.min.js",
    "./styles/material-design-for-bootstrap-free-4.5.10/js/popper.min.js",
    "./styles/stylesheet.css",
    "./views/events.html",
    "./views/event-info.html"
];

self.addEventListener("install", (event) => {
    console.log("[ServiceWorker] Install");
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log("[ServiceWorker] Caching app shell");
            return cache.addAll(filesToCache);
        })
    );
});

self.addEventListener("activate", (event) => {
    console.log("[ServiceWorker] Activate");
    event.waitUntil(
        caches.keys().then((keyList) => {
            return Promise.all(keyList.map((key) => {
                if (key !== CACHE_NAME) {
                    console.log("[ServiceWorker] Removing old cache", key);
                    return caches.delete(key);
                }
            }));
        })
    );
    return self.clients.claim();
});

self.addEventListener("fetch", (event) => {
    console.log("[ServiceWorker] Fetch", event.request.url);
    event.respondWith(
        // First server strategy
        /*fetch(event.request).then((response) => 
        {
            console.log("[ServiceWorker] Fetched",event.request.url,"from server");
            return response;
        },
        () => 
        {
            caches.match(event.request).then((response) =>
            {
                if(response)
                {
                    console.log("[ServiceWorker] Fetched",event.request.url,"from cache");
                    return response;
                }
                return onFetchError(response);
            })
        })*/
        // First cache strategy
        caches.match(event.request).then((response) => {
            if (response) {
                console.log("[ServiceWorker] Fetched", event.request.url, "from cache");
                return response;
            }
            return fetch(event.request).then((response) => {
                console.log("[ServiceWorker] Fetched", event.request.url, "from server");
                return response;
            },
                (response) => {
                    return onFetchError(response);
                });
        })
    );
});

function onFetchError(response) {
    console.log("[ServiceWorker] Fetch error", response);
    return response;
}