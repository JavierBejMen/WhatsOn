<?php
spl_autoload_register(function ($className) {
    require($_SERVER["DOCUMENT_ROOT"] . "/php_classes/$className.php");
});
session_start();
$eventId = $_POST[ValidatorFormEvent::FORM_FIELD_NAME_ID];
if (
    ValidatorFormEvent::isValidEventForUpdatingEvent(
        $eventId,
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_NAME],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_DESCRIPTION],
        $_FILES[ValidatorFormEvent::FORM_FIELD_NAME_HEADER_IMAGE],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_DATE],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_TIME],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_DATE],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_TIME],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_NAME],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_ADDRESS],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_TICKET_PRICE],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_BEER_PRICE],
        $_POST[ValidatorFormEvent::FORM_FIELD_NAME_TAGS]
    )
) {
    $event = DBEvent::getEventFromId($eventId);
    if ($event && $event->getUserEmail() === $_SESSION[HelperNavigator::SESSION_VARIABLE_USER_EMAIL]) {
        $eventHeaderImageFileName = HelperNavigator::getFileNameFromEventUrlHeaderImage($event->getUrlHeaderImage());
        $eventEndDate = DataRepresentationConversor::DateValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_DATE]);
        $eventEndDate = ($eventEndDate) ? $eventEndDate : null;
        $eventEndTime = DataRepresentationConversor::TimeValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_TIME]);
        $eventEndTime = ($eventEndTime) ? $eventEndTime : null;
        $eventLongDrinkPrice = DataRepresentationConversor::FloatValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE]);
        $eventLongDrinkPrice = ($eventLongDrinkPrice) ? $eventLongDrinkPrice : null;
        $eventBeerPrice = DataRepresentationConversor::FloatValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_BEER_PRICE]);
        $eventBeerPrice = ($eventBeerPrice) ? $eventBeerPrice : null;
        $eventIsUpdatedInDataBase = DBEvent::updateEvent(
            $eventId,
            $_POST[ValidatorFormEvent::FORM_FIELD_NAME_NAME],
            $_POST[ValidatorFormEvent::FORM_FIELD_NAME_DESCRIPTION],
            DataRepresentationConversor::DateValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_DATE]),
            DataRepresentationConversor::TimeValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_TIME]),
            $eventEndDate,
            $eventEndTime,
            $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_NAME],
            $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_ADDRESS],
            "0.0",
            "0.0",
            DataRepresentationConversor::FloatValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_TICKET_PRICE]),
            $eventLongDrinkPrice,
            $eventBeerPrice,
            DataRepresentationConversor::TagsStringFromUIStringToPhpArray($_POST[ValidatorFormEvent::FORM_FIELD_NAME_TAGS])
        );
        if (
            $eventIsUpdatedInDataBase
            && $_FILES[ValidatorFormEvent::FORM_FIELD_NAME_HEADER_IMAGE]["tmp_name"]
            && HelperFileUpload::isFileUploaded($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_HEADER_IMAGE])
        ) {
            HelperFileUpload::moveUploadedFileToDestinationFilePath(
                $_FILES[ValidatorFormEvent::FORM_FIELD_NAME_HEADER_IMAGE],
                HelperNavigator::getPhpAbsoluteFilePathFromPhpRelativeFilePath(HelperNavigator::DIR_PATH_EVENTS_IMAGES
                    . "/" . $eventHeaderImageFileName)
            );
        }
    }
}
header("Location: " . HelperNavigator::getUrlReferer());
exit();
