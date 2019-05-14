<div class="sticky-top" id="idEventsWeekCalendarContainerInAllEvents"></div>
<div class="container-fluid px-md-5 classTertiaryBackgroundColor" id="idEventsMain">
    <?php
    $event = DBEvent::getEventFromId(2);
    $arrayOfEvents1 = DBEvent::getEventsWithMinimumDataFromDateOnwards();
    $arrayOfEvents2 = DBEvent::getEventsWithMinimumDataFromDateOnwards(new DateTime("2019-06-07"));
    $arrayOfTags1 = DBEventHasTag::getTagsFromEventId(1);
    $arrayOfTags2 = DBEventHasTag::getTagsFromArrayOfEventIds([2, 3]);
    $arrayOfTags3 = DBTag::getTags();
    $existsUser = DBUser::existsUserWithEncryptedPassword('user-mail@server.com', 'ldskfmgsdfgjngnj');

    // echo '<div class="row">' . '<br><br>';
    // echo (new DateTime(HelperDateTime::$FORMAT_PHP_NOW_DATE_TIME))->format("Y-m-d") . '<br><br>';
    // echo var_dump($event) . '<br><br>';
    // echo var_dump($arrayOfEvents1) . '<br><br>';
    // echo var_dump($arrayOfEvents2) . '<br><br>';
    // echo var_dump($arrayOfTags1) . '<br><br>';
    // echo var_dump($arrayOfTags2) . '<br><br>';
    // echo var_dump($arrayOfTags3) . '<br><br>';
    // echo ($existsUser === true) ? 'El usuario existe.' : 'El usuario NO existe.' . '<br><br>';
    // echo '</div>';

    $domDocument = new DOMDocument();
    $domDocument->encoding = "utf-8";
    $div = $domDocument->createElement("div");
    $div->setAttribute("class", "col-12 col-lg-6 col-xl-6 pt-4 classAllEventsEventContainer");
    $domDocument->appendChild($div);
    echo $domDocument->saveHTML($div);

    if (count($arrayOfEvents1)) {
        try {
            $dateFormatter = new IntlDateFormatter("es_ES", IntlDateFormatter::FULL, NULL, NULL, NULL, NULL);
            $oldDateTimeToCompare = HelperDateTime::getYesterday();
            foreach ($arrayOfEvents1 as $event) {
                $eventDate = new DateTime($event->getStartDate());
                if ($oldDateTimeToCompare < $eventDate) {
                    $currentDateFormatter = (HelperDateTime::isDateTimeFromCurrentYear($eventDate))
                        ? $dateFormatter->setPattern("EEEE, d MMMM") : $dateFormatter->setPattern("EEEE, d MMMM yyyy");
                    echo '<div class="classAllEventsList">';
                    echo '<h4 class="pt-4 mb-0">' . $dateFormatter->format($eventDate) . '</h4>';
                    echo '<div class="row"></div>';
                    echo '</div>';
                    $oldDateTimeToCompare = $eventDate;
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage() . '<br><br>';
        }
    }

    ?>
    <div class="classAllEventsList">
        <h4 class="pt-4 mb-0">Hoy</h4>
        <div class="row">
            <div class="col-12 col-lg-6 col-xl-6 pt-4 classAllEventsEventContainer">
                <div class="card" onclick="loadEventInfoView()" style="background-image: url('./assets/images/salir-con-arte.png')" alt="Imagen del evento Salir con Arte" aria-label="Imagen del evento Salir con Arte">
                    <div class="row justify-content-end classEventPrice classCategoriesList mx-2 mt-1">
                        <span class="btn btn-elegant" disabled>Entrada Libre</span>
                    </div>
                    <div class="card-body w-100 text-white classAllEventsCardBody">
                        <p class="card-title font-weight-bold">Taller de pintura - Salir con Arte</p>
                        <p class="card-text text-white">Lemon Rock - 17:00</p>
                        <div class="card-subtitle row justify-content-start classCategoriesList" aria-label="Categorías de Lemon Rock">
                            <span class="btn btn-elegant" disabled>Pintura</span>
                            <span class="btn btn-elegant" disabled>Arte</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-6 pt-4 classAllEventsEventContainer">
                <div class="card" onclick="loadEventInfoView()" style="background-image: url('./assets/images/lemon-jazz.jpg')" alt="Imagen del evento Lemon Jazz" aria-label="Imagen del evento Lemon Jazz">
                    <div class="row justify-content-end classEventPrice classCategoriesList mx-2 mt-1">
                        <span class="btn btn-elegant" disabled>Entrada Libre</span>
                    </div>
                    <div class="card-body w-100 text-white classAllEventsCardBody">
                        <p class="card-title font-weight-bold">Lemon Jazz</p>
                        <p class="card-text text-white">Lemon Rock - 18:30</p>
                        <div class="card-subtitle row justify-content-start classCategoriesList" aria-label="Categorías de Lemon Rock">
                            <span class="btn btn-elegant" disabled>En directo</span>
                            <span class="btn btn-elegant" disabled>Jazz</span>
                            <span class="btn btn-elegant" disabled>Rock</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="classAllEventsList">
        <h4 class="pt-4 mb-0">Mañana</h4>
        <div class="row">
            <div class="col-12 col-lg-6 col-xl-6 pt-4 classAllEventsEventContainer">
                <div class="card" onclick="loadEventInfoView()" style="background-image: url('./assets/images/guillermo-crovetto.jpg')" alt="Imagen del evento Guillermo Crovetto" aria-label="Imagen del evento Guillermo Crovetto">
                    <div class="row justify-content-end classEventPrice classCategoriesList mx-2 mt-1">
                        <span class="btn btn-elegant" disabled>16 €</span>
                    </div>
                    <div class="card-body w-100 text-white classAllEventsCardBody">
                        <p class="card-title font-weight-bold">Guillermo Crovetto</p>
                        <p class="card-text text-white">Lemon Rock - 17:00</p>
                        <div class="card-subtitle row justify-content-start classCategoriesList" aria-label="Categorías de Lemon Rock">
                            <span class="btn btn-elegant" disabled>En directo</span>
                            <span class="btn btn-elegant" disabled>Indie</span>
                            <span class="btn btn-elegant" disabled>Rock</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="idCategoriesFilterContainerInEvents"></div>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        showMainMenuBar();
        setIdsInEventsLists(HTML_CLASS_ALL_EVENTS_LIST);
        loadEventsWeekCalendarComponentInHtmlElementById(HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_ALL_EVENTS, 250);
        loadCategoriesFilterComponentInHtmlElementById(HTML_ID_CATEGORIES_FILTER_CONTAINER_IN_EVENTS);
    });
</script>