<?php
namespace App\Model;

class MyDebugMessenger {
    public static function show_debug_message() {
        echo "<div class='debugMessage'>";
        echo $_SESSION["debug_message"];
        echo "</div>";
    }
    
    public static function initialize() {
        $_SESSION["debug_message"] = "";
    }
    
    public static function add_debug_message($additional_message) {
        if (isset($_SESSION["debug_message"])) {
            $_SESSION["debug_message"] .= "<br>{$additional_message}<br>";
        }
        else {
            echo "<br>_SESSION[debug_message] is not initialized.<br>";
        }
    } 
    
    public static function clear_debug_message() {
        self::initialize();
    } 
    
        public static function is_initialized() {
            if (isset($_SESSION["debug_message"])) {
                return true;
            }
            else {
                return false;
            }
    } 
}
?>

