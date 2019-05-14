<?php

final class HelperDateTime
{
    public static function getYesterday(): DateTime
    {
        $resultDateTime = new DateTime(self::$FORMAT_PHP_NOW_DATE_TIME, new DateTimeZone(self::$FORMAT_PHP_TIME_ZONE));
        $resultDateTime->sub(new DateInterval("P1D")); // Substract 1 day to now
        return $resultDateTime;
    }
    public static function isDateTimeFromCurrentYear(DateTime $dateTime): bool
    {
        $currentDate = new DateTime(self::$FORMAT_PHP_NOW_DATE_TIME, new DateTimeZone(self::$FORMAT_PHP_TIME_ZONE));
        return ($currentDate->format("Y") - $dateTime->format("Y")) === 0;
    }
    public static $FORMAT_PHP_TIME_ZONE = "Europe/Madrid";
    public static $FORMAT_PHP_NOW_DATE_TIME = "now";
    public static $FORMAT_PHP_DATE_TIME_TO_DATABASE_DATE_TIME = "Y-m-d";
}
