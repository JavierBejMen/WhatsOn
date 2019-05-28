<?php
final class HelperNavigator
{
    public static function getPhpAbsoluteFilePathFromQueryParameterView(string $parameterViewValue): string
    {
        switch ($parameterViewValue) {
            case self::URL_PARAMETER_VIEW_VALUE_EVENT_INFO:
                $relativeFilePathView = self::FILE_PATH_EVENT_INFO_VIEW;
                break;
            case self::URL_PARAMETER_VIEW_VALUE_LOGIN:
                $relativeFilePathView = self::FILE_PATH_LOGIN_VIEW;
                break;
            case self::PARAMETER_VIEW_ADMIN_PANEL:
                $relativeFilePathView = self::FILE_PATH_ADMIN_PANEL_VIEW;
                break;
            case self::URL_PARAMETER_VIEW_VALUE_EVENTS:
            default:
                $relativeFilePathView = self::FILE_PATH_EVENTS_VIEW;
                break;
        }
        return self::getPhpAbsoluteFilePathFromPhpRelativeFilePath($relativeFilePathView);
    }
    public static function getPhpAbsoluteFilePathFromPhpRelativeFilePath(string $phpRelativeFilePath): string
    {
        return $_SERVER["DOCUMENT_ROOT"] . $phpRelativeFilePath;
    }
    public static function getUrlRoot(): string
    {
        return ((self::isSecureConnection()) ? "https://" : "http://") . $_SERVER["HTTP_HOST"];
    }
    public static function getUrlEventInfoViewFromEventId(string $eventId): string
    {
        $queryArray = array(self::URL_QUERY_PARAMETER_VIEW => self::URL_PARAMETER_VIEW_VALUE_EVENT_INFO, self::URL_QUERY_PARAMETER_EVENT_ID => $eventId);
        return self::getUrlRoot() . $_SERVER["SCRIPT_NAME"] . "?" . http_build_query($queryArray);
    }
    public static function getUrlLoginView(): string
    {
        $queryArray = array(self::URL_QUERY_PARAMETER_VIEW => self::URL_PARAMETER_VIEW_VALUE_LOGIN);
        return self::getUrlRoot() . $_SERVER["SCRIPT_NAME"] . "?" . http_build_query($queryArray);
    }
    public static function getUrlAdminPanelView(): string
    {
        $queryArray = array(self::URL_QUERY_PARAMETER_VIEW => self::PARAMETER_VIEW_ADMIN_PANEL);
        return self::getUrlRoot() . $_SERVER["SCRIPT_NAME"] . "?" . http_build_query($queryArray);
    }
    public static function getUrlLogout(): string
    {
        return self::getUrlRoot() . $_SERVER["SCRIPT_NAME"] . "?" . self::URL_QUERY_PARAMETER_LOGOUT;
    }
    public static function redirectToUrlRoot()
    {
        header("Location: " . self::getUrlRoot());
    }
    public static function redirectToUrlLoginView()
    {
        header("Location: " . self::getUrlLoginView());
    }
    public static function redirectToUrlAdminPanelView()
    {
        header("Location: " . self::getUrlAdminPanelView());
    }
    public static function isValidUrlQueryForEventsView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW] === self::URL_PARAMETER_VIEW_VALUE_EVENTS
            && isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_EVENTS_FROM_DATE]);
    }
    public static function isValidUrlQueryForEventInfoView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW] === self::URL_PARAMETER_VIEW_VALUE_EVENT_INFO
            && isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_EVENT_ID]);
    }
    public static function isSecureConnection()
    {
        return (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on");
    }
    public const FILE_PATH_EVENTS_VIEW = "/views/events.php";
    public const FILE_PATH_EVENT_INFO_VIEW = "/views/event-info.php";
    public const FILE_PATH_LOGIN_VIEW = "/views/login.php";
    public const FILE_PATH_ADMIN_PANEL_VIEW = "/views/admin-panel.php";
    // public const FILE_PATH_CREATE_EVENT_VIEW = "/views/admin-panel-subviews/create-event.html";
    public const URL_QUERY_PARAMETER_VIEW = "view";
    public const URL_QUERY_PARAMETER_EVENT_ID = "event-id";
    public const URL_QUERY_PARAMETER_EVENTS_FROM_DATE = "events-from-date";
    public const URL_QUERY_PARAMETER_LOGOUT = "logout";
    public const URL_PARAMETER_VIEW_VALUE_EVENTS = "events";
    public const URL_PARAMETER_VIEW_VALUE_EVENT_INFO = "event-info";
    public const URL_PARAMETER_VIEW_VALUE_LOGIN = "login";
    public const PARAMETER_VIEW_ADMIN_PANEL = "admin-panel";
    public const SESSION_VARIABLE_USER_EMAIL = "user_email";
    public const HTML_ID_LOGIN_EMAIL = "idLoginEmail";
    public const HTML_ID_LOGIN_PASSWORD = "idLoginPassword";
}
