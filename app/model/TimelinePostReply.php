<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-19
 * Time: 12:07
 */

namespace App\Model;

use App\Core\MainModel;


class TimelinePostReply extends MainModel
{
    public $id;
    public $parent_post_id;
    public $owner_user_id;
    public $poster_user_id;
    public $message;
    public $date_posted;
    public $date_updated;

    /** @override */
    public function init() {
        self::$table_name = "TimelinePostReplies";
        self::$className = "TimelinePostReply";

        self::$db_fields = array(
            "id",
            "parent_post_id",
            "owner_user_id",
            "poster_user_id",
            "date_posted",
            "date_updated",
            "message"
        );
//        $this->primary_key_id_name = "user_id";

    }

    public function __construct()
    {
        parent::__construct();
    }

    public function getTimelinePost() {

        $fkTimelinePostId = $this->parent_post_id;
        return $this->belongsTo("TimelinePost", $fkTimelinePostId);
    }
}