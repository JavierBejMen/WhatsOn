<?php
if (HelperNavigator::isValidUrlQueryForEventsView($_GET)) {
    $arrayOfEvents = DBEvent::getEventsWithMinimumDataFromDateOnwardsWhichHaveSomeTagInTagsArray(
        new DateTime($_GET[HelperNavigator::URL_QUERY_PARAMETER_EVENTS_FROM_DATE])
    );
} else {
    $arrayOfEvents = DBEvent::getEventsWithMinimumDataFromDateOnwardsWhichHaveSomeTagInTagsArray();
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
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/components/tags-filter.php");
?>
<script>
    window.addEventListener("DOMContentLoaded", () => {
        showMainMenuBar();
        setIdsInEventsLists(HTML_CLASS_EVENTS_PER_DATE_LIST);
        loadEventsWeekCalendarComponentInHtmlElementById(HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_ALL_EVENTS, 250);
        document.getElementById(HTML_ID_FILTER_TAGS_SHOW_MODAL_BUTTON).addEventListener("click", () => {
            HelperTagsFilter.saveEnabledFilterTagButtons(SESSION_STORAGE_KEY_ENABLED_FILTER_TAGS_VALUES);
        });
        document.getElementById(HTML_ID_FILTER_TAGS_HIDE_MODAL_BUTTON).addEventListener("click", () => {
            HelperTagsFilter.loadPreviousEnabledFilterTagButtons(SESSION_STORAGE_KEY_ENABLED_FILTER_TAGS_VALUES);
        });
        document.getElementById(HTML_ID_FILTER_TAGS_SAVE_BUTTON).addEventListener("click", () => {
            let arrayOfEnabledFilterTags = HelperTagsFilter.getArrayOfEnabledFilterTagsValuesFromHtmlFilterTagsModal();
            (arrayOfEnabledFilterTags.length > 0) ? hideHtmlEventsPerDateListsAndTheirEventContainers(arrayOfEnabledFilterTags):
                showHtmlEventsPerDateListsAndTheirEventContainers();
        });
    });
</script>