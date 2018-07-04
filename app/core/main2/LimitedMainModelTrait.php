<?php

namespace App\Core\Main2;

trait LimitedMainModelTrait
{
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


    /**
     * NOTE: Override this method if the PK field is not named "id". For ex. "user_id", "store_id"...
     * @return bool
     */
    public function create()
    {
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection

        $attributes = $this->get_sanitized_attributes();


        $query = "INSERT INTO " . static::$table_name . " (";
        $query .= join(", ", array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";

        //
        $query = MainModel::update_query_with_current_time_stamp($query);
        $query = MainModel::updateQueryWithNullValues($query);


        // echo "$query";
        $query_result = self::executeByQuery($query);

        if ($query_result) {
            // $database = \App\Core\Main2\MySQLDatabase::getInstance();
            // $this->{$this->primary_key_id_name} = $database->get_last_inserted_id();
            return true;
        } else {
            return false;
        }
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


    protected function get_sanitized_attributes()
    {
        $database = \App\Core\Main2\MySQLDatabase::getInstance();
        $sanitized_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->get_attributes() as $key => $value) {
            $sanitized_attributes[$key] = $database->escape_value($value);
        }
        return $sanitized_attributes;
    }



    public function has_attribute($attribute)
    {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->get_attributes());
    }
}
