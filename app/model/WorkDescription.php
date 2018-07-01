<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-06
 * Time: 07:16
 */

namespace App\Model;

use App\Core\MainModel;


class WorkDescription extends MainModel
{
    protected static $table_name = "WorkDescriptions";
    protected static $className = "WorkDescription";

    protected static $db_fields = array(
        "work_id",
        "description"
    );

    public $work_id;
    public $description;

    public $primary_key_id_name = null;

}