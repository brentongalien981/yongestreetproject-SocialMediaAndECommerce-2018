<?php

global $database;
$database = \App\Core\Main2\MySQLDatabase::getInstance();

global $session;
$session = \App\Model\Session::getInstance();

// global $pseudoCookie;
// $pseudoCookie = \App\Core\PSEUDOCOOKIE::getInstance();

// $x = 99;

\App\Core\Main2\CNMain::initStaticVars();


// $pseudoCookie = new \App\Core\Throttler();
// $database->close_connection();


?>