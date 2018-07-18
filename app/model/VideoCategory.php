<?php
namespace App\Model;

use App\Core\Main\MainModel;

class VideoCategory extends MainModel
{
    protected static $table_name = "VideosCategories";
    protected static $className = "VideoCategory";

    protected static $db_fields = array(
        "video_id",
        "category_id"
    );
//    public static $searchable_fields = array("title");

    public $video_id;
    public $category_id;

    public $primary_key_id_name = null;
}