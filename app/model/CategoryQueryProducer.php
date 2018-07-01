<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-26
 * Time: 20:21
 */

namespace App\Model;


class CategoryQueryProducer
{
    public static function getReadQuery($dataForProducingReadQuery) {

        // 1) Sanity check.
        if (self::handleInvalidQueryDataRequest($dataForProducingReadQuery)) {
            return self::getDefaultReadQuery();
        }


        // 2) Prepare the query parameters.
        $earliestElDate = $dataForProducingReadQuery['earliest_el_date'];
        $limit = $dataForProducingReadQuery['limit'];
        $stringifiedIdsOfAlreadyBeenReadCategories = $dataForProducingReadQuery['stringifiedIdsOfAlreadyBeenReadCategories'];
        self::removeTrailingComma($stringifiedIdsOfAlreadyBeenReadCategories);


        // 3) Set the query.
        $q = "SELECT * FROM Categories";
        $q .= " WHERE created_at <= '{$earliestElDate}'";

        if ($stringifiedIdsOfAlreadyBeenReadCategories !== '') {
            $q .= " AND id NOT IN({$stringifiedIdsOfAlreadyBeenReadCategories})";
        }

        $q .= " ORDER BY name DESC";
        $q .= " LIMIT {$limit}";


        // 4) Return the query.
        return $q;

    }


    public static function removeTrailingComma(&$str) {

        //
        $modifiedStr = $str;

        //
        $lastCharOfStr = substr($str,strlen($str) - 1);
        if ($lastCharOfStr === ',') {
            $modifiedStr = substr($str,0,strlen($str) - 1);
        }

        //
        $str = $modifiedStr;
    }


    public static function handleInvalidQueryDataRequest($data) {

        if (!isset($data['earliest_el_date']) ||
            !isset($data['stringifiedIdsOfAlreadyBeenReadCategories']) ||
            !isset($data['limit']))
        {
            return true;
        }
    }


    public static function getDefaultReadQuery() {
        return "SELECT * FROM Categories LIMIT 0";
    }
}