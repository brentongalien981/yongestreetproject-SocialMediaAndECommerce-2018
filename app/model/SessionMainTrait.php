<?php

namespace App\Model;

trait SessionMainTrait {

    private $logged_in = false;
    public $actual_user_id = -69;
    public $actual_user_name;
    public $actual_user_type_id;
    public $currently_viewed_user_id;
    public $currently_viewed_user_name;



    public function initMainSessionProps() {
        $this->logged_in = true;
        
        $this->actual_user_id = $_SESSION["actual_user_id"];
        $this->actual_user_name = $_SESSION["actual_user_name"];
        $this->actual_user_type_id = $_SESSION["actual_user_type_id"];

        $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"];
        $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"];

    }


    public function unsetMainSessionProps() {

        $this->logged_in = false;

        // unset($this->id);
        unset($this->actual_user_id);
        unset($this->actual_user_name);
        unset($this->actual_user_type_id);

        unset($this->currently_viewed_user_id);
        unset($this->currently_viewed_user_name);
    }


    public function is_viewing_own_account()
    {
        if (!isset($this->actual_user_id)) {
            return false;
        }

        if ($this->actual_user_id === $this->currently_viewed_user_id) {
            return true;
        } else {
            return false;
        }
    }


    public function is_admin()
    {
        if ($this->actual_user_type_id == 1) {
            return true;
        }
        return false;
    }


    public function is_logged_in()
    {
        return $this->logged_in;
    }


    public static function get_my_static_counter()
    {
        return ++$_SESSION["my_static_counter"];
    }


    public function set_currently_viewed_user($now_currently_viewed_user_id, $now_currently_viewed_user_name)
    {
        $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"] = $now_currently_viewed_user_id;
        $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"] = $now_currently_viewed_user_name;
    }

    public function reset_currently_viewed_user()
    {
        $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"] = $_SESSION["actual_user_id"];
        $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"] = $_SESSION["actual_user_name"];
    }
}