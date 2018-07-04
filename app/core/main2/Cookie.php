<?php

namespace App\Core\Main2;

/**
 * NOTE: Allow all error reporting except E_DEPRECATED
 * because it interferes with the encryptions...
 */
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// use App\Core\MainModel;
use App\Model\User;
use App\Model\Session;

class Cookie extends MainModel
{
    public const CN_COOKIE_NAME = "cn-cookie";
    private const ENCRYPTION_SALT = 'fuckinGuessSa-ltyhY5K92AzVnMYyT7';

    // Caution: changing salt will invalidate all signed strings
    private const SIGNATURE_SALT = "heez b00gzZz Rwerizz StrongEhhh";
    // Configuration (must match decryption)
    private const CIPHER_TYPE = MCRYPT_RIJNDAEL_256;
    private const CIPHER_MODE = MCRYPT_MODE_CBC;


    protected static $table_name = "Cookies";
    protected static $className = "Cookie";
    protected static $db_fields = array(
        "id",
        "session_id",
        "value",
        "created_at",
        "updated_at"
    );


    public $id;
    public $session_id;
    public $rawValue;
    public $value;
    public $created_at = self::CURRENT_TIMESTAMP;
    public $updated_at = self::CURRENT_TIMESTAMP;


    // public function __construct()
    // {
    //     parent::__construct();
    // }


    // public static function createClientCookie() {

    //     $name = self::CN_COOKIE_NAME;
    //     $value = 'klkasdjweaoijfs92387klsdajf';
    //     $expire = time() + 60*60*24*7; // 1 week from now
    //     $path = '/';
    //     $domain = 'localhost';
    //     $secure = isset($_SERVER['HTTPS']);
    //     $httponly = true; // JavaScript can't access cookie

    //     // \App\Core\PSEUDOCOOKIE::set(['name' => $name, 'value' => $value]);
    //     // setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    // }



    public static function setCookieSession(&$checkMsg)
    {
        $cnCookieName = self::CN_COOKIE_NAME;
        $signedClientCookieValue = isset($_COOKIE[$cnCookieName]) ? $_COOKIE[$cnCookieName] : null;
        // $PSEUDOCOOKIE = \App\Core\PseudoCookie2::getInstance();
        // $PSEUDOCOOKIE = self::$sPseudoCookie;
        // $signedClientCookieValue = ($PSEUDOCOOKIE->get($cnCookieName) !== null) ? $PSEUDOCOOKIE->get($cnCookieName) : null;
        $isCnCookieValid = false;

        //
        if (isset($signedClientCookieValue)) {

            //
            if (Cookie::isCookieValueSigned($signedClientCookieValue)) {
                $checkMsg = "Yes! Cookie IS signed...";

                //
                $cookieObj = self::getCookieObjBasedOnDbRecord($signedClientCookieValue);


                // If there's a cookie-record in the db...
                if (isset($cookieObj->session_id)) {

                    $actualSessionAssocArr = Session::getPropsInAssociativeArrayForm(['id' => $cookieObj->session_id]);

                    if (!Session::isSessionHiJacked($actualSessionAssocArr)) {
                        $isCnCookieValid = true;
                        
                        // TODO: The cookie is valid so set the session vars...
                        self::$sSession->setProps($actualSessionAssocArr);
                        self::$sSession->resetLastRequestDatetime();
                        self::$sSession->setUserType(self::$sSession->user_type_id);

                        if (isset($actualSessionAssocArr['user_id'])) {

                            // TODO:
                            echo "\n************************\n";
                            echo "TODO: The cookie-session has a valid user_id, so log the user in...\n";
                        }
                    }
                } else {
                    $checkMsg = "Cookie-record does not exist...";
                }
            } else {
                $checkMsg = "Cookie is not signed...";
            }
        } else {
            $checkMsg = "You're a first time guest...";
        }


        //
        if (!$isCnCookieValid) {
            self::$sSession->prepPropsForDbAsGuestUser();
            self::$sSession->create();
            
            $actualSessionAssocArr = Session::getPropsInAssociativeArrayForm(['id' => self::$sSession->id]);
            self::$sSession->setProps($actualSessionAssocArr);
            self::$sSession->resetLastRequestDatetime();
            self::$sSession->setUserType(self::$sSession->user_type_id);


            // self::$sSession->user_id = null;
            // self::$sSession->last_request_datetime = $_SESSION['last_request_datetime'];

            $newCookie = self::generateCnCookie();
            $newCookie->create();
        }
    }


    private static function getCookieObjBasedOnDbRecord($signedCookieValue)
    {

        //
        $safelyUnsignedValue = self::getSafelyUnsignedValue($signedCookieValue);

        //
        $decodedValue = self::decode($safelyUnsignedValue);

        //
        $decryptedValue = self::decrypt($decodedValue);
        

        //
        $cookieData = ['value' => $decryptedValue];
    
        //
        $cookieObj = static::readByWhereClause($cookieData)[0];

        return $cookieObj;
    }


    private static function getSafelyUnsignedValue($signedValue)
    {
        $array = explode('--', $signedValue);
        return $array[0];
    }


    public static function generateCnCookie()
    {
        $newCookie = new Cookie();

        $randomValue = strrev(uniqid()) . uniqid();
        $newCookie->value = self::encode($randomValue);
        
        $newCookie->session_id = self::$sSession->id;

        self::generateClientCookie($newCookie);
        
        return $newCookie;
    }


    private static function generateClientCookie($newCookieObj)
    {
        $name = self::CN_COOKIE_NAME;
        $value = self::getSignedValue(self::encode(self::encrypt($newCookieObj->value)));
        $expire = time() + 60*60*24*7; // 1 week from now
        $path = '/';
        $domain = $_SERVER['SERVER_NAME'];
        $secure = isset($_SERVER['HTTPS']);
        $httponly = true; // JavaScript can't access cookie
        
        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    

    public static function encode($value)
    {
        return base64_encode($value);
    }


    private static function decode($value)
    {
        return base64_decode($value);
    }

    
    public static function encrypt($value)
    {

        // Using initialization vector adds more security
        $ivSize = mcrypt_get_iv_size(self::CIPHER_TYPE, self::CIPHER_MODE);
        $iv =  mcrypt_create_iv($ivSize, MCRYPT_RAND);

        $encryptedValue = mcrypt_encrypt(self::CIPHER_TYPE, self::ENCRYPTION_SALT, $value, self::CIPHER_MODE, $iv);

        // Return initialization vector + encrypted string
        // We'll need the $iv when decoding.
        return $iv . $encryptedValue;
    }


    private static function decrypt($value)
    {

        // Extract the initialization vector from the encrypted string.
        // The $iv comes before encrypted string and has fixed size.
        $ivSize = mcrypt_get_iv_size(self::CIPHER_TYPE, self::CIPHER_MODE);

        $iv = substr($value, 0, $ivSize);
        $encryptedValue = substr($value, $ivSize);

        $decryptedValue = mcrypt_decrypt(self::CIPHER_TYPE, self::ENCRYPTION_SALT, $encryptedValue, self::CIPHER_MODE, $iv);
        return $decryptedValue;
    }
    


    private static function isCookieValueSigned($expectedSignedValue)
    {
        $array = explode('--', $expectedSignedValue);

        // The $expectedSignedValue might be ok.
        if (count($array) === 2) {
            
            // Sign the string portion again. Should create same
            // checksum and therefore the same signed value.
            $newSignedValue = self::getSignedValue($array[0]);
            if ($newSignedValue === $expectedSignedValue) {
                return true;
            }
        }

        return false;
    }


    public static function getSignedValue($value)
    {

        // Using a salt makes it hard to guess how $checksum is generated
        // Caution: changing salt will invalidate all signed strings
        $salt = self::SIGNATURE_SALT;

        // Any hash algorithm would work
        $checksum = sha1($value . $salt);

        // return the string with the checksum at the end
        return $value.'--'.$checksum;
    }



    // /**
    //  * @override
    //  */
    // public function create() {

    // }
}
