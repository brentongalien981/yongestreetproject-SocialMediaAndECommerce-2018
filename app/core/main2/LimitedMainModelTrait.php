<?php

namespace App\Core\Main2;

trait LimitedMainModelTrait {


    public static function instantiate($record)
    {
        
        // $classModel = "\\App\\Model\\" . static::$className;
        $classModel = "\\" . get_called_class();
        

        $object = new $classModel;

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }


    public static function executeByQuery($query = "")
    {
        $database = \App\Core\Main2\MySQLDatabase::getInstance();

        $resultSet = $database->get_result_from_query($query);

        return $resultSet;
    }


    protected function get_attributes()
    {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }



    public function has_attribute($attribute)
    {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->get_attributes());
    }
}