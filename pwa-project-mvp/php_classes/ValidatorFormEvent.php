<?php

final class ValidatorFormEvent
{
    public static function isValidEventForCreatingEvent(
        string $eventName,
        string $eventDescription,
        array $eventHeaderImageFile,
        string $eventStartDate,
        string $eventStartTime,
        string $eventEndDate,
        string $eventEndTime,
        string $eventLocalName,
        string $eventLocalAddress,
        string $eventTicketPrice,
        string $eventLongDrinkPrice,
        string $eventBeerPrice,
        string $eventTags
    ): bool {
        return self::isValidEventName($eventName) && self::isValidEventDescription($eventDescription)
            && self::isValidEventHeaderImageFile($eventHeaderImageFile) && self::isValidEventStartDateTime($eventStartDate, $eventStartTime)
            && self::isValidEventEndDateTime($eventEndDate, $eventEndTime) && self::isValidEventLocalName($eventLocalName)
            && self::isValidEventLocalAddress($eventLocalAddress) && self::isValidEventTicketPrice($eventTicketPrice)
            && self::isValidEventLongDrinkPrice($eventLongDrinkPrice) && self::isValidEventBeerPrice($eventBeerPrice)
            && self::isValidEventTags($eventTags);
    }
    public static function isValidEventForUpdatingEvent(
        string $eventId,
        string $eventName,
        string $eventDescription,
        array $eventHeaderImageFile,
        string $eventStartDate,
        string $eventStartTime,
        string $eventEndDate,
        string $eventEndTime,
        string $eventLocalName,
        string $eventLocalAddress,
        string $eventTicketPrice,
        string $eventLongDrinkPrice,
        string $eventBeerPrice,
        string $eventTags
    ): bool {
        return self::isValidEventId($eventId) && self::isValidEventForCreatingEvent(
            $eventName,
            $eventDescription,
            $eventHeaderImageFile,
            $eventStartDate,
            $eventStartTime,
            $eventEndDate,
            $eventEndTime,
            $eventLocalName,
            $eventLocalAddress,
            $eventTicketPrice,
            $eventLongDrinkPrice,
            $eventBeerPrice,
            $eventTags
        );
    }
    public static function isValidEventId(string $eventId): bool
    {
        return preg_match("/" . self::FORM_FIELD_RESTRICTION_PATTERN_EVENT_ID . "/", $eventId);
    }
    public static function isValidEventName(string $eventName): bool
    {
        return (strlen($eventName) >= self::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT);
    }
    public static function isValidEventDescription(string $eventDescription): bool
    {
        return (strlen($eventDescription) >= self::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT);
    }
    public static function isValidEventHeaderImageFile(array $eventHeaderImageFile): bool
    {
        return (!$eventHeaderImageFile || empty($eventHeaderImageFile["name"])
            || (preg_match("/" . self::FORM_FIELD_RESTRICTION_PATTERN_TYPE_IMAGE_FILE . "/", $eventHeaderImageFile["type"])
                && $eventHeaderImageFile["size"] <= self::FORM_FIELD_RESTRICTION_MAX_SIZE_IMAGE_FILE));
    }
    public static function isValidEventStartDateTime(string $eventStartDate, string $eventStartTime): bool
    {
        return self::isValidDate($eventStartDate) && self::isValidTime($eventStartTime);
    }
    public static function isValidEventEndDateTime(string $eventEndDate, string $eventEndTime): bool
    {
        return ((strlen($eventEndDate) == 0 && strlen($eventEndTime) == 0)
            || (self::isValidDate($eventEndDate) && self::isValidTime($eventEndTime)));
    }
    public static function isValidEventLocalName(string $eventLocalName): bool
    {
        return (strlen($eventLocalName) >= self::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT);
    }
    public static function isValidEventLocalAddress(string $eventLocalAddress): bool
    {
        return (strlen($eventLocalAddress) >= self::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT);
    }
    public static function isValidEventTicketPrice(string $eventTicketPrice): bool
    {
        return self::isValidPrice($eventTicketPrice);
    }
    public static function isValidEventLongDrinkPrice(string $eventLongDrinkPrice): bool
    {
        return (strlen($eventLongDrinkPrice) == 0 || self::isValidPrice($eventLongDrinkPrice));
    }
    public static function isValidEventBeerPrice(string $eventBeerPrice): bool
    {
        return (strlen($eventBeerPrice) == 0 || self::isValidPrice($eventBeerPrice));
    }
    public static function isValidEventTags(string $eventTags): bool
    {
        return preg_match("/" . self::FORM_FIELD_RESTRICTION_PATTERN_TAGS . "/", $eventTags);
    }

    public const FORM_FIELD_NAME_ID = "idEventIdInput";
    public const FORM_FIELD_NAME_NAME = "idEventNameInput";
    public const FORM_FIELD_NAME_DESCRIPTION = "idEventDescriptionInput";
    public const FORM_FIELD_NAME_HEADER_IMAGE = "idEventHeaderImageInput";
    public const FORM_FIELD_NAME_START_DATE = "idEventStartDateInput";
    public const FORM_FIELD_NAME_START_TIME = "idEventStartTimeInput";
    public const FORM_FIELD_NAME_END_DATE = "idEventEndDateInput";
    public const FORM_FIELD_NAME_END_TIME = "idEventEndTimeInput";
    public const FORM_FIELD_NAME_TICKET_PRICE = "idEventTicketPriceInput";
    public const FORM_FIELD_NAME_TICKET_PRICE_CHECK = "idFreeEntranceCheckInput";
    public const FORM_FIELD_NAME_LONG_DRINK_PRICE = "idEventLongDrinkPriceInput";
    public const FORM_FIELD_NAME_MAX_OR_MIN_LONG_DRINK_PRICE_CHECK = "idMaxOrMinLongDrinkPriceCheckInput";
    public const FORM_FIELD_NAME_BEER_PRICE = "idEventBeerPriceInput";
    public const FORM_FIELD_NAME_MAX_OR_MIN_BEER_PRICE_CHECK = "idMaxOrMinBeerPriceCheckInput";
    public const FORM_FIELD_NAME_LOCAL_NAME = "idEventLocalNameInput";
    public const FORM_FIELD_NAME_LOCAL_ADDRESS = "idEventLocalAddressInput";
    public const FORM_FIELD_NAME_TAGS = "idEventTagsInput";
    public const FORM_FIELD_RESTRICTION_MAX_SIZE_IMAGE_FILE = 2097152; // bytes - 2 MB
    public const FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT = 5;
    public const FORM_FIELD_RESTRICTION_PATTERN_EVENT_ID = "^[0-9]+$";
    public const FORM_FIELD_RESTRICTION_PATTERN_TYPE_IMAGE_FILE = "^image\/[a-zA-Z0-9\+\-]+$";
    public const FORM_FIELD_RESTRICTION_PATTERN_TAGS = "^[a-zA-ZáéíóúÁÉÍÓÚ \-]+(,[a-zA-ZáéíóúÁÉÍÓÚ \-]+)*$";
    public const FORM_FIELD_RESTRICTION_PATTERN_DATE = "^(lunes|martes|miércoles|jueves|viernes|sábado|domingo), ([1-9]|[1-2][0-9]|3[0-1]) de (enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre) de [2-9][0-9]{3}$";
    public const FORM_FIELD_RESTRICTION_PATTERN_TIME = "^([0-1][0-9]|2[0-3]):[0-5][0-9]$";
    public const FORM_FIELD_RESTRICTION_PATTERN_PRICE = "^[0-9]+((\.|,)[0-9]{1,2})?$";

    // Private
    private static function isValidDate(string $date): bool
    {
        return preg_match("/" . self::FORM_FIELD_RESTRICTION_PATTERN_DATE . "/", $date);
    }
    private static function isValidTime(string $time): bool
    {
        return preg_match("/" . self::FORM_FIELD_RESTRICTION_PATTERN_TIME . "/", $time);
    }
    private static function isValidPrice(string $price): bool
    {
        return preg_match("/" . self::FORM_FIELD_RESTRICTION_PATTERN_PRICE . "/", $price);
    }
}
