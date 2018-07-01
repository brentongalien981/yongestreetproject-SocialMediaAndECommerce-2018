<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-29
 * Time: 23:43
 */

namespace App\Model;

use App\Core\MainModel;


class Notification extends MainModel
{
    protected static $table_name = "Notifications";
    protected static $className = "Notification";
    protected static $db_fields = array(
        "id",
        "notified_user_id",
        "notifier_user_id",
        "notification_msg_id",
        "initiation_date",
        "is_deleted"
    );

//    protected $primary_key_id_name = "user_id";

    public $id;
    public $notified_user_id;
    public $notifier_user_id;
    public $notification_msg_id;
    public $initiation_date;
    public $is_deleted;


    public function __construct()
    {
        parent::__construct();
    }

    public function getChildNotification($childClassName) {

        return $this->hasOne2($childClassName);

    }

    public function getNotifier() {

        $fkUserId = $this->notifier_user_id;
        return $this->newHasOne("User", $fkUserId);
    }

    public function getChildNotificationTimelinePostReply() {
        $pkNotificationId = $this->id;
        return $this->newHasOne("NotificationTimelinePostReply", $pkNotificationId);
    }

}