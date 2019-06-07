<?php
/*
    IMPORTANT

    Information about how to properly upload files:
    - https://www.php.net/manual/en/features.file-upload.post-method.php

    Upload common errors:
    - https://www.php.net/manual/en/features.file-upload.common-pitfalls.php
    - https://thisinterestsme.com/php-upload-form-not-working/
    
    Edit "php.ini" to display all errors.
*/
spl_autoload_register(function ($className) {
    require($_SERVER["DOCUMENT_ROOT"] . "/php_classes/$className.php");
});
session_start();

// REMOVE - Testing
echo var_dump($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]["name"]) . "<br><br>";
echo var_dump($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]["type"]) . "<br><br>";
echo var_dump($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]["size"]) . "<br><br>";
echo var_dump($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]["tmp_name"]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_NAME]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_DESCRIPTION]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_TAGS]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_DATE]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_TIME]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_DATE]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_TIME]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_TICKET_PRICE]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_BEER_PRICE]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_NAME]) . "<br><br>";
echo var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_ADDRESS]) . "<br><br>";

// echo "Is valid event? " . var_dump(ValidatorFormEvent::isValidEvent(
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_NAME],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_DESCRIPTION],
//     $_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_DATE],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_TIME],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_DATE],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_TIME],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_NAME],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_ADDRESS],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_TICKET_PRICE],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_BEER_PRICE],
//     $_POST[ValidatorFormEvent::FORM_FIELD_NAME_TAGS]
// )) . "<br><br>";
// echo "Is valid image '" . $_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]["name"] . "'? " .
//     var_dump(ValidatorFormEvent::isValidEventImageFile($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE])) . "<br><br>";
// echo "Is valid image empty array ([])? " . var_dump(ValidatorFormEvent::isValidEventImageFile([])) . "<br><br>";
// echo "Is valid name '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_NAME] . "'? " .
//     var_dump(ValidatorFormEvent::isValidEventName($_POST[ValidatorFormEvent::FORM_FIELD_NAME_NAME])) . "<br><br>";
// echo "Is valid name ''? " . var_dump(ValidatorFormEvent::isValidEventName("")) . "<br><br>";
// echo "Is valid name 'sd'? " . var_dump(ValidatorFormEvent::isValidEventName("sd")) . "<br><br>";
// echo "Is valid description '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_DESCRIPTION] . "'? " .
//     var_dump(ValidatorFormEvent::isValidEventDescription($_POST[ValidatorFormEvent::FORM_FIELD_NAME_DESCRIPTION])) . "<br><br>";
// echo "Is valid description ''? " . var_dump(ValidatorFormEvent::isValidEventDescription("")) . "<br><br>";
// echo "Is valid description 'sd'? " . var_dump(ValidatorFormEvent::isValidEventDescription("sd")) . "<br><br>";
// echo "Is valid tags string '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_TAGS] . "'? " .
//     var_dump(ValidatorFormEvent::isValidEventTags($_POST[ValidatorFormEvent::FORM_FIELD_NAME_TAGS])) . "<br><br>";
// echo "Is valid tags string 'a,b,'? " . var_dump(ValidatorFormEvent::isValidEventTags("a,b,")) . "<br><br>";
// echo "Is valid tags string 'a sad ss,'? " . var_dump(ValidatorFormEvent::isValidEventTags("a sad ss,")) . "<br><br>";
// echo "Is valid tags string ''? " . var_dump(ValidatorFormEvent::isValidEventTags("")) . "<br><br>";
// echo "Is valid tags string 'sd asd asd'? " . var_dump(ValidatorFormEvent::isValidEventTags("sd asd asd")) . "<br><br>";
// echo "Is valid tags string 'sd,asd,asd'? " . var_dump(ValidatorFormEvent::isValidEventTags("sd,asd,asd")) . "<br><br>";

// echo "Is valid date '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_DATE] . "'? " .
//     var_dump(ValidatorFormEvent::isValidDate($_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_DATE])) . "<br><br>";
// echo "Is valid date 'miércoles, 5 de junio de 2019'? " . var_dump(ValidatorFormEvent::isValidDate("miércoles, 5 de junio de 2019")) . "<br><br>";
// echo "Is valid date ''? " . var_dump(ValidatorFormEvent::isValidDate("")) . "<br><br>";
// echo "Is valid date 'viernes, 8 de agosto'? " . var_dump(ValidatorFormEvent::isValidDate("viernes, 8 de agosto")) . "<br><br>";
// echo "Is valid time '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_TIME] . "'? " .
//     var_dump(ValidatorFormEvent::isValidTime($_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_TIME])) . "<br><br>";
// echo "Is valid time '12:34'? " . var_dump(ValidatorFormEvent::isValidTime("12:34")) . "<br><br>";
// echo "Is valid time ''? " . var_dump(ValidatorFormEvent::isValidTime("")) . "<br><br>";
// echo "Is valid time '23'? " . var_dump(ValidatorFormEvent::isValidTime("23")) . "<br><br>";
// echo "Is valid time '02:00'? " . var_dump(ValidatorFormEvent::isValidTime("02:00")) . "<br><br>";
// echo "Is valid time '24:00'? " . var_dump(ValidatorFormEvent::isValidTime("24:00")) . "<br><br>";
// echo "Is valid time '4:78'? " . var_dump(ValidatorFormEvent::isValidTime("4:78")) . "<br><br>";

// echo "Is valid start date '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_DATE] . "," . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_TIME]
//     . "'? " . var_dump(ValidatorFormEvent::isValidEventStartDateTime(
//         $_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_DATE],
//         $_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_TIME]
//     )) . "<br><br>";
// echo "Is valid start date 'miércoles, 5 de junio de 2019,12:34'? " .
//     var_dump(ValidatorFormEvent::isValidEventStartDateTime("miércoles, 5 de junio de 2019", "12:34")) . "<br><br>";
// echo "Is valid start date ','? " . var_dump(ValidatorFormEvent::isValidEventStartDateTime("", "")) . "<br><br>";
// echo "Is valid end date '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_DATE] . "," . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_TIME]
//     . "'? " . var_dump(ValidatorFormEvent::isValidEventEndDateTime(
//         $_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_DATE],
//         $_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_TIME]
//     )) . "<br><br>";
// echo "Is valid end date 'miércoles, 5 de junio de 2019,12:34'? " .
//     var_dump(ValidatorFormEvent::isValidEventEndDateTime("miércoles, 5 de junio de 2019", "12:34")) . "<br><br>";
// echo "Is valid end date ','? " . var_dump(ValidatorFormEvent::isValidEventEndDateTime("", "")) . "<br><br>";
// echo "Is valid ticket price '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_TICKET_PRICE] . "'? " .
//     var_dump(ValidatorFormEvent::isValidEventTicketPrice($_POST[ValidatorFormEvent::FORM_FIELD_NAME_TICKET_PRICE])) . "<br><br>";
// echo "Is valid ticket price '0'? " . var_dump(ValidatorFormEvent::isValidEventTicketPrice("0")) . "<br><br>";
// echo "Is valid ticket price ''? " . var_dump(ValidatorFormEvent::isValidEventTicketPrice("")) . "<br><br>";
// echo "Is valid ticket price 'e'? " . var_dump(ValidatorFormEvent::isValidEventTicketPrice("e")) . "<br><br>";
// echo "Is valid ticket price '-3'? " . var_dump(ValidatorFormEvent::isValidEventTicketPrice("-3")) . "<br><br>";
// echo "Is valid ticket price '3.'? " . var_dump(ValidatorFormEvent::isValidEventTicketPrice("3.")) . "<br><br>";
// echo "Is valid long drink price '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE] . "'? " .
//     var_dump(ValidatorFormEvent::isValidEventLongDrinkPrice($_POST[ValidatorFormEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE])) . "<br><br>";
// echo "Is valid long drink price '0'? " . var_dump(ValidatorFormEvent::isValidEventLongDrinkPrice("0")) . "<br><br>";
// echo "Is valid long drink price ''? " . var_dump(ValidatorFormEvent::isValidEventLongDrinkPrice("")) . "<br><br>";
// echo "Is valid long drink price 'e'? " . var_dump(ValidatorFormEvent::isValidEventLongDrinkPrice("e")) . "<br><br>";
// echo "Is valid long drink price '-3'? " . var_dump(ValidatorFormEvent::isValidEventLongDrinkPrice("-3")) . "<br><br>";
// echo "Is valid long drink price '3.'? " . var_dump(ValidatorFormEvent::isValidEventLongDrinkPrice("3.")) . "<br><br>";
// echo "Is valid beer price '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_BEER_PRICE] . "'? " .
//     var_dump(ValidatorFormEvent::isValidEventBeerPrice($_POST[ValidatorFormEvent::FORM_FIELD_NAME_BEER_PRICE])) . "<br><br>";
// echo "Is valid beer price '0'? " . var_dump(ValidatorFormEvent::isValidEventBeerPrice("0")) . "<br><br>";
// echo "Is valid beer price ''? " . var_dump(ValidatorFormEvent::isValidEventBeerPrice("")) . "<br><br>";
// echo "Is valid beer price 'e'? " . var_dump(ValidatorFormEvent::isValidEventBeerPrice("e")) . "<br><br>";
// echo "Is valid beer price '-3'? " . var_dump(ValidatorFormEvent::isValidEventBeerPrice("-3")) . "<br><br>";
// echo "Is valid beer price '3.'? " . var_dump(ValidatorFormEvent::isValidEventBeerPrice("3.")) . "<br><br>";
// echo "Is valid local '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_NAME] . "'? " .
//     var_dump(ValidatorFormEvent::isValidEventLocalName($_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_NAME])) . "<br><br>";
// echo "Is valid local ''? " . var_dump(ValidatorFormEvent::isValidEventLocalName("")) . "<br><br>";
// echo "Is valid local 'sd'? " . var_dump(ValidatorFormEvent::isValidEventLocalName("sd")) . "<br><br>";
// echo "Is valid address '" . $_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_ADDRESS] . "'? " .
//     var_dump(ValidatorFormEvent::isValidEventLocalAddress($_POST[ValidatorFormEvent::FORM_FIELD_NAME_LOCAL_ADDRESS])) . "<br><br>";
// echo "Is valid address ''? " . var_dump(ValidatorFormEvent::isValidEventLocalAddress("")) . "<br><br>";
// echo "Is valid address 'sd'? " . var_dump(ValidatorFormEvent::isValidEventLocalAddress("sd")) . "<br><br>";

if (ValidatorFormEvent::isValidEvent(
    $_POST[ValidatorFormEvent::FORM_FIELD_NAME_NAME],
    $_POST[ValidatorFormEvent::FORM_FIELD_NAME_DESCRIPTION],
    $_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE],
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
)) {
    if (
        $_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]["tmp_name"]
        && HelperFileUpload::isFileUploaded($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE])
    ) {

        // REMOVE - Testing
        // echo "PHP current user: " . get_current_user() . "<br><br>";
        // echo (ini_get("file_uploads")) ?  "file_uploads is set to 1. File uploads are allowed.<br><br>" : "Warning! file_uploads is set to 0. File uploads are NOT allowed.<br><br>";
        // echo "Temporary directory for uploads: " . var_dump(ini_get("upload_tmp_dir")) . "<br><br>";
        // echo "Uploaded image file? " . var_dump(HelperFileUpload::isFileUploaded($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE])) . "<br><br>";
        // echo "Error? " . var_dump($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]["error"]) . "<br><br>";
        // echo "Uploaded file:  " . var_dump($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]["tmp_name"]) . "<br><br>";
        // echo "Destination file:  " . var_dump(HelperNavigator::getPhpAbsoluteFilePathFromPhpRelativeFilePath(HelperNavigator::DIR_PATH_EVENTS_IMAGES . "/" . HelperFileUpload::createDestinationFileName($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]))) . "<br><br>";
        // echo "Was moved file to destination? " . var_dump(HelperFileUpload::moveUploadedFileToDestinationFilePath(
        //     $_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE],
        //     HelperNavigator::getPhpAbsoluteFilePathFromPhpRelativeFilePath(HelperNavigator::DIR_PATH_EVENTS_IMAGES . "/" . HelperFileUpload::createDestinationFileName($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]))
        // )) . "<br><br>";

        $destinationImageFileName = HelperFileUpload::createDestinationFileName($_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE]);
        HelperFileUpload::moveUploadedFileToDestinationFilePath(
            $_FILES[ValidatorFormEvent::FORM_FIELD_NAME_IMAGE_FILE],
            HelperNavigator::getPhpAbsoluteFilePathFromPhpRelativeFilePath(HelperNavigator::DIR_PATH_EVENTS_IMAGES
                . "/" . $destinationImageFileName)
        );
        $eventEndDate = DataRepresentationConversor::DateValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_DATE]);
        $eventEndDate = ($eventEndDate) ? $eventEndDate : null;
        $eventEndTime = DataRepresentationConversor::TimeValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_TIME]);
        $eventEndTime = ($eventEndTime) ? $eventEndTime : null;
        $eventLongDrinkPrice = DataRepresentationConversor::FloatValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE]);
        $eventLongDrinkPrice = ($eventLongDrinkPrice) ? $eventLongDrinkPrice : null;
        $eventBeerPrice = DataRepresentationConversor::FloatValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_BEER_PRICE]);
        $eventBeerPrice = ($eventBeerPrice) ? $eventBeerPrice : null;
        $wasCreated = DBEvent::insertEvent(
            $_POST[ValidatorFormEvent::FORM_FIELD_NAME_NAME],
            $_POST[ValidatorFormEvent::FORM_FIELD_NAME_DESCRIPTION],
            HelperNavigator::createImageFileUrl($destinationImageFileName),
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
            $_SESSION[HelperNavigator::SESSION_VARIABLE_USER_EMAIL],
            DataRepresentationConversor::TagsStringValueFromUIStringToPhpArray($_POST[ValidatorFormEvent::FORM_FIELD_NAME_TAGS])
        );

        // REMOVE - Testing
        // echo "Was created event in DB? " . var_dump($wasCreated) . "<br><br>";
    }

    // REMOVE - Testing
    // echo "UI start date: " . var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_DATE]) . "<br><br>";
    // echo "UI start time: " . var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_TIME]) . "<br><br>";
    // echo "UI end date: " . var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_DATE]) . "<br><br>";
    // echo "UI end time: " . var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_TIME]) . "<br><br>";
    // echo "UI ticket price: " . var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_TICKET_PRICE]) . "<br><br>";
    // echo "UI long drink price: " . var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE]) . "<br><br>";
    // echo "UI beer price: " . var_dump($_POST[ValidatorFormEvent::FORM_FIELD_NAME_BEER_PRICE]) . "<br><br>";
    // echo "DB start date: "
    //     . var_dump(DataRepresentationConversor::DateValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_DATE]))
    //     . "<br><br>";
    // echo "DB start time: "
    //     . var_dump(DataRepresentationConversor::TimeValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_START_TIME]))
    //     . "<br><br>";
    // echo "DB end date: "
    //     . var_dump(DataRepresentationConversor::DateValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_DATE]))
    //     . "<br><br>";
    // echo "DB end time: "
    //     . var_dump(DataRepresentationConversor::TimeValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_END_TIME]))
    //     . "<br><br>";
    // echo "DB ticket price: "
    //     . var_dump(DataRepresentationConversor::FloatValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_TICKET_PRICE]))
    //     . "<br><br>";
    // echo "DB long drink price: "
    //     . var_dump(DataRepresentationConversor::FloatValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE]))
    //     . "<br><br>";
    // echo "DB beer price: "
    //     . var_dump(DataRepresentationConversor::FloatValueFromUIStringToDataBaseString($_POST[ValidatorFormEvent::FORM_FIELD_NAME_BEER_PRICE]))
    //     . "<br><br>";
    // echo "DB image URL: " . var_dump(HelperNavigator::createImageFileUrl($destinationImageFileName)) . "<br><br>";
    // echo "Tags array: "
    //     . var_dump(DataRepresentationConversor::TagsStringValueFromUIStringToPhpArray($_POST[ValidatorFormEvent::FORM_FIELD_NAME_TAGS]))
    //     . "<br><br>";
}
header("Location: " . HelperNavigator::getUrlReferer());
exit();
