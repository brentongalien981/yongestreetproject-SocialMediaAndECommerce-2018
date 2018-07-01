<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-01-08
 * Time: 19:50
 */

namespace App\Model;

use App\Core\MainModel;


class TimelinePostUserSubscription extends MainModel
{
    protected static $table_name = "TimelinePostUserSubscription";
    protected static $className = "TimelinePostUserSubscription";
    protected static $db_fields = array(
        "timeline_post_id",
        "subscriber_user_id",
        "subscription_date"
    );
    public $primary_key_id_name = "timeline_post_id";
//    public $primary_key_id_name = ["timeline_post_id", "subscriber_user_id"];

    public $timeline_post_id;
    public $subscriber_user_id;
    public $subscription_date;

    public function __construct()
    {
        parent::__construct();
    }
}