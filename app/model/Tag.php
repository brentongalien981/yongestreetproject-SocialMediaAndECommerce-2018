<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-06
 * Time: 18:07
 */

namespace App\Model;

use App\Core\MainModel;


class Tag extends MainModel
{
    protected static $table_name = "Tags";
    protected static $className = "Tag";

    protected static $db_fields = array(
        "id",
        "tag",
        "created_at",
        "updated_at"
    );

    public $id;
    public $tag;
    public $created_at;
    public $updated_at;
}