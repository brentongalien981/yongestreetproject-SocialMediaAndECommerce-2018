<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-12
 * Time: 08:59
 */

namespace App\AjaxHandler;

require_once('MainAjaxHandler.php');

//use App\AjaxHandler\MainAjaxHandler;
use App\Controller\SessionController;

class SessionAjaxHandler
{

    /**
     * SessionAjaxHandler constructor.
     */
    public function __construct()
    {
        if (is_request_post() && isset($_POST["update"]) && $_POST["update"] == "yes") {

            /* Validate */
            $allowed_assoc_indexes = ['cart_id'];

            $required_vars_length_array = [
                'cart_id' => ["min" => 1, "max" => 11]
            ];


            //
            $s_controller = new SessionController();

            $s_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
            $s_controller->validator->set_required_post_vars_length_array($required_vars_length_array);



            $is_validation_ok = $s_controller->validator->validate();

            $json_errors_array = $s_controller->validator->get_json_errors_array();


            //
            if ($is_validation_ok) {

                // Prepare the necessary data to pass to the controller.
                // Sanitized vars for passing to the controller.
                $sanitized_vars = array();
                foreach ($allowed_assoc_indexes as $index) {
//                    \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
                    $sanitized_vars[$index] = $_POST[$index];
                }


                // Let the controller handle it.
                $is_update_ok = $s_controller->update($sanitized_vars);

                //
                if ($is_update_ok) {
                    // Everything is ok.
                    $json_errors_array["is_result_ok"] = true;
                }
            }


            // This is to let the user see the errors on their forms.
//    $json_errors_array["form_errors_showable"] = true;
            echo json_encode($json_errors_array);
        }


        else if (isset($_POST['input_currently_viewed_user_id'])) {

            $obj_controller = new SessionController();

            global $session;
            $session->set_currently_viewed_user($_POST['input_currently_viewed_user_id'], $_POST['input_currently_viewed_user_name']);

            echo "1";
        }
    }
}

$the_ajax_handler = new SessionAjaxHandler();