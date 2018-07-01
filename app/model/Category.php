<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-25
 * Time: 18:41
 */

namespace App\Model;

use App\Core\MainModel;

class Category extends MainModel
{
    protected static $table_name = "Categories";
    protected static $className = "Category";

    protected static $db_fields = array(
        "id",
        "name",
        "created_at",
        "updated_at"
    );


    public $id;
    public $name;
    public $created_at;
    public $updated_at;
}