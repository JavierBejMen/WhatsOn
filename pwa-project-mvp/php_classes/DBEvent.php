<?php

final class DBEvent
{
    static public function getEventFromId(int $eventId)
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
        return self::getEventWithLinkedArrayOfTags($statementHandler->fetchObject("Event"), DBEventHasTag::getTagsFromEventId($eventId));
    }
    static public function getEventsWithMinimumDataFromDateOnwards(DateTime $date = null)
    {
        $date = (is_null($date)) ? new DateTime() : $date;
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
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_START_DATE) . " >= :date");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // Debugging Purposes
        }
        $statementHandler->execute([":date" => $date->format('Y-m-d')]);
        //return self::getArrayOfEventsWithIterativeSqlQueriesForTags($statementHandler);
        return self::getArrayOfEventsWithSingleSqlQueryForTags($statementHandler);
    }

    // Private
    static private function getEventWithLinkedArrayOfTags(Event &$event, array &$arrayOfTags)
    {
        $event->setArrayOfTags($arrayOfTags);
        return $event;
    }
    static private function getArrayOfEventsWithIterativeSqlQueriesForTags(PDOStatement $statementHandler)
    {
        $resultArrayOfEvents = array();
        while ($resultEvent = $statementHandler->fetchObject("Event")) {
            $resultEvent->setArrayOfTags(DBEventHasTag::getTagsFromEventId($resultEvent->getId()));
            array_push($resultArrayOfEvents, $resultEvent);
        }
        return $resultArrayOfEvents;
    }
    static private function getArrayOfEventsWithSingleSqlQueryForTags(PDOStatement $statementHandler)
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
