<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-03-13
 * Time: 00:34
 */

namespace App\Model;

use App\Core\MainModel;


class Playlist extends MainModel
{
    const READ_VIDEO_FOR_VIDEO_PLAYLIST = 1;
    const READ_VIDEO_FOR_VIDEO_PLAYLIST_PLUG_IN = 2;

    protected static $table_name = "Playlists";
    protected static $className = "Playlist";

    protected static $db_fields = array(
        "id",
        "user_id",
        "title",
        "description",
        "private",
        "created_at",
        "updated_at"
    );

    public $id;
    public $user_id;
    public $title;

    public $description;
    public $private;
    public $created_at;
    public $updated_at;

    public static function doesContainVideo($playlistId, $videoId) {

        //
        $q = "SELECT * FROM PlaylistsVideos";
        $q .= " WHERE playlist_id = {$playlistId}";
        $q .= " AND video_id = {$videoId}";

        $resultSet = self::execute_by_query($q);

        global $database;

        return ($database->get_num_rows_of_result_set($resultSet) >= 1) ? true : false;
    }


    public function getVideos($dataForPivotTable) {

        // Find
        $videos = $this->hasMany2("Video", $dataForPivotTable);


        foreach ($videos as $video) {

            // Find
            $videoPosterUser = $video->getPosterUser();

            // Filter
            $video->filterExclude();

            // Refine
            $video->replaceFieldNamesForAjax(['id' => 'video_id']);

            // Combine
            $video->combineWithObj($videoPosterUser);
        }


        //
        return $videos;

    }


    public function isGuardedForPrivacy() {

        //
        $isGuarded = true;

        // If the playlist-obj is private,
        if ($this->private) {

            // if the user is not viewing its own account,
            if ($this->session->is_viewing_own_account()) { $isGuarded = false; }
        }
        else { $isGuarded = false; }

        //
        return $isGuarded;
    }
}