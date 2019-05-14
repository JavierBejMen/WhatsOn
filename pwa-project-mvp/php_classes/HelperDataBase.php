<?php

final class HelperDataBase
{
    public static function initializeDataBaseHandler(&$dataBaseHandler)
    {
        if (is_null($dataBaseHandler)) {
            $dataBaseHandler = new DataBaseHandler();
        }
    }
    public static function formatIdStringToInsertIntoQueryString(string $id): string
    {
        return "`" . str_replace("`", "``", $id) . "`";
    }
}
