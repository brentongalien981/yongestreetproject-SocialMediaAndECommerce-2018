<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-05
 * Time: 01:19
 */

namespace App\Model;

use App\Core\MainModel;


class UserTopActivity extends MainModel
{
    protected static $table_name = "UserTopActivities";
    protected static $className = "UserTopActivity";

    protected static $db_fields = array(
        "id",
        "user_id",
        "name",
        "description",
        "photo_link",
        "x_offset"
    );

    public $id;
    public $user_id;
    public $name;
    public $description;
    public $photo_link;
    public $x_offset;
}