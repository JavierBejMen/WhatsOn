<?php

final class DataBaseHandler extends PDO
{
    public function __construct()
    {
        parent::__construct(self::DRIVER_NAME . ":host=" . self::HOST . ";port=" . self::PORT
            . ";dbname=" . self::DATABASE_NAME . ";charset=" . self::CHARSET, self::USER_NAME, self::PASSWORD);
        $this->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Debugging Purposes
    }
    public function getDriverName()
    {
        return self::DRIVER_NAME;
    }
    public function getHost()
    {
        return self::HOST;
    }
    public function getPort()
    {
        return self::PORT;
    }
    public function getDatabaseName()
    {
        return self::DATABASE_NAME;
    }
    public function getCharset()
    {
        return self::CHARSET;
    }
    public function __destruct()
    {
        parent::__destruct();
    }

    private const DRIVER_NAME = "mysql";
    private const HOST = "localhost";
    private const PORT = "3306";
    private const DATABASE_NAME = "whats_on";
    private const CHARSET = "utf8mb4";
    private const USER_NAME = "whats_on_user";
    private const PASSWORD = "whats_on_user";
}
