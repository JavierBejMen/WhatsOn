<?php

final class ViewEvents
{
    public static function isFirstEvent($previousDateTimeToCompare, $domDocumentForEventsPerDateList): bool
    {
        return is_null($previousDateTimeToCompare) && is_null($domDocumentForEventsPerDateList);
    }
    public static function InitializeDomDocumentAndNodesAndPreviousDateTimeToCompare(
        $eventStartDate,
        &$domDocumentForEventsPerDateList,
        &$nodeEventsRow,
        &$previousDateTimeToCompare
    ) {
        $domDocumentForEventsPerDateList = self::createDomDocument(self::createNodeAsStringForEventsPerDateList($eventStartDate));
        $nodeEventsRow = self::getNodeEventsRow($domDocumentForEventsPerDateList);
        $previousDateTimeToCompare = $eventStartDate;
    }
    public static function createDomDocument(string $nodeAsString): DOMDocument
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
    public static function createNodeAsStringForEventsPerDateList(string $eventStartDate): string
    {
        $nodeAsString = '
            <div class="classEventsPerDateList">
                <h4 class="pt-4 mb-0">' . DataRepresentationConversor::DateValueFromDataBaseStringToUIStringInEventsViewAndEventInfoView($eventStartDate) . '</h4>
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
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 pt-4 classEventsPerDateEventContainer mx-auto">
                <a href="' . HelperNavigator::getUrlEventInfoViewFromEventId($eventId) . '">
                    <div class="card" style="background-image: url(\'' . $eventUrlHeaderImage . '\')" alt="Imagen del evento ' . $eventName . '" aria-label="Imagen del evento ' . $eventName . '">
                        <div class="row justify-content-end classEventPrice classTagsList mx-2 mt-1">
                            <span class="btn btn-elegant" disabled>' . $eventTicketPrice . '</span>
                        </div>
                        <div class="card-body w-100 text-white classEventsPerDateCardBody">
                            <p class="card-title font-weight-bold">' . $eventName . '</p>
                            <p class="card-text text-white">' . $eventLocalName . ' - ' . $eventStartTime . '</p>
                            <div class="card-subtitle row justify-content-start classTagsList" aria-label="Etiquetas del evento ' . $eventName . '">
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
    public static function createHtmlStringFromEventArrayOfTags(array $arrayOfTags): string
    {
        $resultString = "";
        foreach ($arrayOfTags as $tag) {
            $resultString .= "<span class=\"btn btn-elegant classTagSpan\" disabled>" . $tag . "</span>";
        }
        return $resultString;
    }
}
