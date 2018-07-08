<?php
namespace App\Model;

use App\Core\Main2\Singleton;
use App\Model\User;
use App\Core\Main2\Cookie;

class Session extends Singleton
{

    //
    use \App\Core\Main2\LimitedMainModelTrait;
    use \App\Model\SessionDbPropertiesTrait;
    use \App\Model\SessionMainTrait;
    use \App\Model\SessionUnguardedPropsTrait;


    // public $database;
    protected static $instance = null;


    public function __construct()
    {
        $this->check_login();
        $this->initUnguardedProps();
         
        if ($this->logged_in) {
            // actions to take right away if user is logged in
        } else {
            // actions to take right away if user is not logged in
        }
    }



    /** @override */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
            
            // TODO: Change the hard-coded user-id...
            // Refer to the latest session of the user..
            // $pseudoSessionRecord = \App\Core\Main2\MainModel::readByWhereClause(['tableName' => 'Sessions', 'user_id' => 8, 'doNotInstantiate' => true])[0];
            // $sessionRecord = \App\Core\Main2\MainModel::readByWhereClause(['tableName' => 'Sessions', 'user_id' => 8, 'doNotInstantiate' => true])[0];
            
            // static::$instance = static::instantiate($sessionRecord);
            //
            // static::refreshLastRequestDateTimeInDb();
            
            //
            // static::$instance->setUserType(static::$instance->user_type_id);
        }
        return static::$instance;
    }


    public function setBasicProps($props)
    {
        $this->setProps($props);
        $this->resetLastRequestDatetime();
        $this->setUserType($this->user_type_id);
    }




    /**
     * Note: database should find user based on username/password.
     *
     * @param [type] $user
     * @return void
     */
    public function login($user)
    {
        if ($user) {

            // Create new cookie-session objs and records.
            $this->prepPropsForDbRecordCreation([
                'userTypeId' => User::LOGGED_IN_USER_TYPE,
                'userId' => $user->user_id
            ]);
            $this->create();
        
            $actualSessionAssocArr = Session::getPropsInAssociativeArrayForm(['id' => $this->id]);
            $this->setBasicProps($actualSessionAssocArr);
        
            $newCookie = Cookie::generateCnCookie();
            $newCookie->create();


            $this->setMainSessionProps($user);

            // TODO: $this->setOtherProps();
        }
    }



    public function logout()
    {

        // TODO: Delete the cookie record in the db.
        $signedClientCookieValue = isset($_COOKIE[Cookie::CN_COOKIE_NAME]) ? $_COOKIE[Cookie::CN_COOKIE_NAME] : null;
        $cookieObj = Cookie::getCookieObjBasedOnDbRecord($signedClientCookieValue);
        Cookie::delete(['id' => $cookieObj->id]);


        // TODO: Delete the session record in the db.
        $sessionIdWithQuotes = "'{$this->id}'";
        static::staticDelete(['id' => $sessionIdWithQuotes]);
        

        foreach ($this as $prop => $value) {
            unset($this->$prop);
            unset($_SESSION[$prop]);
        }

        $this->logged_in = false;
        session_unset();
        session_destroy();
    }



    private function check_login()
    {
        if (isset($_SESSION["actual_user_id"])) {
            $this->initMainSessionProps();
        } else {
            $this->unsetMainSessionProps();
        }
    }
}
