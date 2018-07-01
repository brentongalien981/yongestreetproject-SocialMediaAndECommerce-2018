<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-01-09
 * Time: 06:02
 */

namespace App\Model;

use App\Core\MainModel;

class NotificationTimelinePostReply extends MainModel
{
    protected static $table_name = "NotificationsTimelinePostReply";
    protected static $className = "NotificationTimelinePostReply";
    protected static $db_fields = array(
        "notification_id",
        "timeline_post_reply_id"
    );
    public $primary_key_id_name = "notification_id";

    public $notification_id;
    public $timeline_post_reply_id;

    public function __construct()
    {
        parent::__construct();
    }

    /** @override */
    public function hasMany($extentionClassName, $timelinePostId, $data = null) {

        $extentionalData["id"] = $timelinePostId;
        $extentionalClassPath = "\\App\\Model\\" . $extentionClassName;
        $extentionalClass = new $extentionalClassPath();

        $subscriptions = $extentionalClass->read($extentionalData);

        return $subscriptions;


    }

    public function getSubscriptions($timelinePostId) {

        $timelinePostSubscriptions = $this->hasMany("TimelinePostUserSubscription", $timelinePostId);

        return $timelinePostSubscriptions;
    }

    public function getParentNotifications($data) {

        $extentionalObj = new \App\Model\Notification();

        return $extentionalObj->read_by_where_clause($data);
    }

    public function getTimelinePostReply() {

        $fkTimelinePostReplyId = $this->timeline_post_reply_id;
        return $this->belongsTo("TimelinePostReply", $fkTimelinePostReplyId);
    }
}