<?php

namespace App\Services;

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

        $dsn = "mysql:host=127.0.0.1;dbname=truiter;charset=utf8;user=root;";

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
