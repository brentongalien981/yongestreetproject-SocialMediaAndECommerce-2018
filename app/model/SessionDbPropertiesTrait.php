<?php
namespace App\Model;

trait SessionDbPropertiesTrait
{

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


    public function prepPropsForDbAsGuestUser() {
        session_regenerate_id();

        $this->id = session_id();
        $this->user_id = \App\Core\Main2\MainModel::CN_DB_NULL;
        $this->user_type_id = User::GUEST_USER_TYPE;
        $this->consecutive_failed_requests = 0;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->last_request_datetime = \App\Core\Main2\MainModel::CURRENT_TIMESTAMP;
        $this->last_log_in = \App\Core\Main2\MainModel::CURRENT_TIMESTAMP;
        $this->created_at = \App\Core\Main2\MainModel::CURRENT_TIMESTAMP;
        $this->updated_at = \App\Core\Main2\MainModel::CURRENT_TIMESTAMP;   
    }


    public static function getPropsInAssociativeArrayForm($data = ['id' => '0']) {

                
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE id = '{$data['id']}'";

        $actualSessionRecord = self::executeByQuery($q);

        $actualSessionAssocArr = \App\Core\Main2\MainModel::transformRecordToAssociativeArray($actualSessionRecord);

        return $actualSessionAssocArr;
    }


    public function setProps($props) {

        foreach ($props as $prop => $value) {
            if ($this->has_attribute($prop)) {
                $this->$prop = $value;
                $_SESSION[$prop] = $value;
            }
        }
    }


    // public function setPropsAsGuestUser() {
        
    //     $actualSessionAssocArr = self::getPropsInAssociativeArrayForm(['id' => $this->id]);
    //     // TODO: ish

    //     $this->user_id = $actualSessionAssocArr['user_id'];
    //     $this->user_type_id = $actualSessionAssocArr['user_type_id'];
    //     $this->consecutive_failed_requests = $actualSessionAssocArr['consecutive_failed_requests'];
    //     $this->ip = $actualSessionAssocArr['ip'];
    //     $this->user_agent = $actualSessionAssocArr['user_agent'];
    //     $this->last_request_datetime = $_SERVER['REQUEST_TIME'];

    //     $this->last_log_in = $actualSessionAssocArr['last_log_in'];
    //     $this->created_at = $actualSessionAssocArr['created_at'];
    //     $this->updated_at = $actualSessionAssocArr['updated_at'];

    //     $_SESSION['user_type_id'] = $this->user_type_id;
    //     $_SESSION['consecutive_failed_requests'] = $this->consecutive_failed_requests;
    //     $_SESSION['ip'] = $this->ip;
    //     $_SESSION['user_agent'] = $this->user_agent;
    //     $_SESSION['last_request_datetime'] = $_SERVER['REQUEST_TIME'];
    //     $_SESSION['last_log_in'] = $this->last_log_in;
    //     // $_SESSION['created_at'] = $this->created_at;
    //     // $_SESSION['updated_at'] = $this->updated_at;       
    // }




    /**
     * TODO: NOTE: Call this just before you close the db-connections..
     */
    public static function refreshLastRequestDateTimeInDb()
    {

        $q = "UPDATE " . static::$table_name;
        $q .= " SET last_request_datetime = NOW()";
        $q .= " WHERE id = " . static::$instance->id;

        $session = Session::getInstance();

        if ($session->logged_in) {
            static::executeByQuery($q);
        }

        // $_SESSION['last_request_datetime'] = $session->last_request_datetime;
        
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


    // TODO: Make this private.
    public function setNumOfConsecutiveFailedRequests($value = 0)
    {

        //
        $q = "UPDATE " . static::$table_name;
        $q .= " SET consecutive_failed_requests = $value";
        $q .= " WHERE id = " . static::getInstance()->id;

        if ($this->logged_in) {
            \App\Core\Main2\MainModel::execute_by_query($q);
        }
        

        //
        $this->consecutive_failed_requests = $value;
        $_SESSION['consecutive_failed_requests'] = $value;
    }


    public static function isSessionHiJacked($sessionPropsInArrayForm = null)
    {
        //
        if (!isset($sessionPropsInArrayForm)) { return true; }
        

        if (($sessionPropsInArrayForm['ip'] !== $_SERVER['REMOTE_ADDR']) ||
            ($sessionPropsInArrayForm['user_agent'] !== $_SERVER['HTTP_USER_AGENT'])) {
            return true;
        }

        return false;
    }


    /** @deprecated version */
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
