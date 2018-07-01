<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-03
 * Time: 12:30
 */

namespace App\Privado\HelperClasses\Validation;

use App\Publico\Model\MyValidationErrorLogger;


class RateableItemValidator extends Validator
{
    public $items_to_be_length_validated = null;
    public $items_to_be_length_validated_limits = null;
    public $values_to_be_number_uniformly_checked = null;

    function __construct()
    {
        parent::__construct();
    }

    private function validate_items_length_in_array()
    {
        //

        if (!isset($this->items_to_be_length_validated)) {
            return;
        }

        foreach ($this->items_to_be_length_validated as $item) {
            $is_length_valid = has_length($item, $this->items_to_be_length_validated_limits);

            if (!$is_length_valid) {
                MyValidationErrorLogger::log("post_ids::: post_ids one value exceeds the limit.");
                return false;
            }
        }

        return true;

    }

    public function extra_validate()
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

        $this->validate_items_length_in_array();


        $this->validate_values_number_uniformity();


        $this->set_json_errors_array();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after set_json_errors_array: {$this->can_proceed}");


        $this->finalize_validation();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after finalize_validation: {$this->can_proceed}");


        //
        return $this->can_proceed;
    }

    private function validate_values_number_uniformity()
    {
        if (!isset($this->values_to_be_number_uniformly_checked)) {
            return;
        }

        foreach ($this->values_to_be_number_uniformly_checked as $v) {
            if (!self::is_uniformly_numeric($v)) {
                MyValidationErrorLogger::log("{post_ids}::: {$v} is not a valid number.");
//                return false;
            }
        }
    }
}