<div class="sticky-top" id="idEventsWeekCalendarContainerInAllEvents"></div>
<div class="container-fluid px-md-5 classTertiaryBackgroundColor" id="idEventsMain">
    <?php
    // echo '<div class="row">' . '<br><br>';
    // echo HelperDateTime::getNowDateTime()->format("Y-m-d") . '<br><br>';
    // echo var_dump(DBEvent::getEventFromId(2)) . '<br><br>';
    // echo var_dump(DBEvent::getEventFromId(299)) . '<br><br>';
    // echo var_dump(DBEvent::getEventsWithMinimumDataFromDateOnwards(new DateTime("2019-06-07"))) . '<br><br>';
    // echo var_dump(DBEvent::getEventsWithMinimumDataFromDateOnwards(new DateTime("2040-06-07"))) . '<br><br>';
    // echo var_dump(DBEventHasTag::getTagsFromEventId(1)) . '<br><br>';
    // echo var_dump(DBEventHasTag::getTagsFromEventId(199)) . '<br><br>';
    // echo var_dump(DBEventHasTag::getTagsFromArrayOfEventIds([2, 3])) . '<br><br>';
    // echo var_dump(DBEventHasTag::getTagsFromArrayOfEventIds(array())) . '<br><br>';
    // echo var_dump(DBEventHasTag::getTagsFromArrayOfEventIds([199, 399])) . '<br><br>';
    // echo var_dump(DBTag::getTags()) . '<br><br>';
    // echo (DBUser::existsUserWithEncryptedPassword('user-mail@server.com', 'ldskfmgsdfgjngnj')) ? 'El usuario existe.'
    //     : 'El usuario NO existe.' . '<br><br>';
    // echo (DBUser::existsUserWithEncryptedPassword('a', 'ldskfmgsdfgjngnj')) ? 'El usuario existe.'
    //     : 'El usuario NO existe.' . '<br><br>';
    // echo (DBUser::existsUserWithEncryptedPassword('user-mail@server.com', 'ls')) ? 'El usuario existe.'
    //     : 'El usuario NO existe.' . '<br><br>';
    // echo (DBUser::existsUserWithEncryptedPassword('', 'ldskfmgsdfgjngnj')) ? 'El usuario existe.'
    //     : 'El usuario NO existe.' . '<br><br>';
    // echo '</div>';

    $arrayOfEvents = DBEvent::getEventsWithMinimumDataFromDateOnwards();
    if (count($arrayOfEvents) > 0) {
        $previousDateTimeToCompare = NULL;
        $domDocumentForEventsPerDateList = NULL;

        foreach ($arrayOfEvents as $event) {
            $nodeEventsRow;
            $eventDate = new DateTime($event->getStartDate());
            if (ViewEvents::isFirstEvent($previousDateTimeToCompare, $domDocumentForEventsPerDateList)) {
                ViewEvents::InitializeDomDocumentAndNodesAndPreviousDateTimeToCompare(
                    ViewEvents::getFormattedStringFromEventStartDate($eventDate),
                    $domDocumentForEventsPerDateList,
                    $nodeEventsRow,
                    $previousDateTimeToCompare
                );
            } else {
                if ($previousDateTimeToCompare != $eventDate) {
                    print($domDocumentForEventsPerDateList->saveHTML());

                    ViewEvents::InitializeDomDocumentAndNodesAndPreviousDateTimeToCompare(
                        ViewEvents::getFormattedStringFromEventStartDate($eventDate),
                        $domDocumentForEventsPerDateList,
                        $nodeEventsRow,
                        $previousDateTimeToCompare
                    );
                }
            }
            $domDocumentForEventsPerDateEventContainer = ViewEvents::getDomDocument(
                ViewEvents::createNodeAsStringForEventsPerDateEventContainer(
                    $event->getId(),
                    $event->getUrlHeaderImage(),
                    ViewEvents::getFormattedStringFromEventTicketPrice($event->getTicketPrice()),
                    $event->getName(),
                    $event->getLocalName(),
                    ViewEvents::getFormattedStringFromEventStartTime($event->getStartTime()),
                    ViewEvents::getHtmlStringFromEventArrayOfTags($event->getArrayOfTags())
                )
            );
            $nodeEventsRow->appendChild($domDocumentForEventsPerDateList->importNode($domDocumentForEventsPerDateEventContainer->getElementsByTagName("div")[0], true));
        }
        print($domDocumentForEventsPerDateList->saveHTML());
    }
    ?>
</div>
<div id="idCategoriesFilterContainerInEvents"></div>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        showMainMenuBar();
        setIdsInEventsLists(HTML_CLASS_EVENTS_PER_DATE_LIST);
        loadEventsWeekCalendarComponentInHtmlElementById(HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_ALL_EVENTS, 250);
        loadCategoriesFilterComponentInHtmlElementById(HTML_ID_CATEGORIES_FILTER_CONTAINER_IN_EVENTS);
    });
</script>