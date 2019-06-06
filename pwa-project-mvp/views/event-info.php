<?php
$event = DBEvent::getEventFromId($_GET[HelperNavigator::URL_QUERY_PARAMETER_EVENT_ID]);
?>
<nav class="navbar navbar-expand fixed-top classPrimaryBackgroundColor text-white" id="idEventInfoMenuBar">
    <ul class="navbar-nav w-100 justify-content-between">
        <li class="nav-item">
            <a class="nav-link text-white waves-effect waves-light classRoundNavigationLink" title="Volver atrás" aria-label="Volver atrás" href="<?php print(HelperNavigator::getUrlRefererOrRoot()); ?>">
                <i class="fas fa-arrow-left fa-sm"></i>
            </a>
        </li>
        <li class="nav-item pt-2">
            <h5><?php print($event->getName()); ?></h5>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-effect waves-light classRoundNavigationLink" title="Más acciones" aria-label="Más acciones">
                <i class="fas fa-ellipsis-v fa-sm"></i>
            </a>
        </li>
    </ul>
</nav>
<div id="idEventInfoHeaderImage" style="background-image: url('<?php print($event->getUrlHeaderImage()); ?>')" alt="Imagen de Lemon Jazz" aria-label="Imagen de Lemon Jazz"></div>
<div class="container mb-5" id="idEventInfoMain">
    <div class="row justify-content-start my-4 classTagsList" aria-label="Etiquetas de<?php print($event->getName()); ?>">
        <?php
        foreach ($event->getArrayOfTags() as $tag) {
            print("<span class=\"btn btn-elegant\" disabled>$tag</span>");
        }
        ?>
    </div>
    <div aria-label="Fecha de Lemon Jazz">
        <h5 class="font-weight-bold">Cuándo</h5>
        <p>
            <?php
            print(ViewEvents::getFormattedStringFromEventStartDate(new DateTime($event->getStartDate())));
            print(" - ");
            print(ViewEvents::getFormattedStringFromEventStartTime($event->getStartTime()));
            ?>
        </p>
    </div>
    <div class="classDescriptionContainer" id="idEventInfoDescriptionContainer" aria-label="Descripción de Lemon Jazz">
        <h5 class="font-weight-bold">Descripción</h5>
        <p class="collapse classDescriptionParagraph" id="idEventInfoDescriptionParagraph" aria-expanded="false">
            <?php print($event->getDescription()); ?>
        </p>
        <div class="d-flex justify-content-center">
            <button class="collapsed btn btn-mdb-color btn-sm waves-effect waves-light px-2 py-1 
            classShowHideDescriptionButton" type="button" data-toggle="collapse" href="#idEventInfoDescriptionParagraph" aria-expanded="false" aria-controls="idEventInfoDescriptionParagraph" title="Ver descripción" aria-label="Ver descripción" onclick="toggleShowAndHideDescriptionButtons('idEventInfoDescriptionContainer')">
                <i class="fas fa-chevron-down"></i>
            </button>
            <button class="collapsed btn btn-mdb-color btn-sm waves-effect waves-light px-2 py-1 
            classShowHideDescriptionButton classInvisible" type="button" data-toggle="collapse" href="#idEventInfoDescriptionParagraph" aria-expanded="false" aria-controls="idEventInfoDescriptionParagraph" title="Ocultar descripción" aria-label="Ocultar descripción" onclick="toggleShowAndHideDescriptionButtons('idEventInfoDescriptionContainer')">
                <i class="fas fa-chevron-up"></i>
            </button>
        </div>
    </div>
    <div class="mb-5" aria-label="Precios de Lemon Rock">
        <h5 class="font-weight-bold">Precios</h5>
        <?php
        $ticketPrice = $event->getTicketPrice();
        $drinkPrice = $event->getLongDrinkPrice();
        $beerPrice = $event->getBeerPrice();
        ($ticketPrice == 0) ? print("<p>Entrada libre</p>") : print("<p>Entrada: $ticketPrice &euro;</p>");
        if (!is_null($drinkPrice)) {
            print("<p>Copa: $drinkPrice &euro;</p>");
        }
        if (!is_null($beerPrice)) {
            print("<p>Cerveza: $beerPrice &euro;</p>");
        }
        ?>
    </div>
    <div aria-label="Ubicación de Lemon Jazz">
        <h5 class="font-weight-bold">Ubicación</h5>
        <div class="mb-3" id="idEventInfoMapContainer"></div>
        <p>
            <i class="text-primary fas fa-map-marker-alt fa-lg"></i>
            <span class="text-black-50"><?php print($event->getLocalAddress()); ?></span>
        </p>
    </div>
</div>
<div class="classTertiaryBackgroundColor" id="idEventInfoRecommendationContainer" aria-label="Recomienda Lemon Jazz">
    <p class="font-weight-bold text-center pt-3">Recomienda Lemon Jazz a tus amigos</p>
    <div class="container d-flex justify-content-around" id="idEventInfoViewSocialButtonsList">
        <a class="btn text-body waves-effect px-3 border-0 z-depth-0" title="Compartir en WhatsApp" aria-label="WhatsApp">
            <i class="fab fa-whatsapp fa-3x"></i>
        </a>
        <a class="btn btn-elegant waves-effect waves-light mx-4 my-3 px-3 py-2" title="Compartir en Facebook" aria-label="Facebook">
            <i class="fab fa-facebook-f fa-2x"></i>
        </a>
        <a class="btn text-body waves-effect px-3 border-0 z-depth-0 waves-effect" title="Compartir en Messenger" aria-label="Messenger">
            <i class="fab fa-facebook-messenger fa-3x"></i>
        </a>
        <a class="btn text-body waves-effect px-3 border-0 z-depth-0 waves-effect" title="Compartir en Instagram" aria-label="Instagram">
            <i class="fab fa-instagram fa-3x"></i>
        </a>
    </div>
</div>
<div id="idEventInfoFooterImage" style="background-image: url('<?php print($event->getUrlHeaderImage()); ?>')" alt="Imagen de Lemon Jazz" aria-label="Imagen de Lemon Jazz"></div>
<?php
if ($ticketPrice > 0) {
    print("<a class=\"btn btn-lg btn-default waves-effect w-100 classFloatingBottomButton\" title=\"Comprar entradas\" aria-label=\"Comprar entradas\">COMPRAR ENTRADAS</a>");
}
?>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcNyXtpE6iOxla32ptV-6SvCcANAmxM50&callback=HelperMap.loadLocalDataInGoogleMapsApi" 
    async defer></script> -->
<script>
    window.addEventListener("DOMContentLoaded", () => {
        setHtmlBodyBackgroundColor(HTML_CLASS_WHITE_BACKGROUND_COLOR);
        hideMainMenuBar();

        /* TODO -- Google Maps API */
        HelperMap.loadLocalDataInLeafletApi(HTML_ID_EVENT_INFO_MAP_CONTAINER, "<?php print($event->getLocalName()); ?>",
            <?php print($event->getLocalLatitude()); ?>, <?php print($event->getLocalLongitude()); ?>, 17);
    });
</script>