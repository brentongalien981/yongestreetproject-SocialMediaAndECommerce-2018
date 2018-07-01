<?php

namespace App\Controller;


use App\Model\User;
use App\Model\MyStoreItem;

class Search {

    private $num_of_suggestions = 0;
    private static $table_names = array("Users", "MyStoreItems");
    private static $class_names = array("User", "MyStoreItem");
    private $suggested_objs_array = array();
    public $the_query = array();

    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);
//        $this->set_suggested_objs_array($search_value);
        // Reset the session search query every instantiation.
        $_SESSION['search_query'] = null;
    }

    public static function get_searchable_table_names() {
        return self::$table_names;
    }
    
    public static function get_searchable_class_names() {
        return self::$class_names;
    }    

    public function set_suggested_objs_array($search_value) {
        $query = null;

        foreach (self::$table_names as $index_of_current_table => $table) {
            // Query
            $query = "SELECT * FROM {$table}";

            if ($table == "MyStoreItems") {
                $query .= " INNER JOIN Users ON MyStoreItems.user_id = Users.user_id";
            }
            
            $current_class = self::$class_names[$index_of_current_table];

            foreach ($current_class::$searchable_fields as $current_searchable_table_field_key => $current_searchable_table_field) {
                if ($current_searchable_table_field_key == 0) {
                    $query .= " WHERE";
                } else {
                    $query .= " OR";
                }

                $query .= " " . $current_searchable_table_field . " LIKE '%{$search_value}%'";
            }
            $query .= " LIMIT 4";


            
            

            $class_objs_array = self::get_an_array_of_objs($table, $index_of_current_table, $query, $this->num_of_suggestions);


            // TODO:LOG
            $this->the_query[$index_of_current_table] = $query;
            $this->set_session_search_query($table, $query);

            // Put object in the array
            // Set the array.
            // Basically, VAR: suggested_objs_array has arrays ( Users objects array, Product objects array, ...).
            //      Now, Users objects array, is an array of User objects.. And so too for Products, ...
            if ($class_objs_array != null) {
                $this->suggested_objs_array[$table . "_objs_array"] = $class_objs_array;
            }
        }
    }

    public static function get_an_array_of_objs($table, $index_of_current_table, $query, &$num_of_suggestions) {
        $class_objs_array = null;
        $class_of_current_table = self::$class_names[$index_of_current_table];

        if ($table == "MyStoreItems") {
            $result_set = $class_of_current_table::read_by_query($query);


            global $database;


            $num_of_results = $database->get_num_rows_of_result_set($result_set);
            if ($num_of_results > 0) {
                $class_objs_array = array();

                //
                $num_of_suggestions += $num_of_results;
            }

            while ($row = $database->fetch_array($result_set)) {
                $MyStoreItems_pseudo_obj = array("id" => $row['id'],
                    "name" => $row['name'],
                    "description" => $row['description'],
                    "user_id" => $row['user_id'],
                    "user_name" => $row['user_name'],);

                array_push($class_objs_array, $MyStoreItems_pseudo_obj);
            }
        } else {
            // Instantiate the object
            $class_objs_array = $class_of_current_table::read_by_query_and_instantiate($query);

            //
            $num_of_suggestions += count($class_objs_array);
        }


        //
        return $class_objs_array;
    }

    private function set_session_search_query($table, $query) {
        $_SESSION['search_query'][$table] = $query;
    }

    public static function get_session_search_query() {
        return $_SESSION['search_query'];
    }

    public function get_suggested_objs_array() {
        return $this->suggested_objs_array;
    }

    public function set_num_of_suggestions($num_of_suggestions) {
        $this->num_of_suggestions = $num_of_suggestions;
    }

    public function get_num_of_suggestions() {
        return $this->num_of_suggestions;
    }

}

?>
