<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-13
 * Time: 11:50
 */

namespace App\Core\Main;


class CNMain
{
    public $session;
    public $database;

    public function __construct()
    {
        global $session;
        global $database;

        $this->session = $session;
        $this->database = $database;
    }
}