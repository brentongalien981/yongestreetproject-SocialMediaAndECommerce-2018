<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-06
 * Time: 07:16
 */

namespace App\Model;

use App\Core\MainModel;


class Video extends MainModel
{
    protected static $table_name = "Videos";
    protected static $className = "Video";

    protected static $db_fields = array(
        "id",
        "user_id",
        "title",
        "description",
        "url",
        "owner_name",
        "private",
        "created_at",
        "updated_at"
    );

    public $id;
    public $user_id;
    public $title;

    public $description;
    public $url;
    public $owner_name;
    public $private;
    public $created_at;
    public $updated_at;

    public function getPosterUser() {

        // Find
        $posterUser = $this->belongsTo2("User");

        // Filter
        $posterUser->filterInclude(['user_name']);

        // Refine
        $posterUser->replaceFieldNamesForAjax(['user_name' => 'poster_user_name']);

        return $posterUser;
    }

    public function getRateableItem() {

        // Find
        $data = [
            'item_x_id' => $this->id,
            'item_x_type_id' => \App\Model\RateableItem::ITEM_X_TYPE_ID_VIDEO
        ];

        $rateableItem = \App\Model\RateableItem::readByWhereClause($data)[0];

        // Filter
        $rateableItem->filterExclude();

        // Refine
        $rateableItem->replaceFieldNamesForAjax(['id' => 'rateable_item_id']);

        return $rateableItem;
    }

}