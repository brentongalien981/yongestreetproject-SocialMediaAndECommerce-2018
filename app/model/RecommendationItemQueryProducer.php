<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-06
 * Time: 19:03
 */

namespace App\Model;


class RecommendationItemQueryProducer
{
    public static function getQuery($data) {

        // If the data passed-in is invalid,
        // then just give a default query.
        if (self::handleInvalidQueryDataRequest($data)) {
            return "SELECT * FROM RateableItemsTags LIMIT 0";
        }

        $itemXTypeId = $data['itemXTypeId'];
        $referenceVideoId = $data['referenceVideoId'];
        $stringifiedReferenceTags = "";
        $stringifiedVideoIdsOfAlreadyRecommendedItems = $data['stringifiedVideoIdsOfAlreadyRecommendedItems'];

        //
        $stringifiedExemptedVideoIds = $referenceVideoId . "," . $stringifiedVideoIdsOfAlreadyRecommendedItems;

        // Remove the trailing comma.
        $lastCharOfStringifiedExemptedVideoIds = substr($stringifiedExemptedVideoIds,strlen($stringifiedExemptedVideoIds) - 1);
        if ($lastCharOfStringifiedExemptedVideoIds === ',') {
            $stringifiedExemptedVideoIds = substr($stringifiedExemptedVideoIds,0,strlen($stringifiedExemptedVideoIds) - 1);
        }



        foreach ($data['tags'] as $tag) {
            $stringifiedReferenceTags .= $tag->id . ",";
        }

//        // Remove the last comma.
//        $stringifiedReferenceTags = substr($stringifiedReferenceTags, 0, strlen($stringifiedReferenceTags) - 1);

        // Remove the trailing comma.
        $lastCharOfStringifiedReferenceTags = substr($stringifiedReferenceTags,strlen($stringifiedReferenceTags) - 1);
        if ($lastCharOfStringifiedReferenceTags === ',') {
            $stringifiedReferenceTags = substr($stringifiedReferenceTags,0,strlen($stringifiedReferenceTags) - 1);
        }


        //
        $query = "SELECT rateable_item_id, count(*) AS 'count', v.id AS 'video_id', ri.item_x_type_id, v.title";
        $query .= " FROM RateableItemsTags rit";
        $query .= " INNER JOIN RateableItems ri ON rit.rateable_item_id = ri.id";
        $query .= " INNER JOIN Videos v ON ri.item_x_id = v.id";

        //
        if ($stringifiedReferenceTags !== "") {

            $query .= " WHERE tag_id IN (";
            $query .= $stringifiedReferenceTags;
            $query .= ")";

            $query .= " AND v.id NOT IN ({$stringifiedExemptedVideoIds})";
        }
        else {
            $query .= " WHERE v.id NOT IN ({$stringifiedExemptedVideoIds})";
        }


        $query .= " AND item_x_type_id = {$itemXTypeId}";

        $query .= " GROUP BY rateable_item_id";
        $query .= " ORDER BY count DESC";
        $query .= " LIMIT 4";

        return $query;
    }


    public static function handleInvalidQueryDataRequest($data) {

        if (!isset($data['referenceVideoId']) ||
            !isset($data['itemXTypeId']) ||
            !isset($data['tags']))
        {
            return true;
        }
    }
}