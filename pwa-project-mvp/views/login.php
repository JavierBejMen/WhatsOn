<nav class="navbar navbar-expand fixed-top classPrimaryBackgroundColor text-white" id="idEventInfoMenuBar">
    <ul class="navbar-nav w-100 justify-content-between">
        <li class="nav-item">
            <a class="nav-link text-white waves-effect waves-light classRoundNavigationLink" title="Volver atrás" aria-label="Volver atrás" href="<?php print(HelperNavigator::getUrlRefererOrRoot()); ?>">
                <i class="fas fa-arrow-left fa-sm"></i>
            </a>
        </li>
        <li class="nav-item pt-2">
            <h5>Inicio de sesión</h5>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-effect waves-light classRoundNavigationLink" title="Más acciones" aria-label="Más acciones">
                <i class="fas fa-ellipsis-v fa-sm"></i>
            </a>
        </li>
    </ul>
</nav>
<div class="container classTertiaryBackgroundColor mb-5" id="idLoginMain">
    <form class="needs-validation mx-auto py-5" id="idLoginForm" method="post" action="<?php print(HelperNavigator::getUrlLoginScript()); ?>" novalidate>
        <div class="form-group">
            <label for="idLoginEmail">Usuario</label>
            <input type="email" class="form-control classTertiaryBackgroundColor classOnlyBottomBorderInput" id="idLoginEmail" name="idLoginEmail" placeholder="Email" autocomplete="username" autofocus required>
            <div class="invalid-feedback">
                Por favor, introduce una dirección de correo electrónico.
            </div>
        </div>
        <div class="form-group pb-4">
            <label for="idLoginPassword">Contraseña</label>
            <input type="password" class="form-control classTertiaryBackgroundColor classOnlyBottomBorderInput" id="idLoginPassword" name="idLoginPassword" placeholder="Contraseña" autocomplete="current-password" required>
            <div class="invalid-feedback">
                Por favor, introduce la contraseña.
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button id="idLoginButton" type="submit" class="btn btn-lg btn-default waves-effect mx-auto">ACCEDER</button>
        </div>
    </form>
    <div class="container-flex text-black-50">
        Sólo los administradores autorizados pueden crear eventos de momento. Si estás interesado/a en publicar eventos
        en WhatsOn, ponte en <a class="text-body" href="#"><u>contacto</u></a> con nosotros.
    </div>
</div>
<script>
    window.addEventListener("DOMContentLoaded", () => {
        setHtmlBodyBackgroundColor(HTML_CLASS_TERTIARY_BACKGROUND_COLOR);
        hideMainMenuBar();
        let htmlLoginForm = document.getElementById(HTML_ID_LOGIN_FORM);
        htmlLoginForm.addEventListener("submit", () => {
            HelperForm.validateHtmlForm(htmlLoginForm);
        }, false);
    });
</script>