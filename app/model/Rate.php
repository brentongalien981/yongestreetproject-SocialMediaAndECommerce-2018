<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-30
 * Time: 02:14
 */

namespace App\Model;

use App\Core\MainModel;


class Rate extends MainModel
{
    protected static $db_fields = array("id", "value", "name");
    protected static $table_name = "Rates";
    protected static $className = "Rate";

//    // Override this if the pk-field is not named "id". Ex. "user_id", "product_id", etc...
//    protected $pk = [];


//    public static $searchable_fields = array();
//    public $primary_key_id_name = "id";
//    protected static $primaryKeyName = "id";


    public $id;
    public $value;
    public $name;


    public function __construct()
    {
        parent::__construct();
    }
}