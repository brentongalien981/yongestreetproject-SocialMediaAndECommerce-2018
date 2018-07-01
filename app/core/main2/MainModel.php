<?php
/**
 * TODO: NOTE: There's a problem when updating using the transaction and
 * when you're in debug mode. Because of this limitation, I Just do the
 * update with simple codes...
 */

namespace App\Core\Main2;

use \App\Core\Main2\CNMain;
use App\Model\User;


class MainModel extends CNMain
{

    // TODO: Don't forget to add this on implementation.
    public const CURRENT_TIMESTAMP = "CURRENT_TIMESTAMP";

    protected static $db_fields = array();
    protected static $table_name = "DEFAULT_TABLE_NAME";
    protected static $className = "DEFAULT_CLASS_NAME";
    

    // Override this only if the pk-field is not named "id". Ex. "user_id", "product_id", etc...
    protected $pk = [];

    public static $searchable_fields = array();
    public $primary_key_id_name = "id";
    protected static $primaryKeyName = "id";

    protected static function instantiate($record)
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

    public static function read_by_query($query = "")
    {
        return self::execute_by_query($query);
    }

    public static function execute_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }

    public static function getPascalCasedNameOf($str)
    {

        $pascalCasedStr = "";

        $pascalCasedStr .= strtolower($str[0]);

        for ($i = 1; $i < strlen($str); $i++) {

            $currentChar = $str[$i];

            if (ctype_upper($currentChar)) {
                $pascalCasedStr .= "_";

            }

            $pascalCasedStr .= strtolower($currentChar);

        }

        return $pascalCasedStr;
    }


    public function init()
    {
        // TODO: Override this.
    }

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }


    /**
     * Dynamically create public properties/attributes/variable for the child class
     * extending this MainModel class.
     * @deprecated
     */
    private function create_properties()
    {
        foreach (static::$db_fields as $property) {
            $this->{$property} = null;
        }

        $this->create_primary_key_id_name();
    }

    /**
     * Basically create this so that for ex:
     *      aClassObj->id = $this->database->get_last_inserted_id()
     *      aClassObj->user_id = $this->database->get_last_inserted_id()
     *      aClassObj->product_id = $this->database->get_last_inserted_id()
     *
     * will be user for aClassObj->create(), aClassObj->update(), etc...
     * @deprecated
     */
    private function create_primary_key_id_name()
    {
        $this->{$this->primary_key_id_name} = null;
    }

    protected function has_attribute($attribute)
    {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->get_attributes());
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
        $sanitized_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->get_attributes() as $key => $value) {
            $sanitized_attributes[$key] = $this->database->escape_value($value);
        }
        return $sanitized_attributes;
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
        $query = self::update_query_with_current_time_stamp($query);

        $query_result = self::execute_by_query($query);

        if ($query_result) {
            $this->{$this->primary_key_id_name} = $this->database->get_last_inserted_id();
            return true;
        } else {
            return false;
        }
    }

    public function updateByWhereClause($whereClause)
    {

        $dataForUpdate = ['whereClause' => $whereClause];
        return $this->update($dataForUpdate);
    }

    public static function createWhereClause($data)
    {
        //ish
        //
        $count = 0;

        foreach ($data as $field => $value) {

            //
            if ($field == "limit" ||
                $field == "tableName" ||
                $field == "orderBy") {
                continue;
            }


            //
            if ($count != 0) {
                $data['whereClause'] .= " AND {$field} = '{$value}'";
            } else {
                $data['whereClause'] = "WHERE {$field} = '{$value}'";
            }


            //
            ++$count;
        }

        //
        return $data['whereClause'];
    }

    public function update($data = null)
    {
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->get_sanitized_attributes();
        $attribute_pairs = array();

        foreach ($attributes as $key => $value) {
            // Don't include the password for the update or
            // if the value is null.
            if ($key == "hashed_password" || $value == null) {
                continue;
            }

            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table_name . " SET ";
        $query .= join(", ", $attribute_pairs);


        // Append the whereClause to the query.
        if ($data != null && $data['whereClause'] != null) {
            $query .= " " . $data['whereClause'];
        } else {
            $query .= " WHERE {$this->primary_key_id_name} =" . $this->database->escape_value($this->{$this->primary_key_id_name});
        }


        //
        $query = self::update_query_with_current_time_stamp($query);

        //
        $result_set = self::execute_by_query($query);

        if (!$result_set) {
            return false;
        }

        //
        return ($this->database->get_num_of_affected_rows() == 1) ? true : false;

    }


    /**
     * Replace the word "CURRENT_TIMESTAMP" in the $query string by "NOW()".
     * @param $query
     * @return updated query
     */
    protected static function update_query_with_current_time_stamp($query)
    {
        $newQuery = str_replace("'CURRENT_TIMESTAMP'", "NOW()", $query);
        $newQuery = str_replace("'0000-00-00 00:00:00'", "NOW()", $newQuery);
        return $newQuery;
    }

    public function fetch($data)
    {
        return $this->read($data);
    }


    /**
     * @deprecated
     * @param $data
     * @return array
     */
    public function read_by_where_clause($data)
    {
        return $this->read($data);
    }

    public static function readById($data)
    {

        return static::readStatic($data);
    }


    public
    function read_by_id($data)
    {
//        $data['pk_name'] = $this->primary_key_id_name;
        return $this->read($data);
    }

    /**
     * Delete by Primary Key
     */
    public
    function deleteByPk()
    {

        $pkName = $this->primary_key_id_name;
        $pk = $this->$pkName;

        $query = "DELETE FROM " . static::$table_name;
        $query .= " WHERE {$pkName} = " . $this->database->escape_value($pk);
        $query .= " LIMIT 1";


        self::execute_by_query($query);
        $isDeletionOk = ($this->database->get_num_of_affected_rows() == 1) ? true : false;


        return $isDeletionOk;
    }


    /**
     *
     */
    public static function readByRawQuery($q = null, $instantiateObs = false)
    {

        $records = [];

        if ($q == null) {
            return $records;
        }


        //
        $q = self::update_query_with_current_time_stamp($q);

        //
        $resultSet = self::execute_by_query($q);

        //
        global $database;
        while ($row = $database->fetch_array($resultSet)) {

            if ($instantiateObs) {
                $records[] = static::instantiate($row);
            } else {
                $records[] = static::staticCreatePseudoObj($row);
            }

        }

        //
        return $records;

    }


    /**
     * @param null $data
     * @return array
     */
    public static function readByWhereClause($data = null)
    {

        //
        $count = 0;

        foreach ($data as $field => $value) {

            // Skip the fields that won't be in the where clause.
            if ($field == "limit" ||
                $field == "tableName" ||
                $field == "orderBy" ||
                $field == "orderByFields" ||
                $field == "orderArrangement" ||
                $field == "includedPivotFields" ||
                $field == "doNotInstantiate" ||
                $field == "disregardUsingPkIdForQuery") {
                continue;
            }


            // Set the comparison operator to each fields in the
            // where clause such as '=' or '<', '<=', etc...
            $comparisonOperator = '=';
            if (isset($value['comparisonOperator'])) {
                $comparisonOperator = $value['comparisonOperator'];
                $value = $value['value'];
            }

            if ($count == 0) {

                if (isset($field) &&
                    isset($comparisonOperator) &&
                    isset($value)) {

                    $data['whereClause'] = "";

                    //
                    if ($comparisonOperator === 'NOT IN') {
                        $data['whereClause'] .= "WHERE {$field} NOT IN(" . "{$value})";


                    } else {
                        $data['whereClause'] .= "WHERE {$field}" . " {$comparisonOperator}" . " '{$value}'";
                    }
                }

            } else {

                //
                if (isset($field) &&
                    isset($comparisonOperator) &&
                    isset($value)) {

                    //
                    if ($comparisonOperator === 'NOT IN') {
                        $data['whereClause'] .= " AND {$field} NOT IN(" . "{$value})";


                    } else {
                        $data['whereClause'] .= " AND {$field}" . " {$comparisonOperator}" . " '{$value}'";
                    }
                }
            }


            //
            ++$count;
        }


        //
        return static::readStatic($data);
    }

    /** TODO: Change this func name later when you completely got rid of func read(). */
    public static function readStatic($data = null)
    {

        $id = null;
        $pkName = null;
        $tableName = (isset($data['tableName']) ? $data['tableName'] : static::$table_name);

        $id = (isset($data['id']) ? $data['id'] : null);
        if (isset($data['disregardUsingPkIdForQuery']) && $data['disregardUsingPkIdForQuery']) {
            $id = null;
        }

        $pkName = static::$primaryKeyName;

        $whereClause = (isset($data['whereClause']) ? $data['whereClause'] : null);
        $groupByClause = (isset($data['groupByClause']) ? $data['groupByClause'] : null);
        $fields = (isset($data['fields']) ? $data['fields'] : '*');
        $limit = (isset($data['limit']) ? $data['limit'] : 4);
        $orderByFields = (isset($data['orderByFields']) ? $data['orderByFields'] : null);
        $orderArrangement = (isset($data['orderArrangement']) ? $data['orderArrangement'] : 'DESC');

        $doNotInstantiate = (isset($data['doNotInstantiate']) ? $data['doNotInstantiate'] : false);


        //
        $q = "SELECT {$fields} FROM " . $tableName;


        // Additional query with id.
        if (isset($id)) {
            $q .= " WHERE {$pkName} = {$id}";
        }


        // Additional query with where clause.
        if (isset($whereClause)) {
            $q .= " " . $whereClause;
        }

        // group-by-clause.
        if (isset($groupByClause)) {
            $q .= " " . $groupByClause;
        }

        // // Additional query "ORDER BY {$field} {ASC}.
        if (isset($orderByFields)) {
            $q .= " ORDER BY {$orderByFields} {$orderArrangement}";
        }

        $q .= " LIMIT {$limit}";


        //
        $q = self::update_query_with_current_time_stamp($q);

        //
        $resultSet = self::execute_by_query($q);


        //
        $objs = [];

        global $database;
        while ($row = $database->fetch_array($resultSet)) {

            $obj = null;


            if ($doNotInstantiate) {
                $obj = static::staticCreatePseudoObj($row);
            } else {
                $obj = static::instantiate($row);
            }

        
            // TODO: What do you think, is this necessary?
            // $obj->removeStaticFields();

            //
            array_push($objs, $obj);
        }

        return $objs;
    }

    public
    function show($data)
    {
        $data['limit'] = 1;
        return $this->read($data);
    }

    public
    function read($data = null)
    {
//        //
//        $this->init();

        $id = null;
        $pk_name = null;
        $id = (isset($data['id']) ? $data['id'] : null);
        $pk_name = $this->primary_key_id_name;

        $where_clause = (isset($data['where_clause']) ? $data['where_clause'] : null);
        $groupByClause = (isset($data['groupByClause']) ? $data['groupByClause'] : null);
        $fields = (isset($data['fields']) ? $data['fields'] : '*');
        $limit = (isset($data['limit']) ? $data['limit'] : 4);
        $order_by_field = (isset($data['order_by_field']) ? $data['order_by_field'] : null);
        $order_arrangement = (isset($data['order_arrangement']) ? $data['order_arrangement'] : 'DESC');

        //
        $doNotInstantiate = (isset($data['doNotInstantiate']) ? $data['doNotInstantiate'] : null);

        //
        $q = "SELECT {$fields} FROM " . static::$table_name;


        // Additional query with id.
        if (isset($id)) {
            $q .= " WHERE {$pk_name} = {$id}";
        }

        // Additional query with where clause.
        if (isset($where_clause)) {
            $q .= " " . $where_clause;
        }

        // group-by-clause.
        if (isset($groupByClause)) {
            $q .= " " . $groupByClause;
        }

        // // Additional query "ORDER BY {$field} {ASC}.
        if (isset($order_by_field)) {
            $q .= " ORDER BY {$order_by_field} {$order_arrangement}";
        }

        $q .= " LIMIT {$limit}";


        //
        $q = $this->update_query_with_current_time_stamp($q);


        //
        $result_set = self::execute_by_query($q);


        $array_of_objs = array();

        while ($row = $this->database->fetch_array($result_set)) {

            $an_obj = null;

            if (isset($doNotInstantiate)) {
                $an_obj = $this->createPseudoObj($data, $row);
            } else {
                $an_obj = static::instantiate($row);
            }

//            // Convert obj to an array.
//            $objInArrayForm = get_object_vars($an_obj);

            //
            array_push($array_of_objs, $an_obj);
        }

        return $array_of_objs;
    }


    /**
     * If the attributes to be returned to the ajax / normal request are
     * combinations of real obj attributes, then use this method instead
     * of the normal instantiate() method.
     * @param $data
     * @param $record
     * @return array|null
     */
    public function createPseudoObj($data, $record)
    {
        $obj = null;

        return $obj;
    }


    public static function staticCreatePseudoObj($record)
    {
        $pseudoObj = [];

        /*
         * Because records from querying the db returns records like this:
         *      $record = [
         *          0 => 'value1',
         *
         *          'field1' => 'value1',
         *
         *          1 => 'value2',
         *
         *          'field2' => 'value2'
         *      ]
         * ...you wanna eliminate the fields with numeric indexes.
         */
        foreach ($record as $field => $value) {
            if (!is_numeric($field)) {
                $pseudoObj[$field] = $value;
            }
        }

        return $pseudoObj;
    }


    public static function delete($data)
    {
        global $database;

        $q = "DELETE FROM " . static::$table_name;
        $q .= " WHERE id = " . $database->escape_value($data['id']);
        $q .= " LIMIT 1";


//        $this->database->get_result_from_query($q);
        self::execute_by_query($q);


        return ($database->get_num_of_affected_rows() == 1) ? true : false;
    }

    /**
     * Modify the instantiated obj by appending properties
     * from the producer obj.
     */
    public
    function isProducedBy($producerType)
    {
        $producerTypeClass = "\\App\\Model\\" . $producerType;
//        $producerObj = new $producerTypeClass;

        $producerId = $this->poster_user_id;
        $data['id'] = $producerId;
        $userObj = (new $producerTypeClass)->read_by_id($data)[0];

        $this->updateMeAsPseudoObj($userObj);
    }

    public
    function isCreatedBy($creatorType)
    {
        $creatorTypeClass = "\\App\\Model\\" . $creatorType;

        $notifierUserId = $this->notifier_user_id;
        $data['id'] = $notifierUserId;
        $userObj = (new $creatorTypeClass)->read_by_id($data)[0];

        $this->updateMeAsPseudoObj($userObj);
    }

    /**
     * Modify the instantiated obj by appending properties
     * from the extentional obj.
     */
    public
    function isComposedOf($extentionClassName)
    {
        $extentionalClass = "\\App\\Model\\" . $extentionClassName;

        //
        $parentObjId = null;
        $extentionalObj = null;

        switch ($extentionClassName) {
            case "NotificationRateableItem":
                //
                $parentObjId = $this->id;
                //
                $data['id'] = $parentObjId;
                //
                $extentionalObj = (new $extentionalClass())->read_by_id($data)[0];
                break;
            case "Rate":
                //
                $data['where_clause'] = "WHERE value = {$this->rate_value}";
                //
                $extentionalObj = (new $extentionalClass())->read_by_where_clause($data)[0];
                break;
        }


        //
        $this->updateMeAsPseudoObj($extentionalObj);
    }

    /**
     * Modify the instantiated obj by appending properties
     * from the extentional obj.
     */
    public
    function isConnectedTo($extentionClassName)
    {
        $extentionalClass = "\\App\\Model\\" . $extentionClassName;

        //
        $parentObjId = null;

        switch ($extentionClassName) {
            case "RateableItem":
                $parentObjId = $this->rateable_item_id;
                break;
            case "TimelinePost":
                $parentObjId = $this->item_x_id;
                break;
        }


        //
        $data['id'] = $parentObjId;
        //ish
        $extentionalObj = (new $extentionalClass())->read_by_id($data)[0];

        $this->updateMeAsPseudoObj($extentionalObj);
    }

    public
    function to_string()
    {
        $object_in_string = "";

        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                echo "{$field}: $this->$field<br>";
                $object_in_string .= "{$field}: $this->$field<br>";
            }
        }

        return $object_in_string;
    }


    /** @deprecateds */
    public
    function old_update()
    {
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->get_sanitized_attributes();
        $attribute_pairs = array();

        foreach ($attributes as $key => $value) {
            // Don't include the password for the update.
            if ($key == "hashed_password") {
                continue;
            }

            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . self::$table_name . " SET ";
        $query .= join(", ", $attribute_pairs);
        $query .= " WHERE user_id =" . $this->database->escape_value($this->user_id);//uki


        // Start transaction.
        if (!$this->database->start_transaction()) {
            return false;
        }

        $this->database->get_result_from_query($query);

        //
        $is_update_ok = ($this->database->get_num_of_affected_rows() == 1) ? true : false;


        //
        if ($is_update_ok) {
            //
            if (!$this->database->commit()) {
                return false;
            }

            //
            return true;
        } else {
            //
            $this->database->rollback();

            //
            return false;
        }

    }

    public
    static function old_read($data)
    {
        //uki now
        $query = self::get_query_for_read($data);


        //
        $result_set = self::read_by_query($query);

        //
        $array_of_users = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_user = array(
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "email" => $row['email'],
                "private" => $row['private'],
                "account_status_id" => $row['account_status_id'],
                "user_type_id" => $row['user_type_id']
            );


            //
            array_push($array_of_users, $a_user);
        }

        return $array_of_users;
    }

    /**
     * Modify the instantiated obj by appending properties
     * from the producer obj. Ex, this timelinePostObj has properties like
     *      $this->post_id
     *      $this->message ...
     * And the producerObj (a user) has properties
     *      $producerObj->user_name
     *      $producerObj->user_id ...
     * Now, combine these objs and produce a new updated pseudo obj. So the
     * original obj now has properties
     *      $this->user_name
     *      $this->user_id ...
     * @deprecated
     */
    private
    function updateMeAsPseudoObj($joiningObj)
    {
        foreach ($joiningObj as $key => $value) {

            // Don't overwrite the primary keys.
            if ($key == "id") {
                continue;
            }

            $this->$key = $value;
        }
    }

    /**
     * Modify the instantiated obj by appending properties
     * from the producer obj. Ex, this timelinePostObj has properties like
     *      $this->post_id
     *      $this->message ...
     * And the producerObj (a user) has properties
     *      $producerObj->user_name
     *      $producerObj->user_id ...
     * Now, combine these objs and produce a new updated pseudo obj. So the
     * original obj now has properties
     *      $this->user_name
     *      $this->user_id ...
     */
    public
    function combineWithObj($joiningObj)
    {
        foreach ($joiningObj as $key => $value) {
            $this->$key = $value;
        }
    }

    /** @deprecated */
    public
    function hasOne($producerType)
    {
        $producerTypeClass = "\\App\\Model\\" . $producerType;
//        $producerObj = new $producerTypeClass;

        $producerId = $this->poster_user_id;
        $data['id'] = $producerId;
        $profileObj = (new $producerTypeClass)->read_by_id($data)[0];

        $this->updateMeAsPseudoObj($profileObj);
    }

    /** TODO: Rename newHasOne(). */
    public
    function newHasOne($class, $fk)
    {


        $path = "\\App\\Model\\" . $class;
        $extentionalObj = new $path;

        $data = null;

        // If the sent argument $fk is an array, that means
        // we would like to read a table record using other key (probably a fk)
        // instead of reading by the pk id.
        if (is_array($fk)) {

            foreach ($fk as $field => $value) {
                $data['where_clause'] = "WHERE {$field} = {$value}";
                break;
            }

        } else {
            $data['id'] = $fk;
        }

        $data['limit'] = 1;

        $obj = $extentionalObj->read($data)[0];

        return $obj;
    }

    /** TODO: Change this name later from hasOne2() to hasOne(). */
    public
    function hasOne2($class)
    {

        //
        $path = "\\App\\Model\\" . $class;


        //
        $objs = $this->hasX($class, $path);

        //
        return $objs[0];
    }


    /**
     * This is called by methods hasOne2() and hasMany2().
     * @param $class
     * @param $path
     * @return mixed
     */
    private
    function hasX($class, $path, $data = null)
    {

        // Dynamically figure out the name of the field of the extentional
        // obj based on this obj's class name and then appending the string "_id".
        $fkName = self::getPascalCasedNameOf(static::$className) . "_id";
        $pkName = $this->primary_key_id_name;
        $pkValue = $this->$pkName;
        $data[$fkName] = $pkValue;


        // Then call the readByWhereClause() to get the extentional obs.
        static::reWritePathForAnomalies($path);
        $objs = $path::readByWhereClause($data);

        //
        return $objs;
    }


    public
    function belongsTo2($class)
    {

        //
        $path = "\\App\\Model\\" . $class;

        // Dynamically figure out the name of the field of the extentional
        // obj based on this obj's class name and then appending the string "_id".
        $fkName = static::getPascalCasedNameOf($class) . "_id";
        $fkValue = $this->$fkName;
        $data['id'] = $fkValue;


        // Then call the readByWhereClause() to get the extentional obs.
        $obj = $path::readById($data)[0];

        //
        return $obj;
    }

    private
    static function reWritePathForAnomalies(&$pivotPath)
    {
        if ($pivotPath == "\\App\\Model\\UserFriend") {
            $pivotPath = "\\App\\Model\\Friendship";
        }
//        else if ($pivotPath == "\\App\\Model\\Friend") { $pivotPath =  "\\App\\Model\\Friendship"; }
    }

    /** @deprecated */
    public
    function hasMany($class, $fk, $data = null)
    {


        $path = "\\App\\Model\\" . $class;
        $extentionalObj = new $path;


        // If the sent argument $fk is an array, that means
        // we would like to read a table record using other key (probably a fk)
        // instead of reading by the pk id.
        if (is_array($fk)) {

            foreach ($fk as $field => $value) {
                $data['where_clause'] = "WHERE {$field} = {$value}";
                break;
            }

        } else {
            $data['id'] = $fk;
        }


        $objs = $extentionalObj->read($data);

        return $objs;
    }

    /** TODO: Change this name later: hasMany2(). */
    public
    function hasMany2($class, $data = null)
    {

        // Dynamically figure out the name of the pivot table/class by
        // combining this class's name and the extentional obj's class name.
        $pivotPath = "\\App\\Model\\" . static::$className . $class;


        //
        $pivotObjs = $this->hasX($class, $pivotPath, $data);


        //
        $objs = [];

        // Loop through all the pivot objs. Each pivot obj belongsTo extentional obj.
        foreach ($pivotObjs as $pivotObj) {
            $obj = $pivotObj->belongsTo2($class);

            //
            $includedPivotFields = $data['includedPivotFields'];
            $this->joinPivotFieldsToObj($pivotObj, $includedPivotFields, $obj);


            array_push($objs, $obj);
        }


        // Return the extentional objs.
        return $objs;

    }

    private
    function joinPivotFieldsToObj($pivotObj, $includedPivotFields, &$obj)
    {

        // Join some pivot-table-fields to the extentional-obj.
        if (isset($includedPivotFields)) {

            foreach ($includedPivotFields as $pivotField) {

                $fieldName = $pivotField['fieldName'];
                $replacementFieldName = $pivotField['toBeNamed'];

                // Dynamically add the pivot-field value to the extentional-obj.
                $obj->$replacementFieldName = $pivotObj->$fieldName;
            }
        }
    }

    /** @deprecated */
    public
    function belongsTo($class, $pk)
    {

        return $this->newHasOne($class, $pk);
    }

    public
    static function filterFieldsForReturn(&$objs, $fieldsAllowedForReturn)
    {
        foreach ($objs as $obj) {

            foreach ($obj as $field => $value) {

                if (!in_array($field, $fieldsAllowedForReturn)) {
                    unset($obj->$field);
                }
            }

            // Also remove the static fields.
            if (isset($obj::$db_fields)) {
                $obj::$db_fields = null;
                $obj::$table_name = null;
                $obj::$className = null;
                $obj::$searchable_fields = null;
            }

        }
    }



    public function filterInclude($includedFields = [])
    {

        foreach ($this as $field => $value) {

            if (!in_array($field, $includedFields)) {
                unset($this->$field);
            }
        }

//        $this->removeStaticFields();
    }

    public function filterExclude($excludedFields = [])
    {

        // Other default excluded fields.
        array_push($excludedFields, 'primary_key_id_name');
        array_push($excludedFields, 'pk');
        array_push($excludedFields, 'session');
        array_push($excludedFields, 'database');

        foreach ($this as $field => $value) {

            if (in_array($field, $excludedFields)) {
                unset($this->$field);
            }
        }

//        $this->removeStaticFields();
    }

    public function removeStaticFields()
    {

        if (isset($this::$db_fields)) {
            $this::$db_fields = null;
            $this::$table_name = null;
            $this::$className = null;
            $this::$searchable_fields = null;
        }
    }

    public function removeStaticFields2()
    {

        if (isset(static::$db_fields)) {
            static::$db_fields = null;
            static::$table_name = null;
            static::$className = null;
            static::$searchable_fields = null;
        }
    }

    public function replaceFieldNamesForAjax($keyValuePairs)
    {

        foreach ($keyValuePairs as $oldFieldName => $newFieldName) {

            if (isset($this->$oldFieldName)) {

                $this->$newFieldName = $this->$oldFieldName;
                unset($this->$oldFieldName);
            }
        }
    }


}