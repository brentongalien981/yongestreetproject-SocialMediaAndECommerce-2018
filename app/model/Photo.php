<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-01-14
 * Time: 02:43
 */

namespace App\Model;

use App\Core\MainModel;


class Photo extends MainModel
{
    protected static $table_name = "Photos";
    protected static $className = "Photo";

    protected static $db_fields = array(
        "id",
        "user_id",
        "title",
        "href",
        "src",
        "width",
        "height",
//        "rate_value",
        "private",
        "created_at",
        "updated_at"
    );
    public static $searchable_fields = array("title");

    public $id;
    public $user_id;
    public $title;
    public $href;
    public $src;
    public $width;
    public $height;
//    public $rate_value;
    public $private;
    public $created_at;
    public $updated_at;

}