<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-19
 * Time: 13:40
 */

namespace App\Model;

use App\Core\MainModel;


class RateableItem extends MainModel
{

    // CONSTANTS
    const ITEM_X_TYPE_ID_TIMELINE_POST = 1;
    const ITEM_X_TYPE_ID_VIDEO = 2;

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

    public function getTags() {

        $tags = [];

        // Find
        $tags = $this->hasMany2("Tag");

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

    public function getShit() {
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

}