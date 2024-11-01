<?php

namespace App\Models;

use PDOException;
use Exception;
use PDO;

class Database
{
    private static $instance = null;
    private $hostname;
    private $database;
    private $username;
    private $password;
    private $pdo;


    private function __construct($hostname, $database, $username, $password)
    {
        $this->hostname = $hostname;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;

        $dsn = 'mysql:dbname=' . $database . ';host=' . $hostname;
        try {
            $this->pdo = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            // Set Error Mode to Exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Could not connect to the database: " . $e->getMessage(), 500);
        }
    }

    public static function getInstance($hostname, $database, $username, $password)
    {
        if (self::$instance === null) {
            self::$instance = new self($hostname, $database, $username, $password);
        }
        return self::$instance;
    }

    public function closeConnection()
    {
        $this->pdo = null;
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     * Prepares and executes sql queries
     *
     * @param  string $sql    The SQL query to execute
     * @param  array  $params The parameters of the SQL query
     * @return array The results of the query
     * @throws Exception If the query fails.
     */
    public function query($sql, $params = [])
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage(), 500);
        }
    }

    public function getLastInsertedRow($tableName)
    {
        $sql = "SELECT * FROM $tableName WHERE id = :id";
        $lastInsertedId = $this->pdo->lastInsertId();

        return $this->query($sql, ["id" => $lastInsertedId]);
    }
}
