<?php

final class HelperDataBase
{
    static public function initializeDataBaseHandler(&$dataBaseHandler)
    {
        if (is_null($dataBaseHandler)) {
            $dataBaseHandler = new DataBaseHandler();
        }
    }
    static public function formatIdStringToInsertIntoQueryString(string $id)
    {
        return "`" . str_replace("`", "``", $id) . "`";
    }
}
