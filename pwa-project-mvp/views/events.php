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
    window.addEventListener("DOMContentLoaded", function() {
        showMainMenuBar();
        setIdsInEventsLists(HTML_CLASS_EVENTS_PER_DATE_LIST);
        loadEventsWeekCalendarComponentInHtmlElementById(HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_ALL_EVENTS, 250);

        onHtmlFilterTagsShowModalButtonClickSaveDisabledFilterTagButtons(HTML_ID_FILTER_TAGS_SHOW_MODAL_BUTTON);
        onHtmlFilterTagsCloseModalButtonClickLoadPreviousDisabledFilterTagButtons(HTML_ID_FILTER_TAGS_HIDE_MODAL_BUTTON);

        document.getElementById(HTML_ID_FILTER_TAGS_SAVE_BUTTON).addEventListener("click", function() {
            var arrayOfFilteredTags = new Array();
            var htmlFilterTagButtons = document.querySelectorAll("." + HTML_CLASS_FILTER_TAG_BUTTON + ":not([" + HTML_ATTRIBUTE_DISABLED + "])");

            if (htmlFilterTagButtons.length > 0) {
                for (var htmlFilterTagButton of htmlFilterTagButtons) {
                    arrayOfFilteredTags.push(htmlFilterTagButton.textContent);
                };

                var htmlEventsPerDateLists = document.getElementsByClassName(HTML_CLASS_EVENTS_PER_DATE_LIST);
                for (var htmlEventsPerDateList of htmlEventsPerDateLists) {
                    var numberOfHiddenEvents = 0;
                    var htmlEventContainers = htmlEventsPerDateList.getElementsByClassName(HTML_CLASS_EVENTS_PER_DATE_EVENT_CONTAINER);
                    for (var htmlEventContainer of htmlEventContainers) {
                        var hideEventContainer = true;
                        var htmlEventTags = htmlEventContainer.getElementsByClassName(HTML_CLASS_TAG_SPAN);
                        for (var htmlEventTag of htmlEventTags) {
                            if (arrayOfFilteredTags.includes(htmlEventTag.textContent)) {
                                hideEventContainer = false;
                            }
                        };
                        if (hideEventContainer) {
                            htmlEventContainer.setAttribute(HTML_ATTRIBUTE_HIDDEN, HTML_EMPTY_STRING_VALUE)
                            numberOfHiddenEvents++;
                        } else {
                            htmlEventContainer.removeAttribute(HTML_ATTRIBUTE_HIDDEN);
                        }
                    };
                    if (htmlEventContainers.length == numberOfHiddenEvents) {
                        htmlEventsPerDateList.setAttribute(HTML_ATTRIBUTE_HIDDEN, HTML_EMPTY_STRING_VALUE);
                    } else {
                        htmlEventsPerDateList.removeAttribute(HTML_ATTRIBUTE_HIDDEN);
                    }
                }
            } else {
                showHtmlEventsPerDateListsAndTheirEventContainers();
            }
        });
    });
</script>