<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-13
 * Time: 11:50
 */

namespace App\Core\Main2;


class CNMain
{
    public $session;
    
    public $pseudoSession;
    public $database;
    // public $pseudoCookie;

    
    protected static $sDatabase = null;
    protected static $sSession = null;
    // protected static $sPseudoCookie = null;


    public static function initStaticVars() {
        global $session;
        global $database;
        // global $pseudoCookie;

        static::$sDatabase = $database;
        static::$sSession = $session;
        // static::$sPseudoCookie = $pseudoCookie;
    }


    public function __construct()
    {
        // $this->pseudoSession = \App\Model\PseudoSession::getInstance();
        // $this->database = \App\Core\MySQLDatabase::getInstance();

        global $session;
        global $database;
        // global $pseudoCookie;

        $this->database = $database;
        $this->session = $session;
        // $this->pseudoCookie = $pseudoCookie;


        // self::$sDatabase = \App\Core\MySQLDatabase::getInstance();
        // self::$sPseudoSession = \App\Model\PseudoSession::getInstance();
        // static::initStaticVars();


        // var_dump();
        
    }

}