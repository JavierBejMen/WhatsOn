<?php
$arrayOfEvents = (isset($_GET[ValidatorUrlQuery::URL_QUERY_PARAMETER_EVENTS_FROM_DATE])) ?
    DBEvent::getEventsWithMinimumDataFromDateOnwardsWhichHaveSomeTagInTagsArray(
        new DateTime($_GET[ValidatorUrlQuery::URL_QUERY_PARAMETER_EVENTS_FROM_DATE])
    )
    : DBEvent::getEventsWithMinimumDataFromDateOnwardsWhichHaveSomeTagInTagsArray();
?>
<div class="sticky-top" id="idEventsWeekCalendarContainerInAllEvents"></div>
<div class="container-fluid px-md-5 classTertiaryBackgroundColor" id="idEventsMain">
    <?php
    if ($arrayOfEvents) {
        $previousDateToCompare = null;
        $domDocumentForEventsPerDateList = null;

        foreach ($arrayOfEvents as $event) {
            $nodeEventsRow;
            $eventStartDate = $event->getStartDate();
            if (ViewEvents::isFirstEvent($previousDateToCompare, $domDocumentForEventsPerDateList)) {
                ViewEvents::InitializeDomDocumentAndNodesAndPreviousDateTimeToCompare(
                    $eventStartDate,
                    $domDocumentForEventsPerDateList,
                    $nodeEventsRow,
                    $previousDateToCompare
                );
            } else {
                if ($previousDateToCompare != $eventStartDate) {
                    print($domDocumentForEventsPerDateList->saveHTML());

                    ViewEvents::InitializeDomDocumentAndNodesAndPreviousDateTimeToCompare(
                        $eventStartDate,
                        $domDocumentForEventsPerDateList,
                        $nodeEventsRow,
                        $previousDateToCompare
                    );
                }
            }
            $domDocumentForEventsPerDateEventContainer = ViewEvents::getDomDocument(
                ViewEvents::createNodeAsStringForEventsPerDateEventContainer(
                    $event->getId(),
                    $event->getUrlHeaderImage(),
                    DataRepresentationConversor::EventTicketPriceFromDataBaseStringToUIStringInEventsView($event->getTicketPrice()),
                    $event->getName(),
                    $event->getLocalName(),
                    DataRepresentationConversor::TimeValueFromDataBaseStringToUIString($event->getStartTime()),
                    ViewEvents::getHtmlStringFromEventArrayOfTags($event->getArrayOfTags())
                )
            );
            $nodeEventsRow->appendChild($domDocumentForEventsPerDateList->importNode($domDocumentForEventsPerDateEventContainer->getElementsByTagName("div")[0], true));
        }
        print($domDocumentForEventsPerDateList->saveHTML());
    }
    ?>
</div>
<!-- Button to activate tags modal window for filtering -->
<div class="classShowModalForFilteringFloatingButtonWrap">
    <button type="button" class="btn classSecondaryBackgroundColor text-white waves-effect waves-light classShowModalForFilteringFloatingButton" id="idEventsShowModalForFilteringTagsButton" data-toggle="modal" data-target="#idTagsModal" data-backdrop="false" title="Filtro de etiquetas" aria-label="Filtro de etiquetas">
        FILTROS
    </button>
</div>
<?php
require(HelperNavigator::getPhpAbsoluteFilePathFromPhpRelativeFilePath(HelperNavigator::FILE_PATH_TAGS_MODAL_COMPONENT));
?>
<script>
    window.addEventListener("DOMContentLoaded", () => {
        showMainMenuBar();
        setIdsInEventsLists(HTML_CLASS_EVENTS_PER_DATE_LIST);
        loadEventsWeekCalendarComponentInHtmlElementById(HTML_ID_EVENTS_WEEK_CALENDAR_CONTAINER_IN_ALL_EVENTS, 250);
        HelperTagsModal.clearEnabledTagValuesFromSessionStorage(SESSION_STORAGE_KEY_ENABLED_TAG_VALUES);
        document.getElementById(HTML_ID_EVENTS_SHOW_MODAL_FOR_FILTERING_TAGS_BUTTON).addEventListener("click", () => {
            HelperTagsModal.loadPreviousEnabledTagValuesFromSessionStorageToHtmlFormModal(SESSION_STORAGE_KEY_ENABLED_TAG_VALUES);
        });
        document.getElementById(HTML_ID_TAGS_MODAL_SAVE_BUTTON).addEventListener("click", () => {
            HelperTagsModal.saveEnabledTagValuesFromHtmlModalFormToSessionStorage(SESSION_STORAGE_KEY_ENABLED_TAG_VALUES);
            let arrayOfEnabledTags = HelperTagsModal.getArrayOfEnabledTagValuesFromHtmlTagsModal();
            (arrayOfEnabledTags.length > 0) ? hideHtmlEventsPerDateListsAndTheirEventContainers(arrayOfEnabledTags):
                showHtmlEventsPerDateListsAndTheirEventContainers();
        });
    });
</script>