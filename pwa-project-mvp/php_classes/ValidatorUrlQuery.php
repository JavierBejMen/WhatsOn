<?php

final class ValidatorUrlQuery
{
    public static function isValidUrlQueryForEventsView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW] === self::URL_PARAMETER_VIEW_VALUE_EVENTS
            && (!isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_EVENTS_FROM_DATE])
                || preg_match(
                    "/" . self::URL_PARAMETER_EVENTS_FROM_DATE_PATTERN_VALUE . "/",
                    $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_EVENTS_FROM_DATE]
                ));
    }
    public static function isValidUrlQueryForEventInfoView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW] === self::URL_PARAMETER_VIEW_VALUE_EVENT_INFO
            && isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_EVENT_ID])
            && preg_match("/" . self::URL_PARAMETER_EVENT_ID_PATTERN_VALUE . "/", $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_EVENT_ID]);
    }
    public static function isValidUrlQueryForLoginView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW] === self::URL_PARAMETER_VIEW_VALUE_LOGIN;
    }
    public static function isValidUrlQueryForAdminPanelView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW] === self::URL_PARAMETER_VIEW_VALUE_ADMIN_PANEL;
    }
    public static function isValidUrlQueryForCreateEventView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW] === self::URL_PARAMETER_VIEW_VALUE_CREATE_EVENT;
    }
    public static function isValidUrlQueryForUpdateEventView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW] === self::URL_PARAMETER_VIEW_VALUE_UPDATE_EVENT
            && isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_EVENT_ID])
            && preg_match("/" . self::URL_PARAMETER_EVENT_ID_PATTERN_VALUE . "/", $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_EVENT_ID]);
    }
    public const URL_QUERY_PARAMETER_VIEW = "view";
    public const URL_QUERY_PARAMETER_EVENT_ID = "event-id";
    public const URL_QUERY_PARAMETER_EVENTS_FROM_DATE = "events-from-date";
    public const URL_PARAMETER_VIEW_VALUE_EVENTS = "events";
    public const URL_PARAMETER_VIEW_VALUE_EVENT_INFO = "event-info";
    public const URL_PARAMETER_VIEW_VALUE_LOGIN = "login";
    public const URL_PARAMETER_VIEW_VALUE_ADMIN_PANEL = "admin-panel";
    public const URL_PARAMETER_VIEW_VALUE_CREATE_EVENT = "create-event";
    public const URL_PARAMETER_VIEW_VALUE_UPDATE_EVENT = "update-event";
    public const URL_PARAMETER_EVENT_ID_PATTERN_VALUE = "^[0-9]+$";
    public const URL_PARAMETER_EVENTS_FROM_DATE_PATTERN_VALUE = "^[2-9][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$";
}
