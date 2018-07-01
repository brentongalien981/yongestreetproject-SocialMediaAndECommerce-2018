<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-06
 * Time: 18:02
 */

namespace App\Model;

use App\Core\MainModel;

class RateableItemTag extends MainModel
{
    protected static $table_name = "RateableItemsTags";
    protected static $className = "RateableItemTag";

    protected static $db_fields = array(
        "rateable_item_id",
        "tag_id"
    );
//    public static $searchable_fields = array("title");

    public $rateable_item_id;
    public $tag_id;

    public $primary_key_id_name = null;
}