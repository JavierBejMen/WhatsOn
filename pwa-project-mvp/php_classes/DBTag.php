<?php

final class DBTag
{
    public static function getTags()
    {
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            $statementHandler = self::$dataBaseHandler->prepare("SELECT * FROM "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_TAG) . " ORDER BY "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_NAME) . " ASC");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // REMOVE - Debugging Purposes
            return false;
        }
        $statementHandler->execute();
        $tagRows = $statementHandler->fetchAll(PDO::FETCH_ASSOC);
        return ($tagRows) ? self::getArrayOfTagsFromTagRows($tagRows) : false;
    }

    // Private
    private static function getArrayOfTagsFromTagRows(array $tagRows)
    {
        $resultArrayOfTags = array();
        foreach ($tagRows as $tagRow) {
            array_push($resultArrayOfTags, $tagRow[self::COLUMN_NAME_NAME]);
        }
        return $resultArrayOfTags;
    }

    private static $dataBaseHandler = null;
    private const TABLE_NAME_TAG = "tag";
    private const COLUMN_NAME_NAME = "name";
}
