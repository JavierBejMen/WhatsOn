class HelperServiceWorker {
    static registerServiceWorker(filePathServiceWorker) {
        if ("serviceWorker" in window.navigator) {
            window.navigator.serviceWorker.register(filePathServiceWorker)
                .then(() => {
                    console.log("Service Worker Registered");
                },
                    (errorMessage) => {
                        console.log(errorMessage);
                    });
        }
    }
}