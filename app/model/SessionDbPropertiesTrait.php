<?php

namespace App\Model;

trait SessionDbPropertiesTrait
{
    protected static $instance = null;

    protected static $db_fields = [
        "id",
        "user_id",
        "user_type_id",
        "consecutive_failed_requests",
        "ip",
        "user_agent",
        "last_request_datetime",
        "last_log_in",
        "created_at",
        "updated_at"
    ];
    protected static $table_name = "Sessions";
    protected static $className = "Session";


    public $id;
    public $user_id;
    public $user_type_id;
    public $consecutive_failed_requests;
    public $ip = "TODO_DEFAULT_SESSION_IP";
    public $user_agent = "TODO_DEFAULT_USER_AGENT";
    public $last_request_datetime;
    public $last_log_in;
    public $created_at;
    public $updated_at;


    public $userType;


    /** @override */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            // static::$instance = new static;
        
            // TODO: Change the hard-coded user-id...
            // Refer to the latest session of the user..
            // $pseudoSessionRecord = \App\Core\Main2\MainModel::readByWhereClause(['tableName' => 'Sessions', 'user_id' => 8, 'doNotInstantiate' => true])[0];
            $sessionRecord = \App\Core\Main2\MainModel::readByWhereClause(['tableName' => 'Sessions', 'user_id' => 8, 'doNotInstantiate' => true])[0];
        
            static::$instance = static::instantiate($sessionRecord);
            //
            static::refreshLastRequestDateTimeInDb();
        
            //
            static::$instance->setUserType(static::$instance->user_type_id);
        }
        return static::$instance;
    }


    public function setUserType($userTypeId = null)
    {
        $this->user_type_id = $userTypeId;
        
        switch ($this->user_type_id) {
            case null:
                $this->userType = null;
                break;
            case '1':
                $this->userType = 'guest';
                break;
            case '2':
                $this->userType = 'logged-in';
                break;
            case '3':
                $this->userType = 'admin';
                break;
            default:
                $this->userType = null;
                break;
        }
    }



    /**
     * TODO: NOTE: Call this just before you close the db-connections..
     */
    public static function refreshLastRequestDateTimeInDb()
    {
        $q = "UPDATE " . static::$table_name;
        $q .= " SET last_request_datetime = NOW()";
        $q .= " WHERE id = " . static::$instance->id;

        static::executeByQuery($q);
    }


    public function incrementNumOfConsecutiveFailedRequests()
    {

        //
        $newNumOfConsecutiveFailedRequests = $this->consecutive_failed_requests + 1;

        $this->setNumOfConsecutiveFailedRequests($newNumOfConsecutiveFailedRequests);
    }
    


    public function resetNumOfConsecutiveFailedRequests()
    {
        $this->setNumOfConsecutiveFailedRequests(0);
    }


    private function setNumOfConsecutiveFailedRequests($value = 0)
    {

        //
        $q = "UPDATE " . static::$table_name;
        $q .= " SET consecutive_failed_requests = $value";
        $q .= " WHERE id = " . static::$instance->id;

        static::execute_by_query($q);

        //
        $this->consecutive_failed_requests = $value;
    }


    public function isHijacked($fakeServer = null)
    {
        $_PSEUDOSERVER = [
            'REMOTE_ADDR' => 'TODO_DEFAULT_SESSION_IP',
            'HTTP_USER_AGENT' => 'TODO_DEFAULT_USER_AGENT'
        ];

        if (isset($fakeServer)) {
            $_PSEUDOSERVER = $fakeServer;
        }
        

        if (($this->ip !== $_PSEUDOSERVER['REMOTE_ADDR']) ||
            ($this->user_agent !== $_PSEUDOSERVER['HTTP_USER_AGENT'])) {
            return true;
        }

        return false;
    }
}
