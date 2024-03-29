<?php

/*
    IMPORTANT: Transactions are ONLY valid when queries are executed on the same Database Handler.
*/

final class DBEvent
{
    public static function getEventFromId(int $eventId)
    {
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            $statementHandler = self::$dataBaseHandler->prepare("SELECT * FROM "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_EVENT) . " WHERE "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_ID) . " = :eventId");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // REMOVE - Debugging Purposes
            return false;
        }
        $statementHandler->bindValue(":eventId", $eventId, PDO::PARAM_INT);
        $statementHandler->execute();
        $resultEvent = $statementHandler->fetchObject("Event");
        return ($resultEvent) ? self::getEventWithLinkedArrayOfTags($resultEvent, DBEventHasTag::getTagsFromEventId($eventId)) : false;
    }
    public static function getEventsWithMinimumDataFromDateOnwardsWhichHaveSomeTagInTagsArray(
        DateTime $date = null,
        array $arrayOfTags = null
    ) {
        $arrayOfEventIds = ($arrayOfTags) ? DBEventHasTag::getEventIdsWhichHaveSomeTagInTagsArray($arrayOfTags) : [];
        $date = ($date) ? $date : new DateTime();
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            $statementHandler = self::$dataBaseHandler->prepare("SELECT "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_ID) . ","
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_NAME) . ","
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_URL_HEADER_IMAGE) . ","
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_START_DATE) . ","
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_START_TIME) . ","
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LOCAL_NAME) . ","
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_TICKET_PRICE) . " FROM "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_EVENT) . " WHERE "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_START_DATE) . " >= ? "
                . (($arrayOfEventIds) ? "AND " . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_ID) . " IN ("
                    . HelperDataBase::createStringWithQuotationMarksForBinding(count($arrayOfEventIds)) . ")" : "")
                . " ORDER BY " . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_START_DATE) . " ASC");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // REMOVE - Debugging Purposes
            return false;
        }
        if ($arrayOfTags) {
            if ($arrayOfEventIds) {
                $statementHandler->execute(array_merge(
                    [$date->format(HelperDateTime::$FORMAT_PHP_DATE_TIME_TO_DATABASE_DATE_TIME)],
                    $arrayOfEventIds
                ));
            } else {
                return false;
            }
        } else {
            $statementHandler->execute([$date->format(HelperDateTime::$FORMAT_PHP_DATE_TIME_TO_DATABASE_DATE_TIME)]);
        }
        // $resultArrayOfEvents = self::getArrayOfEventsWithIterativeSqlQueriesForTags($statementHandler);
        $resultArrayOfEvents = self::getArrayOfEventsWithSingleSqlQueryForTags($statementHandler);
        return ($resultArrayOfEvents) ? $resultArrayOfEvents : false;
    }
    public static function insertEvent(
        string $eventName,
        string $eventDescription,
        string $eventUrlHeaderImage,
        string $eventStartDate,
        string $eventStartTime,
        $eventEndDate,
        $eventEndTime,
        string $eventLocalName,
        string $eventLocalAddress,
        $eventLocalLatitude,
        $eventLocalLongitude,
        string $eventTicketPrice,
        $eventLongDrinkPrice,
        $eventBeerPrice,
        string $userEmail,
        array $arrayOfTags
    ) {
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            self::$dataBaseHandler->beginTransaction();
            $statementHandler = self::$dataBaseHandler->prepare("INSERT INTO "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_EVENT) . "("
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_NAME) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_DESCRIPTION) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_URL_HEADER_IMAGE) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_START_DATE) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_START_TIME) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_END_DATE) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_END_TIME) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LOCAL_NAME) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LOCAL_ADDRESS) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LOCAL_LATITUDE) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LOCAL_LONGITUDE) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_TICKET_PRICE) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LONG_DRINK_PRICE) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_BEER_PRICE) . ", "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_USER_EMAIL) . ") VALUES(:eventName, 
                :eventDescription, :eventUrlHeaderImage, :eventStartDate, :eventStartTime, :eventEndDate, :eventEndTime, 
                :eventLocalName, :eventLocalAddress, :eventLocalLatitude, :eventLocalLongitude, :eventTicketPrice, :eventLongDrinkPrice, 
                :eventBeerPrice, :userEmail)");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // REMOVE - Debugging Purposes
            return false;
        }
        $successfulTransaction = $statementHandler->execute([
            ":eventName" => $eventName, ":eventDescription" => $eventDescription, ":eventUrlHeaderImage" => $eventUrlHeaderImage,
            ":eventStartDate" => $eventStartDate, ":eventStartTime" => $eventStartTime, ":eventEndDate" => $eventEndDate,
            ":eventEndTime" => $eventEndTime, ":eventLocalName" => $eventLocalName, ":eventLocalAddress" => $eventLocalAddress,
            ":eventLocalLatitude" => $eventLocalLatitude, ":eventLocalLongitude" => $eventLocalLongitude,
            ":eventTicketPrice" => $eventTicketPrice, ":eventLongDrinkPrice" => $eventLongDrinkPrice, ":eventBeerPrice" => $eventBeerPrice,
            ":userEmail" => $userEmail
        ]);
        $successfulTransaction = $successfulTransaction && DBEventHasTag::TransactionQueryInsertTagsIntoEventId(
            self::$dataBaseHandler,
            self::$dataBaseHandler->lastInsertId(),
            $arrayOfTags
        );
        ($successfulTransaction) ? self::$dataBaseHandler->commit() : self::$dataBaseHandler->rollback();
        return $successfulTransaction;
    }
    public static function updateEvent(
        string $eventId,
        string $eventName,
        string $eventDescription,
        string $eventStartDate,
        string $eventStartTime,
        $eventEndDate,
        $eventEndTime,
        string $eventLocalName,
        string $eventLocalAddress,
        $eventLocalLatitude,
        $eventLocalLongitude,
        string $eventTicketPrice,
        $eventLongDrinkPrice,
        $eventBeerPrice,
        array $arrayOfTags
    ) {
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            self::$dataBaseHandler->beginTransaction();
            $statementHandler = self::$dataBaseHandler->prepare("UPDATE "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_EVENT) . " SET "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_NAME) . " = :eventName, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_DESCRIPTION) . " = :eventDescription, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_START_DATE) . " = :eventStartDate, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_START_TIME) . " = :eventStartTime, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_END_DATE) . " = :eventEndDate, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_END_TIME) . " = :eventEndTime, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LOCAL_NAME) . " = :eventLocalName, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LOCAL_ADDRESS) . " = :eventLocalAddress, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LOCAL_LATITUDE) . " = :eventLocalLatitude, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LOCAL_LONGITUDE) . " = :eventLocalLongitude, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_TICKET_PRICE) . " = :eventTicketPrice, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_LONG_DRINK_PRICE) . " = :eventLongDrinkPrice, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_BEER_PRICE) . " = :eventBeerPrice WHERE "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_ID) . " = :eventId");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // REMOVE - Debugging Purposes
            return false;
        }
        $successfulTransaction = $statementHandler->execute([
            ":eventId" => $eventId, ":eventName" => $eventName, ":eventDescription" => $eventDescription,
            ":eventStartDate" => $eventStartDate, ":eventStartTime" => $eventStartTime, ":eventEndDate" => $eventEndDate,
            ":eventEndTime" => $eventEndTime, ":eventLocalName" => $eventLocalName, ":eventLocalAddress" => $eventLocalAddress,
            ":eventLocalLatitude" => $eventLocalLatitude, ":eventLocalLongitude" => $eventLocalLongitude,
            ":eventTicketPrice" => $eventTicketPrice, ":eventLongDrinkPrice" => $eventLongDrinkPrice, ":eventBeerPrice" => $eventBeerPrice
        ]);
        $successfulTransaction = $successfulTransaction && DBEventHasTag::TransactionQueryDeleteTagsFromEventId(
            self::$dataBaseHandler,
            intval($eventId)
        );
        $successfulTransaction = $successfulTransaction && DBEventHasTag::TransactionQueryInsertTagsIntoEventId(
            self::$dataBaseHandler,
            intval($eventId),
            $arrayOfTags
        );
        ($successfulTransaction) ? self::$dataBaseHandler->commit() : self::$dataBaseHandler->rollback();
        return $successfulTransaction;
    }

    // Private
    private static function getEventWithLinkedArrayOfTags(Event $event, array $arrayOfTags)
    {
        $event->setArrayOfTags($arrayOfTags);
        return $event;
    }
    private static function getArrayOfEventsWithIterativeSqlQueriesForTags(PDOStatement $statementHandler)
    {
        $resultArrayOfEvents = array();
        while ($resultEvent = $statementHandler->fetchObject("Event")) {
            $resultEvent->setArrayOfTags(DBEventHasTag::getTagsFromEventId($resultEvent->getId()));
            array_push($resultArrayOfEvents, $resultEvent);
        }
        return $resultArrayOfEvents;
    }
    private static function getArrayOfEventsWithSingleSqlQueryForTags(PDOStatement $statementHandler)
    {
        $arrayOfEventIds = array();
        $resultArrayOfEvents = array();
        while ($resultEvent = $statementHandler->fetchObject("Event")) {
            array_push($resultArrayOfEvents, $resultEvent);
            array_push($arrayOfEventIds, $resultEvent->getId());
        }
        $arrayOfTags = DBEventHasTag::getTagsFromArrayOfEventIds($arrayOfEventIds);
        foreach ($resultArrayOfEvents as $resultEvent) {
            $resultEvent->setArrayOfTags($arrayOfTags[$resultEvent->getId()]);
        }
        return $resultArrayOfEvents;
    }

    private static $dataBaseHandler = null;
    private const TABLE_NAME_EVENT = "event";
    private const COLUMN_NAME_ID = "id";
    private const COLUMN_NAME_NAME = "name";
    private const COLUMN_NAME_DESCRIPTION = "description";
    private const COLUMN_NAME_URL_HEADER_IMAGE = "url_header_image";
    private const COLUMN_NAME_START_DATE = "start_date";
    private const COLUMN_NAME_START_TIME = "start_time";
    private const COLUMN_NAME_END_DATE = "end_date";
    private const COLUMN_NAME_END_TIME = "end_time";
    private const COLUMN_NAME_LOCAL_NAME = "local_name";
    private const COLUMN_NAME_LOCAL_ADDRESS = "local_address";
    private const COLUMN_NAME_LOCAL_LATITUDE = "local_latitude";
    private const COLUMN_NAME_LOCAL_LONGITUDE = "local_longitude";
    private const COLUMN_NAME_TICKET_PRICE = "ticket_price";
    private const COLUMN_NAME_LONG_DRINK_PRICE = "long_drink_price";
    private const COLUMN_NAME_BEER_PRICE = "beer_price";
    private const COLUMN_NAME_USER_EMAIL = "user_email";
}
