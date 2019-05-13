<?php

final class DBUser
{
    static public function existsUserWithEncryptedPassword(string $user, string $encryptedPassword)
    {
        try {
            HelperDataBase::initializeDataBaseHandler(self::$dataBaseHandler);
            $statementHandler = self::$dataBaseHandler->prepare("SELECT COUNT("
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EMAIL) . ") FROM "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::TABLE_NAME_USER) . " WHERE "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_EMAIL) . " = :user AND "
                . HelperDataBase::formatIdStringToInsertIntoQueryString(self::COLUMN_NAME_ENCRYPTED_PASSWORD) . " = :encryptedPassword");
        } catch (PDOException $exception) {
            print("Error: " . $exception->getMessage()); // Debugging Purposes
        }
        $statementHandler->execute([":user" => $user, ":encryptedPassword" => $encryptedPassword]);
        return ($statementHandler->fetch(PDO::FETCH_NUM)[0] === "1") ? true : false;
    }

    // Private
    private static $dataBaseHandler = null;
    private const TABLE_NAME_USER = "user";
    private const COLUMN_NAME_EMAIL = "email";
    private const COLUMN_NAME_ENCRYPTED_PASSWORD = "encrypted_password";
}
