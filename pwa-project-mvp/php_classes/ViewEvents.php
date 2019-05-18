<?php
final class ViewEvents
{
    public static function isFirstEvent($previousDateTimeToCompare, $domDocumentForEventsPerDateList): bool
    {
        return is_null($previousDateTimeToCompare) && is_null($domDocumentForEventsPerDateList);
    }
    public static function InitializeDomDocumentAndNodesAndPreviousDateTimeToCompare(
        string $eventDate,
        &$domDocumentForEventsPerDateList,
        &$nodeEventsRow,
        &$previousDateTimeToCompare
    ) {
        $domDocumentForEventsPerDateList = self::getDomDocument(self::createNodeAsStringForEventsPerDateList($eventDate));
        $nodeEventsRow = self::getNodeEventsRow($domDocumentForEventsPerDateList);
        $previousDateTimeToCompare = $eventDate;
    }
    public static function getDomDocument(string $nodeAsString): DOMDocument
    {
        // Converting all special characters from 'UTF-8' to 'HTML-ENTITIES'
        $nodeAsString = mb_convert_encoding($nodeAsString, "HTML-ENTITIES", ["UTF-8", "ISO-8859-1"]);
        // Turning off some parse errors
        libxml_use_internal_errors(true);
        $domDocument = new DOMDocument("1.0", "UTF-8");
        // Loading content without adding enclosing html/body tags and also the doctype declaration
        $domDocument->loadHTML($nodeAsString, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        return $domDocument;
    }
    public static function createNodeAsStringForEventsPerDateList(string $eventDate): string
    {
        $nodeAsString = '
            <div class="classEventsPerDateList">
                <h4 class="pt-4 mb-0">' . $eventDate . '</h4>
                <div class="row">
                </div>
            </div>
        ';
        return $nodeAsString;
    }
    public static function createNodeAsStringForEventsPerDateEventContainer(
        string $eventId,
        string $eventUrlHeaderImage,
        string $eventTicketPrice,
        string $eventName,
        string $eventLocalName,
        string $eventStartTime,
        string $eventArrayOfTags
    ): string {
        $nodeAsString = '
            <div class="col-12 col-lg-6 col-xl-6 pt-4 classEventsPerDateEventContainer">
                <a href="' . HelperNavigator::getUrlEventInfoViewFromEventId($eventId) . '">
                    <div class="card" style="background-image: url(\'' . $eventUrlHeaderImage . '\')" alt="Imagen del evento ' . $eventName . '" aria-label="Imagen del evento ' . $eventName . '">
                        <div class="row justify-content-end classEventPrice classCategoriesList mx-2 mt-1">
                            <span class="btn btn-elegant" disabled>' . $eventTicketPrice . '</span>
                        </div>
                        <div class="card-body w-100 text-white classEventsPerDateCardBody">
                            <p class="card-title font-weight-bold">' . $eventName . '</p>
                            <p class="card-text text-white">' . $eventLocalName . ' - ' . $eventStartTime . '</p>
                            <div class="card-subtitle row justify-content-start classCategoriesList" aria-label="Categorías del evento ' . $eventName . '">
                                ' . $eventArrayOfTags . '
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        ';
        return $nodeAsString;
    }
    public static function getNodeEventsRow(DOMDocument $domDocument): DOMNode
    {
        return $domDocument->getElementsByTagName("div")[1];
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
        return ($ticketPrice == 0) ? "Entrada libre" : $ticketPrice . " €";
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
