<?php
final class HelperNavigator
{
    public static function getPhpAbsoluteFilePathFromQueryParameterView(string $parameterViewValue): string
    {
        switch ($parameterViewValue) {
            case HelperNavigator::PARAMETER_VIEW_VALUE_EVENT_INFO:
                $relativeFilePathView = HelperNavigator::FILE_PATH_EVENT_INFO_VIEW;
                break;
            case HelperNavigator::PARAMETER_VIEW_VALUE_EVENTS:
            default:
                $relativeFilePathView = HelperNavigator::FILE_PATH_EVENTS_VIEW;
                break;
        }
        return self::getPhpAbsoluteFilePathFromPhpRelativeFilePath($relativeFilePathView);
    }
    public static function getPhpAbsoluteFilePathFromPhpRelativeFilePath(string $phpRelativeFilePath): string
    {
        return $_SERVER["DOCUMENT_ROOT"] . $phpRelativeFilePath;
    }
    public static function getUrlEventInfoViewFromEventId(string $eventId): string
    {
        $queryArray = array(self::QUERY_PARAMETER_VIEW => self::PARAMETER_VIEW_VALUE_EVENT_INFO, self::QUERY_PARAMETER_EVENT_ID => $eventId);
        return self::getUrlRoot() . $_SERVER["SCRIPT_NAME"] . "?" . http_build_query($queryArray);
    }
    public static function getUrlRoot(): string
    {
        return ((self::isSecureConnection()) ? "https://" : "http://") . $_SERVER["HTTP_HOST"];
    }
    public static function redirectToUrlRoot()
    {
        header("Location: " . self::getUrlRoot());
    }
    public static function isValidUrlQueryForEventsView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[HelperNavigator::QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[HelperNavigator::QUERY_PARAMETER_VIEW] === HelperNavigator::PARAMETER_VIEW_VALUE_EVENTS
            && isset($arrayOfQueryParameters[HelperNavigator::QUERY_PARAMETER_EVENTS_FROM_DATE]);
    }
    public static function isValidUrlQueryForEventInfoView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[HelperNavigator::QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[HelperNavigator::QUERY_PARAMETER_VIEW] === HelperNavigator::PARAMETER_VIEW_VALUE_EVENT_INFO
            && isset($arrayOfQueryParameters[HelperNavigator::QUERY_PARAMETER_EVENT_ID]);
    }
    public static function isSecureConnection()
    {
        return (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on");
    }
    public const FILE_PATH_EVENTS_VIEW = "/views/events.php";
    public const FILE_PATH_EVENT_INFO_VIEW = "/views/event-info.php";
    // public const FILE_PATH_LOGIN_VIEW = "/views/login.html";
    // public const FILE_PATH_ADMIN_PANEL_VIEW = "/views/admin-panel.html";
    // public const FILE_PATH_CREATE_EVENT_VIEW = "/views/admin-panel-subviews/create-event.html";
    public const QUERY_PARAMETER_VIEW = "view";
    public const QUERY_PARAMETER_EVENT_ID = "event-id";
    public const QUERY_PARAMETER_EVENTS_FROM_DATE = "events-from-date";
    public const PARAMETER_VIEW_VALUE_EVENTS = "events";
    public const PARAMETER_VIEW_VALUE_EVENT_INFO = "event-info";
}
