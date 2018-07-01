<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-06
 * Time: 14:34
 */

namespace App\Model;

use App\Core\MainModel;


class Friendship extends MainModel
{
    protected static $table_name = "Friendships";
    protected static $className = "Friendship";

    protected static $db_fields = array(
        "user_id",
        "friend_id"
    );

    public $user_id;
    public $friend_id;

    public $primary_key_id_name = null;

    public function getFriend() {
        $pkId = $this->friend_id;
        return $this->newHasOne("User", $pkId);
    }

    public static function isFollowing($friendId) {

        global $session;
        global $database;

        $data['user_id'] = $session->actual_user_id;
        $data['friend_id'] = $friendId;

        $friendship = static::readByWhereClause($data)[0];


        $isFollowing = false;

        if (isset($friendship)) { $isFollowing = true; }

        return $isFollowing;
    }
}