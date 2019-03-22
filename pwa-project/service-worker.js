const CACHE_NAME = "WhatsOnPWA-v1.0";
var filesToCache = [
    "./",
    "./manifest.json",
    "./index.html",
    "./assets/images/headers-and-footers-local/lemon-rock.jpg",
    "./assets/images/user-profile-picture.png",
    "./assets/images/events-lemon-rock/guillermo-crovetto.jpg",
    "./assets/images/events-lemon-rock/lemon-jazz.jpg",
    "./assets/images/events-lemon-rock/salir-con-arte.png",
    "./assets/icons/icon-128x128.png",
    "./assets/icons/icon-144x144.png",
    "./assets/icons/icon-152x152.png",
    "./assets/icons/icon-192x192.png",
    "./assets/icons/icon-256x256.png",
    "./assets/icons/icon-32x32.png",
    "./assets/images/offers-lemon-rock/offer-1.jpg",
    "./assets/images/offers-lemon-rock/offer-1-thumbnail.jpeg",
    "./assets/images/photos-lemon-rock/lemon-rock-1.jpg",
    "./assets/images/photos-lemon-rock/lemon-rock-2.jpg",
    "./assets/images/photos-lemon-rock/lemon-rock-3.jpg",
    "./assets/images/photos-lemon-rock/lemon-rock-4.jpg",
    "./assets/images/photos-lemon-rock/lemon-rock-5.jpg",
    "./assets/images/photos-lemon-rock/lemon-rock-6.jpg",
    "./assets/images/photos-lemon-rock/lemon-rock-7.jpg",
    "./assets/images/photos-lemon-rock/lemon-rock-8.jpg",
    "./assets/images/thumbnails-local/disco.jpg",
    "./assets/images/thumbnails-local/babel-world-fusion.jpg",
    "./assets/images/thumbnails-local/boogaclub.jpg",
    "./assets/images/thumbnails-local/boom-boom-room.jpg",
    "./assets/images/thumbnails-local/el-pesaor.jpg",
    "./assets/images/thumbnails-local/garden.jpg",
    "./assets/images/thumbnails-local/industrial-copera.jpg",
    "./assets/images/thumbnails-local/la-rocka.jpg",
    "./assets/images/thumbnails-local/la-tertulia.jpg",
    "./assets/images/thumbnails-local/lemon-rock.jpg",
    "./assets/images/thumbnails-local/los-diamantes.jpg",
    "./assets/images/thumbnails-local/mae-west.jpg",
    "./assets/images/thumbnails-local/perro-andaluz.jpg",
    "./assets/images/thumbnails-local/planta-baja.jpg",
    "./assets/images/thumbnails-local/poe.jpg",
    "./assets/images/thumbnails-local/rocknrolla-club.jpg",
    "./assets/images/thumbnails-local/sala-el-tren.jpg",
    "./assets/images/thumbnails-local/sala-vogue.jpg",
    "./components/categories-filter.html",
    "./components/events-week-calendar.html",
    "./scripts/categories-filter.js",
    "./scripts/maps.js",
    "./scripts/navigation.js",
    "./scripts/photos.js",
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
    "./views/categories-of-locals.html",
    "./views/events.html",
    "./views/local.html",
    "./views/map-of-locals.html",
    "./views/offers.html",
    "./views/user-profile.html",
    "./views/local-subviews/events.html",
    "./views/local-subviews/info.html",
    "./views/local-subviews/photos.html",
    "./views/offers-subviews/offer-flyer.html",
    "./views/user-profile-subviews/help-faq-answer.html",
    "./views/user-profile-subviews/help-faqs.html",
    "./views/user-profile-subviews/help.html",
    "./views/user-profile-subviews/settings.html"
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