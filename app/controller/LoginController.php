<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-13
 * Time: 02:52
 */

namespace App\Controller;

use App\Core\Main\MainController;
use App\Model\User;

class LoginController extends MainController
{
    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);
    }

    /** @override */
    protected function setFieldsToBeValidated()
    {

        switch ($this->action) {
            case 'create':
            case 'update':
                $this->validator->fieldsToBeValidated['user_name'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 50,
                    'blank' => 1
                ];
                $this->validator->fieldsToBeValidated['password'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 50,
                    'blank' => 1
                ];
                break;
            case 'read':
                break;
        }
    }


    private function hash_some_text()
    {
//        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
//        $logging_user = User::authenticate_with_user_object_return($user_name, $hashed_password);
    }


    public function create()
    {
        $user_name = $this->sanitizedFields["user_name"];
        $password = $this->sanitizedFields["password"];


        $logging_user = User::authenticate_with_user_object_return($user_name);


        if ($logging_user) {

            // If the user account hasn't been verified yet through email..
            if ((isset($logging_user->signup_token)) &&
                (!is_null($logging_user->signup_token)) &&
                ($logging_user->signup_token != "")) {

                redirect_to(PUBLIC_LOCAL . "unverified-account/index.php");
            }


            //
            $do_passwords_match = password_verify($password, $logging_user->hashed_password);

            if ($do_passwords_match) {
                $this->session->login($logging_user);

                redirect_to(PUBLIC_LOCAL . "index.php");
            } else {
                $log_in_error_comment = "Username/password can not be authenticated.";
                redirect_to(PUBLIC_LOCAL . "log-in/index.php?log_in_error_comment={$log_in_error_comment}");
            }
        } else {
            $log_in_error_comment = "Username/password can not be found.";
            redirect_to(PUBLIC_LOCAL . "log-in/index.php?log_in_error_comment={$log_in_error_comment}");
        }
    }

    /**
     * This is basically the log-out.
     */
    public function delete()
    {
        $this->session->logout();

        redirect_to(PUBLIC_LOCAL . "index.php");
    }
}