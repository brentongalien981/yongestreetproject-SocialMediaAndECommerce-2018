<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-15
 * Time: 12:27
 */

namespace App\Model;

use App\Core\MainModel;


class TimelinePost extends MainModel
{
    protected static $db_fields = array("id", "owner_user_id", "poster_user_id", "date_posted", "date_updated", "message");
    protected static $table_name = "TimelinePosts";
    protected static $className = "TimelinePost";


    public $id;
    public $owner_user_id;
    public $poster_user_id;
    public $message;
    public $date_posted;
    public $date_updated;

    /** @ */
    public function init() {

    }

    public function __construct()
    {
        parent::__construct();
    }

    /** @override */

    public function oldRead($data)
    {
        $data['isProducedBy'] = true;
        global $session;
        $limit = 5;

        $q = "SELECT * ";
        $q .= "FROM TimelinePosts ";
        $q .= "INNER JOIN Users ON TimelinePosts.poster_user_id = Users.user_id ";
        $q .= "INNER JOIN Profile ON TimelinePosts.poster_user_id = Profile.user_id ";
        $q .= "WHERE owner_user_id = {$session->currently_viewed_user_id} ";
        $q .= "ORDER BY date_posted DESC ";
        $q .= "LIMIT {$limit}";

        //
        $result_set = self::read_by_query($q);


        global $database;
        $array_of_objs = array();

        while ($row = $database->fetch_array($result_set)) {
            //
            $an_obj = array(
                "post_id" => $row['id'],
                "date_posted" => $row['date_posted'],
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "pic_url" => $row['pic_url'],
                "message" => $row['message']
            );

            //
            array_push($array_of_objs, $an_obj);
        }

        return $array_of_objs;
    }

    public function getTimelinePostOwner() {

        $fkOwnerUserId = $this->owner_user_id;
        return $this->belongsTo("User", $fkOwnerUserId);
    }
}