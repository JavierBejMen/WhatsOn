function registerServiceWorker(filePathServiceWorker)
{
    window.addEventListener("load", function()
    {
        if("serviceWorker" in window.navigator)
        {
            window.navigator.serviceWorker.register(filePathServiceWorker)
            .then(function()
            {
                console.log("Service Worker Registered");
            },
            function(errorMessage)
            {
                console.log(errorMessage);
            });
        }
    });
}