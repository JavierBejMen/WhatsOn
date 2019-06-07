<?php

final class DataRepresentationConversor
{
    public static function TagsStringValueFromUIStringToPhpArray(string $tagsString): array
    {
        return explode(",", $tagsString);
    }
    public static function DateValueFromUIStringToDataBaseString(string $UIDate): string
    {
        if ($UIDate) {
            $partsOfDate = explode(" ", $UIDate);
            $resultArrayOfStrings = array();
            array_push($resultArrayOfStrings, $partsOfDate[5]);
            array_push($resultArrayOfStrings, "0" . (array_search($partsOfDate[3], self::MONTHS_OF_YEAR) + 1));
            array_push($resultArrayOfStrings, "0" . $partsOfDate[1]);
            return implode("-", $resultArrayOfStrings);
        }
        return "";
    }
    public static function TimeValueFromUIStringToDataBaseString(string $UITime): string
    {
        if ($UITime) {
            $partsOfTime = explode(":", $UITime);
            $partsOfTime[0] = (strlen($partsOfTime[0]) == 1) ? "0" . $partsOfTime[0] : $partsOfTime[0];
            array_push($partsOfTime, "00");
            return implode(":", $partsOfTime);
        }
        return "";
    }
    public static function FloatValueFromUIStringToDataBaseString(string $UIFloat): string
    {

        return ($UIFloat) ? strval(floatval($UIFloat)) : "";
    }

    // Private
    private const MONTHS_OF_YEAR = [
        "enero", "febrero", "marzo", "abril", "mayo", "junio",
        "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
    ];
}
