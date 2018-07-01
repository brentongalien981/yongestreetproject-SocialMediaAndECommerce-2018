<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-06
 * Time: 07:16
 */

namespace App\Model;

use App\Core\MainModel;


class Work extends MainModel
{
    protected static $table_name = "Works";
    protected static $className = "Work";

    protected static $db_fields = array(
        "id",
        "user_id",
        "title",
        "employer",
        "from_date",
        "to_date"
    );

    public $id;
    public $user_id;
    public $title;
    public $employer;
    public $from_date;
    public $to_date;

    public function getWorkDescriptions() {

        $fk = ['work_id' => $this->id];
        $data['limit'] = 7;
        return $this->hasMany("WorkDescription", $fk, $data);
    }
}