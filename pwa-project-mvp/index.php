<?php
/*
    $_SERVER["DOCUMENT_ROOT"] vs $_SERVER["HTTP_HOST"], very useful information in their differences and contexts of use:
    
    https://stackoverflow.com/questions/7229783/difference-between-serverdocument-root-and-serverhttp-host
*/
spl_autoload_register(function ($className) {
    require($_SERVER["DOCUMENT_ROOT"] . "/php_classes/$className.php");
});

session_start();
$_SESSION["view"] = (isset($_GET["view"])) ? $_GET["view"] : "events";
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS, MDBootstrap CSS and Font Awesome Icons -->
    <link rel="stylesheet" href="./styles/material-design-for-bootstrap-free-4.7.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/material-design-for-bootstrap-free-4.7.7/css/mdb.min.css">
    <link rel="stylesheet" href="./styles/fontawesome-free-5.8.1-web/css/all.min.css">
    <!-- Muli Font Family -->
    <link rel="stylesheet" href="./styles/font-family-muli/muli.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />
    <!-- Roboto Font Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <!-- Material Design - Date & Time Picker -->
    <link rel="stylesheet" href="./components/md-date-time-picker-2.3.0/dist/css/mdDateTimePicker.css">
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="./styles/stylesheet.css">
    <!-- PWA feature: Theme color for Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#413F50">
    <!-- PWA feature: Manifest -->
    <link rel="manifest" href="./manifest.json">
    <!-- PWA feature: Add to home screen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="WhatsOn PWA">
    <link rel="apple-touch-icon" href="./assets/icons/icon-152x152.png">
    <!-- PWA feature: Tile icon for Windows -->
    <meta name="msapplication-TileImage" content="./assets/icons/icon-144x144.png">
    <meta name="msapplication-TileColor" content="#413F50">
    <title>WhatsOn PWA</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand fixed-top classPrimaryBackgroundColor text-white" id="idMainMenuBar">
            <ul class="navbar-nav w-100 justify-content-between">
                <li class="nav-item pt-2">
                    <img src="./assets/icons/icon-32x32.png" alt="WhatsOn Logo" aria-label="WhatsOn Logo">
                </li>
                <li class="nav-item pt-2">
                    <h5>WhatsOn Granada</h5>
                </li>
                <div class="d-flex">
                    <li class="nav-item">
                        <a class="nav-link classRoundNavigationLink" title="Buscar" aria-label="Buscar">
                            <i class="fas fa-search fa-sm"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link classRoundNavigationLink" id="idMoreActionsDropdownButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Más acciones" aria-label="Más acciones">
                            <i class="fas fa-ellipsis-v fa-sm"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="idMoreActionsDropdownButton">
                            <a class="dropdown-item waves-effect waves-light" data-toggle="modal" data-target="#idFilterCategoriesModal">Aplicar filtros</a>
                            <a class="dropdown-item waves-effect waves-light">Recomendar WhatsOn</a>
                            <a class="dropdown-item waves-effect waves-light" onclick="loadLoginView()">Crear
                                evento</a>
                        </div>
                    </li>
                </div>
            </ul>
        </nav>
    </header>
    <main role="main">
        <?php
        $filePathView = $_SERVER["DOCUMENT_ROOT"];
        switch ($_SESSION["view"]) {
            case "event-info":
                $filePathView .= "/views/event-info.php";
                break;
            case "events":
            default:
                $filePathView .= "/views/events.php";
                break;
        }
        require($filePathView);
        ?>
    </main>
    <!-- JQuery JS, Popper.js, Bootstrap JS and MDBootstrap JS-->
    <script src="./styles/material-design-for-bootstrap-free-4.7.7/js/jquery-3.3.1.min.js"></script>
    <script src="./styles/material-design-for-bootstrap-free-4.7.7/js/popper.min.js"></script>
    <script src="./styles/material-design-for-bootstrap-free-4.7.7/js/bootstrap.min.js"></script>
    <script src="./styles/material-design-for-bootstrap-free-4.7.7/js/mdb.min.js"></script>
    <!-- Leaflet -->
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
    <!-- Material Date & Time Picker Dependency: Moment.js 2.13.0 -->
    <!-- <script src="./components/md-date-time-picker-2.3.0/dist/js/moment.min.js"></script> -->
    <!-- Material Date & Time Picker Dependency: Moment.js 2.24.0 -->
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <!-- Material Date & Time Picker Dependency: Scroll into view JS -->
    <script src="./components/md-date-time-picker-2.3.0/dist/js/scroll-into-view-if-needed.min.js"></script>
    <!-- Material Date & Time Picker Dependency: Draggabilly PACKAGED JS 2.1.0 -->
    <!-- <script src="./components/md-date-time-picker-2.3.0/dist/js/draggabilly.pkgd.min.js"></script> -->
    <!-- Material Date & Time Picker Dependency: Draggabilly PACKAGED JS 2.2.0 -->
    <script src="https://unpkg.com/draggabilly@2/dist/draggabilly.pkgd.min.js"></script>
    <!-- Material Date & Time Picker JS -->
    <script src="./components/md-date-time-picker-2.3.0/dist/js/mdDateTimePicker.js"></script>
    <!-- Custom scripts -->
    <script src="./js_scripts/maps.js"></script>
    <script src="./js_scripts/navigation.js"></script>
    <script src="./js_scripts/categories-filter.js"></script>
    <script src="./js_scripts/worker.js"></script>
    <script>
        // PWA feature: Service Worker
        registerServiceWorker(FILE_PATH_SERVICE_WORKER);
    </script>
</body>

</html>