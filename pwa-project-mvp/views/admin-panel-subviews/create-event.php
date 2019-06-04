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
<div class="container-fluid classTertiaryBackgroundColor text-black-50 text-center pt-4 pb-2" id="idEditEventPictureContainer">
    <i class="fas fa-camera fa-7x"></i>
    <p class="pt-3">Imagen del evento</p>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-sm classSecondaryBackgroundColor text-white waves-effect waves-light" id="idEditEventPictureButton" title="Añadir o actualizar imagen de evento" aria-label="Añadir o actualizar imagen de evento">
            <i class="fas fa-pen fa-2x"></i>
        </button>
    </div>
</div>
<div class="container py-3" id="idCreateEventMain">
    <form class="needs-validation mx-auto" id="idCreateEventForm" novalidate>
        <div class="form-group">
            <a role="button" class="btn classSecondaryBackgroundColor text-white waves-effect" id="idAddTagsButton" title="Añadir etiquetas" aria-label="Añadir etiquetas">Añadir etiquetas</a>
        </div>
        <div class="form-group">
            <label for="idEventName">Qué <span class="text-danger">*</span></label>
            <input class="form-control classOnlyBottomBorderInput" id="idEventName" type="text" minlength="5" placeholder="Nombre del evento" required>
            <div class="invalid-feedback">
                Por favor, introduce un nombre válido.
            </div>
        </div>
        <div class="form-group">
            <label for="idEventDescription">En qué consiste <span class="text-danger">*</span></label>
            <textarea class="form-control classOnlyBottomBorderInput" id="idEventDescription" rows="5" minlength="5" placeholder="Descripción del evento" required></textarea>
            <div class="invalid-feedback">
                Por favor, introduce una descripción válida.
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
                    <label for="idEventTicketPrice">Entrada <span class="text-danger">*</span></label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventTicketPrice" type="number" min="0" step="0.01" placeholder="Precio de la entrada" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="idFreeEntranceCheck">
                    <label class="form-check-label" for="idFreeEntranceCheck">
                        Entraba libre
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group">
                    <label for="idEventLongDrinkPrice">Copa</label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventLongDrinkPrice" type="number" min="0" step="0.01" placeholder="Precio de la copa">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="idMaxOrMinLongDrinkPriceCheck">
                    <label class="form-check-label" for="idMaxOrMinLongDrinkPriceCheck">
                        Máx./mín.
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group">
                    <label for="idEventBeerPrice">Cerveza</label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventBeerPrice" type="number" min="0" step="0.01" placeholder="Precio de la cerveza">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="idMaxOrMinBeerPriceCheck">
                    <label class="form-check-label" for="idMaxOrMinBeerPriceCheck">
                        Máx./mín.
                    </label>
                </div>
            </div>
        </div>
        <div class="d-flex mb-4">
            <i class="text-primary fas fa-map-marker-alt fa-lg mr-3"></i>
            <div class="w-100">
                <div class="form-group">
                    <label for="idEventLocal">Dónde <span class="text-danger">*</span></label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventLocal" type="text" minlength="5" placeholder="Bar, pub, discoteca o local" required>
                    <div class="invalid-feedback">
                        Por favor, introduce el nombre del local.
                    </div>
                </div>
                <div class="form-group">
                    <label for="idEventAddress">Dirección <span class="text-danger">*</span></label>
                    <input class="form-control classOnlyBottomBorderInput" id="idEventAddress" type="text" minlength="5" placeholder="Dirección del evento" required>
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
<script>
    window.addEventListener("DOMContentLoaded", () => {
        setHtmlBodyBackgroundColor(HTML_CLASS_WHITE_BACKGROUND_COLOR);
        hideMainMenuBar();
        // Event StartDate and StartTime Pickers
        Array.from(document.getElementsByClassName("classStartDateTimeTextInput")).map((dateTimeTextInput) => {
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
        Array.from(document.getElementsByClassName("classEndDateTimeTextInput")).map((dateTimeTextInput) => {
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
        // On HTML_ID_FREE_ENTRANCE_CHECK change, modify HTML_ID_EVENT_TICKET_PRICE
        document.getElementById(HTML_ID_FREE_ENTRANCE_CHECK).addEventListener("change", () => {
            HelperForm.toggleHtmlEventTicketPriceReadOnlyAndValue(HTML_ID_EVENT_TICKET_PRICE);
        });
        // Form validation
        let htmlCreateEventForm = document.getElementById(HTML_ID_CREATE_EVENT_LOGIN_FORM);
        htmlCreateEventForm.addEventListener("submit", () => {
            HelperForm.validateHtmlForm(htmlCreateEventForm);
        }, false);
    });
</script>