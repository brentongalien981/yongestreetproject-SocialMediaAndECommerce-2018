<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-06
 * Time: 07:16
 */

namespace App\Model;

use App\Core\Main\MainModel;


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


    public function getRateableItemWithRefinements($data = []) {
        // Find
        $data = [
            'item_x_id' => $this->id,
            'item_x_type_id' => \App\Model\RateableItem::ITEM_X_TYPE_ID_VIDEO
        ];

        $rateableItem = \App\Model\RateableItem::readByWhereClause($data)[0];

        // if (isset($data['']))
        $rateableItem->doRefinements($data);

        return $rateableItem;
    }


    public function getCategories($refinementData = []) {

        // $categories = [];

        // Find
        $categories = $this->hasMany2('Category');

        foreach ($categories as $category) {

            $category->doRefinements($refinementData);
        }


        //
        return $categories;
    }


    public static function getUserVideos($data = []) {

        $session = Session::getInstance();

        $qData = [
            'disregardUsingPkIdForQuery' => true,
            'user_id' => $session->actual_user_id,
            'limit' => 20,
            'orderByFields' => 'created_at',
            'orderArrangement' => 'DESC'

        ];

        if (isset($data['earliest_el_date'])) {
            $qData['created_at'] = [
                'comparisonOperator' => '<=',
                'value' => $data['earliest_el_date']
            ];
        }

        if (isset($data['stringified_already_read_obj_ids'])) {
            $qData['id'] = [
                'comparisonOperator' => 'NOT IN',
                'value' => $data['stringified_already_read_obj_ids']
            ];
        }

        
        $userVideos = static::readByWhereClause($qData);

        foreach ($userVideos as $video) {

            $categories = $video->getCategories([
                'excludedProps' => ['unwantedJsonProps']
            ]);
            $rateableItemOfVideo = $video->getRateableItemWithRefinements();
            // $rateableItemOfVideo->primary_key_id_name = 'id';
            $videoTags = $rateableItemOfVideo->getTags();


            $video->filterExclude();

            /* Add a carbon-date field to the obj. */
            $rawDateTimeFieldName = "created_at";
            $video->addReadableDateField($rawDateTimeFieldName);

            $video->replaceFieldNamesForAjax(['human_date' => 'created_at_human_date']);

            /* Add a carbon-date field to the obj. */
            $rawDateTimeFieldName = "updated_at";
            $video->addReadableDateField($rawDateTimeFieldName);

            $video->replaceFieldNamesForAjax(['human_date' => 'updated_at_human_date']);


            // Combine
            $video->categories = $categories;
            $video->tags = $videoTags;
        }

        return $userVideos;
    }

}