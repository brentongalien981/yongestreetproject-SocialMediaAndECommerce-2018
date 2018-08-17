<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-19
 * Time: 13:40
 */

namespace App\Model;

use App\Core\Main\MainModel;
use App\Model\Tag;

class RateableItem extends MainModel
{

    // CONSTANTS
    const ITEM_X_TYPE_ID_TIMELINE_POST = 1;
    const ITEM_X_TYPE_ID_VIDEO = 2;
    const ITEM_X_TYPE_ID_ITEM = 3;

    protected static $db_fields = array(
        "id",
        "item_x_id",
        "item_x_type_id"
    );
    protected static $table_name = "RateableItems";
    protected static $className = "RateableItem";

    public $id;
    public $item_x_id;
    public $item_x_type_id;


    /** @override */
    public function init()
    {


//        $this->primary_key_id_name = "user_id";
    }

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @override
     */
    public function create()
    {
        if ($this->doesRecordExist()) {
            return true;
        }

        $isCrudOk = parent::create();
        return $isCrudOk;
    }

    public function getXRateableItem($data = ['doSimplifyReturndedObj' => true])
    {

        //
        $modelPath = "\\App\\Model\\";

        //
        switch ($this->item_x_type_id) {
            case self::ITEM_X_TYPE_ID_TIMELINE_POST:
                $modelPath .= 'TimelinePost';
                break;
            case self::ITEM_X_TYPE_ID_VIDEO:
                $modelPath .= 'Video';
                break;
            default:
                return null;
        }


        //
        $data['id'] = $this->item_x_id;

        // Find
        $xRateableItem = $modelPath::readById($data)[0];


        if ($data['doSimplifyReturndedObj']) {
            // Filter
            $xRateableItem->filterInclude($this->getFieldsToBeIncludedForJson());


            // Refine
            $xRateableItem->replaceFieldNamesForAjax($this->getFieldNamesAndReplacementsKeyValuePairsForJson());
        }

        //
        return $xRateableItem;
    }

    public function getTags()
    {
        $tags = [];

        // Find
        $tags = $this->hasMany2("Tag", ['limit' => 32]);

        foreach ($tags as $tag) {

            // Find

            // Filter
            $tag->filterExclude();

            // Refine

            // Combine
        }


        //
        return $tags;
    }

    public function getShit()
    {
        return 'shit';
    }

    private function getFieldNamesAndReplacementsKeyValuePairsForJson()
    {
        switch ($this->item_x_type_id) {
            case self::ITEM_X_TYPE_ID_TIMELINE_POST:
                return ['id' => 'post_id'];
                break;

            case self::ITEM_X_TYPE_ID_VIDEO:
                return [
                    'id' => 'video_id',
                    'title' => 'video_title'
                ];
                break;
            default:
                return null;
        }
    }

    private function getFieldsToBeIncludedForJson()
    {
        //
        switch ($this->item_x_type_id) {
            case self::ITEM_X_TYPE_ID_TIMELINE_POST:
                return ['id', 'message'];
                break;

            case self::ITEM_X_TYPE_ID_VIDEO:
                return ['id', 'title'];
                break;
            default:
                return null;
        }
    }

    public function doesRecordExist()
    {
        $data['where_clause'] = "WHERE item_x_id = {$this->item_x_id}";
        $data['where_clause'] .= " AND item_x_type_id = {$this->item_x_type_id}";


        $objs = $this->read_by_where_clause($data);
        return (count($objs) > 0) ? true : false;
    }


    public function createRateableItemsTags($data = [])
    {
        if (!isset($data['tags']) || $data['tags'] == "") {
            return;
        }

        $stringifiedTags = $data['tags'];

        // Unique-save all the tags in the db.
        $isSavingOk = Tag::trySave(['withData' => $stringifiedTags]);


        // Now all the intended tags for the video is
        // saved. Loop through all the stringified tags and
        // read the corresponding tag-obj for that tag.
        $tags = explode(',', $stringifiedTags);
        $tagObjs = [];

        for ($i=0; $i < count($tags); $i++) {
            $tagName = $tags[$i];
            $tagObjs[] = Tag::readByWhereClause(['tag' => $tagName])[0];
        }


        // You may have read repeated tag-objs so sort out
        // the repeated ones.
        $uniqueTagObjIds = [];
        foreach ($tagObjs as $i => $tagObj) {
            if (!in_array($tagObj->id, $uniqueTagObjIds)) {
                $uniqueTagObjIds[] = $tagObj->id;
            }
        }

        $tempTagObjs = [];
        foreach ($uniqueTagObjIds as $i => $uniqueId) {
            foreach ($tagObjs as $j => $tagObj) {
                if ($tagObj->id == $uniqueId) {
                    $tempTagObjs[] = $tagObj;
                    break;
                }
            }
        }

        $tagObjs = $tempTagObjs;




        // Create the mapping-model (pivot-table...).
        $this->saveManyRelationships([
            'withClassName' => 'Tag',
            'withObjs' => $tagObjs
        ]);
    }
}
