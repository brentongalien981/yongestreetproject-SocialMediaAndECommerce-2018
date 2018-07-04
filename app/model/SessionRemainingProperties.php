<?php
class SessionRemainingProperties
{
    public $cart_id;
    public $user_id;
    public $seller_user_id;
    public $buyer_user_id;
    private $cart;

//    private $ship_to_address_obj;
    // Vars for shipping.
    public $ship_to_address_id;
    public $ship_to_address_user_id;
    public $ship_to_address_address_type_code;
    public $ship_to_address_street1;
    public $ship_to_address_street2;
    public $ship_to_address_city;
    public $ship_to_address_state;
    public $ship_to_address_zip;
    public $ship_to_address_country_code;
    public $ship_to_address_phone;
    // Transaction vars.
    public $transaction_shipping_charge;
    public $transaction_subtotal;
    public $transaction_sales_tax;
    public $transaction_shipping_fee;
    public $transaction_total;
    public $paypal_transaction_id;
    //
    private $can_now_checkout;
    // Invoice.
    public $invoice_id;
    // Notifications.
    public $num_of_notifications;
    // Refund.
    public $refund_invoice_item_id;
    public $refund_item_quantity;
    // Ad
    public $tae;
    public $ad_name;
    public $ad_description;
    public $ad_photo_url_address;
    public $ad_target_num_airings;
    public $ad_budget;
    public $ad_air_time;
    public $ad_status_id;
    // Chat
    public $chat_thread_id;



    private function TODO_REMAINING_CONTENTS_OF_FUNC_check_login()
    {
        // Start
        if ($_SESSION["actual_user_id"]) {
            if (isset($_SESSION["ship_to_address_id"])) {
                $this->ship_to_address_id = $_SESSION["ship_to_address_id"];
            }
    
            
    
            if (isset($_SESSION["cart_id"])) {
                $this->cart_id = $_SESSION["cart_id"];
            }
    
            if (isset($_SESSION["seller_user_id"])) {
                $this->seller_user_id = $_SESSION["seller_user_id"];
            }
    
            if (isset($_SESSION["buyer_user_id"])) {
                $this->buyer_user_id = $_SESSION["buyer_user_id"];
            }
    
    
    
    
            // For shipping vars.
            if (isset($_SESSION["ship_to_address_idzZzZz"])) {
                $this->ship_to_address_id = $_SESSION["ship_to_address_id"];
                $this->ship_to_address_user_id = $_SESSION["ship_to_address_user_id"];
                $this->ship_to_address_address_type_code = $_SESSION["ship_to_address_address_type_code"];
                $this->ship_to_address_street1 = $_SESSION["ship_to_address_street1"];
                $this->ship_to_address_street2 = $_SESSION["ship_to_address_street2"];
                $this->ship_to_address_city = $_SESSION["ship_to_address_city"];
                $this->ship_to_address_state = $_SESSION["ship_to_address_state"];
                $this->ship_to_address_zip = $_SESSION["ship_to_address_zip"];
                $this->ship_to_address_country_code = $_SESSION["ship_to_address_country_code"];
                $this->ship_to_address_phone = $_SESSION["ship_to_address_phone"];
            
                //
                $this->can_now_checkout = $_SESSION["can_now_checkout"];
            }
            
            
            // For transcation vars.
            if (isset($_SESSION["transaction_total"])) {
                //                $this->transaction_shipping_charge = $_SESSION["transaction_shipping_charge"];
            
                $this->set_transaction_subtotal($_SESSION["transaction_subtotal"]);
                $this->set_transaction_sales_tax($_SESSION["transaction_sales_tax"]);
                $this->set_transaction_shipping_fee($_SESSION["transaction_shipping_fee"]);
                $this->set_transaction_total($_SESSION["transaction_total"]);
            }
            
            
            if (isset($_SESSION["paypal_transaction_id"])) {
                $this->set_paypal_transaction_id($_SESSION["paypal_transaction_id"]);
            }
            
            
            // For invoice.
            if (isset($_SESSION["invoice_id"])) {
                $this->set_invoice_id($_SESSION["invoice_id"]);
            }
            
            
            // For notifications.
            if (isset($_SESSION["num_of_notifications"])) {
                $this->num_of_notifications = $_SESSION["num_of_notifications"];
            }
            
            
            // For refunds.
            if (isset($_SESSION["refund_invoice_item_id"])) {
                $this->refund_invoice_item_id = $_SESSION["refund_invoice_item_id"];
                $this->refund_item_quantity = $_SESSION["refund_item_quantity"];
            }
            
            
            // Ad.
            if (isset($_SESSION["ad_name"])) {
                $this->tae = $_SESSION["tae"];
                $this->ad_name = $_SESSION["ad_name"];
                $this->ad_description = $_SESSION["ad_description"];
                $this->ad_photo_url_address = $_SESSION["ad_photo_url_address"];
                $this->ad_target_num_airings = $_SESSION["ad_target_num_airings"];
                $this->ad_budget = $_SESSION["ad_budget"];
                $this->ad_air_time = $_SESSION["ad_air_time"];
                $this->ad_status_id = $_SESSION["ad_status_id"];
            }
            
            // Chat.
            if (isset($_SESSION["chat_thread_id"])) {
                $this->chat_thread_id = $_SESSION["chat_thread_id"];
                //                $this->chat_with_user_id = $_SESSION["chat_with_user_id"];
            }
        } else {
            unset($this->cart_id);
            unset($this->seller_user_id);
            unset($this->buyer_user_id);

            // TODO: REMINDER: Don't forget to unset the shipping vars.
            // TODO: REMINDER: Don't forget to unset the transaction vars.
            // TODO: REMINDER: Don't forget to unset the $_SESSION["paypal_transaction_id"].
            unset($this->can_now_checkout);


            unset($this->num_of_notifications);

            // Ad
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
//            unset($this->chat_with_user_id);
        }
    }





    public function set_can_now_checkout($what)
    {
        $this->can_now_checkout = $_SESSION["can_now_checkout"] = $what;
    }

    public function set_invoice_id($new_invoice_id)
    {
        $this->invoice_id = $_SESSION["invoice_id"] = $new_invoice_id;
    }

    public function set_refund_invoice_item_id($id)
    {
        $this->refund_invoice_item_id = $_SESSION["refund_invoice_item_id"] = $id;
    }


    public function set_transaction_subtotal($val)
    {
        $this->transaction_subtotal = $_SESSION["transaction_subtotal"] = $val;
    }


    public function set_transaction_sales_tax($val)
    {
        $this->transaction_sales_tax = $_SESSION["transaction_sales_tax"] = $val;
    }

    public function set_transaction_total($val)
    {
        $this->transaction_total = $_SESSION["transaction_total"] = $val;
    }


    public function set_transaction_shipping_fee($val)
    {
        $this->transaction_shipping_fee = $_SESSION["transaction_shipping_fee"] = $val;
    }


    public function set_refund_item_quantity($quantity)
    {
        $this->refund_item_quantity = $_SESSION["refund_item_quantity"] = $quantity;
    }


    public function set_chat_thread_id($chat_thread_id)
    {
        $this->chat_thread_id = $_SESSION["chat_thread_id"] = $chat_thread_id;
    }


    public function set_ad_name($ad_name)
    {
        $this->ad_name = $_SESSION["ad_name"] = $ad_name;
    }

    public function set_ad_description($ad_description)
    {
        $this->ad_description = $_SESSION["ad_description"] = $ad_description;
    }

    public function set_ad_photo_url_address($ad_photo_url_address)
    {
        $this->ad_photo_url_address = $_SESSION["ad_photo_url_address"] = $ad_photo_url_address;
    }

    public function set_ad_target_num_airings($ad_target_num_airings)
    {
        $this->ad_target_num_airings = $_SESSION["ad_target_num_airings"] = $ad_target_num_airings;
    }

    public function set_ad_budget($ad_budget)
    {
        $this->ad_budget = $_SESSION["ad_budget"] = $ad_budget;
    }

    public function set_ad_air_time($ad_air_time)
    {
        $this->ad_air_time = $_SESSION["ad_air_time"] = $ad_air_time;
    }

    public function set_ad_status_id($ad_status_id)
    {
        $this->ad_status_id = $_SESSION["ad_status_id"] = $ad_status_id;
    }

    public function get_can_now_checkout()
    {
        return $this->can_now_checkout;
    }

    public static function get_my_static_counter()
    {
        return ++$_SESSION["my_static_counter"];
    }


    public function set_cart_id($cart_id)
    {
        $this->cart_id = $_SESSION["cart_id"] = $cart_id;
    }

    public function set_ship_to_address_id($id)
    {
        if ($this->is_logged_in()) {
            $this->ship_to_address_id = $_SESSION["ship_to_address_id"] = $id;
        }
    }

    public function set_ship_to_address_vars($address_obj)
    {
        if ($this->is_logged_in()) {
            $this->ship_to_address_id = $_SESSION["ship_to_address_id"] = $address_obj->id;
            $this->ship_to_address_user_id = $_SESSION["ship_to_address_user_id"] = $address_obj->user_id;
            $this->ship_to_address_address_type_code = $_SESSION["ship_to_address_address_type_code"] = $address_obj->address_type_code;
            $this->ship_to_address_street1 = $_SESSION["ship_to_address_street1"] = $address_obj->street1;
            $this->ship_to_address_street2 = $_SESSION["ship_to_address_street2"] = $address_obj->street2;
            $this->ship_to_address_city = $_SESSION["ship_to_address_city"] = $address_obj->city;
            $this->ship_to_address_state = $_SESSION["ship_to_address_state"] = $address_obj->state;
            $this->ship_to_address_zip = $_SESSION["ship_to_address_zip"] = $address_obj->zip;
            $this->ship_to_address_country_code = $_SESSION["ship_to_address_country_code"] = $address_obj->country_code;
            $this->ship_to_address_phone = $_SESSION["ship_to_address_phone"] = $address_obj->phone;
        }
    }

    public function initialize_ship_to_address_vars()
    {
        if ($this->is_logged_in()) {
//            $a_ship_to_address_obj = (Address);
            // Default values.
            // user_id of user "UserForOneTimeAddresses123 is 14".
            $one_time_user_id = 14;
            $one_time_address_type_code = 3;

            $this->ship_to_address_id = $_SESSION["ship_to_address_id"] = null;
            $this->ship_to_address_user_id = $_SESSION["ship_to_address_user_id"] = $one_time_user_id;
            $this->ship_to_address_address_type_code = $_SESSION["ship_to_address_address_type_code"] = $one_time_address_type_code;
            $this->ship_to_address_street1 = $_SESSION["ship_to_address_street1"] = "";
            $this->ship_to_address_street2 = $_SESSION["ship_to_address_street2"] = "";
            $this->ship_to_address_city = $_SESSION["ship_to_address_city"] = "";
            $this->ship_to_address_state = $_SESSION["ship_to_address_state"] = "";
            $this->ship_to_address_zip = $_SESSION["ship_to_address_zip"] = "";
            $this->ship_to_address_country_code = $_SESSION["ship_to_address_country_code"] = "";
            $this->ship_to_address_phone = $_SESSION["ship_to_address_phone"] = "";
        }
    }







    public function set_num_of_notifications($num_of_new_notifications)
    {
        $this->num_of_notifications = $_SESSION["num_of_notifications"] = $num_of_new_notifications;
    }

   

    public function set_paypal_transaction_id($paypal_transaction_id)
    {
        $this->paypal_transaction_id = $_SESSION["paypal_transaction_id"] = $paypal_transaction_id;
    }
}
