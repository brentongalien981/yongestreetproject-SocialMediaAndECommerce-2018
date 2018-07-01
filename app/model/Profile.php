<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-12
 * Time: 03:43
 */

namespace App\Model;

use App\Core\MainModel;


class Profile extends MainModel
{
    protected static $table_name = "Profile";
    protected static $className = "Profile";
    protected static $db_fields = array("user_id", "first_name", "last_name", "description", "pic_url");

    public $user_id;
    public $first_name;
    public $last_name;
    public $description;
    public $pic_url;

    protected $pk = [];
    public $primary_key_id_name = "user_id";
    protected static $primaryKeyName = "user_id";

//    public function init()
//    {
//        self::$table_name = "Profile";
//        self::$className = "Profile";
//        self::$db_fields = array("user_id", "description", "pic_url");
//        $this->primary_key_id_name = "user_id";
//
//    }

    public function __construct()
    {
        parent::__construct();
    }

    public function getAddress() {

        $fkUserId = $this->user_id;
        return $this->newHasOne("Address", ['user_id' => $fkUserId]);
    }


    public function getUserAccount() {

        $fkUserId = $this->user_id;
        return $this->belongsTo("User", ['user_id' => $fkUserId]);
    }

    public static function isTryingToViewOwnProfile($otherUserId) {
        global $session;

        if ($session->actual_user_id == $otherUserId) { return true; }

        return false;
    }
}