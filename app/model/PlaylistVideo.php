<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-03-13
 * Time: 01:45
 */

namespace App\Model;

use App\Core\MainModel;

class PlaylistVideo extends MainModel
{
    protected static $table_name = "PlaylistsVideos";
    protected static $className = "PlaylistVideo";

    protected static $db_fields = array(
        "playlist_id",
        "video_id",
        "created_at",
        "updated_at"
    );
//    public static $searchable_fields = array("title");

    public $playlist_id;
    public $video_id;
    public $created_at;
    public $updated_at;

    public $primary_key_id_name = null;

}