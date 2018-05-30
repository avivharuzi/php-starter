<?php

class Database {
    private $connection;
    private $server      = "localhost";
    private $user        = "root";
    private $password    = "";
    private $db          = "library";
    private $isConnected = false;
    private static $dbSingleInstance;
    
    private function __construct() {
        $this->connection = new mysqli($this->server, $this->user, $this->password, $this->db);
        
        if ($this->connection->connect_errno) {
            $this->isConnected = false;
            exit();
        } else {
            $this->isConnected = true;
        }
    }
    
    public static function getConnectionSingleInstance() {
        if (!self::$dbSingleInstance) { 
            self::$dbSingleInstance = new Database();
        }

        return self::$dbSingleInstance;
    }
    
    public function connectData($sql) {
        $response = $this->connection->query($sql);
        
        if ($response)  {
            return true;
        } else {
            return false;
        }
    }

    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }
    
    public function getSingleData($sql, $class = "stdClass") {
        $result = $this->connection->query($sql);
        
        if ($result->num_rows == 1) {
            $response = $result->fetch_object($class);
        } else {
            return false;
        }
        return $response;
    }

    public function getFullData($sql, $class = "stdClass") {
        $result = $this->connection->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object($class)) {
                $response[] = $row;
            }
        } else {
            return false;
        }
        return $response;
    }
    
    public function getRows($sql) {
        $result = $this->connection->query($sql);
        
        if ($result) {
            return $result->num_rows;
        } else {
            return false;
        }
    }

    public function getId() {
        return $this->connection->insert_id;
    }

    public function disconnect() {
        $this->connection->close();
    }
}

$GLOBALS["conn"] = Database::getConnectionSingleInstance();

?>
