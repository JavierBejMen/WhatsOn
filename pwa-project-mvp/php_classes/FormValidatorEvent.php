<?php
class FormValidatorEvent
{
    public static function isValidEvent(
        array $eventImageFile,
        string $eventName,
        string $eventDescription,
        string $eventTags,
        string $eventStartDate,
        string $eventStartTime,
        string $eventEndDate,
        string $eventEndTime,
        string $eventTicketPrice,
        string $eventLongDrinkPrice,
        string $eventBeerPrice,
        string $eventLocal,
        string $eventAddress
    ): bool {
        return self::isValidEventImageFile($eventImageFile) && self::isValidEventName($eventName)
            && self::isValidEventDescription($eventDescription) && self::isValidEventTags($eventTags)
            && self::isValidEventStartDateTime($eventStartDate, $eventStartTime) && self::isValidEventEndDateTime($eventEndDate, $eventEndTime)
            && self::isValidEventTicketPrice($eventTicketPrice) && self::isValidEventLongDrinkPrice($eventLongDrinkPrice)
            && self::isValidEventBeerPrice($eventBeerPrice) && self::isValidEventLocal($eventLocal) && self::isValidEventAddress($eventAddress);
    }
    public static function isValidEventImageFile(array $eventImageFile): bool
    {
        return (!$eventImageFile || empty($eventImageFile["name"])
            || preg_match("/" . self::FORM_FIELD_RESTRICTION_PATTERN_TYPE_IMAGE_FILE . "/", $eventImageFile["type"]));
    }
    public static function isValidEventName(string $eventName): bool
    {
        return (strlen($eventName) >= self::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT);
    }
    public static function isValidEventDescription(string $eventDescription): bool
    {
        return (strlen($eventDescription) >= self::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT);
    }
    public static function isValidEventTags(string $eventTags): bool
    {
        return preg_match("/" . self::FORM_FIELD_RESTRICTION_PATTERN_TAGS . "/", $eventTags);
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
    public static function isValidEventLocal(string $eventLocal): bool
    {
        return (strlen($eventLocal) >= self::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT);
    }
    public static function isValidEventAddress(string $eventAddress): bool
    {
        return (strlen($eventAddress) >= self::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT);
    }

    public const FORM_FIELD_NAME_IMAGE_FILE = "idEventImageFileInput";
    public const FORM_FIELD_NAME_NAME = "idEventNameInput";
    public const FORM_FIELD_NAME_DESCRIPTION = "idEventDescriptionInput";
    public const FORM_FIELD_NAME_TAGS = "idEventTagsInput";
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
    public const FORM_FIELD_NAME_LOCAL = "idEventLocalInput";
    public const FORM_FIELD_NAME_ADDRESS = "idEventAddressInput";
    public const FORM_FIELD_RESTRICTION_MAX_SIZE_IMAGE_FILE = 2097152;
    public const FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT = 5;
    public const FORM_FIELD_RESTRICTION_PATTERN_TYPE_IMAGE_FILE = "^image\/[a-zA-Z0-9\+\-]+$";
    public const FORM_FIELD_RESTRICTION_PATTERN_TAGS = "^([a-zA-ZáéíóúÁÉÍÓÚ \-]+,)+$";
    public const FORM_FIELD_RESTRICTION_PATTERN_DATE = "^(lunes|martes|miércoles|jueves|viernes|sábado|domingo), ([1-9]|[1-9][0-9]) de (enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre) de [2-9][0-9]{3}$";
    public const FORM_FIELD_RESTRICTION_PATTERN_TIME = "^([0-9]|1[0-9]|2[0-3]):[0-5][0-9]$";
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
