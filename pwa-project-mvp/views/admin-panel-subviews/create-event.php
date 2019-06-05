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
<div class="container-fluid classTertiaryBackgroundColor text-black-50 text-center pt-4 pb-2" id="idEventPictureContainer">
    <i class="fas fa-camera fa-7x"></i>
    <p class="pt-3">Imagen del evento</p>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-sm classSecondaryBackgroundColor text-white waves-effect waves-light" id="idAddEventPictureButton" title="Añadir imagen de evento" aria-label="Añadir imagen de evento">
            <i class="fas fa-pen fa-2x"></i>
        </button>
    </div>
</div>
<div class="container py-3" id="idCreateEventMain">
    <form class="needs-validation mx-auto" id="idCreateEventForm" novalidate>
        <div class="form-group">
            <label for="idEventNameInput">Qué <span class="text-danger">*</span></label>
            <input class="form-control classOnlyBottomBorderInput" id="idEventNameInput" type="text" minlength="5" placeholder="Nombre del evento" required>
            <div class="invalid-feedback">
                Por favor, introduce un nombre válido.
            </div>
        </div>
        <div class="form-group">
            <label for="idEventDescriptionInput">En qué consiste <span class="text-danger">*</span></label>
            <textarea class="form-control classOnlyBottomBorderInput" id="idEventDescriptionInput" rows="5" minlength="5" placeholder="Descripción del evento" required></textarea>
            <div class="invalid-feedback">
                Por favor, introduce una descripción válida.
            </div>
        </div>
        <div class="d-flex mb-4">
            <i class="text-primary fas fa-tags fa-lg mr-3"></i>
            <div class="w-100">
                <div class="form-group">
                    <label for="idEventTagsInput">Etiquetas <span class="text-danger">*</span></label>
                    <input class="form-control classInvisible" id="idEventTagsInput" type="text" pattern="^([a-zA-ZáéíóúÁÉÍÓÚ \-]+,)+$" required>
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
                    <input class="form-control classStartDateTimeTextInput mb-2" id="idEventStartDateTextInput" type="text" pattern="^(lunes|martes|miércoles|jueves|viernes), ([1-9]|[1-9][0-9]) de (enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre) de [2-9][0-9]{3}$" placeholder="Fecha" required>
                    <input class="form-control classStartDateTimeTextInput" id="idEventStartTimeTextInput" type="text" pattern="^([0-9]|1[0-9]|2[0-3]):[0-5][0-9]$" placeholder="Hora" required>
                    <div class="invalid-feedback">
                        Por favor, introduce una fecha y hora de comienzo válida.
                    </div>
                    <button class="btn classSecondaryBackgroundColor text-white waves-effect waves-light w-100 mx-auto mt-3 py-2" type="button" id="idEventStartDateTimeButton" title="Elegir fecha y hora de comienzo" aria-label="Elegir fecha y hora del evento de comienzo">
                        <i class="fas fa-calendar-day fa-lg"></i>
                    </button>
                </div>
                <div class="form-group">
                    <label for="idEventEndDateTimeButton">Cuándo termina</span></label>
                    <input class="form-control classEndDateTimeTextInput mb-2" id="idEventEndDateTextInput" type="text" pattern="^(lunes|martes|miércoles|jueves|viernes), ([1-9]|[1-9][0-9]) de (enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre) de [2-9][0-9]{3}$" placeholder="Fecha">
                    <input class="form-control classEndDateTimeTextInput" id="idEventEndTimeTextInput" type="text" pattern="^([0-9]|1[0-9]|2[0-3]):[0-5][0-9]$" placeholder="Hora">
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
                    <input class="form-control classOnlyBottomBorderInput" id="idEventTicketPriceInput" type="number" min="0" step="0.01" placeholder="Precio de la entrada" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="idFreeEntranceCheckInput">
                    <label class="form-check-label" for="idFreeEntranceCheckInput">
                        Entraba libre
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group">
                    <label for="idEventLongDrinkPriceInput">Copa</label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventLongDrinkPriceInput" type="number" min="0" step="0.01" placeholder="Precio de la copa">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="idMaxOrMinLongDrinkPriceCheckInput">
                    <label class="form-check-label" for="idMaxOrMinLongDrinkPriceCheckInput">
                        Máx./mín.
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group">
                    <label for="idEventBeerPriceInput">Cerveza</label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventBeerPriceInput" type="number" min="0" step="0.01" placeholder="Precio de la cerveza">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="idMaxOrMinBeerPriceCheckInput">
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
                    <label for="idEventLocalInput">Dónde <span class="text-danger">*</span></label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventLocalInput" type="text" minlength="5" placeholder="Bar, pub, discoteca o local" required>
                    <div class="invalid-feedback">
                        Por favor, introduce el nombre del local.
                    </div>
                </div>
                <div class="form-group">
                    <label for="idEventAddressInput">Dirección <span class="text-danger">*</span></label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventAddressInput" type="text" minlength="5" placeholder="Dirección del evento" required>
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
require($_SERVER["DOCUMENT_ROOT"] . "/components/tags-modal.php");
?>
<script>
    window.addEventListener("DOMContentLoaded", () => {
        setHtmlBodyBackgroundColor(HTML_CLASS_WHITE_BACKGROUND_COLOR);
        hideMainMenuBar();
        HelperTagsModal.clearEnabledTagValuesFromSessionStorage(SESSION_STORAGE_KEY_ENABLED_TAG_VALUES);
        document.getElementById(HTML_ID_CREATE_EVENT_SHOW_MODAL_FOR_ADDING_TAGS_BUTTON).addEventListener("click", () => {
            HelperTagsModal.loadPreviousEnabledTagValuesFromSessionStorageToHtmlFormModal(SESSION_STORAGE_KEY_ENABLED_TAG_VALUES);
        });
        document.getElementById(HTML_ID_TAGS_MODAL_SAVE_BUTTON).addEventListener("click", () => {
            HelperTagsModal.saveEnabledTagValuesFromHtmlModalFormToSessionStorage(SESSION_STORAGE_KEY_ENABLED_TAG_VALUES);
            clearHtmlEventTagsInputAndFillWithEnabledTagValuesFromTagModal(HTML_ID_EVENT_TAGS_INPUT);
            clearHtmlEventTagsListAndFillWithEnabledTagValuesFromTagModal(HTML_ID_EVENT_TAGS_LIST);
        });
        // Event StartDate and StartTime Pickers
        Array.from(document.getElementsByClassName(HTML_CLASS_START_DATE_TIME_TEXT_INPUT)).map((dateTimeTextInput) => {
            dateTimeTextInput.addEventListener("focus", () => {
                showDatePickerForHtmlEventStartDateTimeButton(HTML_ID_EVENT_START_DATE_TEXT_INPUT);
            });
            dateTimeTextInput.addEventListener("keypress", (event) => {
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
        Array.from(document.getElementsByClassName(HTML_CLASS_END_DATE_TIME_TEXT_INPUT)).map((dateTimeTextInput) => {
            dateTimeTextInput.addEventListener("focus", () => {
                showDatePickerForEventEndDateTimeButton(HTML_ID_EVENT_START_DATE_TEXT_INPUT, HTML_ID_EVENT_START_TIME_TEXT_INPUT,
                    HTML_ID_EVENT_END_DATE_TEXT_INPUT);
            });
            dateTimeTextInput.addEventListener("keypress", (event) => {
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
        }, false);
    });
</script>