<?php

final class DBEventHasTag
{
    static public function getTagsFromEventId(int $eventId)
    {
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            $statementHandler = self::$dataBaseHandler->prepare("SELECT "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_TAG_NAME) . " FROM "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_EVENT_HAS_TAG) . " WHERE "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EVENT_ID) . " = :eventId");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // Debugging Purposes
        }
        $statementHandler->bindValue(":eventId", $eventId, PDO::PARAM_INT);
        $statementHandler->execute();
        return self::getArrayOfTagsFromEventHasTagRows($statementHandler->fetchAll(PDO::FETCH_ASSOC));
    }
    static public function getTagsFromArrayOfEventIds(array $arrayOfEventIds)
    {
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            $statementHandler = self::$dataBaseHandler->prepare("SELECT * FROM "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_EVENT_HAS_TAG) . " WHERE "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EVENT_ID)
                . " in (" . self::getStringWithQuotationMarksForBinding(count($arrayOfEventIds)) . ") ORDER BY "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EVENT_ID) . " ASC");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // Debugging Purposes
        }
        $statementHandler->execute($arrayOfEventIds);
        return self::getMultidimensionalArrayOfTagsByEventIdFromEventHasTagRows(
            $arrayOfEventIds,
            $statementHandler->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    // Private
    static private function getStringWithQuotationMarksForBinding(int $numberOfEventIds)
    {
        return str_repeat("?,", $numberOfEventIds - 1) . "?";
    }
    static private function getArrayOfTagsFromEventHasTagRows(array $eventHasTagRows)
    {
        $resultArrayOfTags = array();
        foreach ($eventHasTagRows as $eventHasTagRow) {
            array_push($resultArrayOfTags, $eventHasTagRow[self::COLUMN_NAME_TAG_NAME]);
        }
        return $resultArrayOfTags;
    }
    static private function getMultidimensionalArrayOfTagsByEventIdFromEventHasTagRows(array $arrayOfEventIds, array $eventHasTagRows)
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
