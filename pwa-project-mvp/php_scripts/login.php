<?php
spl_autoload_register(function ($className) {
    require($_SERVER["DOCUMENT_ROOT"] . "/php_classes/$className.php");
});
if (
    isset($_POST[HelperNavigator::HTML_ID_LOGIN_EMAIL]) && isset($_POST[HelperNavigator::HTML_ID_LOGIN_PASSWORD])
    && DBUser::existsUserWithEncryptedPassword($_POST[HelperNavigator::HTML_ID_LOGIN_EMAIL], $_POST[HelperNavigator::HTML_ID_LOGIN_PASSWORD])
) {
    session_start();
    $_SESSION[HelperNavigator::SESSION_VARIABLE_USER_EMAIL] = $_POST[HelperNavigator::HTML_ID_LOGIN_EMAIL];
    HelperNavigator::redirectToUrlAdminPanelView();
    exit();
}
HelperNavigator::redirectToUrlLoginView();
exit();
