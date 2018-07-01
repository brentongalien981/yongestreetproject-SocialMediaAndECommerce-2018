<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-12
 * Time: 03:11
 */

namespace App\Model;

use App\Core\MainModel;


class MyStoreItem extends MainModel
{
    protected static $table_name = "MyStoreItems";
    protected static $db_fields = array(
        "id",
        "user_id",
        "name",
        "price",
        "description",
        "photo_address",
        "quantity",
        "mass",
        "length",
        "width",
        "height",
    );
    public static $searchable_fields = array("name", "description");


    public function __construct()
    {
        parent::__construct();
    }



    /**
     * @note that when debugging any UPDATE query here in PhpStorm, the method
     *      $database->get_num_of_affected_rows() will return -1, an erronous
     *      value. But if it's a regular mode (not debugging) it works perfectly.
     *      WEIRD!
     * @param $store_item_id
     * @param $new_stock_quantity
     * @return bool
     */
    public static function update_item_stock_quantity($store_item_id, $new_stock_quantity) {
        $q = "UPDATE " . self::$table_name;
        $q .= " SET quantity = {$new_stock_quantity}";
        $q .= " WHERE id = {$store_item_id}";

        global $database;
        // Start transaction.
        if (!$database->start_transaction()) {
            return false;
        }

        $database->get_result_from_query($q);

        //
        $is_update_ok = ($database->get_num_of_affected_rows() == 1) ? true : false;


        //
        if ($is_update_ok) {
            //
            if (!$database->commit()) {
                return false;
            }

            //
            return true;
        } else {
            //
            $database->rollback();

            //
            return false;
        }
    }
}