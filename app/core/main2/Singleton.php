<?php

namespace App\Core\Main2;

class Singleton
{
    /**
     * NOTE: Always override this var for every sub-class
     * that inherits this class so that you won't have just
     * a one static $instance var that is referred by all
     * sub-classes...
     */
    protected static $instance = null;

    protected function __construct()
    {
        // Don't allow construction from outside-circles...
    }

    protected function __clone()
    {
        // Don't allow..
    }

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}