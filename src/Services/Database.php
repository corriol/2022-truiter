<?php

namespace App;

use Exception;
use PDO;

class Database
{
    private PDO $connection;

    /**
     * Database constructor.
     */
    public function __construct()
    {

        $dsn = "";

		try {
	        $pdo = new PDO($dsn);

        	$this->connection = $pdo;
        } catch (Exception $e) {
        	die($e->getMessage());
        }
    }

    /**
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        $DB = new Database();
        return $DB->connection;
    }
}
