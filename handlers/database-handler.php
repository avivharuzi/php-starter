<?php

class DatabaseHandler {
    private function __construct() {
    }
    
    public static function all($table, $orderBy = false, $orderByField = NULL) {
        if ($orderBy !== false && $orderByField !== NULL) {
            $sql = "SELECT * FROM $table ORDER BY $orderByField $orderBy";
        } else {
            $sql = "SELECT * FROM $table";
        }

        $result = $GLOBALS["conn"]->getFullData($sql, $table);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    
    public static function find($table, $id) {
        $sql = "SELECT * FROM $table WHERE Id = $id LIMIT 1";
        $result = $GLOBALS["conn"]->getSingleData($sql, $table);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public static function whereOne($table, $field, $value) {
        $sql = "SELECT * FROM $table WHERE $field = '$value' LIMIT 1";

        $result = $GLOBALS["conn"]->getSingleData($sql, $table);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public static function whereMany($table, $field, $value, $orderBy = false, $orderByField = NULL) {
        if ($orderBy !== false && $orderByField !== NULL) {
            $sql = "SELECT * FROM $table WHERE $field = '$value' ORDER BY $orderByField $orderBy";
        } else {
            $sql = "SELECT * FROM $table WHERE $field = '$value'";
        }

        $result = $GLOBALS["conn"]->getFullData($sql, $table);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public static function count($table) {
        $sql = "SELECT COUNT(*) as Summary FROM $table";
        $result = $GLOBALS["conn"]->getSingleData($sql);

        if ($result) {
            return $result->Summary;
        } else {
            return 0;
        }
    }

    public static function delete($table, $field, $value) {
        $sql = "DELETE FROM $table WHERE $field = '$value'";
        $result = $GLOBALS["conn"]->connectData($sql);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function insert($sql) {
        $result = $GLOBALS["conn"]->connectData($sql);

        if ($result) {
            return $GLOBALS["conn"]->getId();
        } else {
            return false;
        }
    }

    public static function update($sql) {
        $result = $GLOBALS["conn"]->connectData($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function single($sql) {
        $result = $GLOBALS["conn"]->getSingleData($sql);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public static function full($sql) {
        $result = $GLOBALS["conn"]->getFullData($sql);
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public static function escape($value) {
        return $GLOBALS["conn"]->escape($value);
    }
}

?>
