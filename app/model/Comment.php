<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-03-27
 * Time: 23:59
 */

namespace App\Model;

use App\Core\MainModel;

class Comment extends MainModel
{
    protected static $table_name = "Comments";
    protected static $className = "Comment";

    protected static $db_fields = array(
        "id",
        "rateable_item_id",
        "user_id",
        "message",
        "created_at",
        "updated_at"
    );

    public $id;
    public $rateable_item_id;
    public $user_id;
    public $message;

    public $created_at;
    public $updated_at;

    public function getPosterUser() {

        // Find
        $posterUser = $this->belongsTo2("User");

//        // Filter
//        $posterUser->filterInclude(['user_id', 'user_name']);

//        // Refine
//        $posterUser->replaceFieldNamesForAjax(['user_name' => 'poster_user_name']);

        return $posterUser;
    }

    // This is just for sample phpunit test.
    public function getShit() {
        return 'shit';
    }
}