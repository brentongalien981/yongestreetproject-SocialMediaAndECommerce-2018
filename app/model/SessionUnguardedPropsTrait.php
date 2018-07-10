<?php

namespace App\Model;

trait SessionUnguardedPropsTrait
{
    public $userType;


    public function initUnguardedProps()
    {
        $this->initId();
        $this->initLastRequestDatetime();
        $this->initConsecutiveFailedRequests();
        $this->initUserType();
    }

    private function initId() {
        if ($this->logged_in) {
            $this->id = $_SESSION['id'];
        }
        else {
            $this->id = session_id();
        }
    }

    public function initConsecutiveFailedRequests() {
        if (isset($_SESSION['consecutive_failed_requests'])) {
            $this->consecutive_failed_requests = $_SESSION['consecutive_failed_requests'];
        } else {
            $this->consecutive_failed_requests = $_SESSION['consecutive_failed_requests'] = 0;
        }
    }

    public function initLastRequestDatetime()
    {
        if (isset($_SESSION['last_request_datetime'])) {
            $this->last_request_datetime = $_SESSION['last_request_datetime'];
        } else {
            $this->last_request_datetime = -1;
        }

        $_SESSION['last_request_datetime'] = $_SERVER['REQUEST_TIME'];
        // $_SESSION['truth_last_request_datetime'] = $_SERVER['REQUEST_TIME'];
    }


    public function resetLastRequestDatetime() {
        $_SESSION['last_request_datetime'] = $_SERVER['REQUEST_TIME'];
    }


    public function initUserType()
    {
        $userTypeId = isset($_SESSION['user_type_id']) ? $_SESSION['user_type_id'] : null;

        $this->setUserType($userTypeId);
    }


    public function getLastRequestDatetimeInSec()
    {
        $lastRequestDateTimeObj = date_create($this->last_request_datetime);
        $lastRequestDateTimeInSeconds = date_format($lastRequestDateTimeObj, "U");
        return $lastRequestDateTimeInSeconds;
    }



    public function setUserType($userTypeId = null)
    {
        $userType = null;
        
        switch ($userTypeId) {
            case User::GUEST_USER_TYPE:
                $userType = 'guest';
                break;
            case User::LOGGED_IN_USER_TYPE:
                $userType = 'logged-in';
                break;
            case User::ADMIN_USER_TYPE:
                $userType = 'admin';
                break;
            default:
                $userType = null;
                break;
        }

        $_SESSION['actual_user_type_id'] = $userTypeId;
        $_SESSION['user_type_id'] = $userTypeId;
        $_SESSION['userType'] = $userType;
        $this->user_type_id = $userTypeId;
        $this->userType = $userType;
    }
}
