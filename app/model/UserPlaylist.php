<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-12
 * Time: 20:14
 */

namespace App\Model;

use App\Core\MainModel;

class UserPlaylist extends MainModel
{
    protected static $table_name = "UsersPlaylists";
    protected static $className = "UserPlaylist";

    public $primary_key_id_name = null;
    protected static $primaryKeyName = null;

    protected static $db_fields = array(
        "user_id",
        "playlist_id",
        "created_at",
        "updated_at"
    );

    public $user_id;
    public $playlist_id;
    public $created_at;
    public $updated_at;

}