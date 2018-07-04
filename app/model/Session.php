<?php
namespace App\Model;

use App\Core\Main2\Singleton;
use App\Model\User;

class Session extends Singleton
{

    //
    use \App\Core\Main2\LimitedMainModelTrait;
    use \App\Model\SessionDbPropertiesTrait;
    use \App\Model\SessionMainTrait;
    use \App\Model\SessionUnguardedPropsTrait;


    // public $database;
    protected static $instance = null;


    public function __construct()
    {
        $this->check_login();
        $this->initUnguardedProps();
         
        if ($this->logged_in) {
            // actions to take right away if user is logged in
        } else {
            // actions to take right away if user is not logged in
        }
    }



    /** @override */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
            
            // TODO: Change the hard-coded user-id...
            // Refer to the latest session of the user..
            // $pseudoSessionRecord = \App\Core\Main2\MainModel::readByWhereClause(['tableName' => 'Sessions', 'user_id' => 8, 'doNotInstantiate' => true])[0];
            // $sessionRecord = \App\Core\Main2\MainModel::readByWhereClause(['tableName' => 'Sessions', 'user_id' => 8, 'doNotInstantiate' => true])[0];
            
            // static::$instance = static::instantiate($sessionRecord);
            //
            // static::refreshLastRequestDateTimeInDb();
            
            //
            // static::$instance->setUserType(static::$instance->user_type_id);
        }
        return static::$instance;
    }




    public function login($user)
    {
        // database should find user based on username/password

        session_regenerate_id();


        if ($user) {
            $_SESSION["my_static_counter"] = 0;

            $this->actual_user_id = $_SESSION["actual_user_id"] = $user->user_id;
            $this->actual_user_name = $_SESSION["actual_user_name"] = $user->user_name;
            $this->actual_user_type_id = $_SESSION["actual_user_type_id"] = $user->user_type_id;

            $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"] = $user->user_id;
            $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"] = $user->user_name;

            $this->logged_in = true;


            //
            $this->can_now_checkout = $_SESSION["can_now_checkout"] = false;


            //
            $this->set_invoice_id(null);


            //
            $this->set_num_of_notifications(0);


            // Refund.
            $this->refund_invoice_item_id = $_SESSION["refund_invoice_item_id"] = null;
            $this->refund_item_quantity = $_SESSION["refund_item_quantity"] = null;


            // Ad.
            $this->tae = $_SESSION["tae"] = null;
            $this->ad_name = $_SESSION["ad_name"] = null;
            $this->ad_description = $_SESSION["ad_description"] = null;
            $this->ad_photo_url_address = $_SESSION["ad_photo_url_address"] = null;
            $this->ad_target_num_airings = $_SESSION["ad_target_num_airings"] = null;
            $this->ad_budget = $_SESSION["ad_budget"] = null;
            $this->ad_air_time = $_SESSION["ad_air_time"] = null;
            $this->ad_status_id = $_SESSION["ad_status_id"] = null;

            // Chat
            $this->chat_thread_id = $_SESSION["chat_thread_id"] = null;
//            $this->chat_with_user_id = $_SESSION["chat_with_user_id"] = null;
        }
    }



    public function logout()
    {
        unset($_SESSION["actual_user_id"]);
        unset($_SESSION["actual_user_name"]);
        unset($_SESSION["actual_user_type_id"]);

        unset($_SESSION["currently_viewed_user_id"]);
        unset($_SESSION["currently_viewed_user_name"]);

        unset($_SESSION["cart_id"]);
        unset($_SESSION["seller_user_id"]);
        unset($_SESSION["buyer_user_id"]);

        unset($_SESSION["can_now_checkout"]);

        // Shipping vars.
        unset($_SESSION["ship_to_address_id"]);
        unset($_SESSION["ship_to_address_user_id"]);
        unset($_SESSION["ship_to_address_address_type_code"]);
        unset($_SESSION["ship_to_address_street1"]);
        unset($_SESSION["ship_to_address_street2"]);
        unset($_SESSION["ship_to_address_city"]);
        unset($_SESSION["ship_to_address_state"]);
        unset($_SESSION["ship_to_address_zip"]);
        unset($_SESSION["ship_to_address_country_code"]);
        unset($_SESSION["ship_to_address_phone"]);

        // Transaction vars.
        unset($_SESSION["transaction_shipping_charge"]);
        unset($_SESSION["transaction_subtotal"]);
        unset($_SESSION["transaction_sales_tax"]);
        unset($_SESSION["transaction_shipping_fee"]);
        unset($_SESSION["transaction_total"]);

        unset($_SESSION["paypal_transaction_id"]);

        unset($_SESSION["invoice_id"]);

        // Refund.
        unset($_SESSION["refund_invoice_item_id"]);
        unset($_SESSION["refund_item_quantity"]);


        // Ad.
        unset($_SESSION["tae"]);
        unset($_SESSION["ad_name"]);
        unset($_SESSION["ad_description"]);
        unset($_SESSION["ad_photo_url_address"]);
        unset($_SESSION["ad_target_num_airings"]);
        unset($_SESSION["ad_budget"]);
        unset($_SESSION["ad_air_time"]);
        unset($_SESSION["ad_status_id"]);


        // Chat.
        unset($_SESSION["chat_thread_id"]);
//        unset($_SESSION["chat_with_user_id"]);


        unset($this->actual_user_id);
        unset($this->actual_user_name);
        unset($this->actual_user_type_id);

        unset($this->currently_viewed_user_id);
        unset($this->currently_viewed_user_name);

        unset($this->cart_id);
        unset($this->seller_user_id);
        unset($this->buyer_user_id);
//
        unset($this->ship_to_address_obj);

        unset($this->can_now_checkout);

        // Shipping vars.
        unset($this->ship_to_address_id);
        unset($this->ship_to_address_user_id);
        unset($this->ship_to_address_address_type_code);
        unset($this->ship_to_address_street1);
        unset($this->ship_to_address_street2);
        unset($this->ship_to_address_city);
        unset($this->ship_to_address_state);
        unset($this->ship_to_address_zip);
        unset($this->ship_to_address_country_code);
        unset($this->ship_to_address_phone);


        unset($this->transaction_shipping_charge);
        unset($this->transaction_subtotal);
        unset($this->transaction_sales_tax);
        unset($this->transaction_shipping_fee);
        unset($this->transaction_total);

        unset($this->paypal_transaction_id);


        unset($this->invoice_id);


        // Refund.
        unset($this->refund_invoice_item_id);
        unset($this->refund_item_quantity);


        // Ad.
        unset($this->tae);
        unset($this->ad_name);
        unset($this->ad_description);
        unset($this->ad_photo_url_address);
        unset($this->ad_target_num_airings);
        unset($this->ad_budget);
        unset($this->ad_air_time);
        unset($this->ad_status_id);

        // Chat.
        unset($this->chat_thread_id);
//        unset($this->chat_with_user_id);


        $this->logged_in = false;
        session_unset();
        session_destroy();
    }



    private function check_login()
    {
        if (isset($_SESSION["actual_user_id"])) {
            $this->initMainSessionProps();
        } else {
            $this->unsetMainSessionProps();
        }
    }
}
