<?php

namespace Framework;

use PDO;
use PDOException;
use Exception;

class Database {

    public $conn;

    /**
     * Constructor for Database class
     * @param array $config
     */
    public function __construct($config) {
        $dsn = "mysql:host={$config['host']}; port={$config['port']};
        dbname={$config['dbname']}";

        // Options array to set PDO attributes
        $options = [
            // Set the error reporting mode to exception
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Set the default fetch mode to fetch objects
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: {$e->getMessage()}");
        }
    }

    /**
     * Query the database
     * @param String $query
     * @return PDOStatement
     * @throws PDOException
     */
    public function query($query, $params = []) {
        try {
            $sth = $this->conn->prepare($query);
            // Bind named params
            foreach ($params as $param => $value) {
                $sth->bindValue(":" . $param, $value);
            }
            $sth->execute();
            return $sth;
        } catch (PDOException $e) {
            throw new Exception("Query failed to execute:  {$e->getMessage()}");
        }
    }
}
