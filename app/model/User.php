<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-20
 * Time: 16:52
 */

namespace App\Model;

use App\Core\Main\MainModel;


class User extends MainModel
{
    const GUEST_USER_TYPE = 2;
    const LOGGED_IN_USER_TYPE = 1;
    const ADMIN_USER_TYPE = 3;

    protected static $table_name = "Users";
    protected static $className = "User";
    protected static $db_fields = array(
        "user_id",
        "user_name",
        "email",
        "hashed_password",
        "user_type_id",
        "signup_token",
        "private",
        "account_status_id"
    );
//    public static $searchable_fields = array("user_name", "email");
    public $user_id;
    public $user_name;
    public $email;
    public $hashed_password;
    public $user_type_id;
    public $signup_token;
    public $private;
    public $account_status_id;

    protected $pk = [];
    public $primary_key_id_name = "user_id";
    protected static $primaryKeyName = "user_id";

    public function __construct()
    {
        parent::__construct();
    }

//    public function init() {
//        self::$table_name = "Users";
//        self::$className = "User";
//        self::$db_fields = array("user_id", "user_name", "email", "hashed_password", "user_type_id", "signup_token", "private", "account_status_id");
//        self::$searchable_fields = array("user_name", "email");
//        $this->primary_key_id_name = "user_id";
//
//    }


    /**
     * @param string $user_name
     * @return userObj / bool
     */
    public static function authenticate_with_user_object_return($user_name = "") {
        global $database;

        $user_name = $database->escape_value($user_name);

        $data = array(
            'where_clause' => "WHERE user_name = '{$user_name}'",
            'limit' => 1
        );



        $users = (new self())->read_by_where_clause($data);
        $user = $users[0];

        return !empty($user) ? $user : false;
    }

    public static function get_user_type($type_id) {
        switch ($type_id) {
            case self::GUEST_USER_TYPE:
                return "guest";
                break;
            case self::LOGGED_IN_USER_TYPE:
                return "logged-in";
                break;
            case self::ADMIN_USER_TYPE:
                return "admin";
                break;
        }
    }

    public function getUserSocialMediaAccounts() {

        $fk = ['user_id' => $this->user_id];
        $data['limit'] = 7;
        return $this->hasMany("UserSocialMediaAccount", $fk, $data);
    }

    public function getProfile() {

        return $this->hasOne2("Profile");
    }

    public function getFriends() {
        return $this->hasMany2("Friend");
    }

    public function getSocialMediaAccounts() {

        $socialMediaAccounts = $this->hasMany2("SocialMediaAccount");

        foreach ($socialMediaAccounts as $socialMediaAccount) {

            // find
            $socialMediaCompany = $socialMediaAccount->belongsTo2("SocialMediaCompany");

            // filter
            $socialMediaAccount->filterExclude(['id', 'social_media_company_id']);
            $socialMediaCompany->filterInclude(['name']);

            // refine
            $socialMediaAccount->replaceFieldNamesForAjax(['username' => 'social_media_username']);
            $socialMediaCompany->replaceFieldNamesForAjax(['name' => 'social_media_company_name']);

            // combine
            $socialMediaAccount->combineWithObj($socialMediaCompany);
        }

        //
        return $socialMediaAccounts;
    }

    public static function readByUserName($user_name) {
        $data['user_name'] = $user_name;

        return static::readByWhereClause($data)[0];
    }












    /** TODO: Maybe refacor these. */
    public static function create_user_profile($user_id)
    {
//        global $session;
        global $database;
        $query = "INSERT INTO Profile(user_id) VALUES({$user_id})";

        $is_creation_ok = $database->get_result_from_query($query);

        if ($is_creation_ok) {
            return true;
        }

        return false;
    }
}