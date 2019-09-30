<?php

namespace App;

/**
 * SSQlite database connection
 */
class Database
{
    private $pdo;
    private static $instance = null;

    public function __construct()
    {
        $this->pdo = new \PDO("sqlite:" . Config::SQLITE_DB);
    }

    /**
     * Create and/or Get the database connection
     * @return Database Instance of the database connection
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    /**
     * PDO Connection getter
     * @return PDO PDO Connection instance
     */
    public function getConnection()
    {
        return $this->pdo;
    }
}
