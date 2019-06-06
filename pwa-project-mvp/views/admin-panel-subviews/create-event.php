<!--
    MAX_FILE_SIZE must preceed file input.

    This form element should always be used as it saves users the trouble of waiting for a big file being transferred only to find 
    that it was too large and the transfer failed.

    More info: https://www.php.net/manual/en/features.file-upload.post-method.php
-->
<nav class="navbar navbar-expand fixed-top classPrimaryBackgroundColor text-white" id="idCreateEventMenuBar">
    <ul class="navbar-nav w-100 justify-content-between">
        <li class="nav-item">
            <a class="nav-link text-white waves-effect waves-light classRoundNavigationLink" title="Volver atrás" aria-label="Volver atrás" href="<?php print(HelperNavigator::getUrlAdminPanelView()); ?>">
                <i class="fas fa-arrow-left fa-sm"></i>
            </a>
        </li>
        <li class="nav-item pt-2">
            <h5>Crear evento</h5>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-effect waves-light classRoundNavigationLink" title="Más acciones" aria-label="Más acciones">
                <i class="fas fa-ellipsis-v fa-sm"></i>
            </a>
        </li>
    </ul>
</nav>
<div class="d-flex justify-content-center align-items-center classTertiaryBackgroundColor text-black-50 text-center pt-4 pb-2" id="idEventImageContainer">
    <div id="idEventTemporaryImage">
        <i class="fas fa-camera fa-7x"></i>
        <p class="pt-3">Imagen del evento</p>
    </div>
    <button type="button" class="btn btn-sm classSecondaryBackgroundColor text-white waves-effect waves-light" id="idAddEventImageButton" title="Añadir imagen de evento" aria-label="Añadir imagen de evento">
        <i class="fas fa-pen fa-2x"></i>
    </button>
</div>
<div class="container py-3" id="idCreateEventMain">
    <form class="needs-validation mx-auto" id="idCreateEventForm" method="post" enctype="multipart/form-data" action="<?php print(HelperNavigator::getUrlCreateEventScript()); ?>" novalidate>
        <div class="form-group">
            <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="<?php print(FormValidatorEvent::FORM_FIELD_RESTRICTION_MAX_SIZE_IMAGE_FILE); ?>" />
            <input id="idEventImageFileInput" name="idEventImageFileInput" accept="image/*" type="file" hidden>
            <div class="invalid-feedback">
                Por favor, introduce una imagen válida.
            </div>
        </div>
        <div class="form-group">
            <label for="idEventNameInput">Qué <span class="text-danger">*</span></label>
            <input class="form-control classOnlyBottomBorderInput" id="idEventNameInput" name="idEventNameInput" type="text" minlength="<?php print(FormValidatorEvent::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT); ?>" placeholder="Nombre del evento" required>
            <div class="invalid-feedback">
                Por favor, introduce un nombre válido.
            </div>
        </div>
        <div class="form-group">
            <label for="idEventDescriptionInput">En qué consiste <span class="text-danger">*</span></label>
            <textarea class="form-control classOnlyBottomBorderInput" id="idEventDescriptionInput" name="idEventDescriptionInput" rows="5" minlength="<?php print(FormValidatorEvent::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT); ?>" placeholder="Descripción del evento" required></textarea>
            <div class="invalid-feedback">
                Por favor, introduce una descripción válida.
            </div>
        </div>
        <div class="d-flex mb-4">
            <i class="text-primary fas fa-tags fa-lg mr-3"></i>
            <div class="w-100">
                <div class="form-group">
                    <label for="idEventTagsInput">Etiquetas <span class="text-danger">*</span></label>
                    <input class="form-control" id="idEventTagsInput" name="idEventTagsInput" type="text" pattern="<?php print(FormValidatorEvent::FORM_FIELD_RESTRICTION_PATTERN_TAGS); ?>" required hidden>
                    <div class="row justify-content-start classTagsList" id="idEventTagsList"></div>
                    <div class="invalid-feedback">
                        Por favor, introduce una o más etiquetas.
                    </div>
                    <button class="btn classSecondaryBackgroundColor text-white waves-effect waves-light w-100 mx-auto mt-3 py-2" type="button" id="idCreateEventShowModalForAddingTagsButton" title="Añadir etiquetas" aria-label="Añadir etiquetas" data-toggle="modal" data-target="#idTagsModal" data-backdrop="false" title="Filtro de etiquetas" aria-label="Filtro de etiquetas">
                        <i class="fas fa-pen fa-lg"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="d-flex mb-4">
            <i class="text-primary fas fa-calendar fa-lg mr-3"></i>
            <div class="w-100">
                <div class="form-group">
                    <label for="idEventStartDateTimeButton">Cuándo empieza <span class="text-danger">*</span></label>
                    <input class="form-control classStartDateTimeInput mb-2" id="idEventStartDateInput" name="idEventStartDateInput" type="text" pattern="<?php print(FormValidatorEvent::FORM_FIELD_RESTRICTION_PATTERN_DATE); ?>" placeholder="Fecha" required>
                    <input class="form-control classStartDateTimeInput" id="idEventStartTimeInput" name="idEventStartTimeInput" type="text" pattern="<?php print(FormValidatorEvent::FORM_FIELD_RESTRICTION_PATTERN_TIME); ?>" placeholder="Hora" required>
                    <div class="invalid-feedback">
                        Por favor, introduce una fecha y hora de comienzo válida.
                    </div>
                    <button class="btn classSecondaryBackgroundColor text-white waves-effect waves-light w-100 mx-auto mt-3 py-2" type="button" id="idEventStartDateTimeButton" title="Elegir fecha y hora de comienzo" aria-label="Elegir fecha y hora del evento de comienzo">
                        <i class="fas fa-calendar-day fa-lg"></i>
                    </button>
                </div>
                <div class="form-group">
                    <label for="idEventEndDateTimeButton">Cuándo termina</span></label>
                    <input class="form-control classEndDateTimeInput mb-2" id="idEventEndDateInput" name="idEventEndDateInput" type="text" pattern="<?php print(FormValidatorEvent::FORM_FIELD_RESTRICTION_PATTERN_DATE); ?>" placeholder="Fecha">
                    <input class="form-control classEndDateTimeInput" id="idEventEndTimeInput" name="idEventEndTimeInput" type="text" pattern="<?php print(FormValidatorEvent::FORM_FIELD_RESTRICTION_PATTERN_TIME); ?>" placeholder="Hora">
                    <button class="btn classSecondaryBackgroundColor text-white waves-effect waves-light w-100 mx-auto mt-3 py-2" type="button" id="idEventEndDateTimeButton" title="Elegir fecha y hora de fin" aria-label="Elegir fecha y hora del evento">
                        <i class="fas fa-calendar-day fa-lg"></i>
                    </button>
                </div>
            </div>
        </div>
        <label for="idEventPricesContainer">Precios</label>
        <div class="mx-4 mb-3" id="idEventPricesContainer">
            <div class="d-flex">
                <div class="form-group">
                    <label for="idEventTicketPriceInput">Entrada <span class="text-danger">*</span></label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventTicketPriceInput" name="idEventTicketPriceInput" type="number" min="0" step="0.01" placeholder="Precio de la entrada" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="idFreeEntranceCheckInput" name="idFreeEntranceCheckInput">
                    <label class="form-check-label" for="idFreeEntranceCheckInput">
                        Entraba libre
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group">
                    <label for="idEventLongDrinkPriceInput">Copa</label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventLongDrinkPriceInput" name="idEventLongDrinkPriceInput" type="number" min="0" step="0.01" placeholder="Precio de la copa">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="idMaxOrMinLongDrinkPriceCheckInput" name="idMaxOrMinLongDrinkPriceCheckInput">
                    <label class="form-check-label" for="idMaxOrMinLongDrinkPriceCheckInput">
                        Máx./mín.
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group">
                    <label for="idEventBeerPriceInput">Cerveza</label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventBeerPriceInput" name="idEventBeerPriceInput" type="number" min="0" step="0.01" placeholder="Precio de la cerveza">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="idMaxOrMinBeerPriceCheckInput" name="idMaxOrMinBeerPriceCheckInput">
                    <label class="form-check-label" for="idMaxOrMinBeerPriceCheckInput">
                        Máx./mín.
                    </label>
                </div>
            </div>
        </div>
        <div class="d-flex mb-4">
            <i class="text-primary fas fa-map-marker-alt fa-lg mr-3"></i>
            <div class="w-100">
                <div class="form-group">
                    <label for="idEventLocalNameInput">Dónde <span class="text-danger">*</span></label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventLocalNameInput" name="idEventLocalNameInput" type="text" minlength="<?php print(FormValidatorEvent::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT); ?>" placeholder="Bar, pub, discoteca o local" required>
                    <div class="invalid-feedback">
                        Por favor, introduce el nombre del local.
                    </div>
                </div>
                <div class="form-group">
                    <label for="idEventLocalAddressInput">Dirección <span class="text-danger">*</span></label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventLocalAddressInput" name="idEventLocalAddressInput" type="text" minlength="<?php print(FormValidatorEvent::FORM_FIELD_RESTRICTION_MIN_LENGTH_TEXT); ?>" placeholder="Dirección del evento" required>
                    <div class="invalid-feedback">
                        Por favor, introduce la dirección.
                    </div>
                </div>
            </div>
        </div>
        <button id="idCreateEventSubmitButton" type="submit" class="btn btn-lg w-100 btn-default waves-effect mx-auto">
            CREAR EVENTO
        </button>
    </form>
</div>
<?php
require(HelperNavigator::getPhpAbsoluteFilePathFromPhpRelativeFilePath(HelperNavigator::FILE_PATH_TAGS_MODAL_COMPONENT));
?>
<script>
    window.addEventListener("DOMContentLoaded", () => {
        setHtmlBodyBackgroundColor(HTML_CLASS_WHITE_BACKGROUND_COLOR);
        hideMainMenuBar();

        ////////////////////////////////// TODO - Refactor

        document.getElementById("idAddEventImageButton").addEventListener("click", () => {
            document.getElementById("idEventImageFileInput").click();
        });
        let htmlEventImageFileInput = document.getElementById("idEventImageFileInput");
        htmlEventImageFileInput.addEventListener("input", () => {
            if (htmlEventImageFileInput.files && htmlEventImageFileInput.files[0]) {
                let fileReader = new FileReader();
                fileReader.onload = (event) => {
                    document.getElementById("idEventTemporaryImage").hidden = true;
                    document.getElementById("idEventImageContainer").style.backgroundImage = "url('" + event.target.result + "')";
                };
                fileReader.readAsDataURL(htmlEventImageFileInput.files[0]);
            }
        });

        //////////////////////////////////

        HelperTagsModal.clearEnabledTagValuesFromSessionStorage(SESSION_STORAGE_KEY_ENABLED_TAG_VALUES);
        document.getElementById(HTML_ID_CREATE_EVENT_SHOW_MODAL_FOR_ADDING_TAGS_BUTTON).addEventListener("click", () => {
            HelperTagsModal.loadPreviousEnabledTagValuesFromSessionStorageToHtmlFormModal(SESSION_STORAGE_KEY_ENABLED_TAG_VALUES);
        });
        document.getElementById(HTML_ID_TAGS_MODAL_SAVE_BUTTON).addEventListener("click", () => {
            HelperTagsModal.saveEnabledTagValuesFromHtmlModalFormToSessionStorage(SESSION_STORAGE_KEY_ENABLED_TAG_VALUES);
            fillHtmlEventTagsInputWithEnabledTagValuesFromTagsModal(HTML_ID_EVENT_TAGS_INPUT);
            fillHtmlEventTagsListWithEnabledTagValuesFromTagsModal(HTML_ID_EVENT_TAGS_LIST);
        });
        // Event StartDate and StartTime Pickers
        Array.from(document.getElementsByClassName(HTML_CLASS_START_DATE_TIME_INPUT)).map((dateTimeInput) => {
            dateTimeInput.addEventListener("focus", () => {
                showDatePickerForHtmlEventStartDateTimeButton(HTML_ID_EVENT_START_DATE_TEXT_INPUT);
            });
            dateTimeInput.addEventListener("keypress", (event) => {
                event.preventDefault();
            });
        });
        document.getElementById(HTML_ID_EVENT_START_DATE_TIME_BUTTON).addEventListener("click", () => {
            showDatePickerForHtmlEventStartDateTimeButton(HTML_ID_EVENT_START_DATE_TEXT_INPUT);
        });
        document.getElementById(HTML_ID_EVENT_START_DATE_TEXT_INPUT).addEventListener(JS_DATE_TIME_PICKER_ON_OK_EVENT, () => {
            showTimePickerForHtmlEventStartDateTimeButton(HTML_ID_EVENT_START_TIME_TEXT_INPUT);
        });
        document.getElementById(HTML_ID_EVENT_START_TIME_TEXT_INPUT).addEventListener(JS_DATE_TIME_PICKER_ON_OK_EVENT, () => {
            writeStartDateTimeValuesAndClearEndDateTimeValues(HTML_ID_EVENT_START_DATE_TEXT_INPUT, HTML_ID_EVENT_START_TIME_TEXT_INPUT,
                HTML_ID_EVENT_END_DATE_TEXT_INPUT, HTML_ID_EVENT_END_TIME_TEXT_INPUT);
        });
        // Event EndDate and EndTime Pickers
        Array.from(document.getElementsByClassName(HTML_CLASS_END_DATE_TIME_INPUT)).map((dateTimeInput) => {
            dateTimeInput.addEventListener("focus", () => {
                showDatePickerForEventEndDateTimeButton(HTML_ID_EVENT_START_DATE_TEXT_INPUT, HTML_ID_EVENT_START_TIME_TEXT_INPUT,
                    HTML_ID_EVENT_END_DATE_TEXT_INPUT);
            });
            dateTimeInput.addEventListener("keypress", (event) => {
                event.preventDefault();
            });
        });
        document.getElementById(HTML_ID_EVENT_END_DATE_TIME_BUTTON).addEventListener("click", () => {
            showDatePickerForEventEndDateTimeButton(HTML_ID_EVENT_START_DATE_TEXT_INPUT, HTML_ID_EVENT_START_TIME_TEXT_INPUT,
                HTML_ID_EVENT_END_DATE_TEXT_INPUT);
        });
        document.getElementById(HTML_ID_EVENT_END_DATE_TEXT_INPUT).addEventListener(JS_DATE_TIME_PICKER_ON_OK_EVENT, () => {
            showTimePickerForEventEndDateTimeButton(HTML_ID_EVENT_END_TIME_TEXT_INPUT);
        });
        document.getElementById(HTML_ID_EVENT_END_TIME_TEXT_INPUT).addEventListener(JS_DATE_TIME_PICKER_ON_OK_EVENT, () => {
            writeEndDateTimeValues(HTML_ID_EVENT_END_DATE_TEXT_INPUT, HTML_ID_EVENT_END_TIME_TEXT_INPUT);
        });
        // On HTML_ID_FREE_ENTRANCE_CHECK_INPUT change, modify HTML_ID_EVENT_TICKET_PRICE_INPUT
        document.getElementById(HTML_ID_FREE_ENTRANCE_CHECK_INPUT).addEventListener("change", () => {
            HelperForm.toggleHtmlEventTicketPriceInputReadOnlyAndValue(HTML_ID_FREE_ENTRANCE_CHECK_INPUT, HTML_ID_EVENT_TICKET_PRICE_INPUT);
        });
        // Form validation
        let htmlCreateEventForm = document.getElementById(HTML_ID_CREATE_EVENT_LOGIN_FORM);
        htmlCreateEventForm.addEventListener("submit", () => {
            HelperForm.validateHtmlForm(htmlCreateEventForm);
        });
    });
</script>