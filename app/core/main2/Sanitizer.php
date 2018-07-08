<?php
namespace App\Core\Main2;

class Sanitizer {

    public static function sanitizeHtmlSpecialChars($s) {

        return htmlspecialchars($s);
    }

    public static function sanitizeHtmlEntities($s) {
        return htmlentities($s);
    }

    public static function unsanitizeHtmlEntities($s) {
        return html_entity_decode($s);
    }


    public static function stripHtmlTags($s) {
        return strip_tags($s);
    }

    public static function sanitizeUrl($url) {
        return urlencode($url);
    }

    public static function unsanitizeUrl($url) {
        return urldecode($url);
    }
}
