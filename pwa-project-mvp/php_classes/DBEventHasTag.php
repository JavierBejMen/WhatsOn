<?php

final class DBEventHasTag
{
    public static function getTagsFromEventId(int $eventId)
    {
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            $statementHandler = self::$dataBaseHandler->prepare("SELECT "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_TAG_NAME) . " FROM "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_EVENT_HAS_TAG) . " WHERE "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EVENT_ID) . " = :eventId ORDER BY "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_TAG_NAME) . " ASC");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // Debugging Purposes
        }
        $statementHandler->bindValue(":eventId", $eventId, PDO::PARAM_INT);
        $statementHandler->execute();
        $eventHasTagRows = $statementHandler->fetchAll(PDO::FETCH_ASSOC);
        if (!$eventHasTagRows) {
            return false;
        }
        return self::getArrayOfTagsFromEventHasTagRows($eventHasTagRows);
    }
    public static function getTagsFromArrayOfEventIds(array $arrayOfEventIds)
    {
        if (!$arrayOfEventIds) {
            return false;
        }
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            $statementHandler = self::$dataBaseHandler->prepare("SELECT * FROM "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_EVENT_HAS_TAG) . " WHERE "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EVENT_ID)
                . " IN (" . HelperDataBase::getStringWithQuotationMarksForBinding(count($arrayOfEventIds)) . ") ORDER BY "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EVENT_ID) . " ASC, "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_TAG_NAME) . " ASC");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // Debugging Purposes
        }
        $statementHandler->execute($arrayOfEventIds);
        if (!($eventHasTagRows = $statementHandler->fetchAll(PDO::FETCH_ASSOC))) {
            return false;
        }
        return self::getMultidimensionalArrayOfTagsByEventIdFromEventHasTagRows($arrayOfEventIds, $eventHasTagRows);
    }
    public static function getEventIdsWhichHaveSomeTagInTagsArray(array $arrayOfTags)
    {
        if (!$arrayOfTags) {
            return false;
        }
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            $statementHandler = self::$dataBaseHandler->prepare("SELECT "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EVENT_ID)
                . " FROM " . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_EVENT_HAS_TAG)
                . " WHERE " . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_TAG_NAME) . " IN ("
                . HelperDataBase::getStringWithQuotationMarksForBinding(count($arrayOfTags)) . ") ORDER BY "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EVENT_ID) . " ASC");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // Debugging Purposes}
        }
        $statementHandler->execute($arrayOfTags);
        if (!($eventHasTagRows = $statementHandler->fetchAll(PDO::FETCH_ASSOC))) {
            return false;
        }
        return array_unique(self::getArrayOfEventIdsFromEventHasTagRows($eventHasTagRows));
    }

    // Private
    private static function getArrayOfTagsFromEventHasTagRows(array $eventHasTagRows)
    {
        $resultArrayOfTags = array();
        foreach ($eventHasTagRows as $eventHasTagRow) {
            array_push($resultArrayOfTags, $eventHasTagRow[self::COLUMN_NAME_TAG_NAME]);
        }
        return $resultArrayOfTags;
    }
    private static function getArrayOfEventIdsFromEventHasTagRows(array $eventHasTagRows)
    {
        $resultArrayOfTags = array();
        foreach ($eventHasTagRows as $eventHasTagRow) {
            array_push($resultArrayOfTags, $eventHasTagRow[self::COLUMN_NAME_EVENT_ID]);
        }
        return $resultArrayOfTags;
    }
    private static function getMultidimensionalArrayOfTagsByEventIdFromEventHasTagRows(array $arrayOfEventIds, array $eventHasTagRows)
    {
        $resultArrayOfTags = array();
        foreach ($arrayOfEventIds as $eventId) {
            $resultArrayOfTags[$eventId] = array();
        }
        foreach ($eventHasTagRows as $eventHasTagRow) {
            array_push($resultArrayOfTags[$eventHasTagRow[self::COLUMN_NAME_EVENT_ID]], $eventHasTagRow[self::COLUMN_NAME_TAG_NAME]);
        }
        return $resultArrayOfTags;
    }

    private static $dataBaseHandler = null;
    private const TABLE_NAME_EVENT_HAS_TAG = "event_has_tag";
    private const COLUMN_NAME_EVENT_ID = "event_id";
    private const COLUMN_NAME_TAG_NAME = "tag_name";
}
