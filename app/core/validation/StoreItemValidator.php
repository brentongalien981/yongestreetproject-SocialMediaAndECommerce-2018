<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-31
 * Time: 04:56
 */

namespace App\Privado\HelperClasses\Validation;


class StoreItemValidator extends Validator
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @override
     * @return bool
     */
    public function validate()
    {
        $this->validate_csrf_token();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after validate_csrf: {$this->can_proceed}");


        if ($this->can_proceed) {
            $this->check_required_post_vars_existence();
            \MyDebugMessenger::add_debug_message("\$this->can_proceed after check_required_existence: {$this->can_proceed}");
        }


        if ($this->can_proceed) {
            $this->validate_white_space();
            \MyDebugMessenger::add_debug_message("\$this->can_proceed after validate_whitespace: {$this->can_proceed}");
        }


//        if ($this->can_proceed) {
//            $this->validate_length();
//            \MyDebugMessenger::add_debug_message("\$this->can_proceed after validate_length: {$this->can_proceed}");
//        }uki3
        $this->validate_length();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after validate_length: {$this->can_proceed}");


        if ($this->user_detail_types != null) {
            $this->validate_user_detail_types();
        }


        if ($this->formats != null) {
            //
            $this->validate_formats();
        }


        if ($this->validate_email) {
            //
            $this->validate_email_format();
        }


        if ($this->vars_to_be_unique_checked != null) {
            //
            $this->validate_uniqueness();
        }

        if ($this->vars_to_be_number_uniformly_checked != null) {
            //
            $this->validate_number_uniformity();
        }

        if ($this->vars_to_be_of_decimal_value_checked != null) {
            //
            $this->validate_of_decimal_value();
        }

        if ($this->vars_to_be_of_min_value_checked != null) {
            //
            $this->validate_of_min_value();
        }

//        if ($this->vars_to_be_prefix_checked != null) {
//            //
//            $this->validate_urls();
//        }


        $this->set_json_errors_array();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after set_json_errors_array: {$this->can_proceed}");


        $this->finalize_validation();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after finalize_validation: {$this->can_proceed}");


        //
        return $this->can_proceed;
    }
}