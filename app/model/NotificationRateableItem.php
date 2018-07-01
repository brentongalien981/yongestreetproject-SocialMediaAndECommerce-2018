<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-30
 * Time: 00:05
 */

namespace App\Model;

use App\Core\MainModel;


class NotificationRateableItem extends MainModel implements FilterableFieldInterface
{
    protected static $table_name = "NotificationsRateableItem";
    protected static $className = "NotificationRateableItem";
    protected static $db_fields = array("notification_id", "rateable_item_id", "rate_value");
    public $primary_key_id_name = "notification_id";

    public $notification_id;
    public $rateable_item_id;
    public $rate_value;
    private static $fieldsAllowedForReturn;


    public function init()
    {
        self::setFieldsAllowedForReturn();

    }

    public static function getFieldsAllowedForReturn()
    {
        return self::$fieldsAllowedForReturn;
    }

    public function getParentNotification() {

        return $this->belongsTo2("Notification");

    }

    public function getParentNotifications($data) {

        $extentionalObj = new \App\Model\Notification();

        return $extentionalObj->read_by_where_clause($data);
    }

    public function getRate() {

        $data = [
            'value' => $this->rate_value
        ];

        return \App\Model\Rate::readByWhereClause($data)[0];
    }

    public function getRateableItem() {

        return $this->belongsTo2('RateableItem');
    }


    public static function setFieldsAllowedForReturn()
    {
        self::$fieldsAllowedForReturn = [
            "notification_id",
            "notifier_user_id",
            "user_name",
            "notification_msg_id",
            "post_id",
            "message",
            "name", // rate_tag
            "initiation_date",
            "human_date"
        ];
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function doesRecordExist()
    {

        $q = "SELECT n.notified_user_id, n.notifier_user_id,";
        $q .= " nri.*,";
        $q .= " riu.date_updated";
        $q .= " FROM Notifications n";
        $q .= " INNER JOIN NotificationsRateableItem nri ON n.id = nri.notification_id";
        $q .= " INNER JOIN RateableItemsUsers riu ON (n.notifier_user_id, nri.rateable_item_id) = (riu.responder_user_id, riu.rateable_item_id)";
        $q .= " WHERE notifier_user_id = {$this->session->actual_user_id}";
        $q .= " AND " . "nri.rateable_item_id = {$this->rateable_item_id}";

        $resultSet = self::execute_by_query($q);

        $numOfRecords = $this->database->get_num_rows_of_result_set($resultSet);

        if ($numOfRecords > 0) {
            return true;
        }
        return false;
    }

    public function getExistingRecordId()
    {

        $parentTableName = "Notifications";

        $q = "SELECT * FROM " . $parentTableName;
        $q .= " INNER JOIN " . self::$table_name;
        $q .= " ON " . $parentTableName . ".id =";
        $q .= " " . self::$table_name . ".notification_id";

        $q .= " WHERE notifier_user_id = {$this->session->actual_user_id}";
        $q .= " AND " . "rateable_item_id = {$this->rateable_item_id}";

        $resultSet = self::execute_by_query($q);

        while ($row = $this->database->fetch_array($resultSet)) {
            return $row["id"];
        }
    }
}