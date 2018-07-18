<?php

namespace App\Core\Main2;

trait CNModelExtraTrait
{
    public static function doesCnRecordExist($data = [])
    {
        $tableName = isset($data['tableName']) ? $data['tableName'] : static::$table_name;

        $fields = $data['fields'];

        $whereClause = "";
        $count = 0;

        foreach ($fields as $field => $value) {
            if ($count === 0) {
                $whereClause .= "WHERE {$field} = '{$value}'";
                $count = 1;
            } else {
                $whereClause .= " AND {$field} = '{$value}'";
            }
        }

        $q = "SELECT * FROM {$tableName}";
        $q .= " " . $whereClause;
        $q .= " LIMIT 1";

        $resultSet = self::execute_by_query($q);

        //
        $db = MySQLDatabase::getInstance();
        return ($db->get_num_rows_of_result_set($resultSet) == 1) ? true : false;

    }
}
