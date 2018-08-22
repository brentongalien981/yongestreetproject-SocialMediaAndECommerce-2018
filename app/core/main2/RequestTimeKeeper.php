<?php
namespace App\Core\Main2;

// use App\Model\Session;

class RequestTimeKeeper
{
    public static function setLastRequestTime(Request $request)
    {
        $lastRequestTimeForSessionIndexName = 'LAST_REQUEST_TIME';

        if ($request->isRequestAjax) {
            $lastRequestTimeForSessionIndexName .= '_FOR_' . $request->controllerName;
            $lastRequestTimeForSessionIndexName .= '_' . $request->controllerAction;
        }

        $_SESSION[$lastRequestTimeForSessionIndexName] = $_SERVER['REQUEST_TIME'];
    }


    public static function getLastRequestDateTimeInSeconds($request)
    {
        $lastRequestTimeForSessionIndexName = 'LAST_REQUEST_TIME';

        if ($request->isRequestAjax) {
            $lastRequestTimeForSessionIndexName .= '_FOR_' . $request->controllerName;
            $lastRequestTimeForSessionIndexName .= '_' . $request->controllerAction;
        }


        if (isset($_SESSION[$lastRequestTimeForSessionIndexName])) {
            return $_SESSION[$lastRequestTimeForSessionIndexName];
        } else {
            return $_SERVER['REQUEST_TIME'] - 3;
        }
    }


    public static function getLatestMinuteBasisRequestTimeForControllerNameOfSpecificCrudAction($request)
    {

        // latest_minute_basis_request_time_for_controller_name_of_specific_crud_action

        // To shorten the index name, let a = 'latest_minute_basis_request_time_for_'.
        $a = 'latest_minute_basis_request_time_for_' . $request->controllerName . '_' . $request->controllerAction;
        // $a = 'latest_minute_basis_request_time_for_' . $request['controllerName'] . '_' . $request['controllerAction'];

        if (!isset($_SESSION[$a])) {
            $_SESSION[$a] = $_SERVER['REQUEST_TIME'];
        } 
        
        return $_SESSION[$a];
    }


    public static function setLatestMinuteBasisRequestTimeForControllerNameOfSpecificCrudAction($request, $value)
    {

        // To shorten the index name, let a = 'latest_minute_basis_request_time_for_'.
        $a = 'latest_minute_basis_request_time_for_' . $request->controllerName . '_' . $request->controllerAction;
        // $a = 'latest_minute_basis_request_time_for_' . $request['controllerName'] . '_' . $request['controllerAction'];

        $_SESSION[$a] = $value;
    }


    /**
     * Set the number of requests for the latest
     * minute-basis-request-time for controller-name of
     * specific crud-action.
     */
    public static function setNumOfRequestsForTheLastBasisMinuteForController($request, $value)
    {
        // $b = 'num_of_requests_for_the_last_basis_minute_for_' . $request['controllerName'] . '_' . $request['controllerAction'];
        $b = 'num_of_requests_for_the_last_basis_minute_for_' . $request->controllerName . '_' . $request->controllerAction;

        $_SESSION[$b] = $value;
    }

    public static function getNumOfRequestsForTheLastBasisMinuteForController($request)
    {
        // $b = 'num_of_requests_for_the_last_basis_minute_for_' . $request['controllerName'] . '_' . $request['controllerAction'];
        $b = 'num_of_requests_for_the_last_basis_minute_for_' . $request->controllerName . '_' . $request->controllerAction;

        if (!isset($_SESSION[$b])) {
            self::setNumOfRequestsForTheLastBasisMinuteForController($request, 0);
        }

        return $_SESSION[$b];
    }


    public static function updateVars($request)
    {
        // Let $a = latest_minute_basis_request_time_for_controller_name_of_specific_crud_action.
        $a = self::getLatestMinuteBasisRequestTimeForControllerNameOfSpecificCrudAction($request);

        $currentTime = $_SERVER['REQUEST_TIME'];
        
        $requestTimeGap = $currentTime - $a;

        
        // If the minute-basis time is now 60s past this current request-time,
        // then update the necessary var.
        if ($requestTimeGap > 60) {
                    
            // Renew TheMinuteBasisTimeForControllerNameOfSpecificCrudAction.
            self::setLatestMinuteBasisRequestTimeForControllerNameOfSpecificCrudAction($request, $currentTime);

            // Reset the numOfRequestsForTheLatestMinuteBasisRequestTimeForControllerNameOfSpecificCrudAction.
            self::setNumOfRequestsForTheLastBasisMinuteForController($request, 0);
        } 
        else {
            $oldNumOfRequests = self::getNumOfRequestsForTheLastBasisMinuteForController($request);
            self::setNumOfRequestsForTheLastBasisMinuteForController($request, $oldNumOfRequests + 1);
        }

        
    }
}
