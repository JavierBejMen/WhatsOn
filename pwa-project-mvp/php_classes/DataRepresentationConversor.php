<?php

final class DataRepresentationConversor
{
    public static function FloatValueFromUIStringToDataBaseString(string $UIFloat): string
    {
        return ($UIFloat != "") ? strval(floatval($UIFloat)) : "";
    }
    public static function FloatValueFromDataBaseStringToUIString(string $UIFloat): string
    {
        return ($UIFloat != "") ? str_replace(".", ",", $UIFloat) : "";
    }
    public static function DateValueFromUIStringToDataBaseString(string $UIDate): string
    {
        if ($UIDate != "") {
            $partsOfDate = explode(" ", $UIDate);
            $day = $partsOfDate[1];
            $day = (strlen($day) === 1) ? ("0" . $day) : $day;
            $month = array_search($partsOfDate[3], self::MONTHS_OF_YEAR) + 1;
            $month = ($month < 10) ? ("0" . $month) : $month;
            return $partsOfDate[5] . "-" . $month . "-" . $day;
        }
        return "";
    }
    public static function DateValueFromDataBaseStringToUIStringInEventsViewAndEventInfoView(string $dataBaseDate): string
    {
        if ($dataBaseDate != "") {
            $phpDate = new DateTime($dataBaseDate);
            $dateFormatter = new IntlDateFormatter(HelperDateTime::$LOCALE, IntlDateFormatter::FULL, null, null, null, null);
            (HelperDateTime::isDateTimeFromCurrentYear($phpDate)) ? $dateFormatter->setPattern("EEEE, d 'de' MMMM")
                : $dateFormatter->setPattern("EEEE, d 'de' MMMM 'de' yyyy");
            return $dateFormatter->format($phpDate);
        }
        return "";
    }
    public static function DateValueFromDataBaseStringToUIStringInUpdateEventView(string $dataBaseDate): string
    {
        if ($dataBaseDate != "") {
            $dateFormatter = new IntlDateFormatter(HelperDateTime::$LOCALE, IntlDateFormatter::FULL, null, null, null, null);
            $dateFormatter->setPattern("EEEE, d 'de' MMMM 'de' yyyy");
            return $dateFormatter->format(new DateTime($dataBaseDate));
        }
        return "";
    }
    public static function TimeValueFromUIStringToDataBaseString(string $UITime): string
    {
        return ($UITime != "") ? ($UITime . ":00") : "";
    }
    public static function TimeValueFromDataBaseStringToUIString(string $dataBaseTime): string
    {
        return ($dataBaseTime != "") ? (new DateTime($dataBaseTime))->format("H:i") : "";
    }
    public static function TagsStringFromUIStringToPhpArray(string $tagsString): array
    {
        return ($tagsString != "") ? explode(",", $tagsString) : "";
    }
    public static function TagsArrayFromPhpArrayToUIString(array $arrayOfTags): string
    {
        return ($arrayOfTags != "") ? implode(",", $arrayOfTags) : "";
    }
    public static function EventTicketPriceFromDataBaseStringToUIStringInEventsView(string $eventTicketPrice): string
    {
        return ($eventTicketPrice) ? self::FloatValueFromDataBaseStringToUIString($eventTicketPrice) . " €" : "Entrada libre";
    }
    public static function EventTicketPriceFromDataBaseStringToUIStringInEventInfoView(string $eventTicketPrice): string
    {
        return "Entrada" . (($eventTicketPrice) ? ": " . self::FloatValueFromDataBaseStringToUIString($eventTicketPrice) . " €" : " libre");
    }

    // Private
    private const MONTHS_OF_YEAR = [
        "enero", "febrero", "marzo", "abril", "mayo", "junio",
        "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
    ];
}
