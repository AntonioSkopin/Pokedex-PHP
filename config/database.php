<?php

class Database {
    // Properties
    private $host = "localhost";
    private $db_name = "pokedex";
    private $username = "root";
    private $password = "";
    public $conn;

    // Method to get the connection of the database
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
        } catch (PDOException $exc) {
            die ("Connection Error: $exc");
        }
        return $this->conn;
    }
}