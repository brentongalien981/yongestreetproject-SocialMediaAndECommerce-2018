<?php


namespace App\Controller;

use App\Core\Main\MainController;

class TooManyRequestController extends MainController
{
    public function __construct($menu = null, $action = null)
    {
        parent::__construct($menu, $action);
    }


    /** @override */
    public function index()
    {
        require_once(PUBLIC_PATH . 'too-many-request/index.php');
    }
}
