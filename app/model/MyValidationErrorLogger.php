<?php
namespace App\Model;

class MyValidationErrorLogger {

    private static $error_array;

    public static function initialize() {
        self::$error_array = array();
    }    
    
    public static function get_log_array() {
        return self::$error_array;
    }

    public static function log($error_msg) {
        array_push(self::$error_array, $error_msg);
    }

    public static function is_empty() {
        if (count(self::$error_array) === 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function reset() {
//        self::$error_array = array();
        self::initialize();
    }

}
?>

