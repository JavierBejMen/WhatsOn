<?php

final class DBTag
{
    static public function getTags()
    {
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            // self::$dataBaseHandler = new DataBaseHandler();
            $statementHandler = self::$dataBaseHandler->prepare("SELECT * FROM whats_on."
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_TAG));
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // Debugging Purposes
        }
        $statementHandler->execute();
        return self::getArrayOfTagsFromTagRows($statementHandler->fetchAll(PDO::FETCH_ASSOC));
    }

    // Private
    static private function getArrayOfTagsFromTagRows(array $tagRows)
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
