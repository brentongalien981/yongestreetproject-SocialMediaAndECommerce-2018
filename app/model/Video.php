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
        "is_deleted",
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
    public $is_deleted;
    public $created_at;
    public $updated_at;

    public function getPosterUser()
    {

        // Find
        $posterUser = $this->belongsTo2("User");

        // Filter
        $posterUser->filterInclude(['user_name']);

        // Refine
        $posterUser->replaceFieldNamesForAjax(['user_name' => 'poster_user_name']);

        return $posterUser;
    }


    public function updateCategories($data = [])
    {
        if (!isset($data['categoryIds'])) {
            return;
        }

        //
        $categoryIds = $data['categoryIds'];
        
        // Try to unique read the new categories.
        $categories = Category::uniqueReadMany([
            'uniqueFieldName' => 'id',
            'uniqueFieldValues' => $categoryIds
        ]);

        // Get the old VideoCategory records for this video.
        $videoCategories = $this->cnHasMany([
            'extentionalClassName' => 'Category',
            'limit' => 16
        ]);


        // Loop through the updated-categories.
        foreach ($categories as $category) {

            // Flag.
            $findings = null;
                        
            // Loop through all the old mapping records.
            foreach ($videoCategories as $videoCategory) {
                    
                // If this current-category-id is equal to this current
                // old mapping record's category-id,
                // then dynamically add a property "isStillReferenced"
                // to this mapping obj.
                // Then break the loop.
                if ($category->id == $videoCategory->category_id) {
                    $videoCategory->isStillReferenced = true;
                    $findings = 'isStillReferenced';
                    break;
                }
            }


            // If there's no findings, then create a new
            // mapping record with this updated-category-id.
            if ($findings != 'isStillReferenced') {
                $newMappingObj = new VideoCategory();
                $newMappingObj->video_id = $this->id;
                $newMappingObj->category_id = $category->id;
                $newMappingObj->create();
            }
        }


        // Loop through all the old mapping records.
        foreach ($videoCategories as $videoCategory) {
            // If this current mapping obj doesn't have a
            // property "isStillReferenced", then delete this db-record.
            if (!isset($videoCategory->isStillReferenced)) {
                $videoCategory->cnDeleteByPk();
            }
        }
    }


    public function updateTags($data = [])
    {
        if (!isset($data['tagNames'])) {
            return;
        }

        // Try to unique save the new updated-tags.
        $tagNames = $data['tagNames'];
        $results = Tag::staticSaveMany(['withTags' => $tagNames]);
        
        // Try to unique read the new updated-tags.
        $newTags = Tag::uniqueReadMany([
            'uniqueFieldName' => 'tag',
            'uniqueFieldValues' => $tagNames
        ]);
        
        // Get the old RateableItemTag records for this video.
        $rateableItem = $this->getRateableItemWithRefinements();
        $rateableItemTags = $rateableItem->cnHasMany([
            'extentionalClassName' => 'Tag',
            'limit' => 32
        ]);
        
        
        // Loop through the updated-tags.
        foreach ($newTags as $newTag) {
        
            // Flag.
            $findings = null;
                        
            // Loop through all the old RateableItemTag records
            foreach ($rateableItemTags as $rateableItemTag) {
        
                            // If this current-tag-id is equal to this current
                // old RateableItemTag record's tag-id,
                // then dynamically add a property "isStillReferenced"
                // to this RateableItemTag. Break the loop.
                if ($newTag->id == $rateableItemTag->tag_id) {
                    $rateableItemTag->isStillReferenced = true;
                    $findings = 'isStillReferenced';
                    break;
                }
            }
        
            // If there's no findings, then create a new
            // RateableItemTag record with this updated-tag-id.
            if ($findings != 'isStillReferenced') {
                $newRateableItemTag = new RateableItemTag();
                $newRateableItemTag->rateable_item_id = $rateableItem->id;
                $newRateableItemTag->tag_id = $newTag->id;
                $newRateableItemTag->create();
            }
        }
        
        
        
        // Loop through all the old RateableItemTag records.
        foreach ($rateableItemTags as $rateableItemTag) {
            // If this current RateableItemTag doesn't have a
            // property "isStillReferenced", then delete this db-record.
            if (!isset($rateableItemTag->isStillReferenced)) {
                $rateableItemTag->cnDeleteByPk();
            }
        }
    }


    public function getRateableItem()
    {

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


    public function getRateableItemWithRefinements($data = [])
    {
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


    public function getCategories($refinementData = [])
    {

        // $categories = [];

        // Find
        $categories = $this->hasMany2('Category');

        foreach ($categories as $category) {
            $category->doRefinements($refinementData);
        }


        //
        return $categories;
    }


    public static function getUserVideos($data = [])
    {
        $session = Session::getInstance();

        $qData = [
            'disregardUsingPkIdForQuery' => true,
            'user_id' => $session->actual_user_id,
            'limit' => 20,
            'is_deleted' => 0,
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

