<?php

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
            print("Error: " . $exception->getMessage()); // Debugging Purposes
        }
        $statementHandler->bindValue(":eventId", $eventId, PDO::PARAM_INT);
        $statementHandler->execute();
        if (!($resultEvent = $statementHandler->fetchObject("Event"))) {
            return $resultEvent;
        }
        return self::getEventWithLinkedArrayOfTags($resultEvent, DBEventHasTag::getTagsFromEventId($eventId));
    }
    public static function getEventsWithMinimumDataFromDateOnwardsWhichHaveSomeTagInTagsArray(
        DateTime $date = NULL,
        array $arrayOfTags = NULL
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
                    . HelperDataBase::getStringWithQuotationMarksForBinding(count($arrayOfEventIds)) . ")" : "")
                . " ORDER BY " . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_START_DATE) . " ASC");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // Debugging Purposes
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
        if (!$resultArrayOfEvents) {
            return false;
        }
        return $resultArrayOfEvents;
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
    private const COLUMN_NAME_URL_HEADER_IMAGE = "url_header_image";
    private const COLUMN_NAME_START_DATE = "start_date";
    private const COLUMN_NAME_START_TIME = "start_time";
    private const COLUMN_NAME_LOCAL_NAME = "local_name";
    private const COLUMN_NAME_TICKET_PRICE = "ticket_price";
}
