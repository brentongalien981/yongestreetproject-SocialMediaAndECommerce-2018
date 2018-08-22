<?php

namespace App\Core\Main2;


class Throttler {

    public const MALICE_FREE = 0;
    public const MALICE_BLACK_LISTED_IP = 1;
    public const MALICE_DDOS_ATTACK = 2;
    public const MAX_NUM_OF_REQUESTS_PER_MINUTE_FOR_CONTROLLER_NAME_OF_SPECIFIC_CRUD_ACTION = 60;



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

        // Disregard the checking for these domains for now.
        if ($request->controllerName == 'RateableItemUser' ||
            $request->controllerName == 'RateableItem') {
                return false;
        }


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



    public static function isRequestPossiblyDDOSAttack($request = []) {
    
        // Let $a = latest_minute_basis_request_time_for_controller_name_of_specific_crud_action.
        $a = RequestTimeKeeper::getLatestMinuteBasisRequestTimeForControllerNameOfSpecificCrudAction($request);

        $currentTime = $_SERVER['REQUEST_TIME'];

        // $requestTimeGap = amountOfTimePassedSinceSettingTheMinuteBasisTimeForControllerNameOfSpecificCrudAction.
        $requestTimeGap = $currentTime - $a;

        // If the minute-basis time is now 60s past this current request-time,
        // then the request is safe.
        if ($requestTimeGap > 60) { return false; }

        // Let $b = numOfRequestsForTheLatestMinuteBasisRequestTimeForControllerNameOfSpecificCrudAction
        $b = RequestTimeKeeper::getNumOfRequestsForTheLastBasisMinuteForController($request);

        //
        if ($b > self::MAX_NUM_OF_REQUESTS_PER_MINUTE_FOR_CONTROLLER_NAME_OF_SPECIFIC_CRUD_ACTION) {
            // Oh shootz! It is a DDOS attack.
            return true;
        }

        return false;
    }



    /** This is just for testing. */
    public static function test_isRequestPossiblyDDOSAttack($request = []) {
    
        // Let $a = latest_minute_basis_request_time_for_controller_name_of_specific_crud_action.
        $a = RequestTimeKeeper::getLatestMinuteBasisRequestTimeForControllerNameOfSpecificCrudAction($request);

        $currentTime = $_SERVER['REQUEST_TIME'];

        // $requestTimeGap = amountOfTimePassedSinceSettingTheMinuteBasisTimeForControllerNameOfSpecificCrudAction.
        $requestTimeGap = $currentTime - $a;

        // If the minute-basis time is now 60s past this current request-time,
        // then the request is safe.
        if ($requestTimeGap > 60) { return false; }

        // Let $b = numOfRequestsForTheLatestMinuteBasisRequestTimeForControllerNameOfSpecificCrudAction
        $b = RequestTimeKeeper::getNumOfRequestsForTheLastBasisMinuteForController($request);

        //
        if ($b > self::MAX_NUM_OF_REQUESTS_PER_MINUTE_FOR_CONTROLLER_NAME_OF_SPECIFIC_CRUD_ACTION) {
            // Oh shootz! It is a DDOS attack.
            return true;
        }

        return false;
    }
}