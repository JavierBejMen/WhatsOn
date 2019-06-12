<?php

final class DBUser
{
    public static function existsUserWithEncryptedPassword(string $user, string $encryptedPassword)
    {
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            $statementHandler = self::$dataBaseHandler->prepare("SELECT COUNT("
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EMAIL) . ") FROM "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_USER) . " WHERE "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EMAIL) . " = :user AND "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_ENCRYPTED_PASSWORD) . " = :encryptedPassword");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // REMOVE - Debugging Purposes
            return false;
        }
        $statementHandler->execute([":user" => $user, ":encryptedPassword" => $encryptedPassword]);
        $resultRow = $statementHandler->fetch(PDO::FETCH_NUM);
        return ($resultRow) ? ($resultRow[0] === "1") : false;
    }

    // Private
    private static $dataBaseHandler = null;
    private const TABLE_NAME_USER = "user";
    private const COLUMN_NAME_EMAIL = "email";
    private const COLUMN_NAME_ENCRYPTED_PASSWORD = "encrypted_password";
}
