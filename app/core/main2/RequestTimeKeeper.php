<?php
namespace App\Core\Main2;

// use App\Model\Session;

class RequestTimeKeeper
{
    public static function setLastRequestTime(Request $request) {
        $lastRequestTimeForSessionIndexName = 'LAST_REQUEST_TIME';

        if ($request->isAjax()) {
            $lastRequestTimeForSessionIndexName .= '_FOR_' . $request->controllerName;
            $lastRequestTimeForSessionIndexName .= '_' . $request->controllerAction;
        }

        $_SESSION[$lastRequestTimeForSessionIndexName] = $_SERVER['REQUEST_TIME'];
    }


    public static function getLastRequestDateTimeInSeconds($request) {
        $lastRequestTimeForSessionIndexName = 'LAST_REQUEST_TIME';

        if ($request->isAjax()) {
            $lastRequestTimeForSessionIndexName .= '_FOR_' . $request->controllerName;
            $lastRequestTimeForSessionIndexName .= '_' . $request->controllerAction;
        }


        if (isset($_SESSION[$lastRequestTimeForSessionIndexName])) {
            return $_SESSION[$lastRequestTimeForSessionIndexName];
        } else {
            return $_SERVER['REQUEST_TIME'] - 3;
        }
        

    }
}