const CACHE_NAME = "WhatsOnPWA-v1.0.4";
var filesToCache = [
    "./",
    "./manifest.json",
    "./index.php",
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
    "./styles/material-design-for-bootstrap-free-4.7.7/css/bootstrap.min.css",
    "./styles/material-design-for-bootstrap-free-4.7.7/css/mdb.min.css",
    "./styles/material-design-for-bootstrap-free-4.7.7/font/roboto/Roboto-Bold.woff2",
    "./styles/material-design-for-bootstrap-free-4.7.7/font/roboto/Roboto-Light.woff2",
    "./styles/material-design-for-bootstrap-free-4.7.7/font/roboto/Roboto-Regular.woff2",
    "./styles/material-design-for-bootstrap-free-4.7.7/js/bootstrap.min.js",
    "./styles/material-design-for-bootstrap-free-4.7.7/js/jquery-3.3.1.min.js",
    "./styles/material-design-for-bootstrap-free-4.7.7/js/mdb.min.js",
    "./styles/material-design-for-bootstrap-free-4.7.7/js/popper.min.js",
    "./styles/fontawesome-free-5.8.1-web/css/all.min.css",
    "./styles/fontawesome-free-5.8.1-web/webfonts/fa-brands-400.woff2",
    "./styles/fontawesome-free-5.8.1-web/webfonts/fa-solid-900.woff2",
    "./styles/fontawesome-free-5.8.1-web/webfonts/fa-regular-400.woff2",
    "./styles/font-family-muli/muli.css",
    "./styles/font-family-muli/Muli.woff2",
    "./styles/stylesheet.css",
    "./views/events.php",
    "./views/event-info.html",
    "./views/login.html",
    "./views/admin-panel.html",
    "./views/admin-panel-subviews/create-event.html"
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
        alwaysServerStrategy(event.request)
        //firstCacheThenServerStrategy(event.request)
    );
});

// Always Server strategy (Testing)
function alwaysServerStrategy(request) {
    return fetch(request).then((response) => {
        console.log("[ServiceWorker] Fetched", request.url, "from server");
        return response;
    },
        (error) => {
            console.log("[ServiceWorker] Fetch error", error);
        })
}

// First Cache, Then Server strategy (Production)
function firstCacheThenServerStrategy(request) {
    return caches.match(request).then((response) => {
        if (response) {
            console.log("[ServiceWorker] Fetched", request.url, "from cache");
            return response;
        }
        return fetch(request).then((response) => {
            console.log("[ServiceWorker] Fetched", request.url, "from server");
            return response;
        },
            (error) => {
                console.log("[ServiceWorker] Fetch error", error);
            })
    })
}