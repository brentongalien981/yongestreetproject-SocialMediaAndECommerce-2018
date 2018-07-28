<?php

namespace App\Core\Main2;

trait CNModelSafeCrudOperationsTrait
{
    public static function uniqueReadMany($data = ['uniqueFieldName' => null, 'uniqueFieldValues' => null])
    {
        $objs = [];

        if (!isset($data['uniqueFieldName']) ||
            !isset($data['uniqueFieldValues'])) {
            return $objs;
        }


        $uniqueFieldName = $data['uniqueFieldName'];
        $uniqueFieldValues = $data['uniqueFieldValues'];

        if (is_string($uniqueFieldValues)) {
            $uniqueFieldValues = explode(',', $uniqueFieldValues);

        }

        for ($i=0; $i < count($uniqueFieldValues); $i++) {
            $tempObjs = static::readByWhereClause([
                $uniqueFieldName => $uniqueFieldValues[$i],
                'disregardUsingPkIdForQuery' => true
            ]);

            if (isset($tempObjs[0]) && is_array($tempObjs)) {
                $objs[] = $tempObjs[0];
            }
            
        }

        // You may have read repeated objs so sort out
        // the repeated ones.
        $uniqueObjIds = [];
        foreach ($objs as $i => $obj) {
            if (!in_array($obj->id, $uniqueObjIds)) {
                $uniqueObjIds[] = $obj->id;
            }
        }

        $tempObjs = [];
        foreach ($uniqueObjIds as $i => $uniqueId) {
            foreach ($objs as $j => $obj) {
                if ($obj->id == $uniqueId) {
                    $tempObjs[] = $obj;
                    break;
                }
            }
        }

        $objs = $tempObjs;

        return $objs;
    }


    /**
     * Note: The obj that calls this must have defined its
     * property: $pkNames.
     *
     * @return bool
     */
    public function cnDeleteByPk()
    {
        $whereClause = "";

        $count = 0;
        foreach ($this->pkNames as $pkName) {
            $pkValue = Sanitizer::sqlSanitizeStr($this->$pkName);

            if ($count == 0) {
                $whereClause .= "WHERE {$pkName} = '{$pkValue}'";
            } else {
                $whereClause .= " AND {$pkName} = '{$pkValue}'";
            }

            ++$count;
        }

        $q = "DELETE FROM " . static::$table_name;
        $q .= " " . $whereClause;
        $q .= " LIMIT 1";

        self::execute_by_query($q);
        $isDeletionOk = ($this->database->get_num_of_affected_rows() == 1) ? true : false;


        return $isDeletionOk;
    }
}
