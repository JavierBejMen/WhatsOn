<?php

final class HelperDateTime
{
    public static function getNowDateTime(): DateTime
    {
        return new DateTime(self::$CONSTANT_DATE_TIME_NOW, new DateTimeZone(self::$TIME_ZONE));
    }
    public static function isDateTimeFromCurrentYear(DateTime $dateTime): bool
    {
        $currentDate = self::getNowDateTime();
        return ($currentDate->format("Y") - $dateTime->format("Y")) === 0;
    }
    public static $LOCALE = "es_ES";
    public static $TIME_ZONE = "Europe/Madrid";
    public static $CONSTANT_DATE_TIME_NOW = "now";
    public static $FORMAT_PHP_DATE_TIME_TO_DATABASE_DATE_TIME = "Y-m-d";
}
