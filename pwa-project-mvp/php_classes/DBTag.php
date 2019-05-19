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
            print("Error: " . $exception->getMessage()); // Debugging Purposes
        }
        $statementHandler->execute();
        $tagRows = $statementHandler->fetchAll(PDO::FETCH_ASSOC);
        if (!$tagRows) {
            return false;
        }
        return self::getArrayOfTagsFromTagRows($tagRows);
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
