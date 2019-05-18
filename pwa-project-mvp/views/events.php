<?php
if (HelperNavigator::isValidUrlQueryForEventsView($_GET)) {
    $arrayOfEvents = DBEvent::getEventsWithMinimumDataFromDateOnwards(new DateTime($_GET[HelperNavigator::QUERY_PARAMETER_EVENTS_FROM_DATE]));
} else {
    $arrayOfEvents = DBEvent::getEventsWithMinimumDataFromDateOnwards();
}
?>
<div class="sticky-top" id="idEventsWeekCalendarContainerInAllEvents"></div>
<div class="container-fluid px-md-5 classTertiaryBackgroundColor" id="idEventsMain">
    <?php
    if ($arrayOfEvents) {
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