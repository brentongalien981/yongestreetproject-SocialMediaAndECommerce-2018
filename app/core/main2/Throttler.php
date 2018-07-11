<?php

namespace App\Core\Main2;


class Throttler {

    public const MALICE_FREE = 0;
    public const MALICE_BLACK_LISTED_IP = 1;
    public const MALICE_DDOS_ATTACK = 2;



    public static function addToBlacklistedIps($ip) {

        $numOfFailedAttempts = Request::MAX_NUM_OF_CONSECUTIVE_FAILED_REQUESTS;

        $q = "INSERT INTO BlacklistedIps (ip, failed_attempts)";
        $q .= " VALUES ('$ip', $numOfFailedAttempts)";

        $result = MainModel::execute_by_query($q);

        return $result;
    }


    public static function isRequestFromBlacklistedIp($ip) {

        $returnValue = false;

        $db = MySQLDatabase::getInstance();

        $q = "SELECT COUNT(*) AS count FROM BlacklistedIps";
        $q .= " WHERE ip = '$ip'";
        
        $queryResult = $db->get_result_from_query($q);

        while ($row = $db->fetch_array($queryResult)) {

            if ($row['count'] > 0) { $returnValue = true; }
            break;
        }

        return $returnValue;
    }



    public static function isRequestDDOSAttack($request) {

        // $currentDateInSeconds = date("U");
        $currentDateInSeconds = $_SERVER['REQUEST_TIME'];

        $session = \App\Model\Session::getInstance();
        // $lastRequestDateTime = date_create($session->last_request_datetime);
        
        // $lastRequestDateTimeInSeconds = date_format($lastRequestDateTime, "U");

        // $lastRequestDateTimeInSeconds = $session->last_request_datetime;
        $lastRequestDateTimeInSeconds = RequestTimeKeeper::getLastRequestDateTimeInSeconds($request);

        $requestTimeInterval = $currentDateInSeconds - $lastRequestDateTimeInSeconds;

        // If it's a the very first request...
        if ($lastRequestDateTimeInSeconds === -1) { return false; }

        if ($requestTimeInterval > Request::TIME_INTERVAL_CONSTRAINT_PER_PAGE_REQUEST) {
            // Not a DDOS request.
            return false;
        }

        // A DDOS request.
        return true;
    }
}