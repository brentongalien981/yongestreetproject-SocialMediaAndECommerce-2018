<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-08
 * Time: 05:19
 */

namespace App\Model;

use App\Core\MainModel;

class Friend extends MainModel
{
    protected static $table_name = "Users";
    protected static $className = "User";

    protected static $db_fields = array(
        "id",
    );

    public $id;

    protected static $primaryKeyName = "user_id";
}