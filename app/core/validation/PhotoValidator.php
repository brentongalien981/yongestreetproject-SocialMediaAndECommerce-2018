<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-08-28
 * Time: 11:21
 */

namespace App\Privado\HelperClasses\Validation;

use App\Publico\Model\MyValidationErrorLogger;


class PhotoValidator extends Validator
{

    private $href = null;
    private $src = null;
    private $width = null;
    private $height = null;
    private $accepted_url_prefixes = array(
        "https://farm5.staticflickr.com/",
        "https://www.flickr.com/photos/"
    );
    private $vars_to_be_prefix_checked = null;

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

        if ($this->vars_to_be_prefix_checked != null) {
            //
            $this->validate_urls();
        }


        $this->set_json_errors_array();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after set_json_errors_array: {$this->can_proceed}");


        $this->finalize_validation();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after finalize_validation: {$this->can_proceed}");


        //
        return $this->can_proceed;
    }





    public static function has_prefix($prefix, $raw)
    {
        $prefix_length = strlen($prefix);
        $raw_prefix = substr($raw, 0, $prefix_length);

        if ($raw_prefix &&
            $prefix == $raw_prefix) {
            return true;
        }

        return false;

    }

    public function set_vars_to_be_prefix_checked($vars_to_be_prefix_checked)
    {
        $this->vars_to_be_prefix_checked = $vars_to_be_prefix_checked;
    }

    private function validate_urls()
    {

        foreach ($this->vars_to_be_prefix_checked as $v) {


            $is_currently_iterated_prefix_safe = false;

            foreach ($this->accepted_url_prefixes as $u) {
                if (self::has_prefix($u, $_POST[$v])) {
                    $is_currently_iterated_prefix_safe = true;
                    break;
                }
            }

            if (!$is_currently_iterated_prefix_safe) {
                MyValidationErrorLogger::log("{$v}::: {$v} is not valid.");
                break;
            }

        }
    }

    /**
     * Note: This is revisioned from the superclass Validator to meet the needs
     *       of this subclass PhotoValidator.
     */
    protected function set_json_errors_array()
    {
        /* Log the errors. */
        // Put to the JSON array the first error for each error type.
        // Here, basically, one $log_error_msg is like:
        //      csrf_token::: not valid
        // So the returned json_error_array will have:
        //      json.error_csrf_token => "* not valid"
        foreach (MyValidationErrorLogger::get_log_array() as $log_error_msg) {
//            MyDebugMessenger::add_debug_message($log_error_msg);
            // Find which field that error is based on "field::: is bad" log_error_msg.
            // $pos = position of :::
            $pos = strpos($log_error_msg, ":::");

            $attr = substr($log_error_msg, 0, $pos);

            $error_field = "error_" . substr($log_error_msg, 0, $pos);


            // If the error_field in the $json_errors_array doesn't have value yet,
            // add the log_error_msg.
            if ($this->json_errors_array[$error_field] == "") {
                $this->json_errors_array[$error_field] = "* " . substr($log_error_msg, $pos + 4);
            }


            // Special scenario for the PhotoValidator's embed_code CRUD create.
            if ($attr == "href" ||
                $attr == "src" ||
                $attr == "width" ||
                $attr == "height") {

                if (!isset($this->json_errors_array['error_embed_code'])) {
                    $this->json_errors_array['error_embed_code'] = "* " . substr($log_error_msg, $pos + 4);
                }
            }

            // Special scenario for the PhotoValidator's embed_code CRUD update.
            if ($attr == "edit_href" ||
                $attr == "edit_src" ||
                $attr == "edit_width" ||
                $attr == "edit_height") {

                if (!isset($this->json_errors_array['error_edit_embed_code'])) {
                    $this->json_errors_array['error_edit_embed_code'] = "* " . substr($log_error_msg, $pos + 4);
                }
            }

        }
    }
}