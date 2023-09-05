<?php
class Connection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "tvseriesdb";
    public function getConnect()
    {
        try {
            $dsn = "mysql:host$this->host;database=$this->database";
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        } catch (PDOException $err) {
            return $err;
        }
    }
}
