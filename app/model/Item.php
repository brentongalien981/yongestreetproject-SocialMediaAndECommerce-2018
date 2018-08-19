<?php

namespace App\Model;

use App\Core\Main\MainModel;
use App\Model\RateableItem;

class Item extends MainModel
{
    protected static $table_name = "Items";
    protected static $className = "Item";

    protected static $db_fields = array(
        "id",
        "user_id",
        "name",
        "description",
        "quantity",
        "price",

        "length",
        "width",
        "height",
        "weight",
        "is_deleted",
        "created_at",
        "updated_at"
    );

    public $id;
    public $user_id;
    public $name;
    public $description;
    public $quantity;
    public $price;
    public $length;
    public $width;
    public $height;
    public $weight;
    public $is_deleted;
    public $created_at;
    public $updated_at;



    public static function getUserItems($data = [])
    {
        $session = Session::getInstance();

        // 1) Set the query data.
        $qData = [
            'disregardUsingPkIdForQuery' => true,
            'user_id' => $session->actual_user_id,
            'limit' => 10,
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

        // 2)
        $userItems = static::readByWhereClause($qData);


        // 3) Refine the objs read.
        foreach ($userItems as $item) {

            // a) Read the corresponding RateableItem obj for the item.
            $rateableItem = RateableItem::readByWhereClause([
                'item_x_id' => $item->id,
                'item_x_type_id' => RateableItem::ITEM_X_TYPE_ID_ITEM
            ])[0];
            
            // b) Read the ItemTag objs for this item.
            $tags = $rateableItem->getTags();


            // c) Read the ImageLink objs for this item.
            $imageLinks = $item->cnHasMany([
                'extentionalClassName' => 'ImageLink',
                'limit' => 5
            ]);


            // d) Refine
            $item->doRefinements(['excludedProps' => []]);

            //
            foreach ($imageLinks as $imageLink) {
                $imageLink->doRefinements(['excludedProps' => []]);
            }
            


            /* Add a carbon-date field to the obj. */
            $rawDateTimeFieldName = "created_at";
            $item->addReadableDateField($rawDateTimeFieldName);

            $item->replaceFieldNamesForAjax(['human_date' => 'created_at_human_date']);

            /* Add a carbon-date field to the obj. */
            $rawDateTimeFieldName = "updated_at";
            $item->addReadableDateField($rawDateTimeFieldName);

            $item->replaceFieldNamesForAjax(['human_date' => 'updated_at_human_date']);


            // e) Combine
            $item->imageLinks = $imageLinks;
            $item->tags = $tags;
        }

        return $userItems;
    }
}
