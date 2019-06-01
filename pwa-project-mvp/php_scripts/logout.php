<?php
spl_autoload_register(function ($className) {
    require($_SERVER["DOCUMENT_ROOT"] . "/php_classes/$className.php");
});
session_start();
unset($_SESSION[HelperNavigator::SESSION_VARIABLE_USER_EMAIL]);
HelperNavigator::redirectToUrlRoot();
exit();
