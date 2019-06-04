<?php
final class HelperNavigator
{
    public static function redirectUrlBasedOnSessionVariableUserEmailAndQueryParameters()
    {
        if (isset($_GET[self::URL_QUERY_PARAMETER_LOGOUT])) {
            unset($_SESSION[self::SESSION_VARIABLE_USER_EMAIL]);
        } else if (isset($_SESSION[self::SESSION_VARIABLE_USER_EMAIL])) {
            if ($_GET && isset($_GET[self::URL_QUERY_PARAMETER_VIEW])) {
                $isValidUrlQuery = true;
                switch ($_GET[self::URL_QUERY_PARAMETER_VIEW]) {
                    case self::URL_PARAMETER_VIEW_VALUE_ADMIN_PANEL:
                        if (!self::isValidUrlQueryForAdminPanelView($_GET)) {
                            $isValidUrlQuery = false;
                        }
                        break;
                    case self::URL_PARAMETER_VIEW_VALUE_CREATE_EVENT:
                        if (!self::isValidUrlQueryForCreateEventView($_GET)) {
                            $isValidUrlQuery = false;
                        }
                        break;
                    default:
                        $isValidUrlQuery = false;
                        break;
                }
                if (!$isValidUrlQuery) {
                    self::redirectToUrlRoot();
                    exit();
                }
            } else {
                self::redirectToUrlAdminPanelView();
                exit();
            }
        } else if ($_GET && isset($_GET[self::URL_QUERY_PARAMETER_VIEW])) {
            $isValidUrlQuery = true;
            switch ($_GET[self::URL_QUERY_PARAMETER_VIEW]) {
                case self::URL_PARAMETER_VIEW_VALUE_EVENTS:
                    if (!self::isValidUrlQueryForEventsView($_GET)) {
                        $isValidUrlQuery = false;
                    }
                    break;
                case self::URL_PARAMETER_VIEW_VALUE_EVENT_INFO:
                    if (!(self::isValidUrlQueryForEventInfoView($_GET)
                        && DBEvent::getEventFromId($_GET[self::URL_QUERY_PARAMETER_EVENT_ID]))) {
                        $isValidUrlQuery = false;
                    }
                    break;
                case self::URL_PARAMETER_VIEW_VALUE_LOGIN:
                    break;
                default:
                    $isValidUrlQuery = false;
                    break;
            }
            if (!$isValidUrlQuery) {
                self::redirectToUrlRoot();
                exit();
            }
        } else if ($_GET && !isset($_GET[self::URL_QUERY_PARAMETER_VIEW])) {
            self::redirectToUrlRoot();
            exit();
        }
    }
    public static function getPhpAbsoluteFilePathFromQueryParameterView(string $parameterViewValue): string
    {
        switch ($parameterViewValue) {
            case self::URL_PARAMETER_VIEW_VALUE_EVENT_INFO:
                $relativeFilePathView = self::FILE_PATH_EVENT_INFO_VIEW;
                break;
            case self::URL_PARAMETER_VIEW_VALUE_LOGIN:
                $relativeFilePathView = self::FILE_PATH_LOGIN_VIEW;
                break;
            case self::URL_PARAMETER_VIEW_VALUE_ADMIN_PANEL:
                $relativeFilePathView = self::FILE_PATH_ADMIN_PANEL_VIEW;
                break;
            case self::URL_PARAMETER_VIEW_VALUE_CREATE_EVENT:
                $relativeFilePathView = self::FILE_PATH_CREATE_EVENT_VIEW;
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
    public static function getUrlRefererOrRoot()
    {
        return ($_SERVER["HTTP_REFERER"]) ? self::getUrlReferer() : self::getUrlRoot();
    }
    public static function getUrlRoot(): string
    {
        return ((self::isSecureConnection()) ? "https://" : "http://") . $_SERVER["HTTP_HOST"];
    }
    public static function getUrlReferer(): string
    {
        return $_SERVER["HTTP_REFERER"];
    }
    public static function getUrlEventInfoViewFromEventId(string $eventId): string
    {
        $queryArray = array(self::URL_QUERY_PARAMETER_VIEW => self::URL_PARAMETER_VIEW_VALUE_EVENT_INFO, self::URL_QUERY_PARAMETER_EVENT_ID => $eventId);
        return self::getUrlRoot() . self::FILE_PATH_INDEX_SCRIPT . "?" . http_build_query($queryArray);
    }
    public static function getUrlLoginView(): string
    {
        $queryArray = array(self::URL_QUERY_PARAMETER_VIEW => self::URL_PARAMETER_VIEW_VALUE_LOGIN);
        return self::getUrlRoot() . self::FILE_PATH_INDEX_SCRIPT . "?" . http_build_query($queryArray);
    }
    public static function getUrlAdminPanelView(): string
    {
        $queryArray = array(self::URL_QUERY_PARAMETER_VIEW => self::URL_PARAMETER_VIEW_VALUE_ADMIN_PANEL);
        return self::getUrlRoot() . self::FILE_PATH_INDEX_SCRIPT . "?" . http_build_query($queryArray);
    }
    public static function getUrlCreateEventView(): string
    {
        $queryArray = array(self::URL_QUERY_PARAMETER_VIEW => self::URL_PARAMETER_VIEW_VALUE_CREATE_EVENT);
        return self::getUrlRoot() . self::FILE_PATH_INDEX_SCRIPT . "?" . http_build_query($queryArray);
    }
    public static function getUrlLogout(): string
    {
        return self::getUrlRoot() . self::FILE_PATH_INDEX_SCRIPT . "?" . self::URL_QUERY_PARAMETER_LOGOUT;
    }
    public static function getUrlLoginScript(): string
    {
        return self::getUrlRoot() . self::FILE_PATH_LOGIN_SCRIPT;
    }
    public static function getUrlLogoutScript(): string
    {
        return self::getUrlRoot() . self::FILE_PATH_LOGOUT_SCRIPT;
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
        $existsQueryParameterViewWithEventsValue = isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW] === self::URL_PARAMETER_VIEW_VALUE_EVENTS;
        return (isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_EVENTS_FROM_DATE]) && $existsQueryParameterViewWithEventsValue)
            || $existsQueryParameterViewWithEventsValue;
    }
    public static function isValidUrlQueryForEventInfoView(array $arrayOfQueryParameters): bool
    {
        return isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW])
            && $arrayOfQueryParameters[self::URL_QUERY_PARAMETER_VIEW] === self::URL_PARAMETER_VIEW_VALUE_EVENT_INFO
            && isset($arrayOfQueryParameters[self::URL_QUERY_PARAMETER_EVENT_ID]);
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
    public static function isSecureConnection()
    {
        return (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on");
    }
    public const FILE_PATH_EVENTS_VIEW = "/views/events.php";
    public const FILE_PATH_EVENT_INFO_VIEW = "/views/event-info.php";
    public const FILE_PATH_LOGIN_VIEW = "/views/login.php";
    public const FILE_PATH_ADMIN_PANEL_VIEW = "/views/admin-panel.php";
    public const FILE_PATH_CREATE_EVENT_VIEW = "/views/admin-panel-subviews/create-event.php";
    public const FILE_PATH_INDEX_SCRIPT = "/index.php";
    public const FILE_PATH_LOGIN_SCRIPT = "/php_scripts/login.php";
    public const FILE_PATH_LOGOUT_SCRIPT = "/php_scripts/logout.php";
    public const URL_QUERY_PARAMETER_VIEW = "view";
    public const URL_QUERY_PARAMETER_EVENT_ID = "event-id";
    public const URL_QUERY_PARAMETER_EVENTS_FROM_DATE = "events-from-date";
    public const URL_QUERY_PARAMETER_LOGOUT = "logout";
    public const URL_PARAMETER_VIEW_VALUE_EVENTS = "events";
    public const URL_PARAMETER_VIEW_VALUE_EVENT_INFO = "event-info";
    public const URL_PARAMETER_VIEW_VALUE_LOGIN = "login";
    public const URL_PARAMETER_VIEW_VALUE_ADMIN_PANEL = "admin-panel";
    public const URL_PARAMETER_VIEW_VALUE_CREATE_EVENT = "create-event";
    public const SESSION_VARIABLE_USER_EMAIL = "user_email";
    public const HTML_ID_LOGIN_EMAIL = "idLoginEmail";
    public const HTML_ID_LOGIN_PASSWORD = "idLoginPassword";
}
