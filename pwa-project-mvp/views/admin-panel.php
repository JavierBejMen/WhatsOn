<?php
if (!isset($_SESSION[HelperNavigator::SESSION_VARIABLE_USER_EMAIL])) {
    if (isset($_POST[HelperNavigator::HTML_ID_LOGIN_EMAIL]) && isset($_POST[HelperNavigator::HTML_ID_LOGIN_PASSWORD])) {
        if (DBUser::existsUserWithEncryptedPassword($_POST[HelperNavigator::HTML_ID_LOGIN_EMAIL], $_POST[HelperNavigator::HTML_ID_LOGIN_PASSWORD])) {
            $_SESSION[HelperNavigator::SESSION_VARIABLE_USER_EMAIL] = $_POST[HelperNavigator::HTML_ID_LOGIN_EMAIL];
        } else {
            HelperNavigator::redirectToUrlLoginView();
            exit();
        }
    } else {
        HelperNavigator::redirectToUrlRoot();
        exit();
    }
}
?>
<div class="container-fluid text-black-50 text-center py-4" id="idAdminProfileContainer">
    <p><i class="fas fa-user-circle fa-4x"></i></p>
    <p><?php print($_SESSION[HelperNavigator::SESSION_VARIABLE_USER_EMAIL]); ?></p>
</div>
<div class="container classTertiaryBackgroundColor mb-5 px-0" id="idAdminPanelMain">
    <a class="btn btn-block text-body text-left waves-effect shadow-none border-top border-bottom m-0 py-4" onclick="loadCreateEventView()">
        <i class="far fa-calendar-plus fa-lg pr-4"></i>Crear evento
    </a>
    <a class="btn btn-block text-body text-left waves-effect shadow-none border-bottom m-0 py-4">
        <i class="fas fa-pen fa-lg pr-4"></i>Modificar evento
    </a>
    <a class="btn btn-block text-body text-left waves-effect shadow-none border-bottom m-0 py-4" href="<?php print(HelperNavigator::getUrlLogout()); ?>">
        <i class="fas fa-power-off fa-lg pr-4"></i>Cerrar sesión
    </a>
</div>
<script>
    window.addEventListener("DOMContentLoaded", () => {
        setHtmlBodyBackgroundColor(HTML_CLASS_TERTIARY_BACKGROUND_COLOR);
        showMainMenuBar();
    });
</script>