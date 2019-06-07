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
            print("Error: " . $exception->getMessage()); // REMOVE - Debugging Purposes
            return false;
        }
        $statementHandler->bindValue(":eventId", $eventId, PDO::PARAM_INT);
        $statementHandler->execute();
        $eventHasTagRows = $statementHandler->fetchAll(PDO::FETCH_ASSOC);
        return ($eventHasTagRows) ? self::getArrayOfTagsFromEventHasTagRows($eventHasTagRows) : false;
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
            print("Error: " . $exception->getMessage()); // REMOVE - Debugging Purposes
            return false;
        }
        $statementHandler->execute($arrayOfEventIds);
        $eventHasTagRows = $statementHandler->fetchAll(PDO::FETCH_ASSOC);
        return ($eventHasTagRows) ? self::getMultidimensionalArrayOfTagsByEventIdFromEventHasTagRows($arrayOfEventIds, $eventHasTagRows) : false;
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
            print("Error: " . $exception->getMessage()); // REMOVE - Debugging Purposes
            return false;
        }
        $statementHandler->execute($arrayOfTags);
        $eventHasTagRows = $statementHandler->fetchAll(PDO::FETCH_ASSOC);
        return ($eventHasTagRows) ? array_unique(self::getArrayOfEventIdsFromEventHasTagRows($eventHasTagRows)) : false;
    }
    // TODO
    // public static function insertTagsIntoEventId(array $arrayOfTags, int $eventId)
    // {
    //     try {
    //         HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
    //         $statementHandler = self::$dataBaseHandler->prepare("INSERT INTO");
    //     } catch (PDOException $exception) {
    //         print("Error: " . $exception->getMessage()); // REMOVE - Debugging Purposes
    //         return false;
    //     }
    // }

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
