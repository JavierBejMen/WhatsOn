<?php
spl_autoload_register(function ($className) {
    require($_SERVER["DOCUMENT_ROOT"] . "/php_classes/$className.php");
});
session_start();

// REMOVE - Testing
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_IMAGE_FILE]) . "<br><br>";
echo var_dump($_FILES[FormValidatorEvent::FORM_FIELD_NAME_IMAGE_FILE]["name"]) . "<br><br>";
echo var_dump($_FILES[FormValidatorEvent::FORM_FIELD_NAME_IMAGE_FILE]["type"]) . "<br><br>";
echo var_dump($_FILES[FormValidatorEvent::FORM_FIELD_NAME_IMAGE_FILE]["size"]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_NAME]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_DESCRIPTION]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_TAGS]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_START_DATE]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_START_TIME]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_END_DATE]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_END_TIME]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_TICKET_PRICE]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_BEER_PRICE]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_LOCAL]) . "<br><br>";
echo var_dump($_POST[FormValidatorEvent::FORM_FIELD_NAME_ADDRESS]) . "<br><br>";

echo "Is valid event? " . var_dump(FormValidatorEvent::isValidEvent(
    $_FILES[FormValidatorEvent::FORM_FIELD_NAME_IMAGE_FILE],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_NAME],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_DESCRIPTION],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_TAGS],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_START_DATE],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_START_TIME],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_END_DATE],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_END_TIME],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_TICKET_PRICE],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_BEER_PRICE],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_LOCAL],
    $_POST[FormValidatorEvent::FORM_FIELD_NAME_ADDRESS]
)) . "<br><br>";
echo "Is valid image '" . $_FILES[FormValidatorEvent::FORM_FIELD_NAME_IMAGE_FILE]["name"] . "'? " .
    var_dump(FormValidatorEvent::isValidEventImageFile($_FILES[FormValidatorEvent::FORM_FIELD_NAME_IMAGE_FILE])) . "<br><br>";
echo "Is valid image empty array ([])? " . var_dump(FormValidatorEvent::isValidEventImageFile([])) . "<br><br>";
echo "Is valid name '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_NAME] . "'? " .
    var_dump(FormValidatorEvent::isValidEventName($_POST[FormValidatorEvent::FORM_FIELD_NAME_NAME])) . "<br><br>";
echo "Is valid name ''? " . var_dump(FormValidatorEvent::isValidEventName("")) . "<br><br>";
echo "Is valid name 'sd'? " . var_dump(FormValidatorEvent::isValidEventName("sd")) . "<br><br>";
echo "Is valid description '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_DESCRIPTION] . "'? " .
    var_dump(FormValidatorEvent::isValidEventDescription($_POST[FormValidatorEvent::FORM_FIELD_NAME_DESCRIPTION])) . "<br><br>";
echo "Is valid description ''? " . var_dump(FormValidatorEvent::isValidEventDescription("")) . "<br><br>";
echo "Is valid description 'sd'? " . var_dump(FormValidatorEvent::isValidEventDescription("sd")) . "<br><br>";
echo "Is valid tags string '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_TAGS] . "'? " .
    var_dump(FormValidatorEvent::isValidEventTags($_POST[FormValidatorEvent::FORM_FIELD_NAME_TAGS])) . "<br><br>";
echo "Is valid tags string 'a,b,'? " . var_dump(FormValidatorEvent::isValidEventTags("a,b,")) . "<br><br>";
echo "Is valid tags string 'a sad ss,'? " . var_dump(FormValidatorEvent::isValidEventTags("a sad ss,")) . "<br><br>";
echo "Is valid tags string ''? " . var_dump(FormValidatorEvent::isValidEventTags("")) . "<br><br>";
echo "Is valid tags string 'sd asd asd'? " . var_dump(FormValidatorEvent::isValidEventTags("sd asd asd")) . "<br><br>";
echo "Is valid tags string 'sd,asd,asd'? " . var_dump(FormValidatorEvent::isValidEventTags("sd,asd,asd")) . "<br><br>";
// echo "Is valid date '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_START_DATE] . "'? " .
//     var_dump(FormValidatorEvent::isValidDate($_POST[FormValidatorEvent::FORM_FIELD_NAME_START_DATE])) . "<br><br>";
// echo "Is valid date 'miércoles, 5 de junio de 2019'? " . var_dump(FormValidatorEvent::isValidDate("miércoles, 5 de junio de 2019")) . "<br><br>";
// echo "Is valid date ''? " . var_dump(FormValidatorEvent::isValidDate("")) . "<br><br>";
// echo "Is valid date 'viernes, 8 de agosto'? " . var_dump(FormValidatorEvent::isValidDate("viernes, 8 de agosto")) . "<br><br>";
// echo "Is valid time '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_START_TIME] . "'? " .
//     var_dump(FormValidatorEvent::isValidTime($_POST[FormValidatorEvent::FORM_FIELD_NAME_START_TIME])) . "<br><br>";
// echo "Is valid time '12:34'? " . var_dump(FormValidatorEvent::isValidTime("12:34")) . "<br><br>";
// echo "Is valid time ''? " . var_dump(FormValidatorEvent::isValidTime("")) . "<br><br>";
// echo "Is valid time '23'? " . var_dump(FormValidatorEvent::isValidTime("23")) . "<br><br>";
// echo "Is valid time '02:00'? " . var_dump(FormValidatorEvent::isValidTime("02:00")) . "<br><br>";
// echo "Is valid time '24:00'? " . var_dump(FormValidatorEvent::isValidTime("24:00")) . "<br><br>";
// echo "Is valid time '4:78'? " . var_dump(FormValidatorEvent::isValidTime("4:78")) . "<br><br>";
echo "Is valid start date '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_START_DATE] . "," . $_POST[FormValidatorEvent::FORM_FIELD_NAME_START_TIME]
    . "'? " . var_dump(FormValidatorEvent::isValidEventStartDateTime(
        $_POST[FormValidatorEvent::FORM_FIELD_NAME_START_DATE],
        $_POST[FormValidatorEvent::FORM_FIELD_NAME_START_TIME]
    )) . "<br><br>";
echo "Is valid start date 'miércoles, 5 de junio de 2019,12:34'? " .
    var_dump(FormValidatorEvent::isValidEventStartDateTime("miércoles, 5 de junio de 2019", "12:34")) . "<br><br>";
echo "Is valid start date ','? " . var_dump(FormValidatorEvent::isValidEventStartDateTime("", "")) . "<br><br>";
echo "Is valid end date '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_END_DATE] . "," . $_POST[FormValidatorEvent::FORM_FIELD_NAME_END_TIME]
    . "'? " . var_dump(FormValidatorEvent::isValidEventEndDateTime(
        $_POST[FormValidatorEvent::FORM_FIELD_NAME_END_DATE],
        $_POST[FormValidatorEvent::FORM_FIELD_NAME_END_TIME]
    )) . "<br><br>";
echo "Is valid end date 'miércoles, 5 de junio de 2019,12:34'? " .
    var_dump(FormValidatorEvent::isValidEventEndDateTime("miércoles, 5 de junio de 2019", "12:34")) . "<br><br>";
echo "Is valid end date ','? " . var_dump(FormValidatorEvent::isValidEventEndDateTime("", "")) . "<br><br>";
echo "Is valid ticket price '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_TICKET_PRICE] . "'? " .
    var_dump(FormValidatorEvent::isValidEventTicketPrice($_POST[FormValidatorEvent::FORM_FIELD_NAME_TICKET_PRICE])) . "<br><br>";
echo "Is valid ticket price '0'? " . var_dump(FormValidatorEvent::isValidEventTicketPrice("0")) . "<br><br>";
echo "Is valid ticket price ''? " . var_dump(FormValidatorEvent::isValidEventTicketPrice("")) . "<br><br>";
echo "Is valid ticket price 'e'? " . var_dump(FormValidatorEvent::isValidEventTicketPrice("e")) . "<br><br>";
echo "Is valid ticket price '-3'? " . var_dump(FormValidatorEvent::isValidEventTicketPrice("-3")) . "<br><br>";
echo "Is valid ticket price '3.'? " . var_dump(FormValidatorEvent::isValidEventTicketPrice("3.")) . "<br><br>";
echo "Is valid long drink price '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE] . "'? " .
    var_dump(FormValidatorEvent::isValidEventLongDrinkPrice($_POST[FormValidatorEvent::FORM_FIELD_NAME_LONG_DRINK_PRICE])) . "<br><br>";
echo "Is valid long drink price '0'? " . var_dump(FormValidatorEvent::isValidEventLongDrinkPrice("0")) . "<br><br>";
echo "Is valid long drink price ''? " . var_dump(FormValidatorEvent::isValidEventLongDrinkPrice("")) . "<br><br>";
echo "Is valid long drink price 'e'? " . var_dump(FormValidatorEvent::isValidEventLongDrinkPrice("e")) . "<br><br>";
echo "Is valid long drink price '-3'? " . var_dump(FormValidatorEvent::isValidEventLongDrinkPrice("-3")) . "<br><br>";
echo "Is valid long drink price '3.'? " . var_dump(FormValidatorEvent::isValidEventLongDrinkPrice("3.")) . "<br><br>";
echo "Is valid beer price '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_BEER_PRICE] . "'? " .
    var_dump(FormValidatorEvent::isValidEventBeerPrice($_POST[FormValidatorEvent::FORM_FIELD_NAME_BEER_PRICE])) . "<br><br>";
echo "Is valid beer price '0'? " . var_dump(FormValidatorEvent::isValidEventBeerPrice("0")) . "<br><br>";
echo "Is valid beer price ''? " . var_dump(FormValidatorEvent::isValidEventBeerPrice("")) . "<br><br>";
echo "Is valid beer price 'e'? " . var_dump(FormValidatorEvent::isValidEventBeerPrice("e")) . "<br><br>";
echo "Is valid beer price '-3'? " . var_dump(FormValidatorEvent::isValidEventBeerPrice("-3")) . "<br><br>";
echo "Is valid beer price '3.'? " . var_dump(FormValidatorEvent::isValidEventBeerPrice("3.")) . "<br><br>";
echo "Is valid local '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_LOCAL] . "'? " .
    var_dump(FormValidatorEvent::isValidEventLocal($_POST[FormValidatorEvent::FORM_FIELD_NAME_LOCAL])) . "<br><br>";
echo "Is valid local ''? " . var_dump(FormValidatorEvent::isValidEventLocal("")) . "<br><br>";
echo "Is valid local 'sd'? " . var_dump(FormValidatorEvent::isValidEventLocal("sd")) . "<br><br>";
echo "Is valid address '" . $_POST[FormValidatorEvent::FORM_FIELD_NAME_ADDRESS] . "'? " .
    var_dump(FormValidatorEvent::isValidEventAddress($_POST[FormValidatorEvent::FORM_FIELD_NAME_ADDRESS])) . "<br><br>";
echo "Is valid address ''? " . var_dump(FormValidatorEvent::isValidEventAddress("")) . "<br><br>";
echo "Is valid address 'sd'? " . var_dump(FormValidatorEvent::isValidEventAddress("sd")) . "<br><br>";

exit();
