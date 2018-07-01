<?php

namespace App\Core\Main2;

class MySQLDatabase extends Singleton
{
    protected static $instance = null;
    private $connection;

//    private $prepared_statement;

    protected function __construct()
    {
        parent::__construct();
        $this->open_connection();
    }


    /**
     * @return bool|mysqli_result
     */
    public function start_transaction()
    {
//        $query = "SET autocommit=0;";
        $query = "START TRANSACTION";

        $is_result_ok = true;


        try {
            MyDebugMessenger::add_debug_message("In FILE: my_database.php");
            MyDebugMessenger::add_debug_message("In METHOD: start_transaction()");
            MyDebugMessenger::add_debug_message("VAR:\$query: {$query}");
            $query_result = $this->get_result_from_query($query);
            MyDebugMessenger::add_debug_message("VAR:\$$query_result: {$query_result}");
        } catch (Exception $e) {
            $is_result_ok = false;

            MyDebugMessenger::add_debug_message("ERROR on FILE: my_database.php");
            MyDebugMessenger::add_debug_message("ERROR on METHOD: start_transaction()");
            MyDebugMessenger::add_debug_message("EXCEPTION: " + $e->getMessage());
        } finally {
            //
            MyDebugMessenger::add_debug_message("In CLAUSE: finally");
        }


        MyDebugMessenger::add_debug_message("VAR:\$is_result_ok: {$is_result_ok}");
        return $is_result_ok;
    }


    public function commit()
    {
        $query = "COMMIT";

        $is_result_ok = true;

        try {
            $this->get_result_from_query($query);
        } catch (Exception $e) {
            $is_result_ok = false;

            MyDebugMessenger::add_debug_message("ERROR on FILE: my_database.php");
            MyDebugMessenger::add_debug_message("ERROR on METHOD: commit()");
            MyDebugMessenger::add_debug_message("EXCEPTION: " + $e->getMessage());
        } finally {
            // TODO:DEBUG
            MyDebugMessenger::add_debug_message("In FILE: my_database.php");
            MyDebugMessenger::add_debug_message("In METHOD: commit()");
            //
            return $is_result_ok;
        }
    }



    public function rollback()
    {
        $query = "ROLLBACK";

        $is_result_ok = true;

        try {
            $this->get_result_from_query($query);
        } catch (Exception $e) {
            $is_result_ok = false;

            MyDebugMessenger::add_debug_message("ERROR on FILE: my_database.php");
            MyDebugMessenger::add_debug_message("ERROR on METHOD: rollback()");
            MyDebugMessenger::add_debug_message("EXCEPTION: " + $e->getMessage());
        }



        //
        return $is_result_ok;
    }





    public function open_connection()
    {
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            die("Database connection failed: " .
                    mysqli_connect_error() .
                    " (" . mysqli_connect_errno() . ")"
            );
        }
    }

    public function get_connection()
    {
        return $this->connection;
    }

    public function escape_value($string)
    {
        $escaped_string = mysqli_real_escape_string($this->connection, $string);
        return $escaped_string;
    }

    public function close_connection()
    {
        if (isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    private function confirm_query_result($query_result)
    {
        if (!$query_result) {
            die("Database query failed.");
        }
    }

    public function fetch_array($result_set)
    {
        return mysqli_fetch_array($result_set);
    }

    public function get_last_inserted_id()
    {
        // get the last id inserted over the current db connection
        return mysqli_insert_id($this->connection);
    }

    /**
     * * @note that when debugging any UPDATE query here in PhpStorm, the method
     *      $database->get_num_of_affected_rows() will return -1, an erronous
     *      value. But if it's a regular mode (not debugging) it works perfectly.
     *      WEIRD!
     * @return int
     */
    public function get_num_of_affected_rows()
    {
        return mysqli_affected_rows($this->connection);
    }

    public function get_escaped_value($string)
    {
        $escaped_string = mysqli_real_escape_string($this->connection, $string);
        return $escaped_string;
    }

    public function get_num_rows_of_result_set($result_set)
    {
        return mysqli_num_rows($result_set);
    }

    public function get_result_from_query($query)
    {
        $result = mysqli_query($this->connection, $query);
        $this->confirm_query_result($result);
        return $result;
    }
}

// $database = new MySQLDatabase();
