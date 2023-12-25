<?php

namespace System\Database;

// use mysqli;
use PDO;
use PDOStatement;

/**
*Connect to the database server and execute database action.
*/
abstract class DB{
    private PDO $conn;
    private PDOStatement $stmt;
    // private mysqli $conn;

    /**
    *Connects to the database server.
    */
    public function __construct()
    {
        $this -> conn= new PDO("mysql:host=" .config('db_host') .";dbname=" .config('db_name'), config('db_user'), config('db_pass'));
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
    *Executes the given sql query.
    */
    public function run(string $sql)
    {
        $this->stmt= $this->conn->prepare($sql);
        $this->stmt->execute();   
    }

    /**
    *Fetches and returns data from the executed sql query.
    */
    public function fetch():array 
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    *Returns count of data.
    */
    public function count(): int
    {
        return $this->stmt->rowCount();
    }
    
    /**
    *returns the primary key of last inserted data in the database
    */
    public function lastId(): string
    {
        return $this->conn->lastInsertId();
    }
}