<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-19
 * Time: 17:48
 */

namespace App\Model;

use App\Core\MainModel;


class RateableItemUser extends MainModel
{
    protected static $table_name = "RateableItemsUsers";
    protected static $className = "RateableItemUser";
    protected static $db_fields = array(
        "rateable_item_id",
        "responder_user_id",
        "rate_value",
        "date_created",
        "date_updated"
    );

//    // This class has multiple primary keys. So just override the
//    // parent-model-class's update() method...
//    protected $primary_key_id_name = ["rateable_item_id", "responder_user_id"];

    public $rateable_item_id;
    public $responder_user_id;
    public $rate_value;
    public $date_created;
    public $date_updated;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @override
     * If the attributes to be returned to the ajax / normal request are
     * combinations of real obj attributes, then use this method instead
     * of the normal instantiate() method.
     * @param $data
     * @param $record
     * @return array|null
     */
    public function createPseudoObj($data, $record)
    {
        $obj = null;

        switch ($data["what_to_read"]) {
            case "rate_sigma":

                $obj = array(
                    "rateable_item_id" => $record['rateable_item_id'],
                    "count" => $record['count']
                );

                break;
            case "rate_value_sigma":

                $obj = array(
                    "rateable_item_id" => $record['rateable_item_id'],
                    "count" => $record['count'],
                    "rate_value_sum" => $record['rate_value_sum']
                );

                break;
        }

        return $obj;
    }

    /** @deprecated  */
    public function updateOld()
    {
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->get_sanitized_attributes();
        $attribute_pairs = array();

        foreach ($attributes as $key => $value) {
            // Don't include the password for the update.
            if ($value == null) {
                continue;
            }

            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table_name . " SET ";
        $query .= join(", ", $attribute_pairs);

        $query .= " WHERE rateable_item_id = " . $this->database->escape_value($this->rateable_item_id);
//        $query .= " WHERE rateable_item_id = {$this->rateable_item_id}";

        $query .= " AND responder_user_id = " . $this->database->escape_value($this->responder_user_id);
//        $query .= " AND responder_user_id = {$this->responder_user_id}";

        //
        $query = self::update_query_with_current_time_stamp($query);

        //
        $result_set = self::execute_by_query($query);

        if (!$result_set) {
            return false;
        }

        //
        return ($this->database->get_num_of_affected_rows() == 1) ? true : false;

    }

    public function doesRecordExist()
    {
        $data['where_clause'] = "WHERE rateable_item_id = {$this->rateable_item_id}";
        $data['where_clause'] .= " AND responder_user_id = {$this->responder_user_id}";


        $objs = $this->read_by_where_clause($data);
        return (count($objs) > 0) ? true : false;
    }
}