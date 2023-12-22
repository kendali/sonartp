<?php
class Database
{
    private static $DB_NAME = 'crud_tutorial';
    private static $DB_HOST = 'localhost';
    private static $DB_PORT = '3306';
    private static $DB_USERNAME = 'root';
    private static $DB_PASSWORD = '';

    private static $connection = null;

    private function __construct()
    {
        // Prevents instantiation
        die('Init function is not allowed');
    }

    public static function connect()
    {
        // One connection throughout the application
        if (null == self::$connection) {
            try {
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                self::$connection = new PDO(
                    "mysql:host=" . self::$DB_HOST . ";port=" . self::$DB_PORT . ";dbname=" . self::$DB_NAME,
                    self::$DB_USERNAME,
                    self::$DB_PASSWORD,
                    $options
                );
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }

    public static function disconnect()
    {
        self::$connection = null;
    }
}
?>