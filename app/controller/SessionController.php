<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-02
 * Time: 02:58
 */

namespace App\Controller;

use App\Core\Main\MainController;


class SessionController extends MainController
{
    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);
    }

    public function update($data)
    {
        /* Vars. */
        $d = $data;
        global $session;

        /* Which variables to update? */
        if (isset($d["cart_id"])) { $session->set_cart_id($d["cart_id"]); }
        if (isset($d["something_else"])) { $session->set_cart_xx($d["something_else"]); }


        //
        return true;



    }
}