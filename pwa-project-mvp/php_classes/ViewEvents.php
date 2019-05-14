<?php
final class ViewEvents
{
    public static function isFirstEvent($previousDateTimeToCompare, $domDocumentForEventsPerDateList): bool
    {
        return is_null($previousDateTimeToCompare) && is_null($domDocumentForEventsPerDateList);
    }
    public static function InitializeDomDocumentWithNodesAndPreviousDateTimeToCompare(
        string $eventDate,
        &$domDocumentForEventsPerDateList,
        &$nodeEventsPerDateList,
        &$nodeEventsRow,
        &$previousDateTimeToCompare
    ) {
        $domDocumentForEventsPerDateList = ViewEvents::getDomDocumentForEventsPerDateList($eventDate);
        $nodeEventsPerDateList = ViewEvents::getNodeEventsPerDateListFromDomDocumentForEventsPerDateList($domDocumentForEventsPerDateList);
        $nodeEventsRow = ViewEvents::getNodeEventsRow($domDocumentForEventsPerDateList);
        $previousDateTimeToCompare = $eventDate;
    }
    public static function getDomDocumentForEventsPerDateList(string $eventDate): DOMDocument
    {
        $domDocumentForEventsPerDateList = new DOMDocument("", "utf-8");
        $domDocumentForEventsPerDateList->loadHTML('
            <div class="classEventsPerDateList">
                <h4 class="pt-4 mb-0">' . $eventDate . '</h4>
                <div class="row">
                </div>
            </div>
        ');
        return $domDocumentForEventsPerDateList;
    }
    public static function getNodeEventsPerDateListFromDomDocumentForEventsPerDateList(DOMDocument $domDocument): DOMNode
    {
        return $domDocument->getElementsByTagName("div")[0];
    }
    public static function getNodeEventsRow(DOMDocument $domDocument): DOMNode
    {
        return $domDocument->getElementsByTagName("div")[1];
    }
    public static function getDomDocumentForEventsPerDateEventContainer(
        string $eventUrlHeaderImage,
        string $eventTicketPrice,
        string $eventName,
        string $eventLocalName,
        string $eventStartTime,
        string $eventArrayOfTags
    ): DOMDocument {
        $domDocumentForEventsPerDateEventContainer = new DOMDocument("", "utf-8");
        $domDocumentForEventsPerDateEventContainer->loadHTML('
            <div class="col-12 col-lg-6 col-xl-6 pt-4 classEventsPerDateEventContainer">
                <div class="card" onclick="loadEventInfoView()" style="background-image: url(\'' . $eventUrlHeaderImage . '\')" alt="Imagen del evento Salir con Arte" aria-label="Imagen del evento Salir con Arte">
                    <div class="row justify-content-end classEventPrice classCategoriesList mx-2 mt-1">
                        <span class="btn btn-elegant" disabled>' . $eventTicketPrice . '</span>
                    </div>
                    <div class="card-body w-100 text-white classEventsPerDateCardBody">
                        <p class="card-title font-weight-bold">' . $eventName . '</p>
                        <p class="card-text text-white">' . $eventLocalName . ' - ' . $eventStartTime . '</p>
                        <div class="card-subtitle row justify-content-start classCategoriesList" aria-label="Categorías de Lemon Rock">
                            ' . $eventArrayOfTags . '
                        </div>
                    </div>
                </div>
            </div>
        ');
        return $domDocumentForEventsPerDateEventContainer;
    }
    public static function getFormattedStringFromEventStartDate(DateTime $startDate): string
    {
        $dateFormatter = new IntlDateFormatter(HelperDateTime::$LOCALE, IntlDateFormatter::FULL, NULL, NULL, NULL, NULL);
        (HelperDateTime::isDateTimeFromCurrentYear($startDate)) ? $dateFormatter->setPattern("EEEE, d MMMM")
            : $dateFormatter->setPattern("EEEE, d MMMM yyyy");
        return $dateFormatter->format($startDate);
    }
    public static function getFormattedStringFromEventTicketPrice(string $ticketPrice): string
    {
        return ($ticketPrice == 0) ? "Entrada libre" : $ticketPrice . " &euro;";
    }
    public static function getFormattedStringFromEventStartTime(string $startTime): string
    {
        return (new DateTime($startTime))->format("H:i");
    }
    public static function getHtmlStringFromEventArrayOfTags(array $arrayOfTags): string
    {
        $resultString = "";
        foreach ($arrayOfTags as $tag) {
            $resultString .= "<span class=\"btn btn-elegant\" disabled>" . $tag . "</span>";
        }
        return $resultString;
    }
}
