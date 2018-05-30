<?php

class ValidationHandler {
    private function __construct() {
    }
    
    public static function validateInputs($value, $reg) {
        if (!empty($value)) {
            if (!preg_match($reg, $value)) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    
    public static function validateEmail($email) {
        if (!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public static function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function preserveValue($value , $exist = "") {
        if (!empty($_POST[$value])) {
            return self::testInput($_POST[$value]);
        } else {
            return $exist;
        }
    }
}

?>
